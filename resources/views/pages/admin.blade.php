@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="w-full overflow-y-auto">
                <h2 class="mt-0 mb-6 text-2xl text-blue-600 border-b-2 border-purple-300 pb-2">User List</h2>

                <div class="flex justify-between items-center gap-4 mb-8 flex-wrap">
                    <form class="flex gap-2 flex-1 min-w-[300px] max-w-xl items-center" action="{{ route('admin.user') }}" method="GET">
                        <input type="text" name="search" placeholder="Search by Name, Username or Email..." class="flex-1 w-[100px] py-3 px-4 border border-gray-300 rounded text-base transition-colors box-border h-10 leading-normal focus:border-blue-600 focus:outline-none focus:shadow-[0_0_0_3px_rgba(30,0,255,0.1)]">
                        <button type="submit" class="bg-blue-500 text-white border-none py-3 px-5 rounded text-base cursor-pointer transition-colors whitespace-nowrap flex-shrink-0 w-auto box-border mb-8 hover:bg-blue-600">Search</button>
                    </form>
                    <form action="{{ route('admin.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white border-none py-3 px-6 rounded text-base cursor-pointer transition-colors font-semibold whitespace-nowrap box-border mb-8 hover:bg-green-700">Create New User</button>
                    </form>
                </div>

                <table class="w-full border-collapse mt-4">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-users-body">
                        @forelse($users as $user)
                        <tr>
                            <td><a href="{{ route('profile.show',$user->id_user) }}" class="action-link" style="text-decoration:none; color:black; font-size:1em;">{{ $user->name }}</a></td>
                            <td><a href="{{ route('profile.show',$user->id_user) }}" class="action-link" style="text-decoration:none; color:black; font-size:1em;">{{ $user->username }}</a></td>
                            <td>{{ $user->email }} </td>
                            <td>{{ $user->is_public ? 'Public' : 'Private' }} </td>
                            <td>
                                <a href="{{ route('admin.edit', $user->id_user) }}" class="action-btn edit-btn">EDIT</a>
                                <form action="{{ route('admin.delete', $user->id_user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection