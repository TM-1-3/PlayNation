<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
    
    <div class="h-40 overflow-hidden relative">
        <img src="{{ $group->getGroupPicture() }}" 
             alt="{{ $group->name }}" 
             class="w-full h-full object-cover">
        
        <div class="absolute top-2 right-2">
            @if($group->is_public)
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm">Public</span>
            @else
                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm"><i class="fa-solid fa-lock text-[10px] mr-1"></i>Private</span>
            @endif
        </div>
    </div>
    
    <div class="p-5 flex-1 flex flex-col">
        <h3 class="text-xl font-bold mb-2 text-gray-800 truncate">{{ $group->name }}</h3>
        
        <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
            {{ $group->description ?? 'No description available.' }}
        </p>

        <a href="{{ route('groups.show', $group->id_group) }}" class="mt-auto block w-full text-center text-blue-600 border border-blue-600 py-2 rounded-lg hover:bg-blue-50 transition font-medium no-underline">
            View Group
        </a>
    </div>
</article>
