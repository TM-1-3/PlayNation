@extends('layouts.app')

@section('title', 'Setup')

<!-- removi estas declrações de doctype e head e metadata porque já temos uma genenralização com o blade no extends(layouts.app) então assim fica tudo mais homogéneo
     adicionei também o rodapé e cabeçalo para ficar consistente sitewide e se se mudar num muda tudo ao mesmo tempo
     mantive as tuas lógicas todas 
     mantive a logica do form
     as rotas apontam para os mesmos controllers
     mantive o csrf
     os inputs também estão iguaisinhos
     e a tua lógica de erros -->

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 mt-12">
    <img class="mx-auto mb-6 max-w-[200px]" src="/img/logo.png" alt="Logo">
    <h2 class="text-center text-2xl text-blue-600 mb-4">Profile Setup</h2>
    <p class="text-center text-gray-600 mb-5">Finish Setting Up Your Profile</p>

    <form method="POST" action="{{ route('profile.setup.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="profile_picture" class="block mb-2 font-medium text-gray-700">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="w-full p-2 border border-gray-300 rounded focus:border-blue-600 focus:outline-none" title="Insert your profile picture">
            @error('profile_picture') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="biography" class="block mb-2 font-medium text-gray-700">Biography</label>
            <textarea id="biography" name="biography" rows="3" placeholder="Enter your Biography..." class="w-full p-3 border border-gray-300 rounded focus:border-blue-600 focus:outline-none"></textarea>
            @error('biography') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="flex items-center gap-2.5 my-4">
            <input type="checkbox" id="is_public" name="is_public" checked class="w-4 h-4" title="Define if your profilw will be public or private">
            <label for="is_public" class="m-0 font-medium text-gray-700" title="Define if your profilw will be public or private">Make Profile Public?</label>
        </div>

        <label class="block mb-3 font-medium text-gray-700">Interests (Select all that apply)</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($labels as $label)
                <label class="cursor-pointer">
                    <input type="checkbox" name="labels[]" value="{{ $label->id_label }}" class="hidden peer">
                    
                    <div class="bg-white border-2 border-gray-300 rounded-lg p-4 text-center transition-all hover:border-blue-500 hover:shadow-md peer-checked:border-blue-600 peer-checked:bg-blue-50" title="Click here to select it as a topic of interest">
                        <span class="text-sm font-medium text-gray-700 peer-checked:text-blue-600">{{ $label->designation }}</span>
                    </div>
                </label>
            @endforeach
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded font-semibold cursor-pointer transition-colors hover:bg-blue-700 mt-6" title="Click here to finish setting up your account">Finish Setup</button>
    </form>
</div>

@endsection