<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    // list all groups
    public function index()
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

            // get my groups details
            $myGroups = Group::whereIn('id_group', $myGroupIds)->get();

            // other groups including public and private to ask for access
            $otherGroups = Group::whereNotIn('id_group', $myGroupIds)
                ->orderBy('is_public', 'desc') // public first private after
                ->get();

        } else {
            // only public groups for visitors
            $otherGroups = Group::where('is_public', true)->get();
        }

        return view('pages.groups.index', [
            'myGroups' => $myGroups,
            'otherGroups' => $otherGroups
        ]);
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

        // picture upload
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = $file->hashName();
            $file->storeAs('group', $fileName, 'public');
            $group->picture = $fileName;
        }

        $group->save(); //  saves as public

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
            // delete old one if it exists
            if ($group->picture && Storage::disk('public')->exists('group/' . $group->picture)) {
                Storage::disk('public')->delete('group/' . $group->picture);
            }

            // saves new one
            $file = $request->file('picture');
            $fileName = $file->hashName();
            $file->storeAs('group', $fileName, 'public');
            
            $group->picture = $fileName;
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
        
        // security: only owner can accept
        if (Auth::id() !== $group->id_owner) {
            abort(403, 'Only the owner can accept requests.');
        }
        
        // save original privacy state
        $wasPrivate = !$group->is_public;

        // if private make it public temporarily
        // avoids trigger issues
        if ($wasPrivate) {
            $group->is_public = true;
            $group->save();
        }

        //add member
        if (!$group->members->contains($userId)) {
            $group->members()->attach($userId);
        }

        // return to normal privacy state
        if ($wasPrivate) {
            $group->is_public = false;
            $group->save();
        }

        // removes pending request
        $group->joinRequests()->detach($userId);

        DB::table('join_group_request_notification')
            ->join('notification', 'notification.id_notification', '=', 'join_group_request_notification.id_notification')
            ->where('join_group_request_notification.id_group', $groupId)
            ->where('notification.id_emitter', $userId)
            ->where('notification.id_receiver', Auth::id())
            ->update(['accepted' => true]);

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
        
}