<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Homepage Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array(), function () {
	$controller = 'HomeController@';

    # Homepage
    Route::get('/'        , array('as' => 'home'     , 'uses' => $controller.'getIndex'    ));
    # Category
    Route::get('category' , array('as' => 'category' , 'uses' => $controller.'getCategory' ));
    # Portfolio
    Route::get('portfolio', array('as' => 'portfolio', 'uses' => $controller.'getPortfolio'));
    # Timeline
    Route::get('timeline' , array('as' => 'timeline' , 'uses' => $controller.'getTimeline' ));
});

/*
|--------------------------------------------------------------------------
| Article Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'article'), function () {
    $resource = 'article';
    $controller = 'ArticleController@';
    # 分类目录
    Route::get(            '/', array('as' => $resource.'.index'   , 'uses' => $controller.'index'   ));
    # 分类列表
    Route::get('category/{id}', array('as' => $resource.'.category', 'uses' => $controller.'category'));
    # 展示文章内容
    Route::get(       '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
});

/*
|--------------------------------------------------------------------------
| Creative Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'creative'), function () {
    $resource = 'creative';
    $controller = 'CreativeController@';
    # 分类创意列表
    Route::get(      '/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
    # 展示创意内容
    Route::get( '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
    # 提交创意评论
    Route::post('{slug}', $controller.'postComment')->before('auth');
});

/*
|--------------------------------------------------------------------------
| Travel Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'travel'), function () {
    $resource = 'travel';
    $controller = 'TravelController@';
    # 分类创意列表
    Route::get(            '/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
    # 分类列表
    Route::get('category/{id}', array('as' => $resource.'.category', 'uses' => $controller.'category'));
    # 展示创意内容
    Route::get(       '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
    # 提交创意评论
    Route::post(      '{slug}', $controller.'postComment')->before('auth');
});

/*
|--------------------------------------------------------------------------
| Basic Competence (Signin and Signup Routes)
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'auth'), function () {
	$Authority = 'AuthorityController@';
    # Signout
    Route::get('signout', array('as' => 'signout', 'uses' => $Authority.'getSignout'));
    # Route Group
    Route::group(array('before' => 'guest'), function () use ($Authority) {
        # Signin
        Route::get('signin'                   , array('as' => 'signin'        , 'uses' => $Authority.'getSignin'        ));
        Route::post('signin'                  , $Authority.'postSignin');
        # Signup
        Route::get('signup'                   , array('as' => 'signup'        , 'uses' => $Authority.'getSignup'        ));
        Route::post('signup'                  , $Authority.'postSignup');
        # SignupSuccess
        Route::get('success/{email}'          , array('as' => 'signupSuccess' , 'uses' => $Authority.'getSignupSuccess' ));
        # Activation Account
        Route::get('activate/{activationCode}', array('as' => 'activate'      , 'uses' => $Authority.'getActivate'      ));
        # 忘记密码
        Route::get('forgot-password'          , array('as' => 'forgotPassword', 'uses' => $Authority.'getForgotPassword'));
        Route::post('forgot-password'         , $Authority.'postForgotPassword');
        # 密码重置
        Route::get('forgot-password/{token}'  , array('as' => 'reset'         , 'uses' => $Authority.'getReset'         ));
        Route::post('forgot-password/{token}' , $Authority.'postReset');
    });
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'account', 'before' => 'auth'), function () {
    $Account = 'AccountController@';
    # Account Index
    Route::get('/'               , array('as' => 'account'         , 'uses' => $Account.'getIndex'));
    # Messages
    Route::get('messages'        , array('as' => 'account.messages', 'uses' => $Account.'getMessages'));
    # 创意汇
    Route::group(array('prefix' => 'mycreative'), function () {
        $resource   = 'mycreative';
        $controller = 'CreativeController@';
        Route::get(           '/', array('as' => $resource.'.index'             , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'            , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'             , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'              , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'            , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'        , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload'      , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'           , 'uses' => $controller.'destroy'     ));
    });
    # 去旅行
    Route::group(array('prefix' => 'mytravel'), function () {
        $resource   = 'mytravel';
        $controller = 'TravelController@';
        Route::get(           '/', array('as' => $resource.'.index'                , 'uses' => $controller.'index'              ));
        Route::get(      'create', array('as' => $resource.'.create'               , 'uses' => $controller.'create'             ));
        Route::post(          '/', array('as' => $resource.'.store'                , 'uses' => $controller.'store'              ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'                 , 'uses' => $controller.'edit'               ));
        Route::put(        '{id}', array('as' => $resource.'.update'               , 'uses' => $controller.'update'             ));
        Route::post(       '{id}', array('as' => $resource.'.postSingleUpload'     , 'uses' => $controller.'postSingleUpload'   ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'           , 'uses' => $controller.'postUpload'         ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload'         , 'uses' => $controller.'deleteUpload'       ));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'              , 'uses' => $controller.'destroy'            ));
    });
    # Album
    Route::get('album'           , array('as' => 'account.album'                   , 'uses' => $Account.'getAlbum'              ));
    # 修改基本信息
    Route::get('settings'        , array('as' => 'account.settings'                , 'uses' => $Account.'getSettings'           ));
    Route::put('settings'        , $Account.'putSettings');
    # 修改当前账号密码
    Route::get('change-password' , array('as' => 'account.changePassword'          , 'uses' => $Account.'getChangePassword'     ));
    Route::put('change-password' , $Account.'putChangePassword');
    # 更改头像
    Route::get('change-portrait' , array('as' => 'account.changePortrait'          , 'uses' => $Account.'getChangePortrait'     ));
    Route::put('change-portrait' , $Account.'putChangePortrait');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {
    $Admin = 'AdminController@';
    # 后台首页
    Route::get('/', array('as' => 'admin', 'uses' => $Admin.'getIndex'));
    # 用户管理
    Route::group(array('prefix' => 'users'), function () {
        $resource   = 'users';
        $controller = 'Admin_UserResource@';
        Route::get(        '/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'  ));
        Route::get(   'create', array('as' => $resource.'.create' , 'uses' => $controller.'create' ));
        Route::post(       '/', array('as' => $resource.'.store'  , 'uses' => $controller.'store'  ));
        Route::get('{id}/edit', array('as' => $resource.'.edit'   , 'uses' => $controller.'edit'   ))->before('not.self');
        Route::put(     '{id}', array('as' => $resource.'.update' , 'uses' => $controller.'update' ))->before('not.self');
        Route::delete(  '{id}', array('as' => $resource.'.destroy', 'uses' => $controller.'destroy'))->before('not.self');
    });
    # 服务器运行状态
    Route::group(array('prefix' => 'server'), function () {
        $resource   = 'server';
        $controller = 'Admin_ServerResource@';
        Route::get(        '/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'  ));
    });
    # 文章分类管理
    Route::group(array('prefix' => 'mycategories'), function () {
        $resource   = 'mycategories';
        $controller = 'Admin_CategoryResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });
    # 文章管理
    Route::group(array('prefix' => 'myarticles'), function () {
        $resource   = 'myarticles';
        $controller = 'Admin_ArticleResource@';
        Route::get(           '/', array('as' => $resource.'.index'       , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'      , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'       , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'        , 'uses' => $controller.'edit'        ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload', 'uses' => $controller.'deleteUpload'));
        Route::put(        '{id}', array('as' => $resource.'.update'      , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'  , 'uses' => $controller.'postUpload'  ));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'     , 'uses' => $controller.'destroy'     ));
    });

    # 创意汇分类管理
    Route::group(array('prefix' => 'creative-categories'), function () {
        $resource   = 'creative_categories';
        $controller = 'Admin_CreativeCategoriesResource@';
        Route::get(        '/', array('as'    => $resource.'.index'  , 'uses' => $controller.'index'  ));
        Route::get(   'create', array('as'    => $resource.'.create' , 'uses' => $controller.'create' ));
        Route::post(       '/', array('as'    => $resource.'.store'  , 'uses' => $controller.'store'  ));
        Route::get('{id}/edit', array('as'    => $resource.'.edit'   , 'uses' => $controller.'edit'   ));
        Route::put(     '{id}', array('as'    => $resource.'.update' , 'uses' => $controller.'update' ));
        Route::delete(  '{id}', array('as'    => $resource.'.destroy', 'uses' => $controller.'destroy'));
    });

    # 创意汇管理
    Route::group(array('prefix' => 'creative'), function () {
        $resource   = 'creative';
        $controller = 'Admin_CreativeResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # 去旅行话题管理
    Route::group(array('prefix' => 'travel-categories'), function () {
        $resource   = 'travel_categories';
        $controller = 'Admin_TravelCategoriesResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # 去旅行管理
    Route::group(array('prefix' => 'travel'), function () {
        $resource   = 'travel';
        $controller = 'Admin_TravelResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # 做兼职分类管理
    Route::group(array('prefix' => 'jobs-categories'), function () {
        $resource   = 'travel_categories';
        $controller = 'Admin_JobsCategoriesResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # 做兼职管理
    Route::group(array('prefix' => 'jobs'), function () {
        $resource   = 'jobs';
        $controller = 'Admin_JobsResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });
});

/*
|--------------------------------------------------------------------------
| System Routes
|--------------------------------------------------------------------------
|
*/
// App::missing(function($exception)
// {
//     return Response::view('system.missing', array(), 404);
// });

// App::error(function($exception)
// {
//     return Response::view('system.error', array(), 500);
// });