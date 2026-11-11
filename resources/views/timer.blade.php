<x-app-layout>
    <div class="min-h-screen bg-[#F8F9FA] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
            
            <div class="text-center">
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900">Study Timer</h2>
                <p class="mt-2 text-sm text-gray-500">Time to focus</p>
            </div>

            <!-- Paparan Timer -->
            <div class="text-center my-10">
                <div id="timer-display" class="text-7xl font-bold text-green-800 tracking-tighter">
                    25:00
                </div>
            </div>

            <!-- Borang Mula -->
            <form id="start-form" action="{{ route('timer.start') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">What are you working on?</label>
                    <input type="text" name="subject" required placeholder="e.g. Biology, Chapter 4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-3 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Focus duration (minutes)</label>
                    <input type="number" name="duration_minutes" id="duration-input" value="25" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-3 border">
                </div>
                <button type="button" onclick="startTimer()" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                    Start Session
                </button>
            </form>

           <!-- Bahagian Timer Berjalan (Tersembunyi) -->
            <div id="action-buttons" class="hidden space-y-3">
                <button onclick="pauseTimer()" type="button" id="pause-btn" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Pause
                </button>
                
                <!-- Borang khas untuk Finish -->
                <form id="complete-form" method="POST" action="{{ route('timer.finish') }}">
                    @csrf
                    <input type="hidden" name="subject" id="finish-subject" value="Study Session">
                    
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 transition duration-200">
                        Finish & Save Session
                    </button>
                </form>
            </div>   
    </div>

      <script>
        let timeLeft = 25 * 60;
        let timerInterval;
        let isRunning = false;

        function startTimer() {
            const duration = document.getElementById('duration-input').value;
            const subjectInput = document.querySelector('input[name="subject"]').value; // Ambil subjek
            
            // Masukkan subjek ke dalam borang finish yang tersembunyi
            document.getElementById('finish-subject').value = subjectInput;

            timeLeft = duration * 60;
            
            // Tukar paparan
            document.getElementById('start-form').classList.add('hidden');
            document.getElementById('action-buttons').classList.remove('hidden');
            
            updateDisplay();
            isRunning = true;
            
            timerInterval = setInterval(() => {
                if (isRunning && timeLeft > 0) {
                    timeLeft--;
                    updateDisplay();
                } else if (timeLeft === 0) {
                    clearInterval(timerInterval);
                    document.getElementById('complete-form').submit(); // Hantar borang bila tamat
                }
            }, 1000);
        }

        function pauseTimer() {
            isRunning = !isRunning;
            document.getElementById('pause-btn').innerText = isRunning ? 'Pause' : 'Resume';
        }

        function updateDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timer-display').innerText = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
    </script>
    </x-app-layout>