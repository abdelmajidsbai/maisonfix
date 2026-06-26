<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Offre;

class AccueilController extends Controller
{
    public function index(){
        $categories=Category::all();
        $products=Product::take(8)->get();
        $services=Service::take(2)->get();
        $offres=Offre::take(4)->get();


        return view ('accueil', compact('categories','products','services','offres'));
    }

    public function dashboard(){
        $categories=Category::all();
        $products=Product::take(8)->get();
        $services=Service::take(2)->get();
        $offres=Offre::take(4)->get();


        return view ('dashboard.dashboard', compact('categories','products','services','offres'));
    }
}
