<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class Registration extends ServiceProvider
{
    public static function store( $data = null)
    {
        $user =User::new();
        $user->email = $data->email;
        $user->name = $data->name;
        $user->role = $data->role;
        $user->password = $data->password;
        $user->mobile = $data->mobile;
        $user->img = $data->img;
        $user = User::create($user);
        return $user;
    }


    public static function belongsTo($user)
    {
        return $user->belongsTo(User::class, 'user_id')->select('id');
    }

}
