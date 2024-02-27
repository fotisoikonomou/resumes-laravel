<?php
namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    
    public function index(Request $request)
    {
        $jobAppliedFor = $request->input('jobAppliedFor');
        if ($jobAppliedFor) {
            $candidates = Candidate::where('jobAppliedFor', $jobAppliedFor)->get();
        } else {
            $candidates = Candidate::all();
        }

        return view('candidates.index', compact('candidates'));
    }

   
    public function create()
    {
        $degrees = Degree::all(); 
        return view('candidates.create', compact('degrees'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'degree_id' => 'required|exists:degrees,id',
            'resume' => 'required|file|mimes:pdf',
            'jobAppliedFor' => 'required',
        ]);

        $data = $request->all();
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
           // $data['resume'] = $request->file('resume')->store('resumes');
            $customFileName = $request->lastName . '_' . $request->firstName . '_' . time() . '.' . $file->getClientOriginalExtension();
            // Store the file with the custom name
            $data['resume'] = $file->storeAs('resumes', $customFileName);
        }
        $data['applicationDate'] = now();

        Candidate::create($data);

        return redirect()->route('candidates.index')->with('success', 'Επιτυχης προσθηκη υποψηφιου!');
    }

   
    public function edit(Candidate $candidate)
    {
        $degrees = Degree::all();
        return view('candidates.edit', compact('candidate', 'degrees'));
    }

    // Update a candidate's information
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'degree_id' => 'required|exists:degrees,id',
            'jobAppliedFor' => 'required',
        ]);

        $data = $request->except(['resume']);
        if ($request->hasFile('resume')) {
         
            if ($candidate->resume) {
                Storage::delete($candidate->resume);
            }
            $data['resume'] = $request->file('resume')->store('resumes');
        }

        $candidate->update($data);

        return redirect()->route('candidates.index')->with('success', ' updated !');
    }

   
    public function destroy(Candidate $candidate)
    {
        if ($candidate->resume) {
            Storage::delete($candidate->resume);
        }
        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'deleted !');
    }
}