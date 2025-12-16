@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<div class="flex flex-col items-center justify-center text-center min-h-[60vh] pt-10">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl text-blue-500 font-semibold mb-6">Create New Post</h2>

    @if($errors->has('form'))
      <div class="text-red-600 text-sm mb-4">{{ $errors->first('form') }}</div>
    @endif

    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf

      <div>
        <label for="image" class="block mb-2 font-medium text-gray-700 text-left">Image</label>
        <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
        @error('image') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <div>
        <label for="description" class="block mb-2 font-medium text-gray-700 text-left">Description</label>
        <textarea id="description" name="description" class="h-[100px] w-full p-3 border border-gray-300 rounded focus:border-blue-600 focus:outline-none" placeholder="Enter your Post Description...">{{ old('description') }}</textarea>
        @error('description') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <div>
        <label for="label" class="block mb-2 font-medium text-gray-700 text-left">Label (select existing)</label>
        <select id="labels" name="labels[]" multiple class="w-full min-h-[100px] p-2 border border-gray-300 rounded focus:border-blue-600 focus:outline-none">
          @foreach($labels as $label)
            <option value="{{ $label->id_label }}" {{ (collect(old('labels'))->contains($label->id_label)) ? 'selected' : '' }}>
              {{ $label->designation }}
            </option>
          @endforeach
        </select>
        <small class="text-gray-600 text-left block mt-1">Hold Ctrl/Cmd to select multiple</small>
        @error('labels') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <div>
        <label for="new_label" class="block mb-2 font-medium text-gray-700 text-left">Or create new label</label>
        <input type="text" id="new_label" name="new_label" value="{{ old('new_label') }}" class="w-full p-3 mb-0 border border-gray-300 rounded focus:border-blue-600 focus:outline-none" placeholder="Enter your New Label...">
        @error('new_label') <div class="text-red-600 text-sm mt-1 text-left">{{ $message }}</div> @enderror
      </div>

      <hr class="my-6 border-gray-300">
      <div class="mt-8 flex gap-2.5">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center border border-blue-500 transition-colors hover:bg-blue-500" title="Click to create the post">Create Post</button>
        <a href="{{ route('home') }}" class="bg-transparent text-blue-500 border border-blue-500 py-2 px-4 rounded no-underline inline-flex items-center justify-center cursor-pointer text-center transition-colors hover:bg-blue-500 hover:text-white">Cancel</a>
      </div>
    </form>
  </div>
</div>

@endsection