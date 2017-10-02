<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        //
    }

    

    public function boot(){


        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_key')) {
                $key = explode(' ',$request->input('api_key'));
                $user = User::where('api_key', $request->input('api_key'))->first();
                if(!empty($user)){
                    $request->request->add(['userid' => $user->id]);
                             
                }

                return $user;
            }
        });
        
    }
}

// public function viaRequest( 'api', function ($request) {
//     if ($request->header('Authorization')) {
//         $key = explode(' ',$request->header('Authorization'));
//         $user = User::where('api_key', $key[1])->first();
//         if(!empty($user)){
//         $request->request->add(['userid' => $user->id]);
         
//         }
//         return $user;
// }
