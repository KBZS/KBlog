<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class Auth0IndexController extends Controller
{
    /**
     * Redirect to the Auth0 hosted login page
     *
     * @return mixed
     */
    public function login()
    {
        
        $authorize_params = [
            'scope' => 'openid profile email',
            // Getting an access token for the API.
            // 'audience' => config('laravel-auth0.api_identifier'),
        ];

        return \App::make('auth0')->login(null, null, $authorize_params);
    }

    public static function loginStore()
    {
        if (\Auth::id() != null) {
            $sub = \Auth::id();
            $selecteduser = User::whereSub($sub)->first();
            if ($selecteduser == null) {
                $user = new User;
                if (\Auth::user()->name == \Auth::user()->email) {
                    $user->name = \Auth::user()->nickname;
                } else {
                    $user->name = \Auth::user()->name;
                }
                $user->picture = \Auth::user()->picture;
                $user->sub = \Auth::id();
                $user->email = \Auth::user()->email;
                $user->save();
            }
        }
    }

    /**
     * Log out of Auth0
     *
     * @return mixed
     */
    public function logout()
    {
        
        \Auth::logout();
        $logoutUrl = sprintf(
            'https://%s/v2/logout?client_id=%s&returnTo=%s',
            config('laravel-auth0.domain'),
            config('laravel-auth0.client_id'),
            url('/')
        );
        // var_dump(\Auth::user()->name);
        return \Redirect::intended($logoutUrl);
    }
}
