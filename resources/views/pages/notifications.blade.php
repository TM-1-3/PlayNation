@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<div class="max-w-4xl mx-auto pt-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Notifications</h1>

    @if($notifications->isNotEmpty())

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">

         @foreach($notifications as $notification)
            @php
                $groupReq = $notification->joinGroupRequestNotification;
                $isGroupInvite = false;

                if ($groupReq) {
                    // if emmiter is a member, is invite
                    // if not member, is request
                    $isGroupInvite = $groupReq->group->members->contains($notification->emitter->id_user);
                }
            @endphp

            <div class="p-4 border-b border-gray-100 last:border-b-0 flex items-center justify-between flex-wrap gap-4">
                
                {{-- user info --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.show', $notification->emitter->id_user) }}">
                        <img src="{{ $notification->emitter->getProfileImage() }}" 
                             alt="{{ $notification->emitter->name }}" 
                             class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5">
                    </a>
                    
                    <div>
                        <p class="text-sm text-gray-800">
                            <a href="{{ route('profile.show', $notification->emitter->id_user) }}" class="font-bold hover:underline text-gray-900" title="Click here to go to the user's profile page">
                                {{ $notification->emitter->username }}
                            </a>
                            {{-- text logic --}}
                            
                            {{-- group notification --}}
                            @if($groupReq)
                                @if($isGroupInvite)
                                    {{-- invite text --}}
                                    <span class="text-gray-600"> invited you to join </span>
                                @else
                                    {{-- request text --}}
                                    <span class="text-gray-600"> requested to join your group </span>
                                @endif

                                <a href="{{ route('groups.show', $groupReq->group->id_group) }}" class="font-bold text-blue-600 hover:underline">
                                    {{ $groupReq->group->name }}
                                </a>.

                            {{-- friend fequest --}}
                            @elseif($notification->friendRequestNotification)
                                @if($notification->emitter->verifiedUser)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified user"></i>
                                @endif
                                <span class="text-gray-600"> wants to be your friend.</span>
                            @elseif($notification->friendRequestResultNotification)
                                @if($notification->emitter->verifiedUser)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified user"></i>
                                @endif
                                <span class="text-gray-600">
                                    @if(str_contains($notification->text, 'is now your friend'))
                                        is now your friend
                                    @else
                                        has denied your friend request
                                    @endif
                                </span>
                            @elseif($notification->joinGroupRequestResultNotification)
                                <span class="text-gray-600">
                                    Your request to join 
                                </span>
                                <a href="{{ route('groups.show', $notification->joinGroupRequestResultNotification->group->id_group) }}" class="font-bold text-blue-600 hover:underline">
                                    {{ $notification->joinGroupRequestResultNotification->group->name }}
                                </a>
                                <span class="text-gray-600">
                                    has been accepted!
                                </span>
                            @elseif($notification->privateMessageNotification)
                                @if($notification->emitter->verifiedUser)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified user"></i>
                                @endif
                                <span class="text-gray-600"> sent you a message</span>
                            @elseif($notification->groupMessageNotification)
                                @if($notification->emitter->verifiedUser)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified user"></i>
                                @endif
                                <span class="text-gray-600"> sent a message in </span>
                                <a href="{{ route('groups.show', $notification->groupMessageNotification->groupMessage->group->id_group) }}" class="font-bold text-blue-600 hover:underline">
                                    {{ $notification->groupMessageNotification->groupMessage->group->name }}
                                </a>
                            @endif
                        </p>
                        
                        <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($notification->date)->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- action buttons --}}
                <div class="flex gap-2">
                    
                    @if($groupReq)
                        
                        @if($isGroupInvite)
                            {{-- accept invite --}}
                            <form action="{{ route('groups.accept_invite', $groupReq->group->id_group) }}" method="POST">
                                @csrf
                                {{-- pass notification id to delete it --}}
                                <input type="hidden" name="notification_id" value="{{ $notification->id_notification }}">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors" title="Accept invitation to join the group">
                                    Join Group
                                </button>
                            </form>
                            
                            <form action="{{ route('groups.reject_invite', $groupReq->group->id_group) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="notification_id" value="{{ $notification->id_notification }}">
                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Decline the invitation to join the group">
                                    Decline
                                </button>
                            </form>

                        @else
                            {{-- accept request --}}
                            <form action="{{ route('groups.accept_request', ['group' => $groupReq->group->id_group, 'user' => $notification->emitter->id_user]) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors" title="Approve the user entering the group">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('groups.reject_request', ['group' => $groupReq->group->id_group, 'user' => $notification->emitter->id_user]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Reject the user entering the group">
                                    Reject
                                </button>
                            </form>
                        @endif

                    @elseif($notification->friendRequestNotification)
                        {{-- friend buttons --}}
                        <form action="{{ route('notifications.accept', $notification->id_notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors" title="Accept friend request">
                                Accept
                            </button>
                        </form>
                        <form action="{{ route('notifications.deny', $notification->id_notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Deny friend request">
                                Deny
                            </button>
                        </form>
                    @elseif($notification->friendRequestResultNotification)
                        <form action="{{ route('notifications.read', $notification->id_notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Mark as read">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>
                    @elseif($notification->joinGroupRequestResultNotification)
                        <form action="{{ route('notifications.read', $notification->id_notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Mark as read">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>
                    @elseif($notification->privateMessageNotification)
                        <div class="flex gap-2">
                            <form action="{{ route('notifications.read', $notification->id_notification) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Mark as read">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                        </div>
                    @elseif($notification->groupMessageNotification)
                        <div class="flex gap-2">
                            <a href="{{ route('groups.show', $notification->groupMessageNotification->groupMessage->group->id_group) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors" title="View group">
                                View Group
                            </a>
                            <form action="{{ route('notifications.read', $notification->id_notification) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors" title="Mark as read">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @else
        {{-- empty state --}}
        <div class="text-center py-12">
            <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-bell text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900">No new notifications</h3>
            <p class="text-gray-500 mt-1">When someone interacts with you or your groups, it will appear here.</p>
        </div>
    @endif

</div>
@endsection