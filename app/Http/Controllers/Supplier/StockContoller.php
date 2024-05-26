<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\SupplierStock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StockContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $stocks = SupplierStock::when($request->item,function($query,$item){
        //     $query->where('name','LIKE','%'.$item.'%');
        // })->paginate(10)->stocks();

        $stocks = User::find(Auth::user()->id)->stocks()->paginate(10);
    

        return Inertia::render('Supplier/Stock/Index', compact('stocks'));
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
            
            'product_name' => 'required',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            
            // Add validation rules for other fields
        ]);
        // Create a new stock record

        // dd(Auth::user()->id);
        SupplierStock::create([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'user_id' => Auth::user()->id,  
        ]);

        return to_route('supplier.stocks.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy($id)
    {
        SupplierStock::find($id)->delete();
        return to_route('supplier.stocks.index');
    }
}
