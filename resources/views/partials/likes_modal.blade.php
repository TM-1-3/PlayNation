@props(['modalId', 'postId'])

<div id="likes-modal-{{ $post->id_post }}"
     class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center backdrop-blur-sm"
     onclick="if(event.target === this) toggleLikes({{ $post->id_post }})">
    <div class="bg-white rounded-lg w-full max-w-md max-h-96 overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h4 class="font-semibold text-lg">Liked by</h4>
            <button onclick="toggleLikes({{ $post->id_post }})" class="text-gray-600 hover:text-gray-800 font-bold text-2xl leading-none">&times;</button>
        </div>
        <div id="likes-list-{{ $post->id_post }}" class="p-4 overflow-y-auto max-h-80">
            <div class="text-center text-gray-500">Loading...</div>
        </div>
    </div>
</div>