@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="centered-content">
  <div class="card" style="width:100%; max-width:600px; padding:2em;">
    <h2>Edit Post</h2>

    @if($errors->has('form'))
      <div style="color:red">{{ $errors->first('form') }}</div>
    @endif

    <form method="POST" action="{{ route('post.update', $post->id_post) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label>Current image</label>
      @if($post->image)
        <div style="margin-bottom:10px;">
          <img src="{{ asset('storage/' . ltrim($post->image, '/')) }}" alt="post image" style="max-width:100%;">
        </div>
      @else
        <div class="card">No image</div>
      @endif

      <label for="image">Replace image (optional)</label>
      <input type="file" id="image" name="image">
      @error('image') <div style="color:red">{{ $message }}</div> @enderror

      <label for="description">Description</label>
      <textarea id="description" name="description" style="height:100px; width:100%;">{{ old('description', $post->description) }}</textarea>
      @error('description') <div style="color:red">{{ $message }}</div> @enderror

      <label for="labels">Labels (select existing)</label>
      <select id="labels" name="labels[]" multiple size="6" style="width:100%;">
        @foreach($labels as $label)
          <option value="{{ $label->id_label }}" {{ ($post->labels->pluck('id_label')->contains($label->id_label) || (is_array(old('labels')) && in_array($label->id_label, old('labels')))) ? 'selected' : '' }}>
            {{ $label->designation }}
          </option>
        @endforeach
      </select>
      <small>Hold Ctrl/Cmd to select multiple</small>
      @error('labels') <div style="color:red">{{ $message }}</div> @enderror

      <label for="new_label">Or create new label</label>
      <input type="text" id="new_label" name="new_label" value="{{ old('new_label') }}">
      @error('new_label') <div style="color:red">{{ $message }}</div> @enderror

      <hr>
      <div style="margin-top:2em; display:flex; gap:10px;">
        <button type="submit" class="button">Save</button>

        <form method="POST" action="{{ route('post.destroy', $post->id_post) }}" onsubmit="return confirm('Delete this post?');" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="button" style="background:#e74c3c; color:#fff;">Delete Post</button>
        </form>

        <a href="{{ route('profile.show', $post->id_creator) }}" class="button button-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection