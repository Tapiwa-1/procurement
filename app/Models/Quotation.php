<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'unit_price',
        'quantity',
        'requisition_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
    public function summary(){
        return $this->belongsTo(Summary::class);
    }
    public function taxInvoice(){
        return $this->hasMany(TaxInvoice::class);
    }
   
}
