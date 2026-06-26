<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\Service;


class ServiceOrderController extends Controller
{
    // public function store(Request $request, Service $service)
    // {
    //     $request->validate([
    //         'customer_name' => 'required|string|max:255',
    //         'customer_phone' => 'required|string|max:20',
    //         'customer_address' => 'required|string|max:500',
    //     ]);

    //     ServiceOrder::create([
    //         'service_id' => $service->id,
    //         'customer_name' => $request->customer_name,
    //         'customer_phone' => $request->customer_phone,
    //         'customer_address' => $request->customer_address,
    //     ]);

    //     return redirect()->back()->with('success', 'Votre demande de service a été envoyée avec succès !');
    // }
    // Afficher le formulaire
    public function create(Service $service)
    {
        return view('services.request', compact('service'));
    }

    // Enregistrer la demande
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        ServiceOrder::create([
            'service_id' => $service->id,
            'customer_name' => $validated['name'],
            'customer_phone' => $validated['phone'],
            'customer_address' => $validated['address'],
            'status' => 'pending',
        ]);

        return redirect()->route('services.show', $service->id)->with('success', 'Votre demande a été envoyée avec succès !');
    }
}
