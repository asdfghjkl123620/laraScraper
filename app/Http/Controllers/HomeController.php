<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $articles = Article::orderBy('id', 'DESC')->paginate(10);
        return view('home')->withArticles($articles);
    }

    public function getArticleDetails($id)
    {
        $article = Article::find($id);
        return view('details')->withArticles($article);
    }
    public function getCategory($id)
    {
        $category = Category::find($id);
        $article = Article::where('category_id', $id)->orderBy('id', 'DESC')->paginate(20);
        return view('category')->withArticles($articles)->withCategory($category);
    }
}
