@extends('layouts.app')

@section('title', 'My Messages')

@section('content')
<div class="max-w-7xl mx-auto h-[calc(100vh-80px)] p-4"> <div class="bg-white border border-gray-200 rounded-2xl shadow-sm h-full flex overflow-hidden">
        
        <div class="w-full md:w-1/3 border-r border-gray-200 flex flex-col h-full bg-gray-50/50">
            
            <div class="p-4 border-b border-gray-200 bg-white flex justify-between items-center shrink-0">
                <h2 class="text-xl font-bold text-gray-800">Messages</h2>
                {{-- new chat btn --}}
                <button class="text-gray-400 hover:text-blue-600 transition" title="New Message">
                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1" id="conversations-list">
                @if(count($conversations) > 0)
                    @foreach($conversations as $convo)
                        <div onclick="loadConversation({{ $convo['user_id'] }}, this)" 
                             id="convo-{{ $convo['user_id'] }}"
                             class="conversation-item flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-gray-100 transition group">
                            
                            <img src="{{ $convo['avatar'] }}" alt="{{ $convo['name'] }}" class="w-12 h-12 rounded-full object-cover border border-gray-200 shrink-0">
                            
                            <div class="min-w-0 flex-1">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h3 class="font-bold text-gray-900 truncate">{{ $convo['name'] }}</h3>
                                    <span class="text-xs text-gray-400 shrink-0">{{ \Carbon\Carbon::parse($convo['date'])->format('H:i') }}</span>
                                </div>
                                <p class="text-sm text-gray-500 truncate last-msg-text group-hover:text-gray-700">
                                    {{ $convo['last_message'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-10 px-4">
                        <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa-regular fa-paper-plane text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-500 text-sm">No conversations yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="hidden md:flex flex-col flex-1 h-full bg-white relative w-full md:w-2/3" id="chat-area">
            
            <div id="empty-state" class="absolute inset-0 flex flex-col items-center justify-center text-center p-8 bg-gray-50">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-comments text-4xl text-blue-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Your Messages</h3>
                <p class="text-gray-500 max-w-xs">Select a conversation from the left or start a new one to verify connect with your friends.</p>
            </div>

            <div id="active-chat-container" class="hidden flex flex-col h-full w-full">
                
                <div class="p-4 border-b border-gray-100 flex items-center gap-3 bg-white shadow-sm shrink-0 z-10">
                    <img id="chat-header-img" src="" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    <div>
                        <h3 id="chat-header-name" class="font-bold text-gray-900 leading-tight"></h3>
                        <span class="text-xs text-green-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Online (Fake)
                        </span>
                    </div>
                </div>

                <div id="messages-feed" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 custom-scrollbar scroll-smooth">
                    </div>

                <div class="p-4 bg-white border-t border-gray-100 shrink-0">
                    <form id="dm-form" class="relative flex items-center gap-2">
                        <button type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-full transition">
                            <i class="fa-solid fa-paperclip"></i>
                        </button>
                        
                        <input type="text" id="dm-input" 
                               class="w-full bg-gray-100 border-0 rounded-full py-3 px-5 focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-sm"
                               placeholder="Type a message..." autocomplete="off">
                        
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-md transition transform active:scale-95 flex items-center justify-center w-10 h-10">
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // global vars
        const currentUserId = "{{ Auth::id() }}";
        let activeFriendId = null;
        let pollingInterval = null;
        let isFirstLoad = true; // controll scroll

        const feed = document.getElementById('messages-feed');
        const form = document.getElementById('dm-form');
        const input = document.getElementById('dm-input');
        const headerName = document.getElementById('chat-header-name');
        const headerImg = document.getElementById('chat-header-img');
        const emptyState = document.getElementById('empty-state');
        const chatContainer = document.getElementById('active-chat-container');

        // open chat
        window.loadConversation = function(friendId, element) {
            // select current chat
            document.querySelectorAll('.conversation-item').forEach(el => {
                el.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-600', 'rounded-r-xl');
                el.classList.add('rounded-xl'); // undo selection
            });
            
            if(element) {
                element.classList.remove('rounded-xl');
                element.classList.add('bg-blue-50', 'border-l-4', 'border-blue-600', 'rounded-r-xl');
            }

            // show chat area
            emptyState.classList.add('hidden');
            chatContainer.classList.remove('hidden');
            
            // clean feed when switching chat
            if (activeFriendId !== friendId) {
                feed.innerHTML = '<div class="flex justify-center py-10" id="loading-spinner"><i class="fa-solid fa-spinner fa-spin text-gray-400 text-2xl"></i></div>';
                isFirstLoad = true;
            }

            activeFriendId = friendId;

            // reset old pooling
            if (pollingInterval) clearInterval(pollingInterval);

            // initial fetch and start pooling
            fetchMessages();
            pollingInterval = setInterval(fetchMessages, 3000);

            // focus on input
            setTimeout(() => input.focus(), 100);
        }

        function fetchMessages() {
            if (!activeFriendId) return;

            fetch(`/messages/${activeFriendId}`)
                .then(res => res.json())
                .then(messages => {
                    const spinner = document.getElementById('loading-spinner');//visual loading
                    if(spinner) spinner.remove();

                    renderChat(messages);
                })
                .catch(err => console.error('Error fetching chat:', err));
        }

        // static render
        function renderChat(messages) {
            if (messages.length === 0) return;

            // update header based on last receved msg
            const otherMsg = messages.find(m => m.id_sender != currentUserId);
            if (otherMsg) {
                headerName.innerText = otherMsg.sender_name;
                headerImg.src = otherMsg.sender_image;
            }

            let newMessagesAdded = false;

            messages.forEach(msg => {
                // only adds new msg if there is a new one
                const existingMsg = document.getElementById(`msg-${msg.id_message}`);
                
                if (!existingMsg) {
                    appendMessage(msg, feed);
                    newMessagesAdded = true;
                }
            });

            // screoll to bottom if there is new msgs or first time
            if (newMessagesAdded || isFirstLoad) {
                scrollToBottom();
                isFirstLoad = false;
            }
        }

        function appendMessage(msg, container) {
            const isMe = msg.id_sender == currentUserId;
            const alignClass = isMe ? 'justify-end' : 'justify-start';
            const bgClass = isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none';
            const time = new Date(msg.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            // unique ide for no dulpicates
            const msgId = `msg-${msg.id_message}`; 

            const html = `
                <div id="${msgId}" class="flex ${alignClass} fade-in mb-4">
                    <div class="max-w-[70%] flex flex-col ${isMe ? 'items-end' : 'items-start'}">
                        <div class="${bgClass} px-4 py-2 rounded-2xl shadow-sm relative text-sm leading-relaxed break-words">
                            <p>${msg.text}</p>
                        </div>
                        <span class="text-[10px] text-gray-400 mt-1 px-1">${time}</span>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function scrollToBottom() {
            feed.scrollTo({ top: feed.scrollHeight, behavior: 'smooth' });
        }

        // send msg
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // prevents page refresh
                
                const text = input.value.trim();

                if (!text || !activeFriendId) return;

                // clear input
                input.value = '';
                input.focus();

                // shows message instantly for fast visuals
                // use temp id
                const tempId = 'temp-' + Date.now();
                appendMessage({
                    id_message: tempId, // temp id
                    id_sender: currentUserId,
                    text: text,
                    date: new Date().toISOString()
                }, feed);
                scrollToBottom();

                // update sidebar with this last msg
                const sidebarItem = document.getElementById(`convo-${activeFriendId}`);
                if(sidebarItem) {
                    const lastMsgEl = sidebarItem.querySelector('.last-msg-text');
                    if(lastMsgEl) lastMsgEl.innerText = text;
                }

                // AJAX POST
                fetch(`/messages/${activeFriendId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ text: text })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // update temp id for real one
                        const tempEl = document.getElementById(`msg-${tempId}`);
                        if(tempEl) tempEl.id = `msg-${data.message.id_message}`;
                    } else {
                        console.error('Send failed');
                    }
                })
                .catch(err => console.error('Error sending:', err));
            });
        }
    });
</script>

<style>
    /* custom scroll */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(156, 163, 175, 0.5); border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: rgba(107, 114, 128, 0.8); }
    
    .fade-in { animation: fadeIn 0.2s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush