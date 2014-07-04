<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	// public function showWelcome()
	// {
	// 	return View::make('hello');
	// }

    /*
    |--------------------------------------------------------------------------
    | Homepage Controller
    |--------------------------------------------------------------------------
    |
    */

    public function getCategory()
    {
       return View::make('home.category');
    }

    public function getPortfolio()
    {
       return View::make('home.portfolio');
    }

    public function getTimeline()
    {
       return View::make('home.timeline');
    }

    /**
     * 首页
     * @return Respanse
     */
    public function getIndex()
    {
        $articles   = Article::orderBy('created_at', 'desc')->paginate(6);
        $travel     = Travel::orderBy('created_at', 'desc')->paginate(4);
        $jobs       = Jobs::orderBy('created_at', 'desc')->paginate(4);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('home.index')->with(compact('articles', 'categories', 'travel', 'jobs'));
    }

    /**
     * 视频首页
     * @return Respanse
     */
    public function getVideoIndex()
    {
        $articles   = Article::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('home.videoindex')->with(compact('articles', 'categories'));
    }

    /**
     * 分类文章列表
     * @return Respanse
     */
    public function getCategoryArticles($category_id)
    {
        $articles   = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('home.category')->with(compact('articles', 'categories', 'category_id'));
    }

    /**
     * 文章展示页面
     * @param  string $slug 文章缩略名
     * @return response
     */
    public function getBlogShow($slug)
    {
        $article    = Article::where('slug', $slug)->first();
        is_null($article) AND App::abort(404);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('about.show')->with(compact('article', 'categories'));
    }

    /**
     * 提交评论
     * @param  string $slug 文章缩略名
     * @return response
     */
    public function postBlogComment($slug)
    {
        // 获取评论内容
        $content = e(Input::get('content'));
        // 字数检查
        if (mb_strlen($content)<3)
            return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        // 查找对应文章
        $article = Article::where('slug', $slug)->first();
        // 创建文章评论
        $comment = new Comment;
        $comment->content    = $content;
        $comment->article_id = $article->id;
        $comment->user_id    = Auth::user()->id;
        if ($comment->save()) {
            // 创建成功
            // 更新评论数
            $article->comments_count = $article->comments->count();
            $article->save();
            // 返回成功信息
            return Redirect::back()->with('success', '评论成功。');
        } else {
            // 创建失败
            return Redirect::back()->withInput()->with('error', '评论失败。');
        }
    }

}