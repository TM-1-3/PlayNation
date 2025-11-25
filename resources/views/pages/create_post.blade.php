@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<div class="centered-content">
    <div class="card" style="width:100%; max-width:600px; padding:2em;">
    <h2>Create New Post</h2>

    @if($errors->has('form'))
      <div style="color:red">{{ $errors->first('form') }}</div>
    @endif

    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
      @csrf

      <label for="image">Image</label>
      <input type="file" id="image" name="image">
      @error('image') <div style="color:red">{{ $message }}</div> @enderror

      <label for="description">Description</label>
      <textarea id="description" name="description" style="height:100px; width:100%;">{{ old('description') }}</textarea>
      @error('description') <div style="color:red">{{ $message }}</div> @enderror

      <hr>
      <div style="margin-top:2em; display:flex; gap:10px;">
        <button type="submit" class="button">Create Post</button>
        <a href="{{ route('home') }}" class="button button-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>

@endsection