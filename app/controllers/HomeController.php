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

    /**
     * View: Index
     * @return Respanse
     */
    public function getIndex()
    {
        $articles          = Article::orderBy('created_at', 'desc')->paginate(6);
        $travel            = Travel::orderBy('created_at', 'desc')->paginate(4);
        $product           = Product::orderBy('created_at', 'desc')->paginate(12);
        $productCategories = ProductCategories::orderBy('sort_order')->get();
        $job               = Job::orderBy('created_at', 'desc')->paginate(4);
        $categories        = Category::orderBy('sort_order')->get();
        if(Auth::check())
        {
            $timeline      = Timeline::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        }
        else
        {
            $timeline      = Timeline::orderBy('created_at', 'desc')->get();
        }
        return View::make('home.index')->with(compact('articles', 'categories', 'travel', 'product', 'productCategories', 'job', 'timeline'));
    }

    /**
     * View: Video index
     * @return Respanse
     */
    public function getVideoIndex()
    {
        $articles          = Article::orderBy('created_at', 'desc')->paginate(6);
        $travel            = Travel::orderBy('created_at', 'desc')->paginate(4);
        $product           = Product::orderBy('created_at', 'desc')->paginate(12);
        $productCategories = ProductCategories::orderBy('sort_order')->get();
        $job               = Job::orderBy('created_at', 'desc')->paginate(4);
        $categories        = Category::orderBy('sort_order')->get();
        if(Auth::check())
        {
            $timeline      = Timeline::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        }
        else
        {
            $timeline      = Timeline::orderBy('created_at', 'desc')->get();
        }
        return View::make('home.videoindex')->with(compact('articles', 'categories', 'travel', 'product', 'productCategories', 'job', 'timeline'));
    }

    /**
     * View: Article category
     * @return Respanse
     */
    public function getCategoryArticles($category_id)
    {
        $articles   = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('home.category')->with(compact('articles', 'categories', 'category_id'));
    }

    /**
     * View: Article show
     * @param  string $slug Article slug
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
     * Action: Post comments
     * @param  string $slug Article slug
     * @return response
     */
    public function postBlogComment($slug)
    {
        // Get comment
        $content = e(Input::get('content'));
        // Check word
        if (mb_strlen($content)<3)
            return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        // Find article
        $article = Article::where('slug', $slug)->first();
        // Create comment
        $comment = new Comment;
        $comment->content    = $content;
        $comment->article_id = $article->id;
        $comment->user_id    = Auth::user()->id;
        if ($comment->save()) {
            // Create success
            // Updated comments
            $article->comments_count = $article->comments->count();
            $article->save();
            // Return success
            return Redirect::back()->with('success', '评论成功。');
        } else {
            // Create fail
            return Redirect::back()->withInput()->with('error', '评论失败。');
        }
    }

}