<?php

namespace App\Http\Controllers\ProcuremntOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Quotation;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class QuatationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasRole('Vendor/Supplier')){
            $quatations = Quotation::where('user_id', Auth::user()->id)->when($request->item,function($query,$item){
                $query->where('name','LIKE','%'.$item.'%');
            })->paginate(10);
        }
        
        if(Auth::user()->hasRole('Procurement Officer')){
            $quatations = Quotation::with('user')->when($request->item,function($query,$item){
                $query->where('name','LIKE','%'.$item.'%');
            })->paginate(10);

        }

        if(Auth::user()->hasRole('Assistant Group Accountant')){
            $quatations = Quotation::with('user')->when($request->item,function($query,$item){
                $query->where('name','LIKE','%'.$item.'%');
            })->paginate(10);

        }


        // $suppliers = User::find($quatation->user_id);
       
        return Inertia::render('ProcurementOfficer/Quatations/Index', compact('quatations'));
    }

    public function approve(string $id)
    {
        //
        $quatation = Quotation::find($id);
        $quatation->approved = 1;
        // dd($requisition);
        $quatation->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            
            
            // Add validation rules for other fields
        ]);

        // dd( $request->requisition_id);
        Quotation::create([
            'requisition_id' => $request->requisition_id,
            'title' => $request->title,
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,  
        ]);

        return to_route('supplier.quatations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        // Retrieve the quotation
        $quatation = Quotation::find($id);

        // Check if the quotation is found
        if ($quatation) {
            // Retrieve the associated requisition
            $requisition = Requisition::find($quatation->requisition_id);

            // If the associated requisition is found
            if ($requisition) {
                // Merge the requisition data into the quotation variable
                $quatation->requisition = $requisition;
            }
}

        // dd($quatation);
        return Inertia::render('ProcurementOfficer/Quatations/Show', compact('quatation'));
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
        Quotation::find($id)->delete();
        return to_route('supplier.quatations.index');
    }
}
