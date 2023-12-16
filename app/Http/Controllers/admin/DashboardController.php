<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $posts  = Post::count();

        $period = request('period'); // Default ke harian jika tidak ada request

        $totalViews = Post::withCount('viewedBy')->get()->sum('viewed_by_count');
        $periodViews = Post::withCount([
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

                    default:
                        $query;
                        break;
                }
            }
        ])->paginate(1);

        return view('admin.index', compact('users', 'posts', 'periodViews', 'totalViews', 'period'));
    }
}
