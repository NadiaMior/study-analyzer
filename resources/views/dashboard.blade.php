<x-app-layout>
    <div class="py-8 bg-[#F8F9FA] min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header: Welcome Text -->
            <div class="mb-8">
                <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-1">
                    {{ now()->format('l, F j') }}
                </p>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Welcome back, {{ Auth::user()->name }} ✨</h1>
                <p class="text-gray-500 mt-2">Make today count.</p>
            </div>

            <!-- Grid Kad -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                
                <!-- Kad 1: Daily Goal -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mb-4 text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Daily goal</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ round($studiedToday) }} <span class="text-sm text-gray-400 font-normal">/ 120 min</span></h3>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-4">
                        <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ min(100, ($studiedToday / 120) * 100) }}%"></div>
                    </div>
                </div>

                <!-- Kad 2: Study Streak -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center mb-4 text-yellow-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Study streak</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $streak }} <span class="text-sm text-gray-400 font-normal">days</span></h3>
                    <p class="text-xs text-gray-400 mt-4">Finish a session today to start a streak.</p>
                </div>

                <!-- Kad 3: 7-day average -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                     <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center mb-4 text-purple-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">7-day daily average</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ round($weeklyAverage) }} <span class="text-sm text-gray-400 font-normal">min</span></h3>
                    <p class="text-xs text-gray-400 mt-4">A little progress adds up.</p>
                </div>

                <!-- Kad 4: Suggestion -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4 text-blue-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Today's suggestion</p>
                    <h3 class="text-2xl font-bold text-gray-900">25 <span class="text-sm text-gray-400 font-normal">min</span></h3>
                    <p class="text-xs text-gray-400 mt-2">Start with a focused 25-minute session.</p>
                </div>

            </div>

            <!-- Bahagian Bawah: Ready when you are -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-2">READY WHEN YOU ARE</h4>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Make room for focus</h2>
                <p class="text-gray-500 mb-6 max-w-md">Your next study session is only a tap away. Pick a subject and start with a fresh, focused session.</p>
                <a href="{{ route('timer') }}" class="inline-block bg-black hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-xl transition duration-200">
                    Open study timer &rarr;
                </a>
             <!-- Butang Log Out -->
            <div class="mt-12 text-center pb-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-400 hover:text-red-500 font-medium transition">
                        Log Out
                    </button>
                </form>
            </div>
            </div>

        </div>
    </div>
</x-app-layout>