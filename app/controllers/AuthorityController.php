<?php

class AuthorityController extends BaseController
{
    /**
     * View: Signin
     * @return Response
     */
    public function getSignin()
    {
        return View::make('authority.signin');
    }

    /**
     * Action: Signin
     * @return Response
     */
    public function postSignin()
    {
        // Credentials
        $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'));
        // Remember login status
        // $remember    = Input::get('remember-me', 1);
        // Verify signin
        if (Auth::attempt($credentials)) {
            // Signin success, redirect to the previous page that was blocked
            return Redirect::intended();
        } else {
            // Signin fail, redirect back
            return Redirect::back()
                ->withInput()
                ->withErrors(array('attempt' => 'E-mail 或 用户名错误, 请重新登录'));
        }
    }

    /**
     * Action: Signout
     * @return Response
     */
    public function getSignout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * View: Signup
     * @return Response
     */
    public function getSignup()
    {
        return View::make('authority.signup');
    }

    /**
     * Action: Signup
     * @return Response
     */
    public function postSignup()
    {
        // Get all form data.
        $data = Input::all();
        // Create validation rules
        $rules = array(
            'email'               => 'required|email|unique:users',
            'password'            => 'required|alpha_dash|between:6,16|confirmed',
        );
        // Custom validation message
        $messages = array(
            'email.required'      => '请输入邮箱地址。',
            'email.email'         => '请输入正确的邮箱地址。',
            'email.unique'        => '此邮箱已被使用。',
            'password.required'   => '请输入密码。',
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.confirmed'  => '两次输入的密码不一致。',
        );
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verification success，add user
            $user           = new User;
            $user->email    = Input::get('email');
            $user->password = Input::get('password');
            if ($user->save()) {
                // Add user success
                // Generate activation code
                $activation        = new Activation;
                $activation->email = $user->email;
                $activation->token = str_random(40);
                $activation->save();
                // Send activation mail
                $with = array('activationCode' => $activation->token);
                Mail::later(10, 'authority.email.activation', $with, function ($message) use ($user) {
                    $message
                        ->to($user->email)
                        ->subject('时光碎片 账号激活邮件'); // Subject
                });
                // Redirect to a registration page, prompts user to activate
                return Redirect::route('signupSuccess', $user->email);
            } else {
                // Add user fail
                return Redirect::back()
                    ->withInput()
                    ->withErrors(array('add' => '注册失败。'));
            }
        } else {
            // Verification fail, redirect back
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * View: Signuo success, prompts user to activate
     * @param  string $email user E-mail
     * @return Response
     */
    public function getSignupSuccess($email)
    {
        // Confirmed the existence of this inactive mailboxes
        $activation = Activation::whereRaw("email = '{$email}'")->first();
        // No mailboxes in the database, throw 404
        is_null($activation) AND App::abort(404);
        // Prompts user to activate
        return View::make('authority.signupSuccess')->with('email', $email);
    }

    /**
     * Action: Activate account
     * @param  string $activationCode Activation tokens
     * @return Response
     */
    public function getActivate($activationCode)
    {
        // Database authentication tokens
        $activation = Activation::where('token', $activationCode)->first();
        // No tokens in the database, throw 404
        is_null($activation) AND App::abort(404);
        // Database tokens
        // Activate the corresponding user
        $user               = User::where('email', $activation->email)->first();
        $user->activated_at = new Carbon;
        $user->save();
        // Delete tokens
        $activation->delete();
        // Activation success
        return View::make('authority.activationSuccess');
    }

    /**
     * Page: Forgot password, send a password reset mail
     * @return Response
     */
    public function getForgotPassword()
    {
        return View::make('authority.password.remind');
    }

    /**
     * Action: Forgot password, send a password reset mail
     * @return Response
     */
    public function postForgotPassword()
    {
        // Calling the system-provided class
        $response = Password::remind(Input::only('email'), function ($m, $user, $token) {
            $m->subject('时光碎片 密码重置邮件'); // Title
        });
        // Detect mail and send a password reset message
        switch ($response) {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    /**
     * View: Reset password
     * @return Response
     */
    public function getReset($token)
    {
        // No tokens in the database, throw 404
        is_null(PassowrdReminder::where('token', $token)->first()) AND App::abort(404);
        return View::make('authority.password.reset')->with('token', $token);
    }

    /**
     * Action: Reset password
     * @return Response
     */
    public function postReset()
    {
        // Invoke system comes with the password reset process
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            // Save new password
            $user->password = $password;
            $user->save();
            // User signin
            Auth::login($user);
        });

        switch ($response) {
            case Password::INVALID_PASSWORD:
                // no break
            case Password::INVALID_TOKEN:
                // no break
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::PASSWORD_RESET:
                return Redirect::to('/');
        }
    }

    /**
     * Action：OAuth 2.0 Signup
     * @return Response
     */
    public function getOauthSignup()
    {
        header("Content-type:text/html;charset=utf-8");
        session_start();

        include_once( app_path('api/weibo/config.php') );
        include_once( app_path('api/weibo/saetv2.ex.class.php') );

        $o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

        if (isset($_REQUEST['code'])) {
            $keys                 = array();
            $keys['code']         = $_REQUEST['code'];
            $keys['redirect_uri'] = WB_CALLBACK_URL;
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;
            } catch (OAuthException $e) {
            }
        }

        if ($token) {
            $_SESSION['token'] = $token;
            setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );

            $c            = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
            $ms           = $c->home_timeline(); // Done
            $uid_get      = $c->get_uid();
            $uid          = $uid_get['uid'];
            $user_message = $c->show_user_by_id($uid);// Get sinformation according user ID
            $nickname     = $user_message['screen_name'];
            $password     = $_SESSION['token']['access_token'];
            $credentials  = array('email' => $uid, 'password' => $password);

            if (Auth::attempt($credentials))
            {
                // Signin success, redirect to the previous page that was blocked
                return Redirect::intended();
            } else {
                $user             = new User;
                $user->email      = $uid;
                $user->password   = $_SESSION['token']['access_token'];
                $user->nickname   = $nickname;
                $user->bound_type = '2';
                $user->save();
                return View::make('authority.oauthSuccess');
            }

        } else {
           return View::make('authority.signup')
            ->withErrors(array('add' => '注册失败。'));;
        }

    }

    /**
    * View: OAuth 2.0 Success
    * @param  string
    * @return Response
    */
    public function getOauthSuccess()
    {
        return View::make('authority.oauthSuccess');
    }

    /**
     * Action：OAuth 2.0 QQ
     * @return Response
     */
    public function getOauthQQ()
    {
        include_once( app_path('api/qq/qqConnectAPI.php' ));
        $qc = new QC();
        $callback     = $qc->qq_callback();
        $openid       = $qc->get_openid();

        $qc = new QC($callback,$openid);
        $access_token = $qc->get_access_token();
        $arr          = $qc->get_user_info();
        $nickname     = $arr["nickname"];
        $credentials  = array('email' => $openid, 'password' => $access_token);

        if (Auth::attempt($credentials))
        {
            // Signin success, redirect to the previous page that was blocked
            return Redirect::intended();
        } else {
            $user             = new User;
            $user->email      = $openid;
            $user->password   = $access_token;
            $user->nickname   = $nickname;
            $user->bound_type = '3';
            $user->save();
            return View::make('authority.oauthQQ');
        }

    }


}