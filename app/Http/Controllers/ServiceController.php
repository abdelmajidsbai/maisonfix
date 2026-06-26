<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
   public function index(){
        $services=Service::all();
        return view('services',compact('services'));
    }
    public function show($id)
{
    $service = Service::findOrFail($id);

    
    $relatedServices = Service::where('id', '!=', $service->id)
    ->inRandomOrder() 
    ->take(4)
    ->get();

    return view('services.show', compact('service', 'relatedServices'));
}
}
