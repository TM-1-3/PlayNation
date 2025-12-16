<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full" title="Access the group">
    <a href="{{ route('groups.show', $group->id_group) }}" class="block w-full text-center transition font-medium no-underline">
    <div class="h-40 overflow-hidden relative">
        <img src="{{ $group->getGroupPicture() }}" 
             alt="{{ $group->name }}" 
             class="w-[400px] h-[200px] object-cover">
        
        <div class="absolute top-2 right-2">
            @if($group->is_public)
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm">Public</span>
            @else
                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm"><i class="fa-solid fa-lock text-[10px] mr-1"></i>Private</span>
            @endif
        </div>
    </div>
    
    <div class="p-3 pb-0 flex-1 flex flex-col h-[12vh]">
        <h3 class="text-xl font-bold mb-2 text-gray-800 truncate">{{ $group->name }}</h3>
        
        <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
            {{ $group->description ?? 'No description available.' }}
        </p>
    </div>

     @if(request()->routeIs('admin', ['type' => 'group']))
        <div class="flex justify-center mb-5">
            <form action="{{ route('admin.group.delete', $group->id_group) }}" method="POST" onsubmit="return confirm('Delete this group?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white text-sm py-1 px-3 rounded-lg hover:bg-red-700 transition" title="Delete the group">Delete Group</button>
            </form>
        </div>
    @endif

    </a>

</article>
