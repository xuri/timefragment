<?php

class ArticleController extends BaseController
{
    /**
     * Index
     * @return Respanse
     */
    public function index()
    {
        $articles   = Article::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::orderBy('sort_order')->paginate(6);
        return View::make('article.index')->with(compact('articles', 'categories'));
    }

    /**
     * Category list
     * @return Respanse
     */
    public function category($category_id)
    {
        $articles          = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(6);
        $categories        = Category::orderBy('sort_order')->get();
        $current_category  = Category::where('id', $category_id)->first();
        return View::make('article.category')->with(compact('articles', 'categories', 'category_id', 'current_category'));
    }

    /**
     * Show article
     * @param  string $slug Article abbreviated name
     * @return response
     */
    public function show($slug)
    {
        $article           = Article::where('slug', $slug)->first();
        is_null($article) AND App::abort(404);
        $categories        = Category::orderBy('sort_order')->get();
        return View::make('article.show')->with(compact('article', 'categories'));
    }

    /**
     * Show search result
     * @return response
     */
    public function search()
    {
        $query             = Article::orderBy('created_at', 'desc');
        $categories        = Category::orderBy('sort_order')->get();
        // Get search conditions
        switch (Input::get('target')) {
            case 'title':
                $title = Input::get('like');
                break;
        }
        // Construct query statement
        isset($title) AND $query->where('title', 'like', "%{$title}%")->orWhere('content', 'like', "%{$title}%");
        $articles = $query->paginate(6);
        return View::make('article.search')->with(compact('articles', 'categories'));
    }
}
