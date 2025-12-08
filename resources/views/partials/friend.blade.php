<div class="bg-white p-3 rounded-lg border border-blue-600 flex items-center justify-between hover:bg-gray-50 transition-colors">
    <div class="flex items-center gap-4">
        <a href="{{ route('profile.show', $friend->id_user) }}" class="flex-shrink-0">
            <img src="{{ $friend->getProfileImage()}}" 
                 alt="{{ $friend->name }}" 
                 class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5">
        </a>
        <div>
            <h3 class="font-bold text-gray-900 text-sm leading-tight">
                <a href="{{ route('profile.show', $friend->id_user) }}" class="hover:underline">
                    {{ $friend->name }}
                </a>
            </h3>
            <div class="flex items-center gap-1">
                <p class="text-gray-500 text-xs">{{ '@' . $friend->username }}</p>
                @if($friend->verifiedUser)
                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified"></i>
                @endif
</div>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('profile.show', $friend->id_user) }}" class="hidden sm:block text-gray-600 hover:text-blue-600 text-sm font-semibold px-3 py-1 rounded bg-gray-100 hover:bg-blue-50 transition-colors">
            View
        </a>
        @if(Auth::id() === $user->id_user)
            <form action="{{ route('friend.remove', $friend->id_user) }}" method="POST" onsubmit="return confirm('Remove this friend?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-gray-100 text-gray-700 text-sm font-semibold px-5 py-2 rounded border border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all">
                    Unfriend
                </button>
            </form>
        @endif
    </div>
</div>