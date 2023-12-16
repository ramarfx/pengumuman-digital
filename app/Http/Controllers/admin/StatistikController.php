<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatistikController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $period      = $request->input('period', 'all');
        $currentUser = auth()->user();
        $isAdmin     = $currentUser->roles->first()->name == 'admin';

        $query = Post::withCount([
            'viewedBy' => function ($query) use ($period) {
                switch ($period) {
                    case 'daily':
                        $query->where('post_views.created_at', '>=', now()->startOfDay());
                        break;

                    case 'weekly':
                        $query->whereBetween('post_views.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;

                    case 'monthly':
                        $query->whereMonth('post_views.created_at', now()->month);
                        break;

                    case 'yearly':
                        $query->whereYear('post_views.created_at', now()->year);
                        break;
                }
            }
        ]);

        if (!$isAdmin) {
            $query->whereBelongsTo($currentUser);
        }

        $periodViews = $query->get();

        return view('admin.statistik.index', compact('periodViews', 'period'));
    }
}
