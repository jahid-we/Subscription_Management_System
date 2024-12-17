<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSubscription extends Model
{
    protected $fillable = [
        'name',
        'type',
        'fee',
        'due_date',
        'user_id',
        'status',
        'payment_date',
    ];

     /*
     * Relationship To Other Models
     */

    // Relationship To User
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
