<?php

namespace App\Http\Controllers\ProcurementOfficer;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    //
    /**
     * Show the form for editing the specified resource.
     */
    public function approve(string $id)
    {
        //
        $requisition = Requisition::find($id);
        $requisition->approved = 1;
        // dd($requisition);
        $requisition->save();
        return redirect()->back();
    }
}
