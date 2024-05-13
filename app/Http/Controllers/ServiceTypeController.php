<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index()
    {
      $serviceType = ServiceType::all();
      return response()->json($serviceType);
    }
    // Store a new customer
    public function store(Request $request)
    {
      $Service = ServiceType::create($request->all());
      return response()->json($Service);
    }

    // Get a customer by ID
    public function show($id)
    {
      $Service = ServiceType::findOrFail($id);
      return response()->json($Service);
    }

    // Update a customer
    public function update(Request $request, $id)
    {
      $Service = ServiceType::findOrFail($id);
      $Service->update($request->all());
      return response()->json($Service);
    }

    // Delete a customer
    public function delete($id)
    {
      $Service = ServiceType::findOrFail($id);
      if(!$Service){
        return response()->json('Customer not found');
      }
      if($Service){
        $Service->delete();
        return response()->json('Customer deleted');
      }

    }
}
