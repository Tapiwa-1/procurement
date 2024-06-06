<?php

use App\Http\Controllers\Admin\OverviewController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ProcurementOfficer\ApprovalController;
use App\Http\Controllers\ProcurementOfficer\SummaryController;
use App\Http\Controllers\ProcuremntOfficer\MarketController;
use App\Http\Controllers\ProcuremntOfficer\QuatationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Receptionist\RequisitionController;
use App\Http\Controllers\Supplier\StockContoller;
use App\Http\Controllers\Supplier\TaxClearanceController;
use App\Http\Controllers\Supplier\TaxInvoiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



//admin
Route::middleware([ 'auth','role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/overview', [OverviewController::class,'index'])->middleware('auth')->name('overview');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permission');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.role');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/roles', [UsersController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UsersController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UsersController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UsersController::class, 'revokePermission'])->name('users.permissions.revoke');
    Route::resource('/suppliers', SupplierController::class);
    
});


//supplier
Route::middleware([ 'auth','role:Vendor/Supplier'])->name('supplier.')->prefix('supplier')->group(function () {
    Route::resource('/stocks',StockContoller::class);
    Route::post('/tax-certificate',[TaxClearanceController::class,'store'])->name('taxClearance.store');
    Route::delete('/tax-certificate-delete/{id}',[TaxClearanceController::class,'destroy'])->name('taxClearance.destory');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/tax-invoice',TaxInvoiceController::class);
});


//Receptionist
Route::middleware([ 'auth','role:Receptionist'])->name('receptionist.')->prefix('receptionist')->group(function () {
    Route::resource('/requisition',RequisitionController::class);
});


//Procurement Officer
Route::middleware(['auth', 'role:Procurement Officer'])->name('procurement-officer.')->prefix('procurement-officer')->group(function () {
    
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/requisition/{id}/approve',[ApprovalController::class,'approve'])->name('requisition.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class);
    

});

//Assistant Group Accountant
Route::middleware(['auth', 'role:Assistant Group Accountant'])->name('assistant-group-accountant.')->prefix('assistant-group-accountant')->group(function () {
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/summary/{id}/approve',[SummaryController::class,'approve'])->name('summary.approve');
    Route::patch('/quotation/{id}/approve',[QuatationController::class,'approve'])->name('quotation.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class);
});


//Verification Assistant
Route::middleware(['auth', 'role:Verification Assistant'])->name('verification-assistant.')->prefix('verification-assistant')->group(function () {
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/summary/{id}/approve',[SummaryController::class,'approve'])->name('summary.approve');
    Route::patch('/quotation/{id}/approve',[QuatationController::class,'approve'])->name('quotation.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class); 
    Route::resource('/tax-invoice',TaxInvoiceController::class);
    Route::patch('/tax-invoice/{id}/approve',[TaxInvoiceController::class,'verificationAssistantApproved'])->name('taxinvoice.approve');
});

//Verification Officer
Route::middleware(['auth', 'role:Verification Officer'])->name('verification-officer.')->prefix('verification-officer')->group(function () {
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/summary/{id}/approve',[SummaryController::class,'approve'])->name('summary.approve');
    Route::patch('/quotation/{id}/approve',[QuatationController::class,'approve'])->name('quotation.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class); 
    Route::resource('/tax-invoice',TaxInvoiceController::class);
    Route::patch('/tax-invoice/{id}/approve',[TaxInvoiceController::class,'verificationOfficerApproved'])->name('taxinvoice.approve');
});

//Group Accountant
Route::middleware(['auth', 'role:Group Accountant'])->name('group-accountant.')->prefix('group-accountant')->group(function () {
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/summary/{id}/approve',[SummaryController::class,'approve'])->name('summary.approve');
    Route::patch('/quotation/{id}/approve',[QuatationController::class,'approve'])->name('quotation.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class); 
    Route::resource('/tax-invoice',TaxInvoiceController::class);
    Route::patch('/tax-invoice/{id}/approve',[TaxInvoiceController::class,'groupAccountantApproved'])->name('taxinvoice.approve');
});

//Fm Payments teclar
Route::middleware(['auth', 'role:Fm Payments teclar'])->name('fm-payments-teclar.')->prefix('fm-payments-teclar')->group(function () {
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/summary/{id}/approve',[SummaryController::class,'approve'])->name('summary.approve');
    Route::patch('/quotation/{id}/approve',[QuatationController::class,'approve'])->name('quotation.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class); 
    Route::resource('/tax-invoice',TaxInvoiceController::class);
    Route::patch('/tax-invoice/{id}/approve',[TaxInvoiceController::class,'fmPaymentsTeclarApproved'])->name('taxinvoice.approve');
});

// general Manager
Route::middleware(['auth', 'role:General Manager'])->name('general-manager.')->prefix('general-manager')->group(function () {
    Route::get('/market',[MarketController::class,'index'])->name('market.index');
    Route::get('/supplier/{id}', [SupplierController::class,'show'])->name('suppliers.show');
    Route::get('/requisition',[RequisitionController::class,'index'])->name('requisition.index');
    Route::get('/requisition/{id}',[RequisitionController::class,'show'])->name('requisition.show');
    Route::patch('/summary/{id}/approve',[SummaryController::class,'approve'])->name('summary.approve');
    Route::patch('/quotation/{id}/approve',[QuatationController::class,'approve'])->name('quotation.approve');
    Route::resource('/quatations',QuatationController::class);
    Route::resource('/summaries',SummaryController::class); 
    Route::resource('/tax-invoice',TaxInvoiceController::class);
    Route::patch('/tax-invoice/{id}/approve',[TaxInvoiceController::class,'generalManagerApproved'])->name('taxinvoice.approve');
});

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
