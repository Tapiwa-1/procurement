<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\TaxClearance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = User::role('Vendor/Supplier')->when($request->item,function($query,$item){
            $query->where('name','LIKE','%'.$item.'%');
        })->paginate(10);
        return Inertia::render('Admin/Suppliers/Index',compact('suppliers'));
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'phone' => 'required|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required', 'confirmed', Password::defaults()
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ])->assignRole('Vendor/Supplier');

        return to_route('admin.suppliers.index');
    }

    public function show($id){
        $supplier = User::find($id);
        $certificate = TaxClearance::where('user_id',$id)->get();
        return Inertia::render('Admin/Suppliers/Show',compact('supplier','certificate'));
    }
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
