<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxClearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file',
        // Add other relevant fields
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
