<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Review;
use App\Models\Thread;

class UserDashboardController extends Controller
{
    public function index() {
        $userId = auth()->id();

        return view ('user.dashboard',[
            'orderCount'=> Order::where('user_id',$userId)->count(),
            'commentCount'=> Comment::where('user_id',$userId)->count(),
            'reviewCount'=> Review::where('user_id',$userId)->count(),
            'threadCount'=> Thread::where('user_id',$userId)->count(),

             'latestOrders' => Order::with('product')
                                ->where('user_id', $userId)
                                ->latest()
                                ->take(5)
                                ->get(),

            'latestReviews' => Review::with('product')
                                ->where('user_id', $userId)
                                ->latest()
                                ->take(3)
                                ->get(),

            'latestComments' => Comment::with('thread')
                                ->where('user_id', $userId)
                                ->latest()
                                ->take(3)
                                ->get(),

        ]);
    }
}
