<div>
                <div class="flex justify-between items-end gap-4 mb-8 mt-6 flex-wrap">
                    <form id="search-user-admin" class="flex gap-2 flex-1 min-w-[300px] max-w-xl items-center" action="{{ route('admin.user') }}" method="GET">
                        <input type="text" name="search" placeholder="Search by Name, Username or Email..." class="flex-1 py-1 px-4 border border-gray-300 rounded text-base transition-colors focus:border-blue-600 focus:outline-none focus:shadow-[0_0_0_3px_rgba(30,0,255,0.1)]">
                        <button type="submit" class="bg-blue-500 text-white border-none py-1 px-3 rounded text-base cursor-pointer transition-colors whitespace-nowrap hover:bg-blue-600">Search</button>
                    </form>
                    <form action="{{ route('admin.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white border-none py-1 px-3 rounded text-base cursor-pointer transition-colors font-semibold whitespace-nowrap hover:bg-green-700">Create New User</button>
                    </form>
                </div>

                <table class="w-full border-collapse mt-4">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider">Name</th>
                            <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider">Username</th>
                            <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider">Email</th>
                            <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider">Status</th>
                            <th class="p-4 text-left font-semibold text-sm uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-users-body">
                        @forelse($users as $user)
                        <tr class="border-b border-gray-200 transition-colors hover:bg-gray-50">
                            <td class="p-4 text-gray-800 text-sm font-medium"><a href="{{ route('profile.show',$user->id_user) }}" class="no-underline text-gray-800 hover:text-blue-600">{{ $user->name }}</a></td>
                            <td class="p-4 text-gray-800 text-sm font-medium"><a href="{{ route('profile.show',$user->id_user) }}" class="no-underline text-gray-800 hover:text-blue-600">{{ $user->username }}</a></td>
                            <td class="p-4 text-gray-800 text-sm">{{ $user->email }}</td>
                            <td class="p-4 text-gray-800 text-sm">{{ $user->is_public ? 'Public' : 'Private' }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.edit', $user->id_user) }}" class="bg-none text-blue-500 text-sm font-medium no-underline">Edit</a>
                                    <form action="{{ route('admin.delete', $user->id_user) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-none text-red-500 text-sm font-medium cursor-pointer border-none pb-1" onclick="return confirm('Are you sure you want to delete this user?')">
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
