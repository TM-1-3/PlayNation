<div class="overflow-y-auto h-[80vh] pt-6">
    @if(isset($reportedPosts) && $reportedPosts->count() > 0)
        <div class="space-y-4">
            @foreach($reportedPosts as $post)
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">
                                    {{ $post->report_count }} {{ $post->report_count == 1 ? 'Report' : 'Reports' }}
                                </span>
                                <span class="text-xs text-gray-500">Posted by</span>
                                <a href="{{ route('profile.show', $post->user->id_user) }}" class="text-sm font-semibold text-gray-800 hover:underline">
                                    {{ $post->user->username }}
                                </a>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</span>
                            </div>
                            
                            <div class="mb-3">
                                <p class="text-sm text-gray-700 font-medium mb-1">Report Reasons:</p>
                                <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                    @foreach($post->report_descriptions as $description)
                                        <li>{{ $description }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-3 mb-3">
                        @if($post->image)
                            <img class="w-full max-h-64 object-contain rounded mb-2" src="{{ $post->getPostImage() }}" alt="Post Content">
                        @endif
                        <p class="text-sm text-gray-800">{{ $post->description }}</p>
                        @if($post->labels->isNotEmpty())
                            <div class="mt-2 flex gap-1 flex-wrap">
                                @foreach($post->labels as $label)
                                    <span class="bg-blue-500 text-white text-xs py-1 px-2 rounded">{{ $label->designation }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <form action="{{ route('admin.post.delete', $post->id_post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to delete this post?')">
                                Delete Post
                            </button>
                        </form>
                        <form action="{{ route('admin.post.dismiss', $post->id_post) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-gray-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                                Dismiss Reports
                            </button>
                        </form>
                        <a href="{{ route('profile.show', $post->user->id_user) }}" class="bg-blue-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-600 transition inline-block">
                            View User Profile
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex justify-center mt-8 p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-500">No reported posts at this time.</p>
        </div>
    @endif
</div>
