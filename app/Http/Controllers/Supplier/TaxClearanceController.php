<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\TaxClearance;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxClearanceController extends Controller
{
    //
    public function store(Request $request){
        
        $certificate = new  \App\Models\TaxClearance;

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);

        $certificate = (new FileService)->updateFile($certificate, $request, 'TaxClearance');

        $certificate->user_id = Auth::user()->id;
        $certificate->save();

        return back();
    }

    public function destroy($id){
        $tax = TaxClearance::find($id);

        if($tax->user_id != Auth::user()->id){
            return back()->with('message', 'Delete operation failed');
        }

        if (!empty($tax->file)) {
            $currentFile = public_path() . $tax->file;

            if (file_exists($currentFile)) {
                unlink($currentFile);
            }
        }

        $tax->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
