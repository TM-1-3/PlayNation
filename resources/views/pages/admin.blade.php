@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')


<div class="mx-auto bg-white rounded-lg shadow-md p-8 w-[70vw]">
        <div class="w-full overflow-y-auto">
                <div class= "flex gap-5 justify-around border-b-2 border-gray-200">
                    <a href="{{ route('admin', ['type' => 'content']) }}" class="mt-0 text-xl text-gray-500 border-b-2 border-gray-200 pb-3 font-semibold {{ (isset($type) && $type === 'content') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}"> Manage Content</a>
                    <a href="{{ route('admin', ['type' => 'user']) }}" class="mt-0 text-xl text-gray-500 border-b-2 border-gray-200 pb-3 font-semibold {{ (isset($type) && $type === 'user') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}"> Administer User Accounts</a>
                    <a href="{{ route('admin', ['type' => 'groups']) }}" class="mt-0 text-xl text-gray-500 border-b-2 border-gray-200 pb-3 font-semibold {{ (isset($type) && $type === 'groups') ? 'text-gray-800 border-gray-800' : 'border-transparent' }}"> Moderate Groups</a>
                </div>

                @if(isset($type) && $type=='user')
                    @include('partials.user-manage', ['users' => $users])
                @elseif(isset($type) && $type=='content')
                    @include('partials.content-manage')
                @elseif(isset($type) && $type=='groups')
                    @include('partials.groups-manage')
                @endif
        </div>
</div>

@endsection