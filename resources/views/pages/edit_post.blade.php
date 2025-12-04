@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="flex flex-col items-center justify-center text-center min-h-[60vh] pb-5">
  <div class="w-full max-w-2xl bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl text-blue-600 mb-6">Edit Post</h2>

    @if($errors->has('form'))
      <div class="text-red-600 text-sm mb-4">{{ $errors->first('form') }}</div>
    @endif

    <form method="POST" action="{{ route('post.update', $post->id_post) }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="block mb-2 font-medium text-gray-700 text-left">Current image</label>
        @if($post->image)
          <div class="mb-2.5">
            <img src="{{ $post->getPostImage() }}" alt="post image" class="max-w-full rounded">
          </div>
        @else
          <div class="rounded-lg shadow-sm p-4 mb-4 text-gray-600">No image</div>
        @endif
      </div>

      <div>
        <label for="image" class="block mb-2 font-medium text-gray-700 text-left">Replace image (optional)</label>
        <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        @error('image') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <div>
        <label for="description" class="block mb-2 font-medium text-gray-700 text-left">Description</label>
        <textarea id="description" name="description" class="h-[100px] w-full p-3 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">{{ old('description', $post->description) }}</textarea>
        @error('description') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <div>
        <label for="labels" class="block mb-2 font-medium text-gray-700 text-left">Labels (select existing)</label>
        <select id="labels" name="labels[]" multiple size="6" class="w-full p-2 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
          @foreach($labels as $label)
            <option value="{{ $label->id_label }}" {{ ($post->labels->pluck('id_label')->contains($label->id_label) || (is_array(old('labels')) && in_array($label->id_label, old('labels')))) ? 'selected' : '' }}>
              {{ $label->designation }}
            </option>
          @endforeach
        </select>
        <small class="text-gray-600 text-left block mt-1">Hold Ctrl/Cmd to select multiple</small>
        @error('labels') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <div>
        <label for="new_label" class="block mb-2 font-medium text-gray-700 text-left">Or create new label</label>
        <input type="text" id="new_label" name="new_label" value="{{ old('new_label') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        @error('new_label') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <br>
      <div class="flex gap-2.5">
        <form method="PUT" action="{{ route('post.update', $post->id_post) }}" onsubmit="return confirm('Delete this post?');" class="inline">
          @csrf
          @method('PUT')
          <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded border border-blue-700 transition-colors hover:bg-blue-700 cursor-pointer">Save</button>
        </form>

        <form method="POST" action="{{ route('post.destroy', $post->id_post) }}" onsubmit="return confirm('Delete this post?');" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded border border-red-700 transition-colors hover:bg-red-700 cursor-pointer">Delete Post</button>
        </form>

        <a href="{{ route('profile.show', $post->id_creator) }}" class="bg-transparent text-blue-600 border border-blue-600 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-600 hover:text-white">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection