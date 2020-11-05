<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Article $article)
	{
        // $articles = Article::paginate(30);
        // $articles = Article::with('user','category')->paginate(30);

        $articles = $article->withOrder($request->order)
        ->with('user', 'category')  // 预加载防止 N+1 问题
        ->paginate(20);

		return view('articles.index', compact('articles'));
	}

    public function show(Category $category, Request $request, Article $article)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $articles = $article->withOrder($request->order)
                        ->where('category_id', $category->id)
                        ->with('user', 'category')   // 预加载防止 N+1 问题
                        ->paginate(20);

        return view('articles.index', compact('articles', 'category'));
    }

	public function create(Article $article)
	{
		return view('articles.create_and_edit', compact('article'));
	}

	public function store(ArticleRequest $request)
	{
		$article = Article::create($request->all());
		return redirect()->route('articles.show', $article->id)->with('message', 'Created successfully.');
	}

	public function edit(Article $article)
	{
        $this->authorize('update', $article);
		return view('articles.create_and_edit', compact('article'));
	}

	public function update(ArticleRequest $request, Article $article)
	{
		$this->authorize('update', $article);
		$article->update($request->all());

		return redirect()->route('articles.show', $article->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Article $article)
	{
		$this->authorize('destroy', $article);
		$article->delete();

		return redirect()->route('articles.index')->with('message', 'Deleted successfully.');
    }

}
