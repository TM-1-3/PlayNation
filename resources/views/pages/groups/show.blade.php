@extends('layouts.app')

@section('title', $group->name)

@section('content')

<div class="max-w-6xl mx-auto pt-10 pr-5 pb-5">
    <div class="flex flex-wrap gap-8">
        
        {{-- left info --}}
        <div class="w-full md:w-1/3 md:min-w-[280px]">
            
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-5">
                
                <div class="relative w-full h-48 mb-6 rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ $group->getGroupPicture() }}" 
                         alt="{{ $group->name }}" 
                         class="w-full h-full object-cover">
                </div>
                
                <div class="text-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $group->name }}</h1>
                    
                    @if($group->is_public)
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Public Group</span>
                    @else
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Private Group</span>
                    @endif
                </div>

                
                <p class="text-gray-600 italic text-center mb-6 text-sm">
                    "{{ $group->description ?? 'No description.' }}"
                </p>

                <div class="flex justify-center gap-8 mb-6 border-t border-gray-100 pt-4">
                    <div class="text-center">
                        <span class="block text-xl font-bold text-blue-600">{{ $group->members->count() }}</span>
                        <span class="text-xs text-gray-500 uppercase">Members</span>
                    </div>
                    <div class="text-center">
                        <span class="block text-xl font-bold text-blue-600">0</span>
                        <span class="text-xs text-gray-500 uppercase">Posts</span>
                    </div>
                </div>

                {{-- group actions --}}
                <div class="flex flex-col gap-3 mt-6">
                    
                    @auth
                        {{-- Owner? shows edit --}}
                        @if(Auth::id() === $group->id_owner)
                            <a href="{{ route('groups.edit', $group->id_group) }}" class="w-full bg-gray-100 text-gray-700 py-2.5 rounded-lg hover:bg-gray-200 transition font-bold text-center no-underline border border-gray-300">
                                Edit Group Settings
                            </a>
                        
                        {{-- member? shows leave --}}
                        @elseif($group->members->contains(Auth::user()->id_user))
                            <form action="{{ route('groups.leave', $group->id_group) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this group?');">
                                @csrf
                                <button type="submit" class="w-full bg-white text-red-600 border border-red-200 py-2.5 rounded-lg hover:bg-red-50 transition font-bold shadow-sm">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Leave Group
                                </button>
                            </form>

                        {{-- pending join request? shows cancel request --}}
                        @elseif($group->joinRequests->contains(Auth::user()->id_user))
                            <form action="{{ route('groups.cancel_request', $group->id_group) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-yellow-50 text-yellow-700 border border-yellow-200 py-2.5 rounded-lg hover:bg-yellow-100 transition font-bold shadow-sm">
                                    <i class="fa-regular fa-clock mr-2"></i> Request Pending...
                                </button>
                                <p class="text-xs text-center text-gray-400 mt-2 cursor-pointer hover:underline">Click button to cancel</p>
                            </form>

                        {{-- not in n show request to join/join --}}
                        @else
                            <form action="{{ route('groups.join', $group->id_group) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 duration-200">
                                    {{ $group->is_public ? 'Join Group' : 'Request to Join' }}
                                </button>
                            </form>
                        @endif

                    @else
                        {{-- visitor shows login  --}}
                        <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white py-5.5 rounded-lg hover:bg-blue-700 transition font-bold text-center no-underline shadow-md">
                            Login to Join
                        </a>
                    @endauth

                    {{-- invite btn --}}
                    @if($group->is_public || Auth::id() === $group->id_owner)
                        <button onclick="console.log('Botão clicado!'); openInviteModal()" 
                                class="w-full mt-4 bg-blue-100 text-blue-600 font-bold py-2 rounded-lg hover:bg-blue-200 transition flex items-center justify-center gap-2 cursor-pointer relative z-10 shadow-sm active:scale-95">
                            <i class="fa-solid fa-user-plus"></i> Invite Friends
                        </button>
                    @endif

                    {{-- report group button --}}
                    <button onclick="toggleReport('group', {{ $group->id_group }})" 
                            class="w-full mt-2 bg-transparent text-red-600 border border-red-100 py-2 rounded-lg hover:bg-red-50 transition font-bold flex items-center justify-center gap-2">
                        <i class="fa-solid fa-flag mr-1"></i> Report Group
                    </button>

                    {{-- report modal moved to page bottom to avoid stacking issues --}}



                </div>
            </div>
        </div>

        {{-- right column chat --}}
        <div class="flex-1 min-w-0">
            
            @if($canViewContent)
                <div class="bg-white rounded-lg shadow-md h-[600px] flex flex-col relative overflow-hidden">
                    
                    {{-- header --}}
                    <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700">
                            <i class="fa-regular fa-comments mr-2"></i> Group Chat
                        </h3>
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Live
                        </span>
                    </div>

                    {{-- messages area --}}
                    <div class="flex-1 p-4 overflow-y-auto bg-gray-50/50 flex flex-col gap-3 h-[600px]" id="chat-messages">
                        {{-- JS here --}}
                        <div class="text-center text-gray-400 mt-20" id="loading-msg">
                            <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i>
                            <p>Connecting...</p>
                        </div>
                    </div>

                    {{-- input --}}
                    <div class="p-4 border-t bg-white">
                       
                        <form id="chat-form" class="flex items-center gap-2">
                            
                            {{-- text --}}
                            <input type="text" 
                                   id="message-input"
                                   name="text"
                                   placeholder="Type a message..." 
                                   class="flex-1 border border-gray-300 rounded-full py-3 px-5 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 text-gray-700 transition-shadow"
                                   autocomplete="off">
                            
                            <button type="submit" 
                                    class="bg-transparent border-none p-2 cursor-pointer transition-transform hover:scale-110 active:scale-95 group">
                                <i class="fa-solid fa-paper-plane text-2xl text-blue-600 group-hover:text-blue-700"></i>
                            </button>

                        </form>
                    </div>

                </div>
            @else
                {{-- blockage --}}
                <div class="bg-white rounded-lg shadow-md p-10 text-center border border-gray-200">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-lock text-4xl text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Private Group</h2>
                    <p class="text-gray-500 max-w-md mx-auto">
                        This group is private. Join the group to access the chat.
                    </p>
                </div>
            @endif

        </div>

    </div>
</div>

{{-- invite section --}}
<div id="invite-modal" class="fixed inset-0 bg-black/50 hidden z-[9999] flex items-center justify-center backdrop-blur-sm">
    
    {{-- Container Branco --}}
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100 mx-4 relative z-[10000]">
        
        {{-- Header --}}
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-envelope-open-text text-blue-500"></i> Invite Friends
            </h3>
            <button onclick="closeInviteModal()" class="text-gray-400 hover:text-gray-600 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
                <i class="fa-solid fa-times text-lg"></i>
            </button>
        </div>

        {{-- Lista de Candidatos --}}
        <div id="candidates-list" class="p-4 max-h-[400px] overflow-y-auto flex flex-col gap-2 custom-scrollbar">
            <div class="text-center py-8">
                <i class="fa-solid fa-spinner fa-spin text-blue-500 text-3xl mb-3"></i>
                <p class="text-gray-500 text-sm">Loading your friends list...</p>
            </div>
        </div>

    </div>
</div>



@endsection

@include('partials.report_modal', [
    'modalId' => "report-modal-group-{$group->id_group}",
    'action' => route('report.submit'),
    'title' => 'Report Group',
    'target_type' => 'group',
    'target_id' => $group->id_group,
])

@push('scripts')
<script>
    // clobal vars
    // chat and invite can use
    const groupId = "{{ $group->id_group }}";
    const currentUserId = "{{ Auth::id() }}"; 
    const currentUserName = "{{ Auth::user()->name ?? 'User' }}"; 

    // chat logic starts with page load
    document.addEventListener('DOMContentLoaded', function() {
        
        const chatContainer = document.getElementById('chat-messages');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const loadingMsg = document.getElementById('loading-msg');

        let lastLoadedId = 0; 

        // chats functions
        function loadMessages() {
            fetch(`/groups/${groupId}/messages?after_id=${lastLoadedId}`)
                .then(response => response.json())
                .then(messages => {
                    if (loadingMsg) loadingMsg.remove(); 
                    if (messages.length > 0) {
                        messages.forEach(msg => {
                            if (!document.getElementById(`msg-${msg.id_message}`)) {
                                appendMessageToChat(msg);
                            }
                            if (msg.id_message > lastLoadedId) {
                                lastLoadedId = msg.id_message;
                            }
                        });
                        scrollToBottom();
                    }
                })
                .catch(error => console.error('Error loading:', error));
        }

        function appendMessageToChat(msg, isOptimistic = false, customId = null) {
            const isMe = msg.id_sender == currentUserId;
            const alignmentClass = isMe ? 'justify-end' : 'justify-start';
            const bgClass = isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none';
            const elementId = customId ? customId : `msg-${msg.id_message}`;
            const opacityClass = isOptimistic ? 'opacity-70' : 'opacity-100';
            const timeDisplay = isOptimistic ? 'Sending...' : new Date(msg.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            const avatarHtml = !isMe 
                ? `<img src="${msg.sender.profile_image}" alt="${msg.sender.name}" class="w-8 h-8 rounded-full object-cover mr-2 self-end mb-1 border border-gray-200 shadow-sm">` 
                : '';

            const html = `
                <div id="${elementId}" class="flex ${alignmentClass} mb-4 fade-in ${opacityClass}">
                    ${avatarHtml}
                    <div class="max-w-[70%] flex flex-col ${isMe ? 'items-end' : 'items-start'}">
                        ${!isMe ? `<span class="text-xs text-gray-500 mb-1 ml-1">${msg.sender.name}</span>` : ''}
                        <div class="${bgClass} px-4 py-2 rounded-2xl shadow-sm relative group">
                            <p class="text-sm leading-relaxed">${msg.text}</p>
                        </div>
                        <span class="text-[10px] text-gray-400 mt-1 ml-1 block message-time">${timeDisplay}</span>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', html);
        }

        function scrollToBottom() {
            chatContainer.scrollTo({ top: chatContainer.scrollHeight, behavior: 'smooth' });
        }

        // sending msgs listener
        if(chatForm){
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault(); 
                const textValue = messageInput.value.trim();
                if (!textValue) return;
                
                messageInput.value = ''; 
                messageInput.focus();
                const tempId = 'temp-' + Date.now();

                appendMessageToChat({
                    id_sender: currentUserId,
                    sender: { name: currentUserName, profile_image: "{{ Auth::user()->getProfileImage() }}" },
                    text: textValue,
                    date: new Date().toISOString() 
                }, true, tempId);

                scrollToBottom();

                fetch(`/groups/${groupId}/messages`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ text: textValue })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const tempElement = document.getElementById(tempId);
                        if (tempElement) {
                            tempElement.id = `msg-${data.message.id_message}`;
                            tempElement.classList.remove('opacity-70');
                            tempElement.classList.add('opacity-100');
                            const timeSpan = tempElement.querySelector('.message-time');
                            if(timeSpan) timeSpan.innerText = new Date(data.message.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                        }
                        if (data.message.id_message > lastLoadedId) lastLoadedId = data.message.id_message;
                    }
                })
                .catch(error => console.error('Error sending:', error));
            });
        }

        // starts chat
        loadMessages();
        setInterval(loadMessages, 3000); 
    });

    // invite functions

    // open modal window
    window.openInviteModal = function() {
        const inviteModal = document.getElementById('invite-modal');
        if(inviteModal) {
            inviteModal.classList.remove('hidden');
            loadCandidates();
        } else {
            console.error("Invite modal not found");
        }
    }

    // close modal window
    window.closeInviteModal = function() {
        const inviteModal = document.getElementById('invite-modal');
        if(inviteModal) inviteModal.classList.add('hidden');
    }

    // load candidate friends
    function loadCandidates() {
        const candidatesList = document.getElementById('candidates-list');
        if(!candidatesList) return;
        
        candidatesList.innerHTML = '<div class="text-center py-4 text-gray-500"><i class="fa-solid fa-spinner fa-spin mr-2"></i>Loading friends...</div>';

        fetch(`/groups/${groupId}/candidates`)
            .then(res => res.json())
            .then(users => {
                candidatesList.innerHTML = ''; 

                if (users.length === 0) {
                    candidatesList.innerHTML = '<p class="text-center text-gray-500 py-4">No friends found to invite.</p>';
                    return;
                }

                users.forEach(user => {
                    let btnHtml = '';
                    
                    if (user.status === 'member') {
                        btnHtml = `<span class="text-xs font-bold text-gray-400 px-3 border border-gray-200 rounded py-1 bg-gray-50">Member</span>`;
                    } else if (user.status === 'pending') {
                        btnHtml = `<span class="text-xs font-bold text-yellow-600 px-3 border border-yellow-200 rounded py-1 bg-yellow-50">Pending</span>`;
                    } else {
                        btnHtml = `<button onclick="sendInvite(${user.id}, this)" class="text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded transition shadow-sm cursor-pointer">Invite</button>`;
                    }

                    // img size fix
                    const html = `
                        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition">
                            <div class="flex items-center gap-3">
                                <img src="${user.profile_image}" 
                                     alt="${user.name}"
                                     class="rounded-full object-cover border border-gray-200 shrink-0"
                                     style="width: 40px; height: 40px; min-width: 40px; max-width: 40px;">
                                
                                <div class="min-w-0">
                                    <p class="font-bold text-sm text-gray-800 truncate">${user.name}</p>
                                    <p class="text-xs text-gray-500 truncate">@${user.username}</p>
                                </div>
                            </div>
                            <div class="shrink-0 ml-2">
                                ${btnHtml}
                            </div>
                        </div>
                    `;
                    candidatesList.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(err => console.error(err));
    }

    // send invite
    window.sendInvite = function(userId, btnElement) {
        console.log("A enviar convite para user:", userId); // Debug --------------------------------------------
        
        const originalText = btnElement.innerText;
        btnElement.innerText = 'Sent!';
        btnElement.disabled = true;
        btnElement.classList.replace('bg-blue-600', 'bg-green-600');

        fetch(`/groups/${groupId}/invite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                console.log("Convite enviado com sucesso!");
            } else {
                console.error("Erro no envio:", data);
                btnElement.innerText = 'Error';
                btnElement.classList.replace('bg-green-600', 'bg-red-600');
            }
        })
        .catch(err => {
            console.error("Erro Fetch:", err);
            btnElement.innerText = 'Error';
            btnElement.classList.replace('bg-green-600', 'bg-red-600');
        });
    }

</script>

<style>
    .fade-in { animation: fadeIn 0.3s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush