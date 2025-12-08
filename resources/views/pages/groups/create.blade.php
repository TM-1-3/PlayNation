@extends('layouts.app')

@section('title', 'Create Group')

@section('content')

<div class="centered-content">
    <div class="card" style="width: 100%; max-width: 600px; padding: 2em; text-align: left;">
        <h2 style="color: #1e00ff; border-bottom: 2px solid #d2afe7; padding-bottom: 0.5em; margin-bottom: 1.5em;">
            Create a New Group
        </h2>

        <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="name">Group Name</label>
            <input type="text" id="name" name="name" placeholder="Ex: Sunday Runners" required value="{{ old('name') }}">
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="What is this group about?" style="height: 100px;">{{ old('description') }}</textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror

            <label for="picture">Cover Image</label>
            <input type="file" id="picture" name="picture" accept="image/*">
            @error('picture') <span class="error">{{ $message }}</span> @enderror

            <hr>

            <div style="margin: 20px 0; display: flex; align-items: center;">
                
                <input type="hidden" name="is_public" value="0">
                <input type="checkbox" id="is_public" name="is_public" value="1" checked style="margin-right: 10px;">
                
                <div>
                    <label for="is_public" style="margin: 0; display: block;">Public Group?</label>
                    <small style="color: gray; font-weight: normal;">If unchecked, only members can see posts.</small>
                </div>
            </div>

            <div style="margin-top: 2em; display: flex; gap: 10px;">
                <button type="submit" class="button">Create Group</button>
                <a href="{{ route('groups.index') }}" class="button button-outline">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection