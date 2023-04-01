<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentSource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_four_digits',
        'payment_method_type',
        'rider_id',
        'third_party_payment_source_id',
        'status',
        'token'
    ];

    /**
     * @return BelongsTo
     */
    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }
}
