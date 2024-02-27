<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Candidate;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
   
    public function index()
    {
        $degrees = Degree::all();
        return view('degrees.index', compact('degrees'));
    }

   
    public function create()
    {
        return view('degrees.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'degreeTitle' => 'required|unique:degrees', 
        ]);

        Degree::create($request->all());

        return redirect()->route('degrees.index')->with('success', 'Degree added successfully!');
    }

    
    public function edit(Degree $degree)
    {
        return view('degrees.edit', compact('degree'));
    }

    
    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'degreeTitle' => 'required|unique:degrees,degreeTitle,' . $degree->id,
        ]);

        $degree->update($request->all());

        return redirect()->route('degrees.index')->with('success', 'Degree updated successfully!');
    }

    
     public function destroy(Degree $degree)
     {
        
         $inUse = Candidate::where('degree_id', $degree->id)->first();
 
         if ($inUse) {
            
             return back()->with('error', 'Το πτυχίο χρησιμοποιείται και εως εκ τούτου δεν μπορεί να διαγραφθεί');
         } else {
          
             $degree->delete();
             return redirect()->route('degrees.index')->with('success', 'Το πτυχίο διαγράφθηκε!' . $degree->id);
         }
     }
}