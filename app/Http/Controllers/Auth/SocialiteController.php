<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;

class SocialiteController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
    
            $user = Socialite::driver($provider)->stateless()->user();
            $userCol = User::where('provider_id', $user->getId())->first();
     
            if($userCol){
                Auth::login($userCol);
                return redirect($this->redirectTo);
            }else{
                $addUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    // 'phone' => $user->getId(),
                    'password' => Hash::make('password'),
                    'provider_id' => $user->getId(),
                    'provider_type' => $provider,
                ]);
    
                Auth::login($addUser);
                return redirect($this->redirectTo);
            }
    
         } catch (Exception $exception) {
             return redirect($this->redirectTo);
         }

    }
}
