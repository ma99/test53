<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;

use Illuminate\Http\Request;
use Auth;
use Socialite;

class AuthController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }

       // dd($user);
        $authUser = $this->findOrCreateUser($user);
        //dd($user);
        //Auth::login($authUser, true);
        Auth::login($user, true);

        //return Redirect::to('home');
        return redirect('/home');

    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }

        $name = ($githubUser->name==null) ? $githubUser->nickname : $githubUser->name;

        return User::create([

            'github_id' => $githubUser->id,
            'name' => $name,
            'email' => $githubUser->email,
            'avatar' => $githubUser->avatar
        ]);
    }
}
/* Note: make the password nullable in users_table migrations if it's migrated. 
    Otherwise going to database users table structure using phpmyadmin make it nullable.
*/