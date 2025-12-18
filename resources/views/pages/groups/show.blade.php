@extends('layouts.app')

@section('title', $group->name)

@section('content')

<div class="max-w-6xl mx-auto pt-10 pr-5 pb-5">
    <div class="flex flex-wrap gap-8">
        
        {{-- left info --}}
        <div class="w-full md:w-1/3 md:min-w-[280px] ml-5">
            
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-5">

                <div class="mb-4">
                    <a href="{{ route('groups.index') }}" 
                       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 font-semibold transition-colors group">
                        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                        Back to Groups
                    </a>
                </div>
                
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
                    {{-- Counter Clicável --}}
                    <div class="text-center cursor-pointer hover:bg-gray-50 rounded p-1 transition select-none" onclick="openMembersModal()">
                        <span class="block text-xl font-bold text-blue-600" id="member-count" title="Click to see the group's members">
                            {{ $group->members->count() }}
                        </span>
                        <span class="text-xs text-gray-500 uppercase">Members</span>
                    </div>
                    
                </div>

                {{-- group actions --}}
                <div class="flex flex-col gap-3 mt-6">
                    
                    @auth
                        {{-- Owner? shows edit --}}
                        @if(Auth::id() === $group->id_owner)
                            <a href="{{ route('groups.edit', $group->id_group) }}" class="w-full bg-gray-100 text-gray-700 py-2.5 rounded-lg hover:bg-gray-200 transition font-bold text-center no-underline border border-gray-300" title="Edit the group settings">
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
                                class="w-full mt-4 bg-blue-100 text-blue-600 font-bold py-2 rounded-lg hover:bg-blue-200 transition flex items-center justify-center gap-2 cursor-pointer relative z-10 shadow-sm active:scale-95" title="Invite users to the group">
                            <i class="fa-solid fa-user-plus"></i> Invite Friends
                        </button>
                    @endif

                    {{-- report group button --}}
                    <button onclick="toggleReport('group', {{ $group->id_group }})" 
                            class="w-full mt-2 bg-transparent text-red-600 border border-red-100 py-2 rounded-lg hover:bg-red-50 transition font-bold flex items-center justify-center gap-2" title="Report the group">
                        <i class="fa-solid fa-flag mr-1"></i> Report Group
                    </button>

                    {{-- report modal moved to page bottom to avoid stacking issues --}}



                </div>
            </div>
        </div>

        {{-- right column chat --}}
        <div class="flex-1 min-w-0">
            
            @if($canViewContent)
                <div class="bg-white rounded-lg shadow-md h-[calc(100vh-150px)] min-h-[500px] flex flex-col relative overflow-hidden border border-gray-200">
                    
                    {{-- header --}}
                    <div class="p-4 border-b bg-white flex justify-between items-center shadow-sm z-10">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <span class="text-lg">{{ $group->name }}</span>
                        </h3>
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full border border-green-100 flex items-center gap-1 font-medium">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Live Chat
                        </span>
                    </div>

                    {{-- messages area --}}
                    {{-- backgound like in dms --}}
                    <div class="flex-1 p-4 overflow-y-auto bg-gray-50 flex flex-col gap-3 custom-scrollbar scroll-smooth" id="chat-messages">
                        {{-- O JS vai preencher isto --}}
                        <div class="text-center text-gray-400 mt-20" id="loading-msg">
                            <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i>
                            <p>Loading messages...</p>
                        </div>
                    </div>

                    {{-- input area --}}
                    <div class="p-4 bg-white border-t border-gray-100 shrink-0">
                        <form id="chat-form" class="relative flex items-center gap-2">
                            
                            {{-- attachments btn (nothing for now) --}}
                            <button type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-full transition" title="Attach file">
                                <i class="fa-solid fa-paperclip"></i>
                            </button>
                            
                            {{-- txt input --}}
                            <input type="text" 
                                   id="message-input"
                                   name="text"
                                   placeholder="Type a message..." 
                                   class="w-full bg-gray-100 border-0 rounded-full py-3 px-5 focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-sm"
                                   autocomplete="off">
                            
                            {{-- send btn --}}
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-md transition transform active:scale-95 flex items-center justify-center w-10 h-10 group">
                                <i class="fa-solid fa-paper-plane text-sm group-hover:animate-pulse"></i>
                            </button>

                        </form>
                    </div>

                </div>
            @else
                {{-- block content btn --}}
                <div class="bg-white rounded-lg shadow-md h-[500px] flex items-center justify-center text-center border border-gray-200 p-10">
                    <div>
                        <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa-solid fa-lock text-4xl text-gray-400"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Private Group</h2>
                        <p class="text-gray-500 max-w-md mx-auto">
                            This group is private. Join the group to access the chat and see what's happening inside.
                        </p>
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>

{{-- invite section modal --}}
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

        {{-- candidates list --}}
        <div id="candidates-list" class="p-4 max-h-[400px] overflow-y-auto flex flex-col gap-2 custom-scrollbar">
            <div class="text-center py-8">
                <i class="fa-solid fa-spinner fa-spin text-blue-500 text-3xl mb-3"></i>
                <p class="text-gray-500 text-sm">Loading your friends list...</p>
            </div>
        </div>

    </div>
</div>

{{-- members section modal --}}
<div id="members-modal" class="fixed inset-0 bg-black/50 hidden z-[9999] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden mx-4">
        
        {{-- header --}}
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-users text-blue-500"></i> Group Members
            </h3>
            <button onclick="closeMembersModal()" class="text-gray-400 hover:text-gray-600 w-8 h-8 rounded-full hover:bg-gray-200 transition flex items-center justify-center">
                <i class="fa-solid fa-times text-lg"></i>
            </button>
        </div>

        {{-- list --}}
        <div id="members-list" class="p-4 max-h-[400px] overflow-y-auto flex flex-col gap-2 custom-scrollbar">
            {{-- js fills this with the members --}}
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
    // global vars
    const groupId = "{{ $group->id_group }}";
    const currentUserId = "{{ Auth::id() }}"; 
    const currentUserName = "{{ Auth::user()->name ?? 'User' }}"; 
    
    // state controll
    let lastLoadedId = 0; 
    let isFirstLoad = true; // for smooth scroll
    let pollingInterval = null;

    document.addEventListener('DOMContentLoaded', function() {
        
        // DOM elements
        const chatContainer = document.getElementById('chat-messages');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const loadingMsg = document.getElementById('loading-msg');

        function loadMessages() {
            //?after_id for performance, only loads new msgs
            fetch(`/groups/${groupId}/messages?after_id=${lastLoadedId}`)
                .then(response => response.json())
                .then(messages => {
                    // removes animated spinner
                    if (loadingMsg) loadingMsg.remove(); 
                    
                    if (messages.length > 0) {
                        renderChat(messages);
                    }
                })
                .catch(error => console.error('Error loading:', error));
        }

        function renderChat(messages) {
            let newMessagesAdded = false;

            messages.forEach(msg => {
                // only adds if they exist
                if (!document.getElementById(`msg-${msg.id_message}`)) {
                    appendMessageToChat(msg);
                    
                    // updates controll id for next search
                    if (msg.id_message > lastLoadedId) {
                        lastLoadedId = msg.id_message;
                    }
                    newMessagesAdded = true;
                }
            });

            // scroll id loading for first time or if theres new msgs
            if (newMessagesAdded || isFirstLoad) {
                scrollToBottom();
                isFirstLoad = false;
            }
        }

        function appendMessageToChat(msg, isOptimistic = false, customId = null) {
            const isMe = msg.id_sender == currentUserId;
            
            // style classes
            const alignmentClass = isMe ? 'justify-end' : 'justify-start';
            const bgClass = isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none';
            const opacityClass = isOptimistic ? 'opacity-70' : 'opacity-100';
            
            // id and data
            const elementId = customId ? customId : `msg-${msg.id_message}`;
            const timeDisplay = isOptimistic ? 'Sending...' : new Date(msg.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            // clear tag [post:NUM]
            let displayText = msg.text ? msg.text.replace(/\[post:\d+\]/, '').trim() : '';

            // get post data
            const post = msg.shared_post_data || (msg.message ? msg.message.shared_post_data : null);

            let contentHtml = '';

            // draw post card like in feed
            if (post) {
                if (!displayText) displayText = "Shared a post";

                // data pesets
                const username = post.user ? post.user.username : 'Unknown';
                const userImg = post.user && post.user.profile_image 
                    ? post.user.profile_image 
                    : 'https://ui-avatars.com/api/?name=' + username;
                const description = post.description || post.text_content || ''; 

                contentHtml += `
                    <div class="mt-1 mb-2 bg-white rounded-lg border border-gray-200 overflow-hidden cursor-pointer hover:shadow-md transition-shadow text-left group-post"
                         onclick="window.location.href='/post/${post.id_post}'">
                        
                        <div class="flex items-center p-3 border-b border-gray-100 bg-white">
                            <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" src="${userImg}">
                            <div class="font-semibold text-sm text-gray-800">${username}</div>
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

            // adds clean text
            if (displayText) {
                contentHtml += `<p>${displayText}</p>`;
            }
            // ----------------------------------------------

            // pfp for other users
            const avatarHtml = !isMe && msg.sender
                ? `<img src="${msg.sender.profile_image}" alt="${msg.sender.name}" class="w-8 h-8 rounded-full object-cover mr-2 self-end mb-1 border border-gray-200 shadow-sm">` 
                : '';
            
            // name for other users
            const nameHtml = !isMe && msg.sender
                ? `<span class="text-xs text-gray-500 mb-1 ml-1">${msg.sender.name}</span>` 
                : '';

            const html = `
                <div id="${elementId}" class="flex ${alignmentClass} mb-4 fade-in ${opacityClass}">
                    ${avatarHtml}
                    <div class="max-w-[70%] flex flex-col ${isMe ? 'items-end' : 'items-start'}">
                        ${nameHtml}
                        <div class="${bgClass} px-4 py-2 rounded-2xl shadow-sm relative group text-sm leading-relaxed break-words overflow-hidden">
                            ${contentHtml}
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

        // send msg
        if(chatForm){
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault(); 
                const textValue = messageInput.value.trim();
                if (!textValue) return;
                
                // clear input n focus
                messageInput.value = ''; 
                messageInput.focus();
                
                // temp id
                const tempId = 'temp-' + Date.now();

                appendMessageToChat({
                    id_sender: currentUserId,
                    sender: { name: currentUserName, profile_image: "{{ Auth::user()->getProfileImage() }}" }, // for visuals
                    text: textValue,
                    date: new Date().toISOString() 
                }, true, tempId);

                scrollToBottom();

                // ajax send
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
                        // sitch temp id for real one
                        const tempElement = document.getElementById(tempId);
                        if (tempElement) {
                            tempElement.id = `msg-${data.message.id_message}`;
                            tempElement.classList.remove('opacity-70');
                            tempElement.classList.add('opacity-100');
                            
                            const timeSpan = tempElement.querySelector('.message-time');
                            if(timeSpan) timeSpan.innerText = new Date(data.message.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                        }
                        // update cursor
                        if (data.message.id_message > lastLoadedId) lastLoadedId = data.message.id_message;
                    }
                })
                .catch(error => console.error('Error sending:', error));
            });
        }

        //starts 
        loadMessages();
        pollingInterval = setInterval(loadMessages, 3000); 
    });

    
    window.openInviteModal = function() {
        const inviteModal = document.getElementById('invite-modal');
        if(inviteModal) {
            inviteModal.classList.remove('hidden');
            loadCandidates();
        }
    }

    window.closeInviteModal = function() {
        const inviteModal = document.getElementById('invite-modal');
        if(inviteModal) inviteModal.classList.add('hidden');
    }

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
                    // btns logic
                    let btnHtml = '';
                    if (user.status === 'member') {
                        btnHtml = `<span class="text-xs font-bold text-gray-400 px-3 border border-gray-200 rounded py-1 bg-gray-50">Member</span>`;
                    } else if (user.status === 'pending') {
                        btnHtml = `<span class="text-xs font-bold text-yellow-600 px-3 border border-yellow-200 rounded py-1 bg-yellow-50">Pending</span>`;
                    } else {
                        btnHtml = `<button onclick="sendInvite(${user.id}, this)" class="text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded transition shadow-sm cursor-pointer">Invite</button>`;
                    }

                    const html = `
                        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition">
                            <div class="flex items-center gap-3">
                                <img src="${user.profile_image}" class="rounded-full object-cover border border-gray-200 shrink-0" style="width: 40px; height: 40px;">
                                <div class="min-w-0">
                                    <p class="font-bold text-sm text-gray-800 truncate">${user.name}</p>
                                    <p class="text-xs text-gray-500 truncate">@${user.username}</p>
                                </div>
                            </div>
                            <div class="shrink-0 ml-2">${btnHtml}</div>
                        </div>
                    `;
                    candidatesList.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(err => console.error(err));
    }

    window.sendInvite = function(userId, btnElement) {
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
            if (data.status !== 'success') {
                btnElement.innerText = 'Error';
                btnElement.classList.replace('bg-green-600', 'bg-red-600');
            }
        });
    }

    // members funcs
    
    window.openMembersModal = function() {
        const modal = document.getElementById('members-modal');
        if(modal) {
            modal.classList.remove('hidden');
            loadMembers();
        }
    }

    window.closeMembersModal = function() {
        const modal = document.getElementById('members-modal');
        if(modal) modal.classList.add('hidden');
    }

    function loadMembers() {
        const list = document.getElementById('members-list');
        list.innerHTML = '<div class="text-center py-4 text-gray-500"><i class="fa-solid fa-spinner fa-spin mr-2"></i>Loading members...</div>';

        fetch(`/groups/${groupId}/members`)
            .then(res => res.json())
            .then(members => {
                list.innerHTML = '';
                members.forEach(member => {
                    let actionHtml = '';
                    if (member.can_kick) {
                        actionHtml = `<button onclick="kickMember(${member.id}, this)" class="text-xs font-bold text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded transition shadow-sm cursor-pointer border border-transparent" title="Remove User"><i class="fa-solid fa-user-xmark"></i> Remove</button>`;
                    } else if (member.is_owner) {
                        actionHtml = `<span class="text-xs font-bold text-blue-600 bg-blue-50 border border-blue-200 px-2 py-1 rounded">Owner</span>`;
                    }

                    const html = `
                        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition group">
                            <div class="flex items-center gap-3">
                                <img src="${member.profile_image}" class="rounded-full object-cover border border-gray-200 shrink-0" style="width: 40px; height: 40px;">
                                <div class="min-w-0">
                                    <p class="font-bold text-sm text-gray-800 truncate">${member.name}</p>
                                    <p class="text-xs text-gray-500 truncate">@${member.username}</p>
                                </div>
                            </div>
                            <div class="shrink-0 ml-2">${actionHtml}</div>
                        </div>
                    `;
                    list.insertAdjacentHTML('beforeend', html);
                });
            });
    }

    window.kickMember = function(userId, btnElement) {
        if(!confirm('Are you sure you want to remove this user?')) return;
        
        btnElement.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        btnElement.disabled = true;

        fetch(`/groups/${groupId}/members/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const row = btnElement.closest('.flex'); 
                row.remove();
                const countEl = document.getElementById('member-count');
                if(countEl) countEl.innerText = Math.max(0, parseInt(countEl.innerText) - 1);
            } else {
                alert('Error removing user');
                btnElement.disabled = false;
            }
        });
    }

</script>

<style>
    .fade-in { animation: fadeIn 0.3s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    /* custom scroll */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(156, 163, 175, 0.5); border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: rgba(107, 114, 128, 0.8); }
</style>
@endpush