@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="centered-content"> <div class="card" style="width: 100%; max-width: 600px; padding: 2em; text-align: left;">
        <h2 style="color: #1e00ff; border-bottom: 2px solid #d2afe7; padding-bottom: 0.5em; margin-bottom: 1.5em;">
            ✏️ Edit Profile
        </h2>

        <form method="POST" action="{{ route('admin.edit.action', $user->id_user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            @error('username') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" style="height: 100px; width: 100%;">{{ old('biography', $user->biography) }}</textarea>

            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture">
            @error('profile_picture') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <hr>

            <h4 style="margin-top: 1em;">Change Password <small style="font-size: 0.6em; color: gray;">(Leave empty to keep current)</small></h4>
            
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            @error('password') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror

            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">

            <hr>

            <div style="margin: 20px 0; display: flex; align-items: center;">
                <input type="checkbox" id="is_public" name="is_public" value="1" {{ $user->is_public ? 'checked' : '' }} style="margin-right: 10px;">
                <label for="is_public" style="margin: 0; display: inline;">Make Profile Public?</label>
            </div>

            <div style="margin-top: 2em; display: flex; gap: 10px;">
                <button type="submit" class="button">💾 Save Changes</button>
                <a href="{{ route('profile.show', $user->id_user) }}" class="button button-outline">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection