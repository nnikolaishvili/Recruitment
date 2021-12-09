<?php

namespace App\Http\Controllers;

use App\Http\Requests\Candidate\{SearchRequest, StatusChangeRequest, StoreRequest};
use App\Models\{Candidate, CandidateSkill, HiringStatus, Position, Seniority, Skill};
use App\Traits\FileUploadingTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Cache, DB, Response};
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CandidateController extends Controller
{
    use FileUploadingTrait;

    /**
     * Candidates list
     *
     * @param SearchRequest $request
     * @return View
     */
    public function index(SearchRequest $request): View
    {
        $validated = $request->validated();
        $searchValue = $validated['search'] ?? '';
        $candidates = Candidate::with(['seniority', 'hiringStatus', 'skills'])
            ->search($searchValue)
            ->orderByDesc('id')
            ->paginate(Candidate::ITEMS_PER_PAGE)
            ->appends(['search' => $searchValue]);

        return view('candidates.index', [
            'candidates' => $candidates,
            'searchValue' => $searchValue
        ]);
    }

    /**
     * Candidate create view
     *
     * @return View
     */
    public function create(): View
    {
        return view('candidates.create', [
            'positions' => Cache::getOrSet('positions', Position::class),
            'seniorities' => Cache::getOrSet('seniorities', Seniority::class),
            'skills' => Cache::getOrSet('skills', Skill::class)
        ]);
    }

    /**
     * Store Candidate
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (isset($validated['cv'])) {
            $validated['cv_url'] = 'storage/' . $this->uploadCv($validated['cv']);
        }

        $candidate = Candidate::create($validated);

        if (isset($validated['skills'])) {
            //  attach() method runs separate queries in DB for each skill, whereas insert() runs 1 query
            //  $candidate->skills()->attach($skills);
            $skills = [];
            foreach ($validated['skills'] as $skill) {
                $skills[] = [
                    'candidate_id' => $candidate->id,
                    'skill_id' => $skill,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            CandidateSkill::insert($skills);
        }

        return redirect()->route('candidates.index');
    }

    /**
     * Candidate edit view
     *
     * @param Candidate $candidate
     * @return View
     */
    public function edit(Candidate $candidate): View
    {
        return view('candidates.edit', [
            'candidate' => $candidate->load('position'),
            'statuses' => Cache::getOrSet('hiring-statuses', HiringStatus::class),
            'candidateStatuses' => $candidate->hiringStatuses()
                ->orderByDesc('pivot_created_at')
                ->paginate(HiringStatus::ITEMS_PER_PAGE)
        ]);
    }

    /**
     * Download CV
     *
     * @param Candidate $candidate
     * @return BinaryFileResponse|RedirectResponse
     */
    public function downloadCv(Candidate $candidate): BinaryFileResponse|RedirectResponse
    {
        return Response::download(public_path($candidate->cv_url));
    }

    /**
     * Update status
     *
     * @param Candidate $candidate
     * @param StatusChangeRequest $request
     * @return RedirectResponse
     */
    public function updateStatus(Candidate $candidate, StatusChangeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['hiring_status_id'] === $candidate->hiring_status_id) {
            return back()->withErrors(['current' => 'The selected status is the current one']);
        }

        DB::transaction(function () use ($validated, $candidate) {
            $candidate->update([
                'hiring_status_id' => $validated['hiring_status_id']
            ]);

            $candidate->hiringStatuses()
                ->attach($validated['hiring_status_id'], ['comment' => $validated['comment']]);
        });

        return redirect()->back();
    }

    /**
     * Soft delete candidate
     *
     * @param Candidate $candidate
     * @return RedirectResponse
     */
    public function destroy(Candidate $candidate): RedirectResponse
    {
        $candidate->delete();

        return redirect()->route('candidates.index');
    }
}
