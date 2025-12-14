@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<div class="max-w-4xl mx-auto pt-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Notifications</h1>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('status') }}
        </div>
    @endif

    {{-- Verifica se a lista unificada tem coisas --}}
    @if($notifications->isNotEmpty())

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        
        @foreach($notifications as $notification)
            <div class="p-4 border-b border-gray-100 last:border-b-0 flex items-center justify-between flex-wrap gap-4">
                
                {{-- User Info (Comum a todos) --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.show', $notification->emitter->id_user) }}">
                        <img src="{{ $notification->emitter->getProfileImage() }}" 
                             alt="{{ $notification->emitter->name }}" 
                             class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    </a>
                    
                    <div>
                        <p class="text-sm text-gray-800">
                            <a href="{{ route('profile.show', $notification->emitter->id_user) }}" class="font-bold hover:underline text-gray-900">
                                {{ $notification->emitter->name }}
                            </a>
                            
                            {{-- LÓGICA DE TEXTO DINÂMICO 🔀 --}}
                            
                            {{-- CASO 1: Pedido de Grupo --}}
                            @if($notification->joinGroupRequestNotification)
                                <span class="text-gray-600"> requested to join your group </span>
                                <a href="{{ route('groups.show', $notification->joinGroupRequestNotification->group->id_group) }}" class="font-bold text-blue-600 hover:underline">
                                    {{ $notification->joinGroupRequestNotification->group->name }}
                                </a>.

                            {{-- CASO 2: Pedido de Amizade --}}
                            @elseif($notification->friendRequestNotification)
                                @if($notification->emitter->verifiedUser)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified"></i>
                                @endif
                                <span class="text-gray-600"> wants to be your friend.</span>
                            @endif
                        </p>
                        
                        <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($notification->date)->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Botoes de Ação (Diferentes para cada tipo) --}}
                <div class="flex gap-2">
                    
                    {{-- BOTOES DE GRUPO --}}
                    @if($notification->joinGroupRequestNotification)
                        {{-- (Ainda vamos criar estas rotas no próximo passo, mas o HTML fica já pronto) --}}
                        <form action="{{ route('groups.accept_request', ['group' => $notification->joinGroupRequestNotification->group->id_group, 'user' => $notification->emitter->id_user]) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors">
                                Accept
                            </button>
                        </form>
                        <form action="{{ route('groups.reject_request', ['group' => $notification->joinGroupRequestNotification->group->id_group, 'user' => $notification->emitter->id_user]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors">
                                Decline
                            </button>
                        </form>

                    {{-- BOTOES DE AMIZADE --}}
                    @elseif($notification->friendRequestNotification)
                        <form action="{{ route('notifications.accept', $notification->id_notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded transition-colors">
                                Accept
                            </button>
                        </form>
                        <form action="{{ route('notifications.deny', $notification->id_notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold py-2 px-4 rounded transition-colors">
                                Deny
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

    @else
        {{-- ESTADO VAZIO --}}
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