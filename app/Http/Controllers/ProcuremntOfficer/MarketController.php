<?php

namespace App\Http\Controllers\ProcuremntOfficer;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierStock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MarketController extends Controller
{
    //
    public function index(Request $request){
        $stocks = SupplierStock::when($request->item,function($query,$item){
            $query->where('product_name','LIKE','%'.$item.'%');
        })->paginate(10);
        $role = (Auth::user()->roles->pluck('name'));
        $suppliers = User::all();
        return Inertia::render('Supplier/Stock/Index', compact('stocks','role','suppliers'));
    }
}
