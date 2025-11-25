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
                $query->orWhere('label.designation', 'ILIKE', "%{$search}%")
                $query->orWhere('user.username', 'ILIKE', "%{$search}%");
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
