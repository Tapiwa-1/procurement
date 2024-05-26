<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $requisitions = Requisition::when($request->item,function($query,$item){
            $query->where('name','LIKE','%'.$item.'%');
        })->paginate(10);
        return Inertia::render('Receptionist/Requisitions/Index', compact('requisitions'));
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|integer|min:0',
            'delivery_date' => 'required|string|max:255',
            
            
            // Add validation rules for other fields
        ]);

        Requisition::create([
            'title' => $request->title,
            'description' => $request->description,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'delivery_date' => $request->delivery_date,
            'user_id' => Auth::user()->id,  
        ]);

        return to_route('receptionist.requisition.index');

      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $requisition = Requisition::find($id);
        return Inertia::render('Receptionist/Requisitions/Show', compact('requisition'));
    }

    

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Requisition::find($id)->delete();

        return to_route('receptionist.requisition.index');
    }
}
