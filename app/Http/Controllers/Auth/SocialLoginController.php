<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SocialLoginController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {

        try{
            $githubUser = Socialite::driver('github')->user();


            $user = User::updateOrCreate(
                [
                    'github_id' => $githubUser->id,
                ],
                [
                    'email' => $githubUser->getEmail(),
                    'name' => $githubUser->getNickname(),
                    'password' => Hash::make($githubUser->id),
                ],
            );

            Auth::login($user, true);
            return redirect()->route('post.index');
        } catch (\Exception $e) {
            Log::error('GitHubログインに失敗しました: ' . $e->getMessage());
        return redirect('/login')->with('error', 'GitHubログインに失敗しました');
        }
    }
}
