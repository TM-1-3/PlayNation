@extends('layouts.app')

@section('title', 'Edit Group')

@section('content')

<div class="centered-content">
    <div class="card" style="width: 100%; max-width: 600px; padding: 2em; text-align: left;">
        <h2 style="color: #1e00ff; border-bottom: 2px solid #d2afe7; padding-bottom: 0.5em; margin-bottom: 1.5em;">
            ⚙️ Edit Group: {{ $group->name }}
        </h2>

        {{-- edit form --}}
        <form method="POST" action="{{ route('groups.update', $group->id_group) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Group Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $group->name) }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <label for="description">Description</label>
            <textarea id="description" name="description" style="height: 100px;">{{ old('description', $group->description) }}</textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror

            <label>Current Picture</label>
            @if($group->picture)
                <img src="{{ asset($group->picture) }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
            @else
                <p style="color:gray; font-size: 0.9em;">No picture set.</p>
            @endif

            <label for="picture">Change Picture</label>
            <input type="file" id="picture" name="picture" accept="image/*">
            @error('picture') <span class="error">{{ $message }}</span> @enderror

            <hr>

            <div style="margin: 20px 0; display: flex; align-items: center;">
                <input type="hidden" name="is_public" value="0">
                <input type="checkbox" id="is_public" name="is_public" value="1" {{ $group->is_public ? 'checked' : '' }} style="margin-right: 10px;">
                
                <div>
                    <label for="is_public" style="margin: 0; display: block;">Public Group?</label>
                    <small style="color: gray; font-weight: normal;">If unchecked, only members can see posts.</small>
                </div>
            </div>

            <div style="margin-top: 2em; display: flex; gap: 10px;">
                <button type="submit" class="button">💾 Save Changes</button>
                <a href="{{ route('groups.show', $group->id_group) }}" class="button button-outline">Cancel</a>
            </div>
        </form>

        {{-- (DELETE) --}}
        <div style="margin-top: 4em; padding-top: 2em; border-top: 1px solid #ffcccc;">
            <h4 style="color: #e74c3c;">Danger Zone</h4>
            <p style="font-size: 0.9em; color: #666;">Once you delete a group, there is no going back. Please be certain.</p>
            
            <form method="POST" action="{{ route('groups.destroy', $group->id_group) }}" onsubmit="return confirm('Are you sure you want to delete this group? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="button" style="background-color: #e74c3c; border-color: #e74c3c;">
                    <i class="fa-solid fa-trash"></i> Delete Group
                </button>
            </form>
        </div>

    </div>
</div>

@endsection