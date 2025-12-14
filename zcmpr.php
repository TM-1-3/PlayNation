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