<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subdomain',
        'domain',
        'email',
        'phone',
        'logo',
        'status',
        'trial_ends_at',
        'timezone',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->where('ends_at', '>', now())->latest();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptionHistory()
    {
        return $this->hasMany(SubscriptionHistory::class);
    }

    // Business Logic Methods
    public function isSubscriptionActive()
    {
        return $this->currentSubscription()->exists();
    }

    public function getEmployeeCount()
    {
        return $this->users()->where('role', '!=', 'super_admin')->count();
    }

    public function canAddEmployee()
    {
        $sub = $this->currentSubscription;
        if (!$sub) return false;

        $max = $sub->max_employees_override ?? $sub->plan->max_employees;
        if ($max === null) return true;

        return $this->getEmployeeCount() < $max;
    }
}
