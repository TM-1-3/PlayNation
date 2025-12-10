<div class="overflow-y-scroll">
    <div class="mb-8 mt-6">
        <form id="search-group-admin" action="{{ route('admin.group') }}" method="GET" class="flex gap-2 items-center max-w-2xl mx-auto">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
                                
                <input id="search-input-group" type="text" name="search" placeholder="Search by Group Name or Description..." 
                        class="h-[2em] block w-full pl-10 pr-4 py-2 border-none rounded-lg shadow-md text-gray-900 bg-white outline-none">
            </div>
            <button type="submit" class="h-[2em] bg-blue-500 text-white border-none py-1 px-3 rounded-lg text-base cursor-pointer transition-colors whitespace-nowrap hover:bg-blue-600 font-medium">Search</button>
        </form>
    </div>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groups as $group)
            @include('partials.group-card', ['group' => $group])
        @empty
            <div class="col-span-full mx-auto bg-white rounded-lg shadow-md p-10 text-center text-gray-500">
                <i class="fa-solid fa-users-slash text-4xl mb-4 text-gray-300"></i>
                <p class="text-lg">No groups found.</p>
            </div>
        @endforelse
    </div>
</div>
