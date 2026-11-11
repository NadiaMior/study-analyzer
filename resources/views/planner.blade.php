<x-app-layout>
    <div class="py-8 bg-[#F8F9FA] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-1">YOUR PLANNER</p>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Make a plan ✨</h1>
                <p class="text-gray-500 mt-2">Set your targets and crush them.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Borang Tambah Plan -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 md:col-span-1 h-fit">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Add New Plan</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-2 rounded mb-3 text-sm text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('planner.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject / Title</label>
                            <input type="text" name="title" required placeholder="e.g. Review Math" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-2 border">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" name="plan_date" required value="{{ date('Y-m-d') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-2 border">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Time (Optional)</label>
                            <input type="time" name="plan_time" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-2 border">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                            <textarea name="notes" rows="3" placeholder="What to cover?" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-2 border"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-xl transition">
                            Save Plan
                        </button>
                    </form>
                </div>

                <!-- Senarai Plan -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 md:col-span-2">
                    <h4 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">UPCOMING STUDY PLANS</h4>
                    
                    @if($plans->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500">No upcoming study plans. Add something to your calendar to get started.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($plans as $plan)
                                <div class="flex items-start space-x-4 border-b border-gray-100 pb-4">
                                    <div class="flex-shrink-0 bg-green-50 text-green-600 rounded-lg p-3 text-center min-w-[70px]">
                                        <span class="block text-xs font-bold uppercase">{{ \Carbon\Carbon::parse($plan->plan_date)->format('M') }}</span>
                                        <span class="block text-xl font-extrabold">{{ \Carbon\Carbon::parse($plan->plan_date)->format('d') }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-bold text-gray-900 text-lg">{{ $plan->title }}</h5>
                                        @if($plan->plan_time)
                                            <p class="text-sm text-gray-500">At {{ \Carbon\Carbon::parse($plan->plan_time)->format('h:i A') }}</p>
                                        @endif
                                        @if($plan->notes)
                                            <p class="text-sm text-gray-500 mt-1">{{ $plan->notes }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>