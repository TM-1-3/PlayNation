<div>
        <div class="flex justify-between items-end gap-4 mb-8 mt-6 flex-wrap">
            <form id="search-group-admin" class="flex gap-2 flex-1 min-w-[300px] max-w-xl items-center" action="{{ route('admin') }}" method="GET">
                <input type="text" name="search" placeholder="Search for Groups by Name and Description..." class="flex-1 py-1 px-4 border border-gray-300 rounded text-base transition-colors focus:border-blue-600 focus:outline-none focus:shadow-[0_0_0_3px_rgba(30,0,255,0.1)]">
                <button type="submit" class="bg-blue-500 text-white border-none py-1 px-3 rounded text-base cursor-pointer transition-colors whitespace-nowrap hover:bg-blue-600">Search</button>
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
