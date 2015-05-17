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

class AccountController extends BaseController
{
    /**
     * View: Account center index
     * @return response
     */
    public function getIndex()
    {
        return View::make('account.index');
    }

    /**
     * View: getMessages
     * @return response
     */
    public function getMessages()
    {
       return View::make('account.messages');
    }

    /**
     * View: getAlbum
     * @return response
     */
    public function getAlbum()
    {
       return View::make('account.album');
    }

    /**
     * View: getSettings
     * @return response
     */
    public function getSettings()
    {
       return View::make('account.settings');
    }

    /**
     * Action: Update basic information
     * @return Response
     */
    public function putSettings()
    {
        // Get all form data
        $info = array(
            'username'      => Input::get('username'),
            'nickname'      => Input::get('nickname'),
            'alipay'        => Input::get('alipay'),
            'phone'         => Input::get('phone'),
            'bio'           => Input::get('bio'),
            'sex'           => Input::get('sex'),
            'born_year'     => Input::get('born_year'),
            'born_month'    => Input::get('born_month'),
            'born_day'      => Input::get('born_day'),
            'province'      => Input::get('province'),
            'city'          => Input::get('city'),
            'address'       => Input::get('address')
        );
        // $info = Input::all();
        // Create validation rules
        $rules = array(
            'nickname'  => 'required|between:1,30',
            'bio'       => 'between:1,60',
            'address'   => 'between:1,80',
            'phone'     => 'numeric',
        );
        // Custom validation message
        $messages = array(
            'username.between'  => '长度请保持在:min到:max字之间',
            'username.required' => '请填写您的姓名',
            'nickname.required' => '请输入昵称',
            'nickname.between'  => '昵称长度请保持在:min到:max字之间',
            'bio.between'       => '个人简介长度请保持在:min到:max字之间',
            'address.between'   => '长度请保持在:min到:max字之间',
            'phone.numeric'     => '请填写正确的手机号码',
        );
        // Begin verification
        $validator = Validator::make($info, $rules, $messages);
        if ($validator->passes()) {
            // Verification success
            // Update account
            $user                   = Auth::user();
            $user->username         = Input::get('username');
            $user->nickname         = Input::get('nickname');
            $user->alipay           = Input::get('alipay');
            $user->bio              = Input::get('bio');
            $user->sex              = Input::get('sex');
            $user->born_year        = Input::get('born_year');
            $user->born_month       = Input::get('born_month');
            $user->born_day         = Input::get('born_day');
            $user->home_province    = Input::get('province');
            $user->home_city        = Input::get('city');
            $user->home_address     = Input::get('address');
            $user->phone            = Input::get('phone');
            if ($user->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', '<strong>基本资料更新成功。</strong>');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>基本资料更新失败。</strong>');
            }
        } else {
            // Verification fail, redirect back
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * View: Update user password
     * @return Response
     */
    public function getChangePassword()
    {
        return View::make('account.changePassword');
    }

    /**
     * Action: Update user password
     * @return Response
     */
    public function putChangePassword()
    {
        // Get all form data
        $data = array(
            'password_old'          => Input::get('password_old'),
            'password'              => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );
        // $data = Input::all();
        // Verify old password
        if (! Hash::check($data['password_old'], Auth::user()->password) )
            return Redirect::back()->withErrors($this->messages->add('password_old', '原始密码错误'));
        // Create validation rules
        $rules = array(
            'password' => 'required|alpha_dash|between:6,16|confirmed',
        );
        // Custom validation message
        $messages = array(
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.required'   => '请输入密码。',
            'password.confirmed'  => '两次输入的密码不一致。',
        );
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verification success
            // Update account
            $user           = Auth::user();
            $user->password = Input::get('password');
            if ($user->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', '<strong>密码修改成功。</strong>');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>密码修改失败。</strong>');
            }
        } else {
            // Verification fail, redirect back
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * View: Update avatar
     * @return Response
     */
    public function getChangePortrait()
    {
        return View::make('account.changePortrait');
    }

    /**
     * Action: Update avatar
     * @return Response
     */
    public function putChangePortrait()
    {
        // Get all form data
        $data  = Input::all();
        // Create validation rules
        $rules = array(
            'portrait' => 'required|mimes:jpg,jpeg,gif,png|max:1024',
        );
        // Custom validation message
        $messages = array(
            'portrait.required' => '请选择需要上传的图片。',
            'portrait.mimes'    => '请上传 :values 格式的图片。',
            'portrait.max'      => '图片的大小请控制在 1M 以内。',
        );
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verification success
            $image          = Input::file('portrait');
            $ext            = $image->guessClientExtension();  // 根据 mime 类型取得真实拓展名
            $fullname       = $image->getClientOriginalName(); // 客户端文件名，包括客户端拓展名
            $hashname       = date('H.i.s').'-'.md5($fullname).'.'.$ext; // 哈希处理过的文件名，包括真实拓展名
            // Picture information storage
            $user           = Auth::user();
            $oldImage       = $user->portrait;
            $user->portrait = $hashname;
            $user->save();
            // Storing images of different sizes
            $portrait       = Image::make($image->getRealPath());
            // crop the best fitting 1:1 ratio and resize to custom pixel
            $portrait->fit(220)->save(public_path('portrait/large/'.$hashname));
            $portrait->fit(128)->save(public_path('portrait/medium/'.$hashname));
            $portrait->fit(64)->save(public_path('portrait/small/'.$hashname));
            // Delete old avatar
            File::delete(
                public_path('portrait/large/'.$oldImage),
                public_path('portrait/medium/'.$oldImage),
                public_path('portrait/small/'.$oldImage)
            );
            // Return success
            return Redirect::back()->with('success', '操作成功。');
        } else {
            // Verification fail, redirect back
            return Redirect::back()->with('error', $validator->messages()->first());
        }
    }

    /**
     * View: My comments
     * @return Response
     */
    public function getMyComments()
    {
        $comments = Comment::where('user_id', Auth::user()->id)->paginate(15);
        return View::make('account.myComments')->with(compact('comments'));
    }

    /**
     * Action: Delete my comments
     * @param  int $id comment ID
     * @return response
     */
    public function deleteMyComment($id)
    {
        // Delete operations only allow comments to yourself
        $comment = Comment::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (is_null($comment))
            return Redirect::back()->with('error', '没有找到对应的评论');
        elseif ($comment->delete())
            return Redirect::back()->with('success', '评论删除成功。');
        else
            return Redirect::back()->with('warning', '评论删除失败。');
    }

}
