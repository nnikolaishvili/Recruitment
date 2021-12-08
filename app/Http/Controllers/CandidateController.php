<?php

namespace App\Http\Controllers;

use App\Http\Requests\Candidate\{StatusChangeRequest, StoreRequest};
use App\Models\{Candidate, CandidateSkill, HiringStatus, Position, Seniority, Skill};
use App\Traits\FileUploadingTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{DB, Response};
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CandidateController extends Controller
{
    use FileUploadingTrait;

    /**
     * Candidates list
     *
     * @return View
     */
    public function index(): View
    {
        $candidates = Candidate::with(['seniority', 'hiringStatus', 'skills'])->orderByDesc('id')->paginate(10);

        return view('candidates.index', compact('candidates'));
    }

    /**
     * Candidate create view
     *
     * @return View
     */
    public function create(): View
    {
        return view('candidates.create', [
            'positions' => Position::pluck('name', 'id')->toArray(),
            'seniorities' => Seniority::pluck('name', 'id')->toArray(),
            'skills' => Skill::pluck('name', 'id')->toArray()
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
        $validated['hiring_status_id'] = HiringStatus::INITIAL;

        if (isset($validated['cv'])) {
            $validated['cv_url'] = 'storage/' . $this->uploadPdf($validated['cv']);
        }

        $candidate = Candidate::create($validated);

        if (isset($validated['skills'])) {
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
        $candidate = $candidate->load(['hiringStatuses', 'position']);
        $candidateStatuses = $candidate->hiringStatuses();

        return view('candidates.edit', [
            'candidate' => $candidate,
            'statuses' => HiringStatus::pluck('name', 'id')->toArray(),
            'candidateStatusesCount' => $candidateStatuses->count(),
            'candidateStatuses' => $candidateStatuses->orderByDesc('pivot_created_at')->paginate(10)
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

        if ($validated['hiring_status_id'] == $candidate->hiring_status_id) {
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
