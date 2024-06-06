<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'requisition_id',
        'title',
        'content',
        'approved',
        // Add other relevant fields
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requisition(){
        return $this->belongsTo(Requisition::class);
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }
}
