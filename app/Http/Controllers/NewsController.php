<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        $news->load(['comments.user', 'likes']);
        $isLiked = auth()->check() && $news->likes()->where('user_id', auth()->id())->exists();

        return view('news.show', compact('news', 'isLiked'));
    }

    public function storeComment(Request $request, News $news)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'news_id' => $news->id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment toegevoegd!');
    }
}
