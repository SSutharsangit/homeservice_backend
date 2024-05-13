<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Provider;
use App\Models\User;
use App\Providers\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = DB::table('customers')
            ->select(
                'customers.id as id',
                'customers.user_id',
                'users.name as name',
                'users.email',
                'users.mobile',
                'users.img',
                'users.user_name',
                'users.role',
                'users.password'
            )
            ->leftJoin('users', 'users.id', '=', 'customers.user_id')->get();
        return response()->json($customers);
    }
    // Store a new customer
    public function store(Request $request)
    {
        // Create a new user
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
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->save();
        return response()->json(['message' => 'Customer created successfully.', 'customer' => $customer]);
    }


    public function show($id)
    {
        // $customer = Customer::find($id);
        // $customer->user;
        // return response()->json($customer);
        $customers = DB::table('customers')
            ->select(
                'customers.id as id',
                'customers.user_id',
                'users.name as name',
                'users.email',
                'users.mobile',
                'users.img',
                'users.user_name',
                'users.role',
                'users.password'
            )
            ->leftJoin('users', 'users.id', '=', 'customers.user_id')
            ->where('customers.id', $id)->first();
        return response()->json($customers);
    }

    // Update a customer
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer) {
            $user_id = $customer->user_id;
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
            $customer->save();
        }

        $customer = Customer::where('user_id', $user->id)->first();
        $customer->user();
        return response()->json($customer);
    }

    // Delete a customer
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $user = User::find($customer->user_id);
        $customer->delete();
        $user->delete();
        return response()->json('Customer deleted');
    }
}
