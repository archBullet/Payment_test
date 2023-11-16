<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'merchant_id',
        'user_id',
        'payment_id',
        'status',
        'amount',
        'amount_paid'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
