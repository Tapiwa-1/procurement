<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'requester_id',
        'delivery_date',
        'vendor_id',
        'items', // This can be a JSON string or separate model relation
        'total_estimated_cost',
        'justification',
        'additional_information',
        'approval_status', // Can be "pending", "approved", "rejected"
    ];

    // Define relationships with other models (optional)

    // public function department()
    // {
    //     return $this->belongsTo(Department::class);
    // }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id'); // Assuming requester is a user
    }

    // ... other relationships
}
