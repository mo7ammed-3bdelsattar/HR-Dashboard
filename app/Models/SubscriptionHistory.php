<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    use HasFactory;

    protected $table = 'subscription_history';

    protected $fillable = [
        'company_id',
        'subscription_id',
        'old_plan_id',
        'new_plan_id',
        'action',
        'changed_by',
        'reason',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function oldPlan()
    {
        return $this->belongsTo(Plan::class, 'old_plan_id');
    }

    public function newPlan()
    {
        return $this->belongsTo(Plan::class, 'new_plan_id');
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
