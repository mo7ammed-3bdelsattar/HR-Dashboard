<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uid',
        'name',
        'subdomain',
        'domain',
        'email',
        'phone1',
        'phone2',
        'address',
        'logo',
        'status',
        'trial_ends_at',
        'current_plan_id',
        'user_id',
        'timezone',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currentPlan()
    {
        return $this->belongsTo(Plan::class, 'current_plan_id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptionHistory()
    {
        return $this->hasMany(SubscriptionHistory::class);
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
