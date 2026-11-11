<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession;

class StudyTimerController extends Controller
{
    public function start(Request $request)
    {
        $activeSession = StudySession::where('user_id', auth()->id())
                            ->where('status', 'running')
                            ->first();

        if ($activeSession) {
            // Bila timer tamat atau tekan finish
            $activeSession->update([
                'status' => 'completed',
                'elapsed_seconds' => $activeSession->planned_seconds, 
                'ended_at' => now(),
                'running_since' => null,
            ]);

            // Terus pergi ke page Progress
            return redirect()->route('progress')->with('success', 'Sesi tamat! Syabas!');
        }

        $request->validate([
            'subject' => 'required|string|max:100',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        StudySession::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'planned_seconds' => $request->duration_minutes * 60,
            'status' => 'running',
            'started_at' => now(),
            'running_since' => now(),
        ]);

        return redirect()->back()->with('success', 'Sesi bermula!');
    }
}