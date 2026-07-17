<?php

namespace Saeedvir\SocialiteSlim\Examples;

use App\Http\Controllers\Controller;
use Saeedvir\SocialiteSlim\Facades\Socialite;
use Saeedvir\SocialiteSlim\Facades\OAuth as OAuthFacade;
use Saeedvir\SocialiteSlim\Traits\HasOAuthConnections;
use Exception;

class OAuthController extends Controller
{
    /**
     * Redirect the user to the OAuth provider authentication page.
     *
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the OAuth provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $oauthUser = Socialite::driver($provider)->user();
            
            // Prepare user data
            $userData = [
                'email' => $oauthUser->getEmail(),
                'name' => $oauthUser->getName(),
                'nickname' => $oauthUser->getNickname(),
                'avatar' => $oauthUser->getAvatar(),
                'access_token' => $oauthUser->token,
                'refresh_token' => $oauthUser->refreshToken ?? null,
                'expires_at' => isset($oauthUser->expiresIn) ? now()->addSeconds($oauthUser->expiresIn) : null,
            ];
            
            // Find or create OAuth connected user
            $connectedUser = OAuthFacade::findOrCreateOauthUser(
                $provider,
                $oauthUser->getId(),
                $userData
            );
            
            // If user is already authenticated, connect the OAuth account
            if (auth()->check()) {
                OAuthFacade::connectToUser($connectedUser, auth()->user());
                return redirect()->route('dashboard')->with('success', 'OAuth account connected successfully!');
            }
            
            // If OAuth user is already connected to a local user, log them in
            if ($connectedUser->user) {
                auth()->login($connectedUser->user);
                return redirect()->route('dashboard');
            }
            
            // If user exists with the same email, connect and log them in
            if ($userData['email']) {
                $userClass = config('socialite.user_model');
                $user = $userClass::where('email', $userData['email'])->first();
                if ($user) {
                    OAuthFacade::connectToUser($connectedUser, $user);
                    auth()->login($user);
                    return redirect()->route('dashboard');
                }
            }
            
            // Otherwise, store OAuth data in session and redirect to registration
            session(['oauth_data' => [
                'provider' => $provider,
                'provider_id' => $oauthUser->getId(),
                'user_data' => $userData,
            ]]);
            
            return redirect()->route('register')->with('oauth_registration', true);
            
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with ' . ucfirst($provider));
        }
    }

    /**
     * Display a listing of the OAuth connections for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // This assumes the User model uses the HasOAuthConnections trait
        $connections = auth()->user()->oauthConnections;
        
        return view('oauth.connections', compact('connections'));
    }

    /**
     * Remove the specified OAuth connection.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $oauthConnectedUser = \Saeedvir\SocialiteSlim\Models\OauthConnectedUser::findOrFail($id);
        
        // Ensure the OAuth connection belongs to the authenticated user
        if ($oauthConnectedUser->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        
        $oauthConnectedUser->delete();
        
        return redirect()->back()->with('success', 'OAuth connection removed successfully!');
    }
}