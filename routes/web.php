<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard'); 
});

Route::get('/dashboard', function () {
    // 1. Ambil semua sesi belajar yang dah siap
    $sessions = \App\Models\StudySession::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->get();

    // 2. Kira jumlah minit belajar HARI INI
    $studiedToday = $sessions->where('started_at', '>=', now()->startOfDay())
                             ->sum('elapsed_seconds') / 60;

    // 3. Kira purata 7 hari lepas
    $weeklyAverage = $sessions->where('started_at', '>=', now()->subDays(7))
                              ->sum('elapsed_seconds') / 60 / 7;

    // 4. Kira streak (hari unik belajar)
    $streak = $sessions->groupBy(function($date) {
        return \Carbon\Carbon::parse($date->started_at)->format('Y-m-d');
    })->count();

    return view('dashboard', compact('studiedToday', 'weeklyAverage', 'streak'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/timer', function () { return view('timer'); })->name('timer');
    
    Route::get('/progress', function () {
        $sessions = \App\Models\StudySession::where('user_id', auth()->id())
                    ->where('status', 'completed')
                    ->orderBy('started_at', 'desc')
                    ->get();

        $totalMinutesToday = $sessions->where('started_at', '>=', now()->startOfDay())
                                      ->sum('elapsed_seconds') / 60;

        return view('progress', compact('sessions', 'totalMinutesToday'));
    })->name('progress');

        // Planner
    Route::get('/planner', [App\Http\Controllers\StudyPlannerController::class, 'index'])->name('planner');
    Route::post('/planner', [App\Http\Controllers\StudyPlannerController::class, 'store'])->name('planner.store');
    Route::get('/ai-chat', function () { return view('ai-chat'); })->name('ai-chat');

    // Laluan untuk Start Timer
    Route::post('/timer/start', [App\Http\Controllers\StudyTimerController::class, 'start'])->name('timer.start');
    
    // Laluan untuk Finish Timer (Ini yang penting untuk butang finish tadi)
        Route::post('/timer/finish', function (\Illuminate\Http\Request $request) {
        $activeSession = \App\Models\StudySession::where('user_id', auth()->id())
                            ->where('status', 'running')
                            ->first();

        if ($activeSession) {
            $activeSession->update([
                'status' => 'completed',
                'elapsed_seconds' => $activeSession->planned_seconds, 
                'ended_at' => now(),
                'running_since' => null,
            ]);
        } else {
            \App\Models\StudySession::create([
                'user_id' => auth()->id(),
                'subject' => $request->subject ?? 'Study Session',
                'planned_seconds' => 60,
                'elapsed_seconds' => 60,
                'status' => 'completed',
                'started_at' => now()->subMinute(),
                'ended_at' => now(),
            ]);
        }
        
        return redirect()->route('progress')->with('success', 'Sesi tamat! Syabas!');
    })->name('timer.finish');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';