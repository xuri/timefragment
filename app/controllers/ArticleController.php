<?php

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @uses        Laravel The PHP frameworks for web artisans http://laravel.com
 * @author      Ri Xu http://xuri.me <xuri.me@gmail.com>
 * @copyright   Copyright (c) TimeFragment
 * @link        http://www.timefragment.com
 * @since       25th Nov, 2014
 * @license     Licensed under The MIT License http://www.opensource.org/licenses/mit-license.php
 * @version     0.1
 */

class ArticleController extends BaseController
{
    /**
     * Index
     * @return Respanse
     */
    public function index()
    {
        $articles   = Article::where('post_status', 'open')->orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::where('cat_status', 'open')->orderBy('sort_order')->paginate(6);
        return View::make('article.index')->with(compact('articles', 'categories'));
    }

    /**
     * Category list
     * @return Respanse
     */
    public function category($category_id)
    {
        $articles           = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->where('post_status', 'open')->paginate(6);
        $categories         = Category::orderBy('sort_order')->get();
        $current_category   = Category::where('id', $category_id)->first();
        return View::make('article.category')->with(compact('articles', 'categories', 'category_id', 'current_category'));
    }

    /**
     * Show article
     * @param  string $slug Article abbreviated name
     * @return response
     */
    public function show($slug)
    {
        $article    = Article::where('slug', $slug)->where('post_status', 'open')->first();
        is_null($article) AND App::abort(404);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('article.show')->with(compact('article', 'categories'));
    }

    /**
     * Show search result
     * @return response
     */
    public function search()
    {
        $query      = Article::orderBy('created_at', 'desc')->where('post_status', 'open');
        $categories = Category::orderBy('sort_order')->get();
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
