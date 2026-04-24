<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Article;
use App\Models\Video;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

public function index() {
    $articles = Article::with(['images', 'tags', 'commentaires'])->get();
    $videos   = Video::with(['images', 'tags', 'commentaires'])->get();
    return view('home', compact('articles', 'videos'));
}

    public function show($id) {
    $item = Article::with(['images', 'tags', 'commentaires'])->findOrFail($id);
    return view('detail', compact('item'));
}
}
