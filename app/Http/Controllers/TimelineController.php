<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TimelineController extends Controller {

    public function index(Request $request): View {

        /** @var User|null $user */
        $user = Auth::user();

        $timelineType = $request->query('timeline', 'public');

        $query = Post::with(['user', 'labels']);

        if ($user && $timelineType === 'personalized') {

            $userLabels = $user->labels()->pluck('label.id_label')->toArray();
            if (!empty($userLabels)) {
                $query->withCount(['labels as relevance' => function ($q) use ($userLabels) {
                    $q->whereIn('label.id_label', $userLabels);
                }])
                ->orderByDesc('relevance')
                ->orderByDesc('date');
            } 
            else {
                $query->orderByDesc('date');
            }
        } 
        else {
            $query->orderByDesc('date');
        }

        // Filter posts: only show posts from public profiles, from friends, or own posts
        if ($user) {
            $query->where(function($q) use ($user) {
                $q->where('id_creator', $user->id_user) // Own posts
                ->orWhereHas('user', function($userQuery) {
                    $userQuery->where('is_public', true);
                })
                ->orWhereHas('user', function($userQuery) use ($user) {
                    $userQuery->whereIn('id_user', function($subQuery) use ($user) {
                        $subQuery->select('id_friend')
                            ->from('user_friend')
                            ->where('id_user', $user->id_user);
                    });
                });
            });
        } else {
            // Guest users can only see public posts
            $query->whereHas('user', function($userQuery) {
                $userQuery->where('is_public', true);
            });
        }

        $posts = $query->get();

        return view('pages.home', ['posts' => $posts, 'activeTimeline' => $timelineType]);
    }

    public function searchPost(Request $request)
    {
        $search = $request->get('search');
        $posts = Post::with(['user', 'labels']);
        
        if($search) {
            $posts->where(function($query) use ($search) {
                $query->where('description', 'ILIKE', "%{$search}%")
                    ->orWhereHas('labels', function($q) use ($search) {
                        $q->where('designation', 'ILIKE', "%{$search}%");
                    })
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('username', 'ILIKE', "%{$search}%");
                    });
            });
        }
        
        $posts = $posts->get();

        if ($request->ajax()) {
            return response()->json([
                'posts' => $posts
            ]);
        }
        
        return view('pages.home', ['posts' => $posts]);
    }

}
