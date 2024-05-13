<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use App\Providers\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{

        public function index()
    {
        $providers = DB::table('providers')
        ->select('providers.id as id', 'providers.user_id', 'users.name as name',
         'users.email','users.mobile','users.img','users.user_name','users.role','users.password')
        ->leftJoin('users', 'users.id', '=', 'providers.user_id')->get();
      return response()->json($providers);
    }

    // Store a new customer
    public function store(Request $request)
    {
        $user = new User();
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->password = $request->password;
        $user->mobile = $request->mobile;
        $user->img = $request->img;
        $user->status = "Active";
        $user->save();

        $provider = new Provider();
        $provider->user_id = $user->id;
        $provider->save();

        return response()->json(['message' => 'provider created successfully.', 'provider' => $provider]);

    }

    // Get a customer by ID
    public function show($id)
    {
    //   $provider = Provider::findOrFail($id);
    //   $provider->user;
    //   return response()->json($provider);
      $provider = DB::table('providers')
      ->select('providers.id as id', 'providers.user_id', 'users.name as name',
       'users.email','users.mobile','users.img','users.user_name','users.role','users.password')
      ->leftJoin('users', 'users.id', '=', 'providers.user_id')
      ->where('providers.id',$id)  ->first();
      return response()->json($provider);
    }

    // Update a customer
    public function update(Request $request, $id)
    {
        $providers = Provider::findOrFail($id);
        if ($providers) {
            $user_id = $providers->user_id;
            $user = User::findOrFail($user_id);
            if ($user) {
                $user->user_name = $request->user_name;
                $user->email = $request->email;
                $user->name = $request->name;
                $user->role = $request->role;
                $user->password = $request->password;
                $user->mobile = $request->mobile;
                $user->img = $request->img;

                $user->save();
            }
            $providers->save();
        }

        $customer = Provider::where('user_id', $user->id)->first();
        $customer->user();
        return response()->json($customer);

    }

    // Delete a customer
    public function delete($id)
    {
      $provider = Provider::findOrFail($id);
      $user = User::find($provider->user_id);
      $provider->delete();
      $user->delete();
      return response()->json('provider deleted');
    }


}
