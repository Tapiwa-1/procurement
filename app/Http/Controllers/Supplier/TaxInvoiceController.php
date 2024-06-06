<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\TaxInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaxInvoiceController extends Controller
{
    //
    public function index(Request $request){

        $taxInvoices = TaxInvoice::all();

        return Inertia::render('Supplier/Invoice/Index', compact('taxInvoices'));
        
    }

    public function verificationAssistantApproved(string $id)
    {
        //
        $taxInvoice = TaxInvoice::find($id);
        $taxInvoice->verification_assistant_approved = 1;
        $taxInvoice->save();
        return redirect()->back();
    }

    public function verificationOfficerApproved(string $id)
    {
        //
        $taxInvoice = TaxInvoice::find($id);
        $taxInvoice->verification_officer_approved = 1;
        $taxInvoice->save();
        return redirect()->back();
    }

    public function groupAccountantApproved(string $id)
    {
        //
        $taxInvoice = TaxInvoice::find($id);
        $taxInvoice->group_accountant_approved = 1;
        $taxInvoice->save();
        return redirect()->back();
    }
    
    public function fmPaymentsTeclarApproved(string $id)
    {
        //
        $taxInvoice = TaxInvoice::find($id);
        $taxInvoice->fm_payments_teclar_approved = 1;
        $taxInvoice->save();
        return redirect()->back();
    }


    public function generalManagerApproved(string $id)
    {
        //
        $taxInvoice = TaxInvoice::find($id);
        $taxInvoice->general_manager_approved = 1;
        $taxInvoice->save();
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
            'unit_price' => 'required',
            'quantity' => 'required',
            
            
            // Add validation rules for other fields
        ]);
        
        TaxInvoice::create([
            'requisition_id' => $request->requisition_id,
            'invoice_number'=>strtoupper('INVOICE 2024 ' . substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6/strlen($x)) )),1,6)),
            'customer_name' => 'Metbank Zimbabwe',
            'quotation_id'=> $request->quotation_id,
            'title' => $request->title,
            'description' => $request->description,
            'unit_price'=> $request->unit_price,
            'quantity' => $request->quantity,
            'subtotal' =>$request->unit_price *  $request->quantity,
            'tax'=> 0.02,
            'total_amount_due'=> $request->unit_price *  $request->quantity * 0.02 + $request->unit_price *  $request->quantity,
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
      
        $taxInvoice = TaxInvoice::with(['user','requisition','quotation'])->find($id);
        return Inertia::render('Supplier/Invoice/Show',compact('taxInvoice'));
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
        // Quotation::find($id)->delete();
        // return to_route('supplier.quatations.index');
    }
}
