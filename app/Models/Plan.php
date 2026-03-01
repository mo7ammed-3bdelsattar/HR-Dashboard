<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_monthly',
        'price_yearly',
        'currency',
        'max_employees',
        'duration_days',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    public function features()
    {
        return $this->hasMany(PlanFeature::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function hasFeature($key)
    {
        return $this->features()->where('feature_key', $key)->exists();
    }

    public function getFeatureValue($key)
    {
        return $this->features()->where('feature_key', $key)->value('feature_value');
    }
}
