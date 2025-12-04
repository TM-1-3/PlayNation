<div class="bg-white border border-gray-200 rounded-lg mb-5 text-left flex flex-col" id="post-{{ $post->id_post }}">
    <div class="flex items-center p-3.5">
        @if($post->user)
            <a href="{{ route('profile.show', $post->user->id_user) }}">
                <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                     src="{{ $post->user->getProfileImage() }}" 
                     alt="avatar">
            </a>
            <a href="{{ route('profile.show', $post->user->id_user) }}" class="font-semibold text-sm text-gray-800 no-underline">
                {{ $post->user->username }}
            </a>
        @else
            <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" src="{{ asset('img/default_avatar.png') }}" alt="avatar">
            <span class="font-semibold text-sm text-gray-800">Unknown User</span>
        @endif
        
        <span class="ml-auto text-xs text-gray-500">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>
    </div>

    @if($post->image)
        <img class="w-full block border-t border-gray-200" src="{{ asset($post->image) }}" alt="Post Content">
    @endif
    
    <div class="py-3 px-4 text-sm leading-relaxed">
        @if($post->user)
            <a href="{{ route('profile.show', $post->user->id_user) }}" class="font-semibold mr-1 text-gray-800 no-underline">
                {{ $post->user->username }}
            </a>
        @endif
        {{ $post->description }}
    </div>

    @if($post->labels->isNotEmpty())
        <div class="px-4 pb-4 flex gap-1 flex-wrap">
            @foreach($post->labels as $label)
                <span class="bg-blue-500 text-white text-xs py-1 px-2 rounded font-semibold">{{ $label->designation }}</span>
            @endforeach
        </div>
    @endif
</div>
