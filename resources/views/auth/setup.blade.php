<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Setup</title>
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/setup.css') }}">
</head>
<body>

<div class="card setup-container">
    <h2>Profile Setup</h2>
    <p style="text-align: center; color: #666; margin-bottom: 20px;">Finish Setting Up Your Profile</p>

    <form method="POST" action="{{ route('profile.setup.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            @error('profile_picture') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" rows="3" placeholder="I love running and eating pizza..."></textarea>
            @error('biography') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="privacy-toggle">
            <label for="is_public" style="margin:0;">Make Profile Public?</label>
            <input type="checkbox" id="is_public" name="is_public" checked>
        </div>

        <label>Interests (Select all that apply)</label>
        <div class="label-grid">
            @foreach($labels as $label)
                <label class="label-option">
                    <input type="checkbox" name="labels[]" value="{{ $label->id_label }}">
                    
                    <div class="label-card">
                        <img src="{{ asset($label->image) }}" alt="icon">
                        <span>{{ $label->designation }}</span>
                    </div>
                </label>
            @endforeach
        </div>
        
        <button type="submit">Finish Setup</button>
    </form>
</div>

</body>
</html>