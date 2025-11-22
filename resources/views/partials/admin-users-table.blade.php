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
    <td colspan="5" style="text-align:center;">No users found</td>
</tr>
@endforelse
