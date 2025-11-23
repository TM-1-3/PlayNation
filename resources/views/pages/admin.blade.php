@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')

<div id="app-layout">

    <div id="main-content">
        <header id="header">
            <h1>Admin Page</h1>
            <div id="user-info" style=" display: flex; gap:1em">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="color:red; background:none; font-size:1.1em;">Log out</button>
                </form>
                <a href="{{ route('home') }}" style="color:black; text-decoration:none; padding-top:0.7em">Home Page</a>
            </div>
        </header>

        <div id="container">
            <div class="card">
                <h2>User List</h2>

                <div class="search-controls">
                    <form id="search-user-admin" action="{{ route('admin.user') }}" method="GET">
                        <input type="text" id="search-input" name="search" placeholder="Search by Name, Username or Email...">
                        <button class="btn-primary" type="submit" style="background-color: #3498db;">Search</button>
                    </form>
                    <form action="" method="POST">
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
                            <td><a href="" class="action-link" style="text-decoration:none; color:black">{{ $user->name }}</a></td>
                            <td><a href="" class="action-link" style="text-decoration:none; color:black">{{ $user->username }}</a></td>
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