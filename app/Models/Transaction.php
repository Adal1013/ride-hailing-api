<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount_in_cents',
        'currency',
        'installments',
        'reference',
        'payment_source_id',
        'trip_id',
    ];

    /**
     * @return belongsTo
     */
    public function paymentSource(): belongsTo
    {
        return $this->belongsTo(PaymentSource::class);
    }

    /**
     * @return BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}
