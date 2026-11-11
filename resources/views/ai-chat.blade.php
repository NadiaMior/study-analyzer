<x-app-layout>
    <div class="py-8 bg-[#F8F9FA] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-6 flex justify-between items-end">
                <div>
                    <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-1">AI STUDY COACH</p>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">What would you like to learn? ✨</h1>
                </div>
                <button onclick="clearChat()" class="text-sm bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm hover:bg-gray-50 font-medium">New Chat</button>
            </div>

            <!-- Kotak Chat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-[65vh] flex flex-col">
                
                <!-- Mesej -->
                <div id="chat-box" class="flex-1 p-6 overflow-y-auto space-y-4">
                    <!-- Mesej Pembuka AI -->
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold flex-shrink-0">AI</div>
                        <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-[80%]">
                            <p class="text-gray-800 text-sm">Hi! I can explain tricky topics, quiz you, or help you plan a study session. What are you working on?</p>
                        </div>
                    </div>
                </div>

                <!-- Input Pengguna -->
                <div class="p-4 border-t border-gray-100 bg-white rounded-b-2xl">
                    <form id="chat-form" onsubmit="sendMessage(event)" class="flex space-x-3">
                        <input type="text" id="user-input" required placeholder="Ask a question about what you're studying..." class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm p-3 border bg-gray-50">
                        <button type="submit" id="send-btn" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-xl transition flex items-center justify-center">
                            Send
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript untuk Puter AI -->
    <script>
        const chatBox = document.getElementById('chat-box');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');

        async function sendMessage(e) {
            e.preventDefault();
            const message = userInput.value.trim();
            if (!message) return;

            // 1. Papar mesej pengguna
            appendMessage('user', message);
            userInput.value = '';
            
            // 2. Tunjuk status "Thinking..."
            const loadingId = appendMessage('ai', 'Thinking...', true);
            sendBtn.disabled = true;

            try {
                // 3. Panggil Puter AI
                const response = await puter.ai.chat(message);
                
                // 4. Buang status loading, papar jawapan AI
                document.getElementById(loadingId).remove();
                appendMessage('ai', response);
                
            } catch (error) {
                document.getElementById(loadingId).remove();
                appendMessage('ai', 'Maaf, sistem AI sedang sibuk. Sila cuba lagi.');
                console.error(error);
            } finally {
                sendBtn.disabled = false;
            }
        }

        function appendMessage(role, text, isLoading = false) {
            const div = document.createElement('div');
            const id = 'msg-' + Date.now() + Math.random().toString(36).substr(2, 9);
            div.id = id;

            if (role === 'user') {
                div.className = 'flex items-start justify-end space-x-3 flex-row-reverse space-x-reverse';
                div.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-white font-bold flex-shrink-0">You</div>
                    <div class="bg-black text-white rounded-2xl rounded-tr-none p-4 max-w-[80%]">
                        <p class="text-sm whitespace-pre-wrap">${text}</p>
                    </div>
                `;
            } else {
                div.className = 'flex items-start space-x-3';
                div.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold flex-shrink-0">AI</div>
                    <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-[80%]">
                        <p class="text-gray-800 text-sm whitespace-pre-wrap ${isLoading ? 'animate-pulse text-gray-500' : ''}">${text}</p>
                    </div>
                `;
            }

            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
            return id;
        }

        function clearChat() {
            chatBox.innerHTML = `
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold flex-shrink-0">AI</div>
                    <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-[80%]">
                        <p class="text-gray-800 text-sm">Hi! I can explain tricky topics, quiz you, or help you plan a study session. What are you working on?</p>
                    </div>
                </div>
            `;
        }
    </script>
</x-app-layout>