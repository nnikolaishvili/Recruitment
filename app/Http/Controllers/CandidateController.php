<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateStoreRequest;
use App\Models\Candidate;
use App\Models\HiringStatus;
use App\Models\Position;
use App\Models\Seniority;
use App\Models\Skill;
use App\Traits\FileUploadingTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
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
        $candidates = Candidate::with(['seniority', 'hiringStatus', 'skills'])
            ->orderByDesc('id')
            ->paginate(10);

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
     * @param CandidateStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CandidateStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['hiring_status_id'] = HiringStatus::INITIAL;

        if (isset($validated['cv'])) {
            $validated['cv_url'] = 'storage/' . $this->uploadPdf($validated['cv']);
        }

        $candidate = Candidate::create($validated);

        if (isset($validated['skills'])) {
            $candidate->skills()->attach($validated['skills']);
        }

        return redirect()->route('candidates');
    }

    /**
     * Candidate edit view
     *
     * @param Candidate $candidate
     * @return View
     */
    public function edit(Candidate $candidate): View
    {
        return view('candidates.edit', compact('candidate'));
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
}
