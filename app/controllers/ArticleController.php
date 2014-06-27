<?php

class ArticleController extends BaseController
{
    /**
     * 首页
     * @return Respanse
     */
    public function index()
    {
        $articles   = Article::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::orderBy('sort_order')->paginate(6);
        return View::make('article.index')->with(compact('articles', 'categories'));
    }

    /**
     * 分类文章列表
     * @return Respanse
     */
    public function category($category_id)
    {
        $articles   = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::orderBy('sort_order')->get();
        $current_category = Category::where('id', $category_id)->first();
        return View::make('article.category')->with(compact('articles', 'categories', 'category_id', 'current_category'));
    }

    /**
     * 文章展示页面
     * @param  string $slug 文章缩略名
     * @return response
     */
    public function show($slug)
    {
        $article    = Article::where('slug', $slug)->first();
        is_null($article) AND App::abort(404);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('article.show')->with(compact('article', 'categories'));
    }

}
