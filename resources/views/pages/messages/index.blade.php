@extends('layouts.app')

@section('title', 'My Messages')

@section('content')
<div class="max-w-7xl mx-auto h-[calc(100vh-80px)] p-4"> 
    
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm h-full flex overflow-hidden">
        
        <div class="w-full md:w-1/3 border-r border-gray-200 flex flex-col h-full bg-gray-50/50">
            
            <div class="p-4 border-b border-gray-200 bg-white flex justify-between items-center shrink-0">
                <h2 class="text-xl font-bold text-gray-800">Messages</h2>
                {{-- new chat btn --}}
                <button onclick="openNewChatModal()" class="text-gray-400 hover:text-blue-600 transition p-2 rounded-full hover:bg-gray-100" title="Start new conversation">
                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1" id="conversations-list">
                @if(count($conversations) > 0)
                    @foreach($conversations as $convo)
                        <div onclick="loadConversation({{ $convo['user_id'] }}, this)" 
                             id="convo-{{ $convo['user_id'] }}"
                             data-name="{{ $convo['name'] }}"
                             data-img="{{ $convo['avatar'] }}"
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
                    <div id="no-convos-msg" class="text-center py-10 px-4">
                        <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa-regular fa-paper-plane text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-500 text-sm">No conversations yet.</p>
                        <button onclick="openNewChatModal()" class="text-blue-600 font-bold text-sm mt-2 hover:underline">Start one now</button>
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
                <p class="text-gray-500 max-w-xs">Select a conversation from the left or start a new one.</p>
            </div>

            <div id="active-chat-container" class="hidden flex flex-col h-full w-full">
                
                <div class="p-4 border-b border-gray-100 flex items-center gap-3 bg-white shadow-sm shrink-0 z-10">
                    <img id="chat-header-img" src="" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    <div>
                        <h3 id="chat-header-name" class="font-bold text-gray-900 leading-tight"></h3>
                        <span class="text-xs text-green-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Online
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

{{-- new chat modal --}}
<div id="new-chat-modal" class="fixed inset-0 bg-black/50 hidden z-[9999] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-in">
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-pen text-blue-500"></i> New Message
            </h3>
            <button onclick="closeNewChatModal()" class="text-gray-400 hover:text-gray-600 w-8 h-8 rounded-full hover:bg-gray-200 transition flex items-center justify-center">
                <i class="fa-solid fa-times text-lg"></i>
            </button>
        </div>
        <div id="friends-list" class="p-4 max-h-[400px] overflow-y-auto flex flex-col gap-2 custom-scrollbar">
            {{-- JS preenche isto --}}
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
        let isFirstLoad = true;

        const feed = document.getElementById('messages-feed');
        const form = document.getElementById('dm-form');
        const input = document.getElementById('dm-input');
        const headerName = document.getElementById('chat-header-name');
        const headerImg = document.getElementById('chat-header-img');
        const emptyState = document.getElementById('empty-state');
        const chatContainer = document.getElementById('active-chat-container');

        // load convo
        window.loadConversation = function(friendId, element) {
            // ui update sidebar
            document.querySelectorAll('.conversation-item').forEach(el => {
                el.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-600', 'rounded-r-xl');
                el.classList.add('rounded-xl');
            });
            
            if(element) {
                element.classList.remove('rounded-xl');
                element.classList.add('bg-blue-50', 'border-l-4', 'border-blue-600', 'rounded-r-xl');
                
                // load header
                headerName.innerText = element.dataset.name;
                headerImg.src = element.dataset.img;
            }

            // show chat
            emptyState.classList.add('hidden');
            chatContainer.classList.remove('hidden');
            
            if (activeFriendId !== friendId) {
                feed.innerHTML = '<div class="flex justify-center py-10" id="loading-spinner"><i class="fa-solid fa-spinner fa-spin text-gray-400 text-2xl"></i></div>';
                isFirstLoad = true;
            }

            activeFriendId = friendId;
            if (pollingInterval) clearInterval(pollingInterval);

            fetchMessages();
            pollingInterval = setInterval(fetchMessages, 3000);
        }

        function fetchMessages() {
            if (!activeFriendId) return;

            fetch(`/messages/${activeFriendId}`)
                .then(res => res.json())
                .then(messages => {
                    const spinner = document.getElementById('loading-spinner');
                    if(spinner) spinner.remove();
                    renderChat(messages);
                })
                .catch(err => console.error(err));
        }

        function renderChat(messages) {
            // if no msgs does nothing header was already updated
            
            let newMessagesAdded = false;

            messages.forEach(msg => {
                const existingMsg = document.getElementById(`msg-${msg.id_message}`);
                if (!existingMsg) {
                    appendMessage(msg, feed);
                    newMessagesAdded = true;
                }
            });

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
            const msgId = `msg-${msg.id_message}`; 

            // clean tag [post:NUM]
            let displayText = msg.text.replace(/\[post:\d+\]/, '').trim();

            // detect posts data comes from 'msg.shared_post_data' or 'msg.message...'
            const post = msg.shared_post_data || (msg.message ? msg.message.shared_post_data : null);

            let contentHtml = '';

            // draw card post partial style
            if (post) {
                if (!displayText) displayText = "Shared a post";

                // security placeholders
                const username = post.user ? post.user.username : 'Unknown';
                // users img or placeholder
                const userImg = post.user && post.user.profile_image 
                    ? post.user.profile_image 
                    : 'https://ui-avatars.com/api/?name=' + username;
                
                const description = post.description || post.text_content || ''; 

                contentHtml += `
                    <div class="mt-1 mb-2 bg-white rounded-lg border border-gray-200 overflow-hidden cursor-pointer hover:shadow-md transition-shadow text-left"
                         onclick="window.location.href='/post/${post.id_post}'">
                        
                        <div class="flex items-center p-3 border-b border-gray-100 bg-white">
                            <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                                 src="${userImg}">
                            <div class="font-semibold text-sm text-gray-800">
                                ${username}
                            </div>
                        </div>

                        ${post.image ? `
                            <div class="w-full border-t border-gray-200 bg-gray-100">
                                <img src="/posts/${post.image}" class="w-full h-auto object-cover max-h-[300px]">
                            </div>
                        ` : ''}
                        
                        <div class="flex items-center gap-4 px-4 py-2 border-b border-gray-50">
                            <i class="fa-regular fa-heart text-gray-600 text-lg"></i>
                            <i class="fa-regular fa-comment text-gray-600 text-lg"></i>
                            <i class="fa-regular fa-share-from-square text-gray-600 text-lg"></i>
                        </div>

                        <div class="py-3 px-4 text-sm leading-relaxed text-gray-800 line-clamp-3">
                            <span class="font-semibold mr-1">${username}</span>
                            ${description}
                        </div>
                    </div>
                `;
            }
            
            if (displayText) {
                contentHtml += `<p>${displayText}</p>`;
            }

            const html = `
                <div id="${msgId}" class="flex ${alignClass} fade-in mb-4">
                    <div class="max-w-[70%] flex flex-col ${isMe ? 'items-end' : 'items-start'}">
                        <div class="${bgClass} px-4 py-2 rounded-2xl shadow-sm relative text-sm leading-relaxed break-words overflow-hidden">
                            ${contentHtml}
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

        // send
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const text = input.value.trim();
                if (!text || !activeFriendId) return;

                input.value = '';
                input.focus();

                const tempId = 'temp-' + Date.now();
                appendMessage({
                    id_message: tempId,
                    id_sender: currentUserId,
                    text: text,
                    date: new Date().toISOString()
                }, feed);
                scrollToBottom();

                // update sidebar
                const sidebarItem = document.getElementById(`convo-${activeFriendId}`);
                if(sidebarItem) {
                    const lastMsgEl = sidebarItem.querySelector('.last-msg-text');
                    const timeEl = sidebarItem.querySelector('span.text-xs'); // time element
                    if(lastMsgEl) lastMsgEl.innerText = text;
                    if(timeEl) timeEl.innerText = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    
                    // move to top
                    const list = document.getElementById('conversations-list');
                    list.prepend(sidebarItem);
                }

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
                        const tempEl = document.getElementById(`msg-${tempId}`);
                        if(tempEl) tempEl.id = `msg-${data.message.id_message}`;
                    }
                })
                .catch(err => console.error(err));
            });
        }
    });

    // new chat modal logic
    function openNewChatModal() {
        const modal = document.getElementById('new-chat-modal');
        const list = document.getElementById('friends-list');
        modal.classList.remove('hidden');
        
        list.innerHTML = '<div class="text-center py-4 text-gray-500"><i class="fa-solid fa-spinner fa-spin mr-2"></i>Loading friends...</div>';

        fetch('/messages/friends')
            .then(res => res.json())
            .then(friends => {
                list.innerHTML = '';
                if(friends.length === 0) {
                    list.innerHTML = '<p class="text-center text-gray-500">No friends found.</p>';
                    return;
                }
                
                friends.forEach(friend => {
                    const html = `
                        <div onclick="startNewChat(${friend.id}, '${friend.name}', '${friend.image}')" 
                             class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition">
                            <img src="${friend.image}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            <div>
                                <p class="font-bold text-sm text-gray-800">${friend.name}</p>
                                <p class="text-xs text-gray-500">@${friend.username}</p>
                            </div>
                        </div>
                    `;
                    list.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(err => console.error(err));
    }

    function closeNewChatModal() {
        document.getElementById('new-chat-modal').classList.add('hidden');
    }

    function startNewChat(id, name, image) {
        closeNewChatModal();

        // veryfies if friend is in the sidebar
        let existingItem = document.getElementById(`convo-${id}`);
        
        // if not create it temporarely on the top
        if (!existingItem) {
            const list = document.getElementById('conversations-list');
            const noMsg = document.getElementById('no-convos-msg');
            if(noMsg) noMsg.remove(); // remove msg no conversaton

            const html = `
                <div onclick="loadConversation(${id}, this)" 
                     id="convo-${id}"
                     data-name="${name}"
                     data-img="${image}"
                     class="conversation-item flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-gray-100 transition group fade-in">
                    <img src="${image}" alt="${name}" class="w-12 h-12 rounded-full object-cover border border-gray-200 shrink-0">
                    <div class="min-w-0 flex-1">
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h3 class="font-bold text-gray-900 truncate">${name}</h3>
                            <span class="text-xs text-gray-400 shrink-0">Now</span>
                        </div>
                        <p class="text-sm text-gray-500 truncate last-msg-text group-hover:text-gray-700">
                            New conversation
                        </p>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('afterbegin', html);
            existingItem = document.getElementById(`convo-${id}`);
        }

        // clicks it to open
        existingItem.click();
    }
</script>

<style>
    /* scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(156, 163, 175, 0.5); border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: rgba(107, 114, 128, 0.8); }
    
    .fade-in { animation: fadeIn 0.2s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    
    /* modal animation */
    .animate-scale-in { animation: scaleIn 0.2s ease-out forwards; }
    @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
</style>
@endpush