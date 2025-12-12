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
        $group = Group::with('owner', 'members')->findOrFail($id);
        $user = Auth::user();
        // public anyone (logged or not)
        if ($group->is_public) {
            return view('pages.groups.show', compact('group'));
        }

        // private only if has key
        if ($user && (
            $group->members->contains($user->id_user) || 
            $group->id_owner === $user->id_user || 
            $user->isAdmin()
        )) {
            return view('pages.groups.show', compact('group'));
        }

        // visitor if try acced private
        if (!$user) {
            return redirect()->route('login')->with('status', 'Please login to view private groups.');
        }

        // logged but no access
        abort(403, 'This group is private.');

    }

    public function create()
    {
        // Segurança extra: só logados entram (embora a rota já deva ter middleware)
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }
        
        // Retorna a view que criámos com o formulário Tailwind
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
        $group->name = $request->name;
        $group->description = $request->description;
        $group->is_public = $request->input('is_public'); 
        $group->id_owner = $user->id_user;
        $group->picture = '';

        $group->save();

        if ($request->hasFile('picture')) {
            $uploadrequest = new Request([
                'id' => $group->id_group,
                'type' => 'group'
            ]);
            $uploadrequest->files->set('file', $request->file('picture'));
            app(FileController::class)->upload($uploadrequest);
        }

        // owner is auto member
        $group->members()->attach($user->id_user);

        return redirect()->route('groups.show', $group->id_group)
            ->with('status', 'Group created successfully! 🎉');
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
            // delete old picture if exists
            if (!empty($group->picture)) {
                Storage::disk('storage')->delete('group/' . $group->picture);
            }

            // upload new picture
            $file = $request->file('picture');
            $fileName = $file->hashName();
            $file->storeAs('group', $fileName, 'storage');
            
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
                // Baseado no padrão do FriendController
                $notificationId = DB::table('notification')->insertGetId([
                    'id_receiver' => $group->id_owner, // O Dono recebe
                    'id_emitter'  => $user->id_user,   // Eu envio
                    'text'        => $user->name . " requested to join your group '" . $group->name . "'.",
                    'date'        => now()
                ], 'id_notification');

                // C. Criar a Notificação Específica (Tabela Filha 'join_group_request_notification')
                // Isto liga a notificação ao grupo específico para saberes qual aceitar depois
                DB::table('join_group_request_notification')->insert([
                    'id_notification' => $notificationId,
                    'id_group'        => $group->id_group,
                    'accepted'        => null // null = pendente
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
            $groups = Group::whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input])
                         ->orderByRaw("ts_rank(tsvectors, to_tsquery('portuguese', ?)) DESC", [$input])
                         ->get();
        } else {
            $groups = Group::all();
        }
        
        if ($type == 'group-page') {
            if ($request->ajax()) {
                $myGroups = collect();
                $otherGroups = collect();

                if ($user) {
                    // user's group IDs (member or owner)
                    $memberGroupIds = DB::table('group_membership')
                        ->where('id_member', $user->id_user)
                        ->pluck('id_group')
                        ->toArray();
                    
                    $ownerGroupIds = DB::table('groups')
                        ->where('id_owner', $user->id_user)
                        ->pluck('id_group')
                        ->toArray();

                    $myGroupIds = array_unique(array_merge($memberGroupIds, $ownerGroupIds));

                    // myGroups and otherGroups
                    $myGroups = $groups->whereIn('id_group', $myGroupIds)->values();
                    $otherGroups = $groups->whereNotIn('id_group', $myGroupIds)
                        ->sortByDesc('is_public')
                        ->values();
                } else {
                    // public groups for visitors
                    $otherGroups = $groups->where('is_public', true)->values();
                }

                // pictures
                $myGroups = $myGroups->map(function($group) {
                    $groupArray = $group->toArray();
                    $groupArray['picture'] = $group->getGroupPicture();
                    return $groupArray;
                });

                $otherGroups = $otherGroups->map(function($group) {
                    $groupArray = $group->toArray();
                    $groupArray['picture'] = $group->getGroupPicture();
                    return $groupArray;
                });

                return response()->json([
                    'myGroups' => $myGroups,
                    'otherGroups' => $otherGroups
                ]);
            }
        } else if ($type == 'group-admin') {
            if ($request->ajax()) {
                // pictures
                $groups = $groups->map(function($group) {
                    $groupArray = $group->toArray();
                    $groupArray['picture'] = $group->getGroupPicture();
                    return $groupArray;
                });

                return response()->json([
                    'groups' => $groups,
                ]);
            }
            
            return view('pages.admin', ['groups' => $groups, 'type' => 'group']);
        }
        
        return view('pages.admin', ['groups' => $groups, 'type' => 'group']);
    }
        
}