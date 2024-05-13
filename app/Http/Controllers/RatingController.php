<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = DB::table('ratings')
            ->select(
                'ratings.id as id',
                'ratings.rating',
                'ratings.feedback',
                'serve_pro.provider_id',
                'serve_pro.service_id',
                'serve_pro.amount_per_hour',
                'services.name as service_name',
                'services.description as service_description',
                'users.name as provider_name',
                'service_types.name as service_type_name'
            )
            ->leftJoin('provider_services as serve_pro', 'serve_pro.id', '=', 'ratings.service_provider_id')
            ->leftJoin('providers', 'providers.id', '=', 'serve_pro.provider_id')
            ->leftJoin('users', 'users.id', '=', 'providers.user_id')
            ->leftJoin('services', 'services.id', '=', 'serve_pro.service_id')
            ->leftJoin('service_types', 'service_types.id', '=', 'services.service_type_id')
            ->get();
        return response()->json($ratings);
    }

    // Store a new customer
    public function store(Request $request)
    {
        $rating = Rating::create($request->all());
        return response()->json($rating);
    }

    // Get a customer by ID
    public function show($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->gig->service;
        $rating->gig->provider->user;
        return response()->json($rating);
    }

    // Update a customer
    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->update($request->all());
        return response()->json($rating);
    }

    // Delete a customer
    public function delete($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return response()->json('Customer deleted');
    }
}
