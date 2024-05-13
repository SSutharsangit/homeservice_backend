<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

//use App\Http\Controllers\Auth; // Is this needed?
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;

class AuthControllerController extends Controller
{
    //use SendsPasswordResetEmails;
    public function getAll(Request $request)
    {
        $user = DB::table('customers')
        ->select('users.id as id','users.name as name',
         'users.email','users.mobile','users.img','users.user_name','users.role','users.status','users.password')
        ->leftJoin('users', 'users.id', '=', 'customers.user_id')->get();
        return response()->json($user);
    }
    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json('User not found');
        }
        if ($user) {
            $user->status="Inactive";
            $user->save();
            return response()->json('User deleted');
        }
    }

    public function update(Request $request, $id)
    {   $user = User::findOrFail($id);
        if (!$user) {
            return response()->json('User not found');
        }
        if ($user) {
              $user->status="Active";
            $user->save();
            return response()->json('User deleted');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('user_name', 'password', 'role');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userID = $user->id;
            $userID = $user->role;
            if ($userID = "Customer") {
                $customer = DB::table('customers')
                    ->select('customers.id', 'customers.user_id')
                    ->leftJoin('users', 'users.id', '=', 'customers.user_id')
                    ->where('customers.user_id', $userID)->first();
                    return response()->json(['success! user' => $user,'customer' => $customer], 200);
            }
            if ($userID = "Provider") {
                $provider = DB::table('providers')
                    ->select('providers.id', 'providers.user_id')
                    ->leftJoin('users', 'users.id', '=', 'providers.user_id')
                    ->where('providers.user_id', $userID)->first();
                return response()->json(['success! user' => $user,'provider' =>  $provider], 200);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $this->validateEmail($request);

    //     $response = $this->broker()->sendResetLink(
    //         $request->only('email')
    //     );

    //     return $response == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
    //         ? response()->json(['message' => 'Password reset link sent to your email'], 200)
    //         : response()->json(['error' => 'Unable to send password reset link'], 500);
    // }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
}
