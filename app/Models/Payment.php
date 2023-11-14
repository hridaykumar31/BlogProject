<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'token',
        'amount',
        'status',
    ];

    protected $primaryKey = 'id';

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
