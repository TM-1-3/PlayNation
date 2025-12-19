@extends('layouts.app')

@section('title', 'About PlayNation')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-6">
    
    <div class="text-center mb-20 fade-in">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Our Mission</span>
        <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
            The Dedicated Space for <br>
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Sports Enthusiasts</span>
        </h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed">
            In a digital world where general-purpose social media presents a convoluted experience, 
            <strong>PlayNation</strong> rises as the exclusive network for athletes, fans, teams, and coaches to share the fitness lifestyle.
        </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-24">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                <i class="fa-solid fa-people-group text-xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-800 mb-2">Diverse Ecosystem</h3>
            <p class="text-sm text-gray-500 leading-relaxed">From casual practitioners to professional coaches and teams. Interact with like-minded individuals who share your passion.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-800 mb-2">Official Sources</h3>
            <p class="text-sm text-gray-500 leading-relaxed">Follow <strong>Verified Accounts</strong> for official updates, schedules, and results directly from your favourite athletes and clubs.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                <i class="fa-solid fa-users-rectangle text-xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-800 mb-2">Smart Groups</h3>
            <p class="text-sm text-gray-500 leading-relaxed">Join <strong>Public Groups</strong> to discuss modalities or request access to <strong>Private Groups</strong> for exclusive team strategies.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                <i class="fa-solid fa-filter text-xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-800 mb-2">Filters & Search</h3>
            <p class="text-sm text-gray-500 leading-relaxed">Don't get lost in the noise. Filter content by specific sports, teams, or dates to find exactly what drives you.</p>
        </div>
    </div>

    <div class="bg-gray-50 rounded-3xl p-10 md:p-16 text-center border border-gray-200">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Behind PlayNation</h2>
        <p class="text-gray-500 mb-12">Developed by Group 2551 for the LBAW Project.</p>
        
        <div class="grid md:grid-cols-4 gap-8">
            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Carolina+Ferreira&background=random&size=150" class="w-20 h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800">Carolina Ferreira</h4>
                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide"></p>
            </div>

            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Gabriela+Mattos&background=random&size=150" class="w-20 h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800">Gabriela de Mattos</h4>
                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide"></p>
            </div>

            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Joao+Marques&background=random&size=150" class="w-20 h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800">João Marques</h4>
                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide"></p>
            </div>

            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Tomas+Morais&background=random&size=150" class="w-20 h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800">Tomás Morais</h4>
                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide"></p>
            </div>
        </div>
    </div>
</div>
@endsectionA