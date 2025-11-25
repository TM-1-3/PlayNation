@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')

<div id="app-layout">

    <div id="main-content">
        <div id="container-admin">
                <h2>User List</h2>

                <div class="search-controls">
                    <form id="search-user-admin" action="{{ route('admin.user') }}" method="GET">
                        <input type="text" id="search-input" name="search" placeholder="Search by Name, Username or Email...">
                        <button class="btn-primary" type="submit" style="background-color: #3498db;">Search</button>
                    </form>
                    <form action="{{ route('admin.create') }}" method="GET">
                        @csrf
                        <button type="submit" style="background:green">Create New User</button>
                    </form>
                </div>

                <table id="admin-users-table">
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
                                <a href="" class="action-link">Edit</a>
                                <form action="{{ route('admin.delete', $user->id_user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" 
                                            style="background:none; border:none; color:#e74c3c; cursor:pointer; text-decoration:none; font-size:1em;">
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