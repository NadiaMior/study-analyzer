<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyPlan;

class StudyPlannerController extends Controller
{
    public function index()
    {
        // Ambil semua plan pengguna, susun ikut tarikh
        $plans = StudyPlan::where('user_id', auth()->id())
                    ->orderBy('plan_date', 'asc')
                    ->orderBy('plan_time', 'asc')
                    ->get();
                    
        return view('planner', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'notes' => 'nullable|string|max:500',
            'plan_date' => 'required|date',
            'plan_time' => 'nullable',
        ]);

        StudyPlan::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'notes' => $request->notes ?? '',
            'plan_date' => $request->plan_date,
            'plan_time' => $request->plan_time,
        ]);

        return redirect()->back()->with('success', 'Rancangan berjaya disimpan!');
    }
}