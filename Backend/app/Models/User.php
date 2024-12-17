<?php

namespace App\Models;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'otp',
        'role'
    ];
    protected $hidden = [
        'otp',
    ];

    /*
     * Relationship To Other Models
     */

    // Relationship To Subscription
    public function userSubscriptions():HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

}
