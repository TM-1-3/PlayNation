<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use App\Models\JoinGroupRequestNotification;
use App\Models\JoinGroupRequestResultNotification;
use App\Models\GroupMember;

class GroupController extends Controller
{
    // list all groups
    public function index(Request $request)
    {
        $user = Auth::user();
        $myGroups = collect();
        $otherGroups = collect();

        if ($user) {
            // my groups
            // gets ids of groups where im member
            $memberGroupIds = DB::table('group_membership')
                ->where('id_member', $user->id_user)
                ->pluck('id_group')
                ->toArray();
            
            // gets ids of groups i own
            $ownerGroupIds = DB::table('groups')
                ->where('id_owner', $user->id_user)
                ->pluck('id_group')
                ->toArray();

            // merge both and remove duplicates
            $myGroupIds = array_unique(array_merge($memberGroupIds, $ownerGroupIds));

            // Build query for my groups
            $myGroupsQuery = Group::whereIn('id_group', $myGroupIds);
            $myGroupsQuery = $this->filterGroups($myGroupsQuery, $request);
            $myGroups = $myGroupsQuery->get();

            // Build query for other groups
            $otherGroupsQuery = Group::whereNotIn('id_group', $myGroupIds);
            $otherGroupsQuery = $this->filterGroups($otherGroupsQuery, $request);
            $otherGroups = $otherGroupsQuery->get();

        } else {
            // only public groups for visitors
            $otherGroupsQuery = Group::where('is_public', true);
            $otherGroupsQuery = $this->filterGroups($otherGroupsQuery, $request);
            $otherGroups = $otherGroupsQuery->get();
        }

        return view('pages.groups.index', [
            'myGroups' => $myGroups,
            'otherGroups' => $otherGroups
        ]);
    }

    private function filterGroups($query, Request $request)
    {
        // Filter by group name using vectors
        $groupName = $request->query('group_name');
        if ($groupName) {
            $input = $groupName . ':*';
            $query->whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input]);
        }

        // Filter by owner name using vectors
        $ownerName = $request->query('owner_name');
        if ($ownerName) {
            $input = $ownerName . ':*';
            $query->whereHas('owner', function($q) use ($input) {
                $q->whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input]);
            });
        }

        // Filter: minimum number of members
        $minMembers = $request->query('min_members');
        if ($minMembers !== null && $minMembers > 0) {
            $query->whereRaw(
                '(SELECT COUNT(*) FROM group_membership WHERE group_membership.id_group = groups.id_group) >= ?',
                [$minMembers]
            );
        }

        // Filter: public groups only
        if ($request->has('public_only')) {
            $query->where('is_public', true);
        }

        // Filter: private groups only
        if ($request->has('private_only')) {
            $query->where('is_public', false);
        }


        // Apply sort option
        $sort = $request->query('sort');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('id_group', 'asc');
                break;
            case 'newest':
                $query->orderBy('id_group', 'desc');
                break;
            case 'most_members':
                $query->withCount('members')->orderByDesc('members_count');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                // Default: maintain original ordering (public first)
                if (!$request->has('my_groups')) {
                    $query->orderBy('is_public', 'desc')->orderBy('id_group', 'desc');
                }
                break;
        }

        return $query;
    }

    

    // show group details
    public function show($id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();

        // Verificações de permissão (Mantém isto, é importante para o chat também)
        $isMember = $user ? $group->members->contains($user->id_user) : false;
        $isOwner = $user ? $group->id_owner === $user->id_user : false;
        $isAdmin = $user ? $user->isAdmin() : false;

        $canViewContent = $group->is_public || $isMember || $isOwner || $isAdmin;

        // REMOVEMOS A PARTE DOS POSTS ($group->posts...)
        // Para já não enviamos nada extra, só o grupo e permissões.

        return view('pages.groups.show', [
            'group' => $group,
            'canViewContent' => $canViewContent
        ]);
    }

    public function create()
    {
        // only logged in users can create groups
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }
        
        // view
        return view('pages.groups.create');
    }

    // strore in bd
    public function store(Request $request)
    {
        $user = Auth::user();

        
        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
            'description' => 'nullable|string|max:1000',
            'picture' => 'nullable|image|max:4096', 
            'is_public' => 'boolean' 
        ]);

        //guarante owner exists in group_owner
        $isOwner = DB::table('group_owner')->where('id_group_owner', $user->id_user)->exists(); 
        
        if (!$isOwner) {
            DB::table('group_owner')->insert(['id_group_owner' => $user->id_user]);
        }

        //create group
        

        $group = new Group();
        $group->id_owner = Auth::id();
        $group->name = $request->name;
        $group->description = $request->description;
        
        //trick becouse of trigger on insert
        $desiredPrivacy = $request->input('is_public'); 
        
        // make it public first
        $group->is_public = true; 

        $group->save(); //  saves as public

        // picture upload using FileController (keeps behaviour consistent with posts)
        if ($request->hasFile('picture')) {
            $uploadrequest = new \Illuminate\Http\Request([
                'id' => $group->id_group,
                'type' => 'group'
            ]);
            $uploadrequest->files->set('file', $request->file('picture'));
            app(FileController::class)->upload($uploadrequest);
        }

        // adds memnbership for owner trigger dos not activate becouse its public
        $group->members()->attach(Auth::user()->id_user);

        // if user wants it private change it now
        if (!$desiredPrivacy) {
            $group->is_public = false;
            $group->save();
        }

        return redirect()->route('groups.show', $group->id_group)->with('status', 'Group created successfully! 🎉');
    }

    
    public function edit($id)
    {
        $group = Group::findOrFail($id);

        //owner our site admin can editadmin can now edit groups
        if (Auth::id() !== $group->id_owner && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('pages.groups.edit', compact('group'));
    }

    
    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        if (Auth::id() !== $group->id_owner && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id_group . ',id_group',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|max:4096',
            'is_public' => 'nullable|boolean'
        ]);

        $group->name = $request->name;
        $group->description = $request->description;
        $group->is_public = $request->input('is_public', false);

        if ($request->hasFile('picture')) {
            $uploadrequest = new \Illuminate\Http\Request([
                'id' => $group->id_group,
                'type' => 'group'
            ]);
            $uploadrequest->files->set('file', $request->file('picture'));
            app(FileController::class)->upload($uploadrequest);
        }
        
        $group->save();

        return redirect()->route('groups.show', $group->id_group)->with('status', 'Group updated!');
    }

    //delete
    public function destroy($id)
    {
        $group = Group::findOrFail($id);

        if (Auth::id() !== $group->id_owner && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        if (!empty($group->picture)) {
            Storage::disk('storage')->delete('group/' . $group->picture);
        }

        $group->delete();

        return redirect()->route('groups.index')->with('status', 'Group deleted.');
    }

    public function join($id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();

        // basic verifications
        if ($group->members->contains($user->id_user) || $group->id_owner === $user->id_user) {
            return redirect()->back()->with('status', 'You are already a member.');
        }

        // public automatic join
        if ($group->is_public) {
            $group->members()->attach($user->id_user);
            return redirect()->back()->with('status', 'Welcome to the group! 👋');
        } 
        
        // request + notify owner
        else {
            // Verifies for existing request
            if (!$group->joinRequests->contains($user->id_user)) {
                
                // create request on table
                $group->joinRequests()->attach($user->id_user);

                // create generic notification
                // based on friend controller notification system
                $notificationId = DB::table('notification')->insertGetId([
                    'id_receiver' => $group->id_owner, // Owner recieves
                    'id_emitter'  => $user->id_user,   // I send
                    'text'        => $user->name . " requested to join your group '" . $group->name . "'.",
                    'date'        => now()
                ], 'id_notification');

                // Creates specific join group request notification
                // this connects to the specific group so owner can accept/reject
                DB::table('join_group_request_notification')->insert([
                    'id_notification' => $notificationId,
                    'id_group'        => $group->id_group,
                    'accepted'        => null // null = pending
                ]);

                return redirect()->back()->with('status', 'Request sent! Owner notified. 📨');
            }
            
            return redirect()->back()->with('status', 'Request already sent.');
        }
    }

    public function leave($id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();

        // owner cant leave must delete group or transfer ownership
        if ($group->id_owner === $user->id_user) {
            return redirect()->back()->with('error', 'The owner cannot leave the group.');
        }

        // remove from members list
        $group->members()->detach($user->id_user);

        return redirect()->route('groups.index')->with('status', 'You left the group.');
    }

    public function cancelRequest($id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();

        $group->joinRequests()->detach($user->id_user);

        return redirect()->back()->with('status', 'Join request cancelled.');
    }

    public function searchGroup(Request $request)
    {
        $search = $request->get('search');
        $type = $request->get('type'); 
        $user = Auth::user();

        if ($search) {
            $input = $search . ':*';
            $query = Group::whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input])
                          ->orderByRaw("ts_rank(tsvectors, to_tsquery('portuguese', ?)) DESC", [$input]);
        } else {
            $query = Group::query();
        }
        
        $groups = $query->get();

        
        if ($request->ajax()) {
            
            
            if ($type == 'group-page') {
                $myGroups = collect();
                $otherGroups = collect();

                if ($user) {
                    // my groups (member or owner)
                    $myGroupIds = $user->groups()->pluck('group_membership.id_group')
                        ->merge($user->ownedGroups()->pluck('id_group'))
                        ->unique()
                        ->toArray();

                    $myGroups = $groups->whereIn('id_group', $myGroupIds)->values();
                    
                    // other groups Public first Private after
                    $otherGroups = $groups->whereNotIn('id_group', $myGroupIds)
                        ->sortByDesc('is_public')
                        ->values();
                } else {
                    $otherGroups = $groups->where('is_public', true)->values();
                }

                // contruct the full image url
                $myGroups = $myGroups->map(fn($g) => array_merge($g->toArray(), ['picture' => $g->getGroupPicture()]));
                $otherGroups = $otherGroups->map(fn($g) => array_merge($g->toArray(), ['picture' => $g->getGroupPicture()]));

                return response()->json([
                    'myGroups' => $myGroups,
                    'otherGroups' => $otherGroups
                ]);
            }
            
            // generic fallback
            $formattedGroups = $groups->map(fn($g) => array_merge($g->toArray(), ['picture' => $g->getGroupPicture()]));
            return response()->json(['groups' => $formattedGroups]);
        }

        // no ajax return directly to index
        return redirect()->route('groups.index');
    }

    public function acceptRequest($groupId, $userId)
    {
        $group = Group::findOrFail($groupId);
        
        // security check
        if (Auth::id() !== $group->id_owner) {
            abort(403, 'Only the owner can accept requests.');
        }
        
        // start transaction
        DB::transaction(function () use ($group, $userId) {
            
            // save state and open dor
            $wasPrivate = !$group->is_public;
            if ($wasPrivate) {
                $group->is_public = true;
                $group->save();
            }

            // add member
            // verify if exists not to duplicate
            $exists = GroupMember::where('id_group', $group->id_group)
                                 ->where('id_member', $userId)
                                 ->exists();

            if (!$exists) {
                GroupMember::create([
                    'id_group'  => $group->id_group,
                    'id_member' => $userId
                ]);
            }

            // Close Door
            if ($wasPrivate) {
                $group->is_public = false;
                $group->save();
            }
        });

        // clean up request and notification
        // remove pending request
        $group->joinRequests()->detach($userId);

        // update notification status to accepted
        DB::table('join_group_request_notification')
            ->join('notification', 'notification.id_notification', '=', 'join_group_request_notification.id_notification')
            ->where('join_group_request_notification.id_group', $groupId)
            ->where('notification.id_emitter', $userId)
            ->where('notification.id_receiver', Auth::id())
            ->update(['accepted' => true]);

        // create acceptance notification for the user
        $owner = Auth::user();
        $resultNotificationId = DB::table('notification')->insertGetId([
            'id_receiver' => $userId,
            'id_emitter' => $owner->id_user,
            'text' => 'Your request to join ' . $group->name . ' has been accepted!',
            'date' => now()
        ], 'id_notification');

        DB::table('join_group_request_result_notification')->insert([
            'id_notification' => $resultNotificationId,
            'id_group' => $groupId
        ]);

        return redirect()->back()->with('status', 'User accepted into the group!');
    }

    public function rejectRequest($groupId, $userId)
    {
        $group = Group::findOrFail($groupId);

        // only owner can reject
        if (Auth::id() !== $group->id_owner) {
            abort(403, 'Only the owner can reject requests.');
        }

        // only remove request
        $group->joinRequests()->detach($userId);

        // update join group request notification to rejected
        DB::table('join_group_request_notification')
            ->join('notification', 'notification.id_notification', '=', 'join_group_request_notification.id_notification')
            ->where('join_group_request_notification.id_group', $groupId)
            ->where('notification.id_emitter', $userId)
            ->where('notification.id_receiver', Auth::id())
            ->update(['accepted' => false]);

        return redirect()->back()->with('status', 'Request rejected.');
    }

    public function getCandidates(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();

        // only owner can invite
        if (!$group->is_public && $group->id_owner !== $user->id_user) {
            return response()->json(['error' => 'Not authorized'], 403);
        }

        // get friends of user  
        // ------------------------------------------ if no friends implemented yet ill fix later
        $friends = $user->friends; 

        $candidates = $friends->map(function ($friend) use ($group) {
            
            // already member?
            if ($group->members->contains($friend->id_user)) {
                return [
                    'id' => $friend->id_user,
                    'name' => $friend->name,
                    'username' => $friend->username,
                    'profile_image' => $friend->getProfileImage(),
                    'status' => 'member' // Botão cinzento "Member"
                ];
            }

            // has pending request?
            // serach in table if theres a join notification pending to this group
            $hasPendingLink = Notification::where(function($q) use ($friend) {
                    $q->where('id_receiver', $friend->id_user) // recieved invite
                      ->orWhere('id_emitter', $friend->id_user); // asked to join
                })
                ->whereHas('joinGroupRequestNotification', function($q) use ($group) {
                    $q->where('id_group', $group->id_group)
                      ->whereNull('accepted'); // pending
                })->exists();

            if ($hasPendingLink) {
                return [
                    'id' => $friend->id_user,
                    'name' => $friend->name,
                    'username' => $friend->username,
                    'profile_image' => $friend->getProfileImage(),
                    'status' => 'pending' // pending
                ];
            }

            // available to invite
            return [
                'id' => $friend->id_user,
                'name' => $friend->name,
                'username' => $friend->username,
                'profile_image' => $friend->getProfileImage(),
                'status' => 'available' // invite
            ];
        });

        return response()->json($candidates);
    }

    public function sendInvite(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $sender = Auth::user();
        $receiverId = $request->input('user_id'); // friends id to invite

        // basic validation
        if (!$group->is_public && $group->id_owner !== $sender->id_user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // make parent notification generic text
        $notification = Notification::create([
            'text' => 'invited you to join ' . $group->name,
            'date' => now(),
            'id_emitter' => $sender->id_user,
            'id_receiver' => $receiverId
        ]);

        // create group linked notification using existing table model
        JoinGroupRequestNotification::create([
            'id_notification' => $notification->id_notification,
            'id_group' => $group->id_group,
            'accepted' => null // Null = pending
        ]);

        return response()->json(['status' => 'success']);
    }

    public function acceptInvite(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();
        
        // verifyes if already a member
        if ($group->members->contains($user->id_user)) {
            return redirect()->back()->with('error', 'You are already a member.');
        }

        // operation to enter the group
        DB::transaction(function () use ($group, $user) {
            
            // save original state
            $wasPrivate = !$group->is_public;

            // if private make temporarily public
            if ($wasPrivate) {
                $group->is_public = true;
                $group->save();
            }

            // now trigger accepts new user
            GroupMember::create([
                'id_group'  => $group->id_group,
                'id_member' => $user->id_user
            ]);

            // get it back to private
            if ($wasPrivate) {
                $group->is_public = false;
                $group->save();
            }
        });

        // delete notification
        if ($request->has('notification_id')) {
            Notification::destroy($request->input('notification_id'));
        }

        return redirect()->route('groups.show', $group->id_group)->with('success', 'You joined the group!');
    }

    public function rejectInvite(Request $request, $id)
    {
        // just deletes notification
        if ($request->has('notification_id')) {
            Notification::destroy($request->input('notification_id'));
        }

        return redirect()->back()->with('status', 'Invite declined.');
    }

    public function getMembers(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user(); 

        // get members
        $members = $group->members->map(function ($member) use ($group, $user) {
            return [
                'id' => $member->id_user,
                'name' => $member->name,
                'username' => $member->username,
                'profile_image' => asset($member->getProfileImage()), 
                'is_owner' => $member->id_user === $group->id_owner,
                // only show kick if its not me
                'can_kick' => ($user->id_user === $group->id_owner) && ($member->id_user !== $user->id_user),
                'is_admin' => $user->isAdmin()
            ];
        });

        return response()->json($members);
    }

    public function removeMember(Request $request, $groupId, $userId)
    {
        $group = Group::findOrFail($groupId);

        // only owner can kick
        if (Auth::id() !== $group->id_owner) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        // cat kick myself use btn leave
        if ((int)$userId === $group->id_owner) {
            return response()->json(['status' => 'error', 'message' => 'Cannot kick owner'], 400);
        }

        // remove from table group_membership
        GroupMember::where('id_group', $groupId)
                   ->where('id_member', $userId)
                   ->delete();

        return response()->json(['status' => 'success']);
    }
        
}