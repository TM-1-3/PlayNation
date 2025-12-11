@extends('layouts.app')

@section('title', 'Groups')

@section('content')

<div class="max-w-6xl mx-auto p-5 pb-20">
    
    {{-- header n search--}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h2 class="text-3xl font-bold text-gray-800">Communities</h2>
        
        {{-- searchbar --}}
        <div class="relative w-full md:max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
            <input type="text" id="group-search" placeholder="Search for groups..." 
                   class="block h-[2em] w-full pl-10 pr-4 py-2.5 border-none rounded-lg shadow-md text-gray-900 bg-white outline-none">
        </div>

        @auth
            <a href="{{ route('groups.create') }}" class="bg-blue-600 text-white py-2.5 px-5 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 no-underline font-semibold shadow-md text-sm whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> New Group
            </a>
        @endauth
    </div>

    @auth
        {{-- SECÇÃO 1: MEUS GRUPOS --}}
        @if($myGroups->isNotEmpty())
            <div class="mb-12 group-section">
                <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-user-group text-blue-500"></i> My Groups
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="my-groups-grid">
                    @foreach($myGroups as $group)
                        @include('partials.group-card', ['group' => $group])
                    @endforeach
                </div>
            </div>
        @endif
    @endauth

    {{-- SECÇÃO 2: EXPLORAR (Outros Grupos) --}}
    <div class="group-section">
        <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-regular fa-compass text-blue-500"></i> Explore
        </h3>

        @if($otherGroups->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">
                <p>No more groups to discover right now.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="other-groups-grid">
                @foreach($otherGroups as $group)
                    @include('partials.group-card', ['group' => $group])
                @endforeach
            </div>
        @endif
        
        {{-- Mensagem de "Sem Resultados" para a pesquisa --}}
        <div id="no-results" class="hidden text-center py-10 text-gray-400">
            <i class="fa-solid fa-filter-circle-xmark text-4xl mb-2"></i>
            <p>No groups found matching your filter.</p>
        </div>
    </div>

</div>

{{-- SCRIPT DE PESQUISA DINÂMICA --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('group-search');
        const cards = document.querySelectorAll('.group-card-item'); // Vamos adicionar esta classe no partial
        const noResults = document.getElementById('no-results');

        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const desc = card.getAttribute('data-desc').toLowerCase();

                if (name.includes(term) || desc.includes(term)) {
                    card.style.display = ''; // Mostra
                    visibleCount++;
                } else {
                    card.style.display = 'none'; // Esconde
                }
            });

            // Mostra mensagem se tudo estiver escondido
            if (visibleCount === 0 && cards.length > 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });
    });
</script>

@endsection