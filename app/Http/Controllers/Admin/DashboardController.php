<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\FaqCategory;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'admins_count' => User::where('role', 'admin')->count(),
            'products_count' => Product::count(),
            'news_count' => News::count(),
            'faq_categories_count' => FaqCategory::count(),
            'unread_messages_count' => ContactMessage::where('read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
