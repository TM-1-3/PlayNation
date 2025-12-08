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
    public function index(Request $request)
    {
        // for searching 
        $query = Group::query();

        if ($request->has('search')) {
            // save for future (tsvector) 
            $query->where('name', 'ilike', '%' . $request->search . '%');
        } else {
            $query->where('is_public', true);
        }

        $groups = $query->get();

        return view('pages.groups.index', compact('groups'));
    }

    // show group details
    public function show($id)
    {
        $group = Group::with('owner', 'members')->findOrFail($id);
        
        // verufy access (is public or is member)
        if (!$group->is_public) {
            if (!Auth::check() || !$group->members->contains(Auth::user()->id_user)) {
                // only owner can access ----------------------------------------------------perguntar sobre isto, nos grupos privados apenas e só o owner que pode ver?, depois como é que seriam os membros que não são owners mas foram adicionados pelo owner?
                if (!Auth::check() || $group->id_owner !== Auth::id()) {
                    abort(403, 'This group is private.');
                }
            }
        }

        return view('pages.groups.show', compact('group'));
    }

    public function create()
    {
        if (!Auth::check()) return redirect()->route('login');
        
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

        // 2. Garantir que o user é um "Group Owner" na tabela group_owner
        // A tua BD exige que o ID exista na tabela group_owner antes de criar o grupo
        $isOwner = DB::table('group_owner')->where('id_group_owner', $user->id_user)->exists(); //------------Não percebi esta parte explica melhor como é que a nossa base de dados sabe sobre os group ouwners, (eles devem podem ser owners de alguns grupos mas membros de outros). 
        
        if (!$isOwner) {
            DB::table('group_owner')->insert(['id_group_owner' => $user->id_user]);
        }

        //create group
        $group = new Group();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->is_public = $request->has('is_public'); 
        $group->id_owner = $user->id_user;

        // image as in profile
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('groups', 'public');
            $group->picture = 'storage/' . $path;
        }

        $group->save();

        // owner is auto member
        $group->members()->attach($user->id_user);

        return redirect()->route('groups.show', $group->id_group)
            ->with('status', 'Group created successfully! 🎉');
    }

    
    public function edit($id)
    {
        $group = Group::findOrFail($id);

        // only ownwer can edit (probably admins showld too)
        if (Auth::id() !== $group->id_owner) {
            abort(403, 'Unauthorized');
        }

        return view('pages.groups.edit', compact('group'));
    }

    
    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        if (Auth::id() !== $group->id_owner) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id_group . ',id_group',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|max:4096',
        ]);

        $group->name = $request->name;
        $group->description = $request->description;
        $group->is_public = $request->has('is_public');

        // smart delete of group picture
        if ($request->hasFile('picture')) {
            if ($group->picture) {
                $oldPath = str_replace('storage/', '', $group->picture);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('picture')->store('groups', 'public');
            $group->picture = 'storage/' . $path;
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

        if ($group->picture) {
            Storage::disk('public')->delete(str_replace('storage/', '', $group->picture));
        }

        $group->delete();

        return redirect()->route('groups.index')->with('status', 'Group deleted.');
    }
}