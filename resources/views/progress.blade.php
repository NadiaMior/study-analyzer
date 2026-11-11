<x-app-layout>
    <div class="py-8 bg-[#F8F9FA] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-1">YOUR PROGRESS</p>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Keep going ✨</h1>
                <p class="text-gray-500 mt-2">Look at how far you've come.</p>
            </div>

            <!-- Kad Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <!-- Kad 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mb-4 text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Studied today</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ round($totalMinutesToday) }} <span class="text-sm text-gray-400 font-normal">min</span></h3>
                    <p class="text-xs text-gray-400 mt-2">of your 120 min daily goal</p>
                </div>

                <!-- Kad 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center mb-4 text-purple-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total sessions</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $sessions->count() }} <span class="text-sm text-gray-400 font-normal">sessions</span></h3>
                    <p class="text-xs text-gray-400 mt-2">Keep the momentum going.</p>
                </div>
            </div>

            <!-- Senarai Sejarah -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h4 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">RECENT SESSIONS</h4>
                
                @if($sessions->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-500">No completed sessions yet. Start your first session today!</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($sessions as $session)
                            <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                                <div>
                                    <h5 class="font-bold text-gray-800 text-lg">{{ $session->subject }}</h5>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($session->started_at)->format('M d, Y - h:i A') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-sm">
                                        {{ round($session->elapsed_seconds / 60) }} min
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>