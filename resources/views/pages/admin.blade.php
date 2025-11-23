<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #f4f7f9; }
        #app-layout { display: flex; min-height: 100vh; }
        #sidebar { width: 220px; background-color: #2c3e50; color: white; padding-top: 20px; }
        #sidebar a { display: block; padding: 15px 20px; text-decoration: none; color: #ecf0f1; border-left: 3px solid transparent; }
        #sidebar a:hover, #sidebar a.active { background-color: #34495e; border-left: 3px solid #3498db; }
        #main-content { flex-grow: 1; display: flex; flex-direction: column; }
        #header { background-color: white; padding: 15px 30px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        #container { padding: 30px; }
        .card { background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #34495e; }
        .action-link { margin-right: 10px; color: #3498db; text-decoration: none; }
        .action-link:hover { text-decoration: underline; }
        .search-controls { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .search-controls input[type="text"] { padding: 10px; border: 1px solid #ccc; border-radius: 4px; width: 300px; }
        .btn-primary { background-color: #2ecc71; color: white; padding: 10px 15px; border: none; border-radius: 4px; text-decoration: none; cursor: pointer; }
        .pagination { display: flex; justify-content: center; margin-top: 20px; }
        .pagination a { padding: 8px 12px; margin: 0 4px; border: 1px solid #ddd; text-decoration: none; color: #3498db; border-radius: 4px; }
        .pagination a.active { background-color: #3498db; color: white; border-color: #3498db; }
        button { padding: 10px 20px; cursor: pointer; background-color: #e11d48; color: white; border: none; border-radius: 5px; }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>

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

</body>
</html>