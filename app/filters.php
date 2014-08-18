<?php

/*
|--------------------------------------------------------------------------
| Registering an application event, order of execution is as follows:
|--------------------------------------------------------------------------
|
| 1. Implementation of application events       App::before parameter $request
| 2. Front filter                               Route::filter parameters $route, $request
|
| 3. Implementation (registered before route from) anonymous callback function or the appropriate controller method, and get the response instance $response
|
| 4. Rear filter                                Route::filter parameters $route, $request, $response
| 5. Implementation of application event        App::after parameter $request, $response
|
| 6. Return responses to the client instance $response
|
| 7. Implementation of application event        App::finish parameter $request, $response
| 8. Implementation of application event        App::shutdown parameter $application
|
*/

# App::before(function ($request) {});

# App::after(function ($request, $response) {});

# App::finish(function ($request, $response) {});

# App::shutdown(function($application) {});


/*
|--------------------------------------------------------------------------
| [Front] Filters
|--------------------------------------------------------------------------
# Route::filter('beforeFilter', function ($route, $request) {});
|
*/

# CSRF protection filters to prevent cross-site request forgery
Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
        throw new Illuminate\Session\TokenMismatchException;
});

# You must be an administrator
Route::filter('admin', function () {
    // Blocking users who are not administrators, jump back to the previous page
    if (! Auth::user()->is_admin) return Redirect::back();
});

# Users must be logged in
Route::filter('auth', function () {
    // Blocking users who are not logged and documented the current URL, go to login page
    if (Auth::guest()) return Redirect::guest(route('signin'));
});

# HTTP-based authentication filter single popup login authentication
Route::filter('auth.basic', function () {
    return Auth::basic();
});

# Must activated
Route::filter('auth.activated', function () {
    if ( Auth::user()->activated_at == NULL )
        return View::make('authority.signupSuccess')->with('email', Auth::user()->email);
});

# Must be a visitor (less)
Route::filter('guest', function () {
    // Block logged in users
    if (Auth::check()) return Redirect::to('/');
});

# Prevent dangerous operations on your account
Route::filter('not.self', function ($route) {
    // Intercept your user ID
    if (Auth::user()->id == $route->parameter('id'))
        return Redirect::back();
});

/*
|--------------------------------------------------------------------------
| [Rear] Filters
|--------------------------------------------------------------------------
# Route::filter('afterFilter', function ($route, $request, $response) {});
|
*/



/*
|--------------------------------------------------------------------------
| Event Monitoring
|--------------------------------------------------------------------------
|
*/
# User signin event
Event::listen('auth.login', function ($user, $remember) {
    // Store last signin time
    $user->signin_at = new Carbon;
    $user->save();
    // Additional permissions-related operations later
    // ...
});
# User signout event
// Event::listen('auth.logout', function ($user) {
//     //
// });