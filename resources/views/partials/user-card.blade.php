<div class="flex justify-between bg-white rounded-lg p-5 transition-all shadow-md hover:shadow-xl hover:border-blue-400">
    <div class="flex items-center gap-4">
        <a href="{{ route('profile.show', $friend->id_user) }}" class="flex-shrink-0">
            <img src="{{ $friend->getProfileImage()}}" 
                 alt="{{ $friend->name }}" 
                 class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5">
        </a>
        <div>
            <h3 class="font-bold text-gray-900 text-sm leading-tight ">
                <a href="{{ route('profile.show', $friend->id_user) }}" class="hover:underline" title="Click to view the profile">
                    {{ $friend->name }}
                </a>
            </h3>
            <div class="flex items-center gap-1">
                <p class="text-gray-500 text-xs">{{ '@' . $friend->username }}</p>
                @if($friend->verifiedUser)
                    <i class="fa-solid fa-circle-check text-blue-500 text-[12px]" title="Verified user"></i>
                @endif
            </div>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('profile.show', $friend->id_user) }}" class="hidden sm:block text-gray-600 hover:text-blue-600 text-sm font-semibold px-3 py-1 rounded bg-gray-100 hover:bg-blue-50 transition-colors" title="Click to view your friend's profile">
            View
        </a>
        @if(Auth::id() === $user->id_user && Route::is('user.friends'))
            <form action="{{ route('friend.remove', $friend->id_user) }}" method="POST" onsubmit="return confirm('Remove this friend?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-gray-600 text-sm font-medium px-4 py-1.5 rounded-lg border border-gray-300 hover:border-red-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Remove this user as your friend duration-200">
                    <i class="fa-solid fa-user-minus mr-1.5 text-xs"></i>Unfriend
                </button>
            </form>
        @endif
    </div>
</div>


