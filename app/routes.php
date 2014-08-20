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
    Route::get('/'        , array('as' => 'home'     , 'uses' => $controller.'getIndex'     ));
    # Homepage with Video
    #Route::get('/'        , array('as' => 'home'     , 'uses' => $controller.'getVideoIndex'));
    # Category
    Route::get('category' , array('as' => 'category' , 'uses' => $controller.'getCategory'  ));
    # Portfolio
    Route::get('portfolio', array('as' => 'portfolio', 'uses' => $controller.'getPortfolio' ));
    # Timeline
    Route::get('timeline' , array('as' => 'timeline' , 'uses' => $controller.'getTimeline'  ));
});

/*
|--------------------------------------------------------------------------
| Article Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'article'), function () {
    $resource   = 'article';
    $controller = 'ArticleController@';
    # Get index
    Route::get(            '/', array('as' => $resource.'.index'   , 'uses' => $controller.'index'   ));
    # Category index
    Route::get('category/{id}', array('as' => $resource.'.category', 'uses' => $controller.'category'));
    # Search result
    Route::post(      'search', array('as' => $resource.'.search'  , 'uses' => $controller.'search'  ));
    # Show content
    Route::get(       '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
});

/*
|--------------------------------------------------------------------------
| Creative Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'creative'), function () {
    $resource   = 'creative';
    $controller = 'CreativeController@';
    # Get index
    Route::get(            '/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
    # Category index
    Route::get('category/{id}', array('as' => $resource.'.category', 'uses' => $controller.'category'));
    # Show contents
    Route::get(       '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
    # Search result
    Route::post(      'search', array('as' => $resource.'.search'  , 'uses' => $controller.'search'  ));
    # Post comments
    Route::post(      '{slug}', $controller.'postComment')->before('auth');
});

/*
|--------------------------------------------------------------------------
| Travel Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'travel'), function () {
    $resource   = 'travel';
    $controller = 'TravelController@';
    # Get index
    Route::get(            '/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
    # Category index
    Route::get('category/{id}', array('as' => $resource.'.category', 'uses' => $controller.'category'));
    # Search result
    Route::post(      'search', array('as' => $resource.'.search'  , 'uses' => $controller.'search'  ));
    # Show contents
    Route::get(       '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
    # Post comments
    Route::post(      '{slug}', $controller.'postComment')->before('auth');
});

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'product'), function () {
    $resource   = 'product';
    $controller = 'ProductController@';
    # Get index
    Route::get(      '/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
    # Show contents
    Route::get( '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
    # Post comments
    Route::post('{slug}', $controller.'postAction')->before('auth');
});

/*
|--------------------------------------------------------------------------
| Job Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'job'), function () {
    $resource   = 'job';
    $controller = 'JobController@';
    # List
    Route::get(            '/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
    # List
    Route::get('category/{id}', array('as' => $resource.'.category', 'uses' => $controller.'category'));
    # Search result
    Route::post(      'search', array('as' => $resource.'.search'  , 'uses' => $controller.'search'  ));
    # Show
    Route::get(       '{slug}', array('as' => $resource.'.show'    , 'uses' => $controller.'show'    ));
    # Post comments
    Route::post(      '{slug}', $controller.'postComment')->before('auth');
});

/*
|--------------------------------------------------------------------------
| Timeline Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix' => 'timeline', 'before' => 'auth'), function () {
    $resource   = 'timeline';
    $controller = 'TimelineController@';
    # Timeline Index
    Route::get('/', array('as' => $resource.'.getIndex', 'uses' => $controller.'getIndex'));
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
        # Oauth Signup
        Route::get('oauth-signup'             , array('as' => 'oauth-signup'  , 'uses' => $Authority.'getOauthSignup'   ));
        # Oauth QQ Signup
        Route::get('oauth-qq'                 , array('as' => 'oauth-qq'      , 'uses' => $Authority.'getOauthQQ'       ));
        # Oauth Success
        Route::get('oauth-success'            , array('as' => 'oauth-success' , 'uses' => $Authority.'getOauthSuccess', 'before' => 'auth' ));
        # Signup Success
        Route::get('success/{email}'          , array('as' => 'signupSuccess' , 'uses' => $Authority.'getSignupSuccess' ));
        # Activation Account
        Route::get('activate/{activationCode}', array('as' => 'activate'      , 'uses' => $Authority.'getActivate'      ));
        # Forgot password
        Route::get('forgot-password'          , array('as' => 'forgotPassword', 'uses' => $Authority.'getForgotPassword'));
        Route::post('forgot-password'         , $Authority.'postForgotPassword');
        # Reset password
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
    # Creative
    Route::group(array('prefix' => 'mycreative'), function () {
        $resource   = 'mycreative';
        $controller = 'CreativeController@';
        Route::get(               '/', array('as' => $resource.'.index'             , 'uses' => $controller.'index'           ));
        Route::get(          'create', array('as' => $resource.'.create'            , 'uses' => $controller.'create'          ));
        Route::post(              '/', array('as' => $resource.'.store'             , 'uses' => $controller.'store'           ));
        Route::get(       '{id}/edit', array('as' => $resource.'.edit'              , 'uses' => $controller.'edit'            ));
        Route::put(            '{id}', array('as' => $resource.'.update'            , 'uses' => $controller.'update'          ));
        Route::post(           '{id}', array('as' => $resource.'.postUpload'        , 'uses' => $controller.'postUpload'      ));
        Route::delete(    '{id}/edit', array('as' => $resource.'.deleteUpload'      , 'uses' => $controller.'deleteUpload'    ));
        Route::delete(         '{id}', array('as' => $resource.'.destroy'           , 'uses' => $controller.'destroy'         ));
        Route::get(        'comments', array('as' => $resource.'.comments'          , 'uses' => $controller.'comments'        ));
        Route::delete('comments/{id}', array('as' => $resource.'.deleteComment'     , 'uses' => $controller.'deleteComment'   ));

    });
    # Travel
    Route::group(array('prefix' => 'mytravel'), function () {
        $resource   = 'mytravel';
        $controller = 'TravelController@';
        Route::get(               '/', array('as' => $resource.'.index'             , 'uses' => $controller.'index'           ));
        Route::get(          'create', array('as' => $resource.'.create'            , 'uses' => $controller.'create'          ));
        Route::post(              '/', array('as' => $resource.'.store'             , 'uses' => $controller.'store'           ));
        Route::get(       '{id}/edit', array('as' => $resource.'.edit'              , 'uses' => $controller.'edit'            ));
        Route::put(            '{id}', array('as' => $resource.'.update'            , 'uses' => $controller.'update'          ));
        Route::post(           '{id}', array('as' => $resource.'.postUpload'        , 'uses' => $controller.'postUpload'      ));
        Route::delete(    '{id}/edit', array('as' => $resource.'.deleteUpload'      , 'uses' => $controller.'deleteUpload'    ));
        Route::delete(         '{id}', array('as' => $resource.'.destroy'           , 'uses' => $controller.'destroy'         ));
        Route::get(        'comments', array('as' => $resource.'.comments'          , 'uses' => $controller.'comments'        ));
        Route::delete('comments/{id}', array('as' => $resource.'.deleteComment'     , 'uses' => $controller.'deleteComment'   ));
    });
    # Product
    Route::group(array('prefix' => 'myproduct'), function () {
        $resource   = 'myproduct';
        $controller = 'ProductController@';
        Route::get(               '/', array('as' => $resource.'.index'             , 'uses' => $controller.'index'           ));
        Route::get(          'create', array('as' => $resource.'.create'            , 'uses' => $controller.'create'          ));
        Route::post(              '/', array('as' => $resource.'.store'             , 'uses' => $controller.'store'           ));
        Route::get(       '{id}/edit', array('as' => $resource.'.edit'              , 'uses' => $controller.'edit'            ));
        Route::put(            '{id}', array('as' => $resource.'.update'            , 'uses' => $controller.'update'          ));
        Route::post(           '{id}', array('as' => $resource.'.postUpload'        , 'uses' => $controller.'postUpload'      ));
        Route::delete(    '{id}/edit', array('as' => $resource.'.deleteUpload'      , 'uses' => $controller.'deleteUpload'    ));
        Route::delete(         '{id}', array('as' => $resource.'.destroy'           , 'uses' => $controller.'destroy'         ));
        Route::get(            'cart', array('as' => $resource.'.cart'              , 'uses' => $controller.'cart'            ));
        Route::delete(         '{id}', array('as' => $resource.'.destroyGoods'      , 'uses' => $controller.'destroyGoods'    ));
        Route::get(        'comments', array('as' => $resource.'.comments'          , 'uses' => $controller.'comments'        ));
        Route::delete('comments/{id}', array('as' => $resource.'.deleteComment'     , 'uses' => $controller.'deleteComment'   ));
    });
    # Order
    Route::group(array('prefix' => 'order'), function () {
        $resource   = 'order';
        $controller = 'ProductOrderController@';
        Route::get(                        '/', array('as' => $resource.'.index'                , 'uses' => $controller.'index'                ));
        Route::get(               '{id}/order', array('as' => $resource.'.order'                , 'uses' => $controller.'order'                ));
        Route::get('{id}/customerOrderDetails', array('as' => $resource.'.customerOrderDetails' , 'uses' => $controller.'customerOrderDetails' ));
        Route::get(  '{id}/sellerOrderDetails', array('as' => $resource.'.sellerOrderDetails'   , 'uses' => $controller.'sellerOrderDetails'   ));
        Route::delete(                  '{id}', array('as' => $resource.'.destroyOrder'         , 'uses' => $controller.'destroyOrder'         ));
        Route::post(                 'payment', array('as' => $resource.'.payment'              , 'uses' => $controller.'payment'              ));
        Route::post(               'rePayment', array('as' => $resource.'.rePayment'            , 'uses' => $controller.'rePayment'            ));
        Route::post(            'trade-notify', array('as' => $resource.'.tradeNotify'          , 'uses' => $controller.'tradeNotify'          ));
        Route::get(             'trade-return', array('as' => $resource.'.tradeReturn'          , 'uses' => $controller.'tradeReturn'          ));
        Route::get(                   'seller', array('as' => $resource.'.seller'               , 'uses' => $controller.'seller'               ));
        Route::post(              'send-goods', array('as' => $resource.'.sendGoods'            , 'uses' => $controller.'sendGoods'            ));
        Route::post(                'checkout', array('as' => $resource.'.checkout'             , 'uses' => $controller.'checkout'             ));
    });
    # Job
    Route::group(array('prefix' => 'myjob'), function () {
        $resource   = 'myjob';
        $controller = 'JobController@';
        Route::get(               '/', array('as' => $resource.'.index'             , 'uses' => $controller.'index'           ));
        Route::get(          'create', array('as' => $resource.'.create'            , 'uses' => $controller.'create'          ));
        Route::post(              '/', array('as' => $resource.'.store'             , 'uses' => $controller.'store'           ));
        Route::get(       '{id}/edit', array('as' => $resource.'.edit'              , 'uses' => $controller.'edit'            ));
        Route::put(            '{id}', array('as' => $resource.'.update'            , 'uses' => $controller.'update'          ));
        Route::post(           '{id}', array('as' => $resource.'.postUpload'        , 'uses' => $controller.'postUpload'      ));
        Route::delete(    '{id}/edit', array('as' => $resource.'.deleteUpload'      , 'uses' => $controller.'deleteUpload'    ));
        Route::delete(         '{id}', array('as' => $resource.'.destroy'           , 'uses' => $controller.'destroy'         ));
        Route::get(        'comments', array('as' => $resource.'.comments'          , 'uses' => $controller.'comments'        ));
        Route::delete('comments/{id}', array('as' => $resource.'.deleteComment'     , 'uses' => $controller.'deleteComment'   ));
    });
    # Album
    Route::get('album'           , array('as' => 'account.album'           , 'uses' => $Account.'getAlbum'           ));
    # Update basic information
    Route::get('settings'        , array('as' => 'account.settings'        , 'uses' => $Account.'getSettings'        ));
    Route::put('settings'        , $Account.'putSettings');
    # Update user password
    Route::get('change-password' , array('as' => 'account.changePassword'  , 'uses' => $Account.'getChangePassword'  ));
    Route::put('change-password' , $Account.'putChangePassword');
    # Update avatar
    Route::get('change-portrait' , array('as' => 'account.changePortrait'  , 'uses' => $Account.'getChangePortrait'  ));
    Route::put('change-portrait' , $Account.'putChangePortrait');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {
    $Admin = 'AdminController@';
    # Admin index
    Route::get('/', array('as' => 'admin', 'uses' => $Admin.'getIndex'));
    # User management
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
    # Server status
    Route::group(array('prefix' => 'server'), function () {
        $resource   = 'server';
        $controller = 'Admin_ServerResource@';
        Route::get(        '/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'  ));
    });
    # Category management
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
    # Article management
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

    # Creative category mangement
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

    # Creative management
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

    # Travel category management
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

    # Travel management
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

    # Product category management
    Route::group(array('prefix' => 'product-categories'), function () {
        $resource   = 'product_categories';
        $controller = 'Admin_ProductCategoriesResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # Product management
    Route::group(array('prefix' => 'product'), function () {
        $resource   = 'product';
        $controller = 'Admin_ProductResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # Jobs category management
    Route::group(array('prefix' => 'job-categories'), function () {
        $resource   = 'job_categories';
        $controller = 'Admin_JobCategoriesResource@';
        Route::get(           '/', array('as' => $resource.'.index'        , 'uses' => $controller.'index'       ));
        Route::get(      'create', array('as' => $resource.'.create'       , 'uses' => $controller.'create'      ));
        Route::post(          '/', array('as' => $resource.'.store'        , 'uses' => $controller.'store'       ));
        Route::get(   '{id}/edit', array('as' => $resource.'.edit'         , 'uses' => $controller.'edit'        ));
        Route::put(        '{id}', array('as' => $resource.'.update'       , 'uses' => $controller.'update'      ));
        Route::post(       '{id}', array('as' => $resource.'.postUpload'   , 'uses' => $controller.'postUpload'  ));
        Route::delete('{id}/edit', array('as' => $resource.'.deleteUpload' , 'uses' => $controller.'deleteUpload'));
        Route::delete(     '{id}', array('as' => $resource.'.destroy'      , 'uses' => $controller.'destroy'     ));
    });

    # Job management
    Route::group(array('prefix' => 'job'), function () {
        $resource   = 'job';
        $controller = 'Admin_JobResource@';
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

Route::get('browser_not_support', array('as' => 'browser_not_support', function()
{
    return View::make('system.browserUpdate');
}));

App::missing(function($exception)
{
    return Response::view('system.missing', array(), 404);
});

// App::error(function($exception)
// {
//     return Response::view('system.error', array(), 500);
// });