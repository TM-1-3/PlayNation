<div>
                <div class="flex justify-between items-end gap-4 mb-8 mt-6 flex-wrap">
                    
                    <div class="mx-auto flex-1">
                        <form id="search-user-admin" action="{{ route('admin.user') }}" method="GET" class="flex gap-2 items-center">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                                </div>
                                
                                <input id="search-input-user" type="text" name="search" placeholder="Search by Name, Username or Email..." 
                                    class="h-[2em] block w-full pl-10 pr-4 py-2 border-none rounded-lg shadow-md text-gray-900 bg-white outline-none">
                            </div>
                            <button type="submit" class="h-[2em] bg-blue-500 text-white border-none py-1 px-3 rounded-lg text-base cursor-pointer transition-colors whitespace-nowrap hover:bg-blue-600 font-medium" text="Submit your user search">Search</button>
                        </form>
                    </div>
                    <form action="{{ route('admin.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="h-[2em] rounded-lg bg-green-600 text-white border-none py-1 px-3 text-base cursor-pointer transition-colors font-semibold whitespace-nowrap hover:bg-green-700" title="Create new user account">Create New User</button>
                    </form>
                </div>

                <div class="overflow-auto max-h-[70vh] rounded-lg mt-4">
                    <table class="w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200 sticky top-0 z-10">
                            <tr>
                                <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider bg-gray-50">Name</th>
                                <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider bg-gray-50">Username</th>
                                <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider bg-gray-50">Email</th>
                                <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider bg-gray-50">Status</th>
                                <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider bg-gray-50">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="admin-users-body">
                        @forelse($users as $user)
                        <tr class="border-b border-gray-200 transition-colors hover:bg-gray-50">
                            <td class="p-4 text-gray-800 text-sm font-medium"><a href="{{ route('profile.show',$user->id_user) }}" class="no-underline text-gray-800 hover:text-blue-600" text="Click to acess the user's page">{{ $user->name }}</a></td>
                            <td class="p-4 text-gray-800 text-sm font-medium"><a href="{{ route('profile.show',$user->id_user) }}" class="no-underline text-gray-800 hover:text-blue-600" text="Click to acess the user's page">
                                {{ $user->username }}
                                @if($user->verifiedUser)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-lg" title="Verified Account"></i>
                                @endif
                            </a>
                            </td>
                            <td class="p-4 text-gray-800 text-sm">{{ $user->email }}</td>
                            <td class="p-4 text-gray-800 text-sm">{{ $user->is_public ? 'Public' : 'Private' }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.edit', $user->id_user) }}" class="bg-none text-blue-500 text-sm font-medium no-underline" title="Edit user information">Edit</a>
                                    @if(!$user->verifiedUser)
                                        <form action="{{ route('admin.verify', $user->id_user) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="bg-none text-green-600 text-sm font-medium cursor-pointer border-none pb-1 hover:text-green-700" title="Verify the user">
                                                Verify
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.unverify', $user->id_user) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-none text-amber-600 text-sm font-medium cursor-pointer border-none pb-1 hover:text-amber-700" title="Remove verification status" onclick="return confirm('Are you sure you want to unverify this user?')">
                                                Unverify
                                            </button>
                                        </form>
                                    @endif
                                    @if(!$user->isBanned())
                                        <form action="{{ route('admin.ban', $user->id_user) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="bg-none text-orange-600 text-sm font-medium cursor-pointer border-none pb-1 hover:text-orange-700" title="Ban this user" onclick="return confirm('Are you sure you want to ban this user? They will not be able to perform any actions.')">
                                                Ban
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.unban', $user->id_user) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="bg-none text-gray-600 text-sm font-medium cursor-pointer border-none pb-1 hover:text-gray-700" title="Unban this user">
                                                Unban
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.delete', $user->id_user) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-none text-red-500 text-sm font-medium cursor-pointer border-none pb-1" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete the account">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-8 text-gray-500 italic">No users found</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
</div>
