<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use Illuminate\Http\Request;



class OffreController extends Controller
{
     public function index() {
        $offres = Offre::all();
        return view('dashboard.offres.index', compact('offres'));
    }

    public function edit(Offre $offre){
        return view('dashboard.offres.edit', compact('offre'));
    }

    public function update(Request $request, Offre $offre){
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string|unique:categories,slug,',
            'image'=>'nullable|image'
        ]);

        $offre->title = $request->title;
        $offre->description = $request->description;
        

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $offre->image = $imageName;
        }

        $offre->save();
        return redirect()->route('dashboard.offres.index')->with('success','Offre modifiée');
    }
}
