<div class="overflow-y-auto h-[80vh] pt-6 space-y-6">

    {{-- Reported Posts --}}
    <div>
        <h4 class="text-lg font-semibold mb-3">Reported Posts</h4>
        @if(isset($reportedPosts) && $reportedPosts->count() > 0)
            <div class="space-y-4">
                @foreach($reportedPosts as $post)
                    @include('partials.report-card', ['report' => $post, 'type' => 'post'])
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
                @foreach($reportedUsers as $user)
                    @include('partials.report-card', ['report' => $user, 'type' => 'user'])
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
                @foreach($reportedGroups as $group)
                    @include('partials.report-card', ['report' => $group, 'type' => 'group'])
                @endforeach
            </div>
        @else
            <div class="flex justify-center mt-2 p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No reported groups at this time.</p>
            </div>
        @endif
    </div>

    {{-- Reported Comments --}}
    <div>
        <h4 class="text-lg font-semibold mb-3">Reported Comments</h4>
        @if(isset($reportedComments) && $reportedComments->count() > 0)
            <div class="space-y-4">
                @foreach($reportedComments as $comment)
                    @include('partials.report-card', ['report' => $comment, 'type' => 'comment'])
                @endforeach
            </div>
        @else
            <div class="flex justify-center mt-2 p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No reported comments at this time.</p>
            </div>
        @endif
    </div>

</div>
