<?php

namespace Saeedvir\SocialiteSlim\Examples;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Saeedvir\SocialiteSlim\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            
            // Process the user data
            // $user->token;
            // $user->getId();
            // $user->getName();
            // $user->getEmail();
            // $user->getAvatar();
            
            return redirect()->route('dashboard')->with('success', 'Successfully authenticated with GitHub!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with GitHub.');
        }
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            // Process the user data
            // $user->token;
            // $user->getId();
            // $user->getName();
            // $user->getEmail();
            // $user->getAvatar();
            
            return redirect()->route('dashboard')->with('success', 'Successfully authenticated with Google!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google.');
        }
    }

    /**
     * Redirect the user to the Telegram authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToTelegram()
    {
        return Socialite::driver('telegram')->redirect();
    }

    /**
     * Obtain the user information from Telegram.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleTelegramCallback()
    {
        try {
            $user = Socialite::driver('telegram')->user();
            
            // Process the user data
            // $user->token;
            // $user->getId();
            // $user->getName();
            // $user->getNickname();
            
            return redirect()->route('dashboard')->with('success', 'Successfully authenticated with Telegram!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Telegram.');
        }
    }
}