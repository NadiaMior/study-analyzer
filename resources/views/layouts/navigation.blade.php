<nav class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-50">
    <div class="max-w-md mx-auto flex justify-around items-center py-3 px-2">
        
        <!-- Home -->
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-16 text-gray-500 hover:text-green-600 transition-colors {{ request()->routeIs('dashboard') ? 'text-green-600' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="text-[10px] font-medium {{ request()->routeIs('dashboard') ? 'font-bold' : '' }}">Home</span>
        </a>

        <!-- Timer -->
        <a href="{{ route('timer') }}" class="flex flex-col items-center justify-center w-16 text-gray-500 hover:text-green-600 transition-colors {{ request()->routeIs('timer') ? 'text-green-600' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[10px] font-medium {{ request()->routeIs('timer') ? 'font-bold' : '' }}">Timer</span>
        </a>

        <!-- Progress -->
        <a href="{{ route('progress') }}" class="flex flex-col items-center justify-center w-16 text-gray-500 hover:text-green-600 transition-colors {{ request()->routeIs('progress') ? 'text-green-600' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            <span class="text-[10px] font-medium {{ request()->routeIs('progress') ? 'font-bold' : '' }}">Progress</span>
        </a>

        <!-- Planner -->
        <a href="{{ route('planner') }}" class="flex flex-col items-center justify-center w-16 text-gray-500 hover:text-green-600 transition-colors {{ request()->routeIs('planner') ? 'text-green-600' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-[10px] font-medium {{ request()->routeIs('planner') ? 'font-bold' : '' }}">Planner</span>
        </a>

        <!-- AI Chat -->
        <a href="{{ route('ai-chat') }}" class="flex flex-col items-center justify-center w-16 text-gray-500 hover:text-green-600 transition-colors {{ request()->routeIs('ai-chat') ? 'text-green-600' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            <span class="text-[10px] font-medium {{ request()->routeIs('ai-chat') ? 'font-bold' : '' }}">AI Chat</span>
        </a>

    </div>
</nav>