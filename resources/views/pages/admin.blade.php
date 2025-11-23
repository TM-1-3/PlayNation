@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')

<div id="app-layout">

    <div id="main-content">
        <div id="container-admin">
            <div class="card">
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
                            <td><a href="{{ route('profile.show',$user->id_user) }}" class="action-link" style="text-decoration:none; color:black">{{ $user->name }}</a></td>
                            <td><a href="{{ route('profile.show',$user->id_user) }}" class="action-link" style="text-decoration:none; color:black">{{ $user->username }}</a></td>
                            <td>{{ $user->email }} </td>
                            <td>{{ $user->is_public ? 'Public' : 'Private' }} </td>
                            <td>
                                <a href="" class="action-link">Edit</a>
                                <a href="" class="action-link" style="color: #e74c3c;">Delete</a>
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
</div>

@endsection