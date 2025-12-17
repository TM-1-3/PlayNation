<div class="overflow-y-auto h-[80vh] pt-6 space-y-6">

    {{-- Reported Posts --}}
    <div>
        <h4 class="text-lg font-semibold mb-3">Reported Posts</h4>
        @if(isset($reportedPosts) && $reportedPosts->count() > 0)
            <div class="space-y-4">
                @foreach($reportedPosts as $post)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl border border-gray-200 transition-shadow duration-300 p-4 mb-3">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">
                                        {{ $post->report_count }} {{ $post->report_count == 1 ? 'Report' : 'Reports' }}
                                    </span>
                                    <span class="text-xs text-gray-500">Posted by</span>
                                    <a href="{{ route('profile.show', $post->user->id_user) }}" class="text-sm font-semibold text-gray-800 hover:underline" title="Click to go to the user's page">
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

                        <div class="flex gap-2">
                            <form action="{{ route('admin.post.delete', $post->id_post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to delete this post?')" title="Delete the post">
                                    Delete Post
                                </button>
                            </form>
                            <form action="{{ route('admin.post.dismiss', $post->id_post) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Click to keep the content">
                                    Dismiss Reports
                                </button>
                            </form>
                            <a href="{{ route('profile.show', $post->user->id_user) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Click to view the post">
                                View Post
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center mt-2 p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No reported posts at this time.</p>
            </div>
        @endif
    </div>

    {{-- Reported Users --}}
    <div>
        <h4 class="text-lg font-semibold mb-3">Reported Users</h4>
        @if(isset($reportedUsers) && $reportedUsers->count() > 0)
            <div class="space-y-4">
                @foreach($reportedUsers as $u)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl border border-gray-200 transition-shadow duration-300 p-4 mb-3">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <img src="{{ $u->getProfileImage() }}" class="w-10 h-10 rounded-full object-cover border" alt="avatar">
                                    <div>
                                        <a href="{{ route('profile.show', $u->id_user) }}" class="font-semibold text-gray-800 hover:underline" title="Click to go the user's page">{{ $u->username }}</a>
                                        <div class="text-xs text-gray-500">{{ $u->name }}</div>
                                    </div>
                                </div>
                                <div>
                                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">{{ $u->report_count }} {{ $u->report_count == 1 ? 'Report' : 'Reports' }}</span>
                                </div>

                                <div class="mt-3">
                                    <p class="text-sm text-gray-700 font-medium mb-1">Report Reasons:</p>
                                    <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                        @foreach($u->report_descriptions as $d)
                                            <li>{{ $d }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <form action="{{ route('admin.delete', $u->id_user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Delete this user?')" title="Delete user account">Delete User</button>
                            </form>

                            <form action="{{ route('admin.user.dismiss', $u->id_user) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Keep user account">Dismiss Reports</button>
                            </form>

                            <a href="{{ route('profile.show', $u->id_user) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Go to the user's page">View Profile</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center mt-2 p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No reported users at this time.</p>
            </div>
        @endif
    </div>

    {{-- Reported Groups --}}
    <div>
        <h4 class="text-lg font-semibold mb-3">Reported Groups</h4>
        @if(isset($reportedGroups) && $reportedGroups->count() > 0)
            <div class="space-y-4">
                @foreach($reportedGroups as $g)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl border border-gray-200 transition-shadow duration-300 p-4 mb-3">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <img src="{{ $g->getGroupPicture() }}" class="w-10 h-10 rounded object-cover border" alt="group">
                                    <div>
                                        <a href="{{ route('groups.show', $g->id_group) }}" class="font-semibold text-gray-800 hover:underline" title="Access the group's page">{{ $g->name }}</a>
                                        <div class="text-xs text-gray-500">Owner: {{ $g->owner->username ?? '—' }}</div>
                                    </div>
                                </div>
                                <div>
                                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">{{ $g->report_count }} {{ $g->report_count == 1 ? 'Report' : 'Reports' }}</span>
                                </div>

                                <div class="mt-3">
                                    <p class="text-sm text-gray-700 font-medium mb-1">Report Reasons:</p>
                                    <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                        @foreach($g->report_descriptions as $d)
                                            <li>{{ $d }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <form action="{{ route('admin.group.delete', $g->id_group) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Delete this group?')" title="Delete the group">Delete Group</button>
                            </form>
                            <form action="{{ route('admin.group.dismiss', $g->id_group) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Keep the group">Dismiss Reports</button>
                            </form>
                            <a href="{{ route('groups.show', $g->id_group) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Access the group's page">View Group</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center mt-2 p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No reported groups at this time.</p>
            </div>
        @endif
    </div>

</div>
