<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceOrder;

class ServiceOrderController extends Controller
{
    // All orders
    public function index(Request $request)
    {
        $query = ServiceOrder::with('service'); // eager load relation

        if ($request->filled('date')) {
           $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('status') && in_array($request->status, ['pending', 'validated'])) {
           $query->where('status', $request->status);
        }

        $services = $query->get();

        return view('dashboard.service_orders.index', compact('services'));
    }

    // Pending orders
    public function pending()
    {
        $services = ServiceOrder::with('service')->where('status', 'pending')->get();
        return view('dashboard.service_orders.pending', compact('services'));
    }

    // Validated orders
    public function validated()
    {
        $services = ServiceOrder::with('service')->where('status', 'validated')->get();
        return view('dashboard.service_orders.validated', compact('services'));
    }

    public function validateOrder(ServiceOrder $serviceOr) {
        $serviceOr->status = 'validated';
        $serviceOr->save();
        return redirect()->back()->with('success','Commande service validée!');
    }

    public function destroy(ServiceOrder $serviceOr) {
        $serviceOr->delete();
        return redirect()->back()->with('success','Commande service supprimée!');
    }
}
