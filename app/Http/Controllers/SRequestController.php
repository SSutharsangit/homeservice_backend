<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\SRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SRequestController extends Controller
{
    public function index()
    {
        $sRequests = DB::table('s_requests')
            ->select(
                's_requests.id as id',
                's_requests.customer_id',
                'cus_user.name as customer_name',

                's_requests.service_provider_id',
                'serve_pro.provider_id',
                'pro_user.name as provider_name',
                'serve_pro.amount_per_hour',
                'serve_pro.service_id',
                'services.name as service_name',
                'service_types.name as service_type_name',
                'services.description as service_description',
                's_requests.from_date_time',
                's_requests.to_date_time',
                's_requests.amount',
                's_requests.location',
                's_requests.status',

            )
            ->leftJoin('provider_services as serve_pro', 'serve_pro.id', '=', 's_requests.service_provider_id')
            ->leftJoin('providers', 'providers.id', '=', 'serve_pro.provider_id')
            ->leftJoin('customers', 'customers.id', '=', 's_requests.customer_id')
            ->leftJoin('users as pro_user', 'pro_user.id', '=', 'providers.user_id')
            ->leftJoin('users as cus_user', 'cus_user.id', '=', 'customers.user_id')
            ->leftJoin('services', 'services.id', '=', 'serve_pro.service_id')
            ->leftJoin('service_types', 'service_types.id', '=', 'services.service_type_id')
            ->get();
        return response()->json($sRequests);
    }

    // Store a new customer
    public function store(Request $request)
    {

        $customer = Customer::find($request->customer_id); // Assuming Customer is your model for the customers table
if (!$customer) {
    // Customer does not exist, handle accordingly
    return "no";
}
      // return $request;
        $requestData = $request->all();
        // $requestData['customer_id'] = 1;
        // $requestData['customer_id'] = 1;
        $sRequest = SRequest::create($requestData);
        return
         response()->json($sRequest);
    }

    // Get a customer by ID
    public function show($id)
    {
        $sRequest = SRequest::findOrFail($id);
        $sRequest->gig->service;
        $sRequest->customer->user;
        $sRequest->gig->provider->user;
        return response()->json($sRequest);
    }

    // Update a customer
    public function update(Request $request, $id)
    {
        $sRequest = SRequest::findOrFail($id);
        $sRequest->update($request->all());
        return response()->json($sRequest);
    }

    // Delete a customer
    public function delete($id)
    {
        $sRequest = SRequest::findOrFail($id);
        $sRequest->delete();
        return response()->json('Customer deleted');
    }
}
