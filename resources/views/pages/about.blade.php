@extends('layouts.app')

@section('title', 'About PlayNation')

@section('content')
<div class="w-full max-w-6xl mx-auto py-8 md:py-12 px-4 md:px-6 overflow-x-hidden">
    
    <div class="text-center mb-12 md:mb-20 fade-in">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Our Mission</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 break-words">
            The Dedicated Space for <br class="hidden md:block">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Sports Enthusiasts</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed">
            In a digital world where general-purpose social media presents a convoluted experience, 
            <strong>PlayNation</strong> rises as the exclusive network for athletes, fans, teams, and coaches to share the fitness lifestyle.
        </p>
    </div>

    <div class="mb-16 md:mb-24">
        <div class="text-center mb-8 md:mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Engineered for Scale & Security</h2>
            <p class="text-gray-500 mt-2 text-sm md:text-base">Our commitment to technical excellence ensures a seamless experience.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 text-center">
            <div class="p-4 md:p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600">
                    <i class="fa-solid fa-chart-line text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Event-Ready Scale</h4>
                <p class="text-sm text-gray-500">Built to handle the intensity of live sports. Our architecture scales seamlessly to support high traffic during major sporting events.</p>
            </div>

            <div class="p-4 md:p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 text-purple-600">
                    <i class="fa-solid fa-shield-halved text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Data Integrity</h4>
                <p class="text-sm text-gray-500">Your privacy matters. We use robust encryption and strict privacy controls, giving you full power over your data visibility.</p>
            </div>

            <div class="p-4 md:p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4 text-orange-600">
                    <i class="fa-solid fa-universal-access text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Inclusive Design</h4>
                <p class="text-sm text-gray-500">Sports are for everyone. Our platform is designed to be accessible to all users, regardless of device or ability.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-16 md:mb-24">
        
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

    <div class="bg-gray-50 rounded-3xl p-8 md:p-16 text-center border border-gray-200 mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Behind PlayNation</h2>
        <p class="text-gray-500 mb-8 md:mb-12">Developed by Group 2551 for the LBAW Project.</p>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Carolina+Ferreira&background=random&size=150" class="w-16 h-16 md:w-20 md:h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Carolina Ferreira</h4>
            </div>

            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Gabriela+Mattos&background=random&size=150" class="w-16 h-16 md:w-20 md:h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Gabriela de Mattos</h4>
            </div>

            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Joao+Marques&background=random&size=150" class="w-16 h-16 md:w-20 md:h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800 text-sm md:text-base">João Marques</h4>
            </div>

            <div class="flex flex-col items-center">
                <img src="https://ui-avatars.com/api/?name=Tomas+Morais&background=random&size=150" class="w-16 h-16 md:w-20 md:h-20 rounded-full mb-3 shadow-md border-2 border-white">
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Tomás Morais</h4>
            </div>
        </div>
    </div>

    <div class="text-center pb-8">
        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6">Ready to join the game?</h3>
        @auth
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-blue-700 hover:-translate-y-1 transition transform duration-200">
                Go to Feed <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        @else
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-blue-700 hover:-translate-y-1 transition transform duration-200">
                    Get Started
                </a>
                <a href="{{ route('login') }}" class="inline-block bg-white text-blue-600 border border-blue-200 px-8 py-3 rounded-full font-bold hover:bg-gray-50 transition transform duration-200">
                    Login
                </a>
            </div>
        @endauth
    </div>

</div>
@endsection