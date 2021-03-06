<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category,Request $request, Article $article)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $articles = $article->withOrder($request->order)
                        ->where('category_id', $category->id)
                        ->with('user', 'category')   // 预加载防止 N+1 问题
                        ->paginate(20);

        // 传参变量话题和分类到模板中
        return view('articles.index', compact('articles', 'category'));
    }
}
