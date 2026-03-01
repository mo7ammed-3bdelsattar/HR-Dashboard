<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'company_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'transaction_id',
        'payment_date',
        'due_date',
        'invoice_number',
        'invoice_path',
        'notes',
        'received_by',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
