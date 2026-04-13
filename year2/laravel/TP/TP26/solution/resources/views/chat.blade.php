<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat avec {{ $receiver->name }}
        </h2>
    </x-slot>

    <div class="flex flex-col h-[calc(100vh-65px)] max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div id="messages" class="flex-1 overflow-y-auto p-4 flex flex-col gap-3">
            @foreach ($messages as $msg)
                @php $isMe = $msg->sender_id === auth()->id(); @endphp
                <div class="{{ $isMe ? 'self-end bg-blue-500 text-white rounded-l-lg rounded-tr-lg' : 'self-start bg-gray-200 text-gray-800 rounded-r-lg rounded-tl-lg' }} p-3 max-w-xs lg:max-w-md shadow-sm">
                    <p class="text-sm whitespace-pre-wrap">{{ $msg->content }}</p>
                    <span class="text-[10px] block mt-1 {{ $isMe ? 'opacity-75' : 'text-gray-500' }}">
                        {{ $msg->created_at->format('H:i') }}
                    </span>
                </div>
            @endforeach
        </div>

        {{-- 3. Sticky Input Area (Bottom) --}}
        <div class="p-4 bg-white border-t border-gray-200">
            <div class="flex items-end space-x-2">
                <textarea
                    id="message-input"
                    rows="1"
                    placeholder="Votre message..."
                    class="border border-gray-300 rounded-lg p-2 flex-1 resize-none focus:ring-blue-500 focus:border-blue-500"
                    oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"
                ></textarea>
                <button
                    type="button"
                    onclick="sendMessage()"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition h-10"
                >
                    Envoyer
                </button>
            </div>
        </div>
    </div>

    <script>
        const scrollToBottom = () => {
            const div = document.getElementById("messages");
            div.scrollTop = div.scrollHeight;
        };

        window.onload = scrollToBottom;

        function sendMessage() {
            const input = document.getElementById('message-input');
            const content = input.value.trim();
            if (!content) return;

            const receiver_id = {{ $receiver->id }};

            fetch(`/chat/${receiver_id}/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ content: content })
            });

            input.value = '';
            input.style.height = '';
        }

        window.authId = {{ auth()->id() }};

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof window.Echo !== 'undefined') {
                window.Echo.private(`chat.${window.authId}`).listen(
                    "PrivateMessageSent",
                    (e) => {
                        const div = document.getElementById("messages");
                        const isMe = e.sender_id == window.authId;

                        const now = new Date();
                        const timeString = now.getHours().toString().padStart(2, '0') + ':' +
                                         now.getMinutes().toString().padStart(2, '0');

                        const messageHtml = `
                            <div class="${isMe ? 'self-end bg-blue-500 text-white rounded-l-lg rounded-tr-lg' : 'self-start bg-gray-200 text-gray-800 rounded-r-lg rounded-tl-lg'} p-3 max-w-xs lg:max-w-md mb-2 shadow-sm animate-fade-in">
                                <p class="text-sm whitespace-pre-wrap">${e.content}</p>
                                <span class="text-[10px] block mt-1 ${isMe ? 'opacity-75' : 'text-gray-500'}">${timeString}</span>
                            </div>
                        `;

                        div.insertAdjacentHTML('beforeend', messageHtml);
                        scrollToBottom();
                    }
                );
            }
        });

        document.getElementById('message-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.3s ease-out; }
        #messages::-webkit-scrollbar {
            display: none;
        }

        #messages {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</x-app-layout>
