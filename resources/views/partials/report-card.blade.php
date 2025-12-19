<div class="bg-white rounded-lg shadow-md hover:shadow-xl border border-gray-200 transition-shadow duration-300 p-4 mb-3">
    <div class="flex justify-between items-start mb-3">
        <div class="flex-1">
            {{-- Header section based on type --}}
            @if($type === 'post')
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">
                        {{ $report->report_count }} {{ $report->report_count == 1 ? 'Report' : 'Reports' }}
                    </span>
                    <span class="text-xs text-gray-500">Posted by</span>
                    <a href="{{ route('profile.show', $report->user->id_user) }}" class="text-sm font-semibold text-gray-800 hover:underline" title="Click to go to the user's page">
                        {{ $report->user->username }}
                    </a>
                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($report->date)->diffForHumans() }}</span>
                </div>
            @elseif($type === 'user')
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ $report->getProfileImage() }}" class="w-10 h-10 rounded-full object-cover border" alt="avatar">
                    <div>
                        <a href="{{ route('profile.show', $report->id_user) }}" class="font-semibold text-gray-800 hover:underline" title="Click to go the user's page">{{ $report->username }}</a>
                        <div class="text-xs text-gray-500">{{ $report->name }}</div>
                    </div>
                </div>
                <div>
                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">{{ $report->report_count }} {{ $report->report_count == 1 ? 'Report' : 'Reports' }}</span>
                </div>
            @elseif($type === 'group')
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ $report->getGroupPicture() }}" class="w-10 h-10 rounded object-cover border" alt="group">
                    <div>
                        <a href="{{ route('groups.show', $report->id_group) }}" class="font-semibold text-gray-800 hover:underline" title="Access the group's page">{{ $report->name }}</a>
                        <div class="text-xs text-gray-500">Owner: {{ $report->owner->username ?? '—' }}</div>
                    </div>
                </div>
                <div>
                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">{{ $report->report_count }} {{ $report->report_count == 1 ? 'Report' : 'Reports' }}</span>
                </div>
            @elseif($type === 'comment')
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-red-600 text-white text-xs py-1 px-2 rounded font-semibold">
                        {{ $report->report_count }} {{ $report->report_count == 1 ? 'Report' : 'Reports' }}
                    </span>
                    <span class="text-xs text-gray-500">Commented by</span>
                    <a href="{{ route('profile.show', $report->user->id_user) }}" class="text-sm font-semibold text-gray-800 hover:underline" title="Click to go to the user's page">
                        {{ $report->user->username }}
                    </a>
                </div>
            @endif

            {{-- Report reasons --}}
            <div class="mt-3">
                <p class="text-sm text-gray-700 font-medium mb-1">Report Reasons:</p>
                <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                    @foreach($report->report_descriptions as $description)
                        <li>{{ $description }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Action buttons based on type --}}
    <div class="flex gap-2">
        @if($type === 'post')
            <form action="{{ route('admin.post.delete', $report->id_post) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to delete this post?')" title="Delete the post">
                    Delete Post
                </button>
            </form>
            <form action="{{ route('admin.post.dismiss', $report->id_post) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="cursor-pointer bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Click to keep the content">
                    Dismiss Reports
                </button>
            </form>
            <a href="{{ route('profile.show', $report->user->id_user) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Click to view the post">
                View Post
            </a>
        @elseif($type === 'user')
            <form action="{{ route('admin.delete', $report->id_user) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Delete this user?')" title="Delete user account">
                    Ban User
                </button>
            </form>
            <form action="{{ route('admin.user.dismiss', $report->id_user) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="cursor-pointer bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Keep user account">
                    Dismiss Reports
                </button>
            </form>
            <a href="{{ route('profile.show', $report->id_user) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Go to the user's page">
                View Profile
            </a>
        @elseif($type === 'group')
            <form action="{{ route('admin.group.delete', $report->id_group) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Delete this group?')" title="Delete the group">
                    Delete Group
                </button>
            </form>
            <form action="{{ route('admin.group.dismiss', $report->id_group) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="cursor-pointer bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Keep the group">
                    Dismiss Reports
                </button>
            </form>
            <a href="{{ route('groups.show', $report->id_group) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Access the group's page">
                View Group
            </a>
        @elseif($type === 'comment')
            <form action="{{ route('admin.comment.delete', $report->id_comment) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to delete this comment?')" title="Delete the comment">
                    Delete Comment
                </button>
            </form>
            <form action="{{ route('admin.comment.dismiss', $report->id_comment) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="cursor-pointer bg-gray-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-gray-600 transition" title="Click to keep the content">
                    Dismiss Reports
                </button>
            </form>
            {{-- need to chande route --}}
            <a href="{{ route('profile.show', $report->user->id_user) }}" class="bg-blue-500 text-white text-sm py-1 px-3 rounded-lg hover:bg-blue-600 transition inline-block" title="Click to view the post">
                View Comment
            </a>
        @endif
    </div>
</div>
