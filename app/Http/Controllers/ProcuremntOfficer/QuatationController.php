<?php

namespace App\Http\Controllers\ProcuremntOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Quotation;
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
            $quatations = Quotation::when($request->item,function($query,$item){
                $query->where('name','LIKE','%'.$item.'%');
            })->paginate(10);
        }
        
        return Inertia::render('ProcurementOfficer/Quatations/Index', compact('quatations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        
        $quatation = Quotation::find($id);
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
        //
    }
}
