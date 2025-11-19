<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Profile - LBAW</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
    <style>
        /* Specific styles for this page */
        .setup-container { width: 600px; max-width: 90%; }
        
        /* Grid for Labels */
        .label-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        /* The Label Card Logic */
        .label-option { cursor: pointer; position: relative; }
        
        /* Hide the actual checkbox */
        .label-option input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* The visual card */
        .label-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            transition: all 0.2s;
            height: 100px;
        }

        .label-card img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .label-card span { font-size: 0.9rem; font-weight: 500; }

        /* State: Hover */
        .label-option:hover .label-card { border-color: #93c5fd; }

        /* State: Checked (Selected) */
        .label-option input:checked + .label-card {
            border-color: #2563eb;
            background-color: #eff6ff;
            color: #2563eb;
            box-shadow: 0 0 0 2px #bfdbfe;
        }

        textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: vertical; }
        
        /* Toggle Switch for Privacy */
        .privacy-toggle { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .privacy-toggle input { width: auto; margin: 0; }
    </style>
</head>
<body>

<div class="card setup-container">
    <h2>Complete Your Profile</h2>
    <p style="text-align: center; color: #666; margin-bottom: 20px;">Tell us a bit more about yourself.</p>

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