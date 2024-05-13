<?php

namespace App\Http\Controllers;

use App\Models\ProviderService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $data = DB::table('services')
        ->select('services.id','services.name','services.img', 'services.description', 'service_type_id', 'service_types.name as service_type_name')
        ->leftJoin('service_types as service_types', 'service_types.id', '=', 'services.service_type_id')->get();
        return response()->json($data);
    }
    // Store a new Service
    public function store(Request $request)
    {
        $Service = Service::create($request->all());
        return response()->json($Service);
    }

    // Get a Service by ID
    public function getAllByService($id)
    {
        $Service = Service::findOrFail($id);

        if($Service){

            $providerService = DB::table('provider_services as serve_pro')
            ->select(
                'serve_pro.provider_id',
                'serve_pro.service_id',
                'serve_pro.amount_per_hour',
                'services.name as service_name',
                'services.description as service_description',
                'users.name as provider_name',
                'service_types.name as service_type_name',
                'ratings.rating',
                'ratings.feedback'
            )
            ->leftJoin('providers', 'providers.id', '=', 'serve_pro.provider_id')
            ->leftJoin('ratings', 'ratings.service_provider_id', '=', 'serve_pro.id')
            ->leftJoin('users', 'users.id', '=', 'providers.user_id')
            ->leftJoin('services', 'services.id', '=', 'serve_pro.service_id')
            ->leftJoin('service_types', 'service_types.id', '=', 'services.service_type_id')
           -> where('service_id', $id)->get();
            return response()->json($providerService);
        }



    }




    public function show($id)
    {
        $Service = Service::findOrFail($id);
        $Service->serviceType;
        return response()->json($Service);
    }
    // Update a Service
    public function update(Request $request, $id)
    {
        $Service = Service::findOrFail($id);
        $Service->update($request->all());
        return response()->json($Service);
    }

    // Delete a Service
    public function delete($id)
    {
        $Service = Service::findOrFail($id);
        $Service->delete();
        return response()->json('Service deleted');
    }
}
