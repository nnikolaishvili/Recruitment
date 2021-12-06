<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\Seniority;
use App\Models\Skill;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('position')->get();

        return view('candidates.index', compact('candidates'));
    }

    public function create()
    {
        $positions = Position::pluck('name', 'id')->toArray();
        $seniorities = Seniority::pluck('name', 'id')->toArray();
        $skills = Skill::pluck('name', 'id')->toArray();

        return view('candidates.create', [
            'positions' => $positions,
            'seniorities' => $seniorities,
            'skills' => $skills
        ]);
    }

    public function store(Request $request)
    {
        //
    }
}
