{{-- report card (hidden) --}}
<div id="report-card-{{ $post->id_post }}" class="hidden absolute w-2xl top-[20em] right-[13em] mx-auto bg-white border border-gray-200 rounded-lg p-4 ">
        <div class="flex justify-between items-start mb-3">
            <h4 class="font-semibold text-red-800 text-lg">Report Post</h4>
            <button onclick="toggleReport({{ $post->id_post }})" class="text-red-600 hover:text-red-800 font-bold text-2xl leading-none">&times;</button>
        </div>
        <form action="{{ route('post.report', $post->id_post) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for reporting:</label>
                <select name="reason" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <option value="">Select a reason</option>
                    <option value="spam">Spam</option>
                    <option value="harassment">Harassment or hate speech</option>
                    <option value="inappropriate">Inappropriate content</option>
                    <option value="misinformation">Misinformation</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional details (optional):</label>
                <textarea name="details" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Provide more information..."></textarea>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition font-medium">Submit Report</button>
                <button type="button" onclick="toggleReport({{ $post->id_post }})" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition font-medium">Cancel</button>
            </div>
        </form>
</div>

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
                <button onclick="toggleReport({{ $post->id_post }})" class="text-black py-1 px-1 text-xl no-underline bg-transparent border-none cursor-pointer" title="Report post">⋮</button>
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
