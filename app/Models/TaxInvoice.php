<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'requisition_id',
       'quotation_id',
       'title',
       'invoice_number',
       'customer_name',
       'description',
       'quantity',
       'unit_price',
       'subtotal',
       'tax',
       'total_amount_due',
       'verification_assistant_approved',
       'verification_officer_approved',
       'group_accountant_approved',
       'fm_payments_teclar_approved',
       'general_manager_approved',
    ];

    //This belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //This belongs to one requisition
    public function requisition(){
        return $this->belongsTo(Requisition::class);
    }

    //this belongs to one quatation
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    //this belongs to one summary
    public function summary(){
        return $this->belongsTo(Summary::class);
    }

}
