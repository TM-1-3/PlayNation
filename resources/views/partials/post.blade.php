{{-- report modal include --}}
@include('partials.report_modal', [
    'modalId' => "report-modal-post-{$post->id_post}",
    'action' => route('post.report', $post->id_post),
    'title' => 'Report Post',
    'target_type' => 'post',
    'target_id' => $post->id_post,
])

<div class="bg-white border border-gray-200 rounded-lg mb-5 text-left flex flex-col" id="post-{{ $post->id_post }}">

    <div class="flex items-center p-3.5">
        <a href="{{ route('profile.show', $post->user->id_user) }}">
            <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                src="{{ $post->user->getProfileImage() }}" 
                alt="avatar">
        </a>
        <a href="{{ route('profile.show', $post->user->id_user) }}" class="font-semibold text-sm text-gray-800 no-underline">
            {{ $post->user->username }}
            @if($post->user->verifiedUser)
                <i class="fa-solid fa-circle-check text-blue-500 text-[12px]"></i>
            @endif
        </a>
        
        <span class="ml-auto text-xs text-gray-500 pr-4">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>

        @if($type == 'profile' && Auth::check() && Auth::id() == $post->id_creator)
            <div>
                <a href="{{ route('post.edit', $post->id_post) }}" class="text-black py-1 px-1 text-xl no-underline" title="Edit post">⋮</a>
            </div>
        @else
            <div>
                <button onclick="toggleReport('post', {{ $post->id_post }})" class="text-black py-1 px-1 text-xl no-underline bg-transparent border-none cursor-pointer" title="Report post">⋮</button>
            </div>
        @endif
    </div>

    @if($post->image)
        <img class="w-full block border-t border-gray-200" src="{{ $post->getPostImage() }}" alt="Post Content">
    @endif
    
    <div class="flex items-center gap-4 px-4 pt-2">
        <button class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer" title="Like">
            <i class="fa-regular fa-heart text-lg"></i>
            <span class="text-sm">Like</span>
        </button>
        <button class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer" title="Comment">
            <i class="fa-regular fa-comment text-lg"></i>
            <span class="text-sm">Comment</span>
        </button>
        <button class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer" title="Share">
            <i class="fa-regular fa-share-from-square text-lg"></i>
            <span class="text-sm">Share</span>
        </button>
        <form action="{{ route('post.save', $post->id_post) }}" method="POST" class="ml-auto">
            @csrf
            @php
                $isSaved = isset($savedPostIds) && in_array($post->id_post, $savedPostIds);
            @endphp
            <button class="flex items-center gap-1 text-gray-600 bg-transparent border-none cursor-pointer" title="Save">
                <i class="{{ $isSaved ? 'fa-solid' : 'fa-regular' }} fa-bookmark text-lg"></i>
                <span class="text-sm">Save</span>
            </button>
        </form>
    </div>
    
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
