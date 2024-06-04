<?php

namespace App\Http\Controllers\ProcurementOfficer;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use App\Models\Summary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $summaries = Summary::when($request->item,function($query,$item){
            $query->where('name','LIKE','%'.$item.'%');
        })->paginate(10);

        $requisitions = Requisition::where('approved',1)->get();
        
        return Inertia::render('ProcurementOfficer/Summary/Index', compact('summaries','requisitions'));
    }

    public function approve(string $id)
    {
        //
        $summary = Summary::find($id);
        $summary->approved = 1;
        // dd($requisition);
        $summary->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'requisition_id'=>'required',
            
            // Add validation rules for other fields
        ]);

        // dd( $request->requisition_id);
        Summary::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,  
            'requisition_id' => $request->requisition_id[0],
        ]);

        return to_route('procurement-officer.summaries.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $summary = Summary::with('requisition')->find($id);
        return Inertia::render('ProcurementOfficer/Summary/Show', compact('summary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Summary::find($id)->delete();
        return back();
    }
}
