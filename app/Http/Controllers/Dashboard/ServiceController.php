<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
     // Display all services
    public function index()
    {
        $services = Service::all();
        return view('dashboard.services.index', compact('services'));
    }

    // Show form to create a service
    public function create()
    {
        return view('dashboard.services.create');
    }

    // Store new service
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'details' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->details = $request->details;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        $service->save();

        return redirect()->route('dashboard.services.index')->with('success', 'Service created!');
    }

    // Show form to edit a service
    public function edit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    // Update service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'details' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        $service->name = $request->name;
        $service->description = $request->description;
        $service->details = $request->details;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        $service->save();

        return redirect()->route('dashboard.services.index')->with('success', 'Service updated!');
    }

    // Delete service
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('dashboard.services.index')->with('success', 'Service deleted!');
    }
}
