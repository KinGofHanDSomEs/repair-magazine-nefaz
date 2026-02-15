<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'technic_id',
        'status',
        'price',
        'payment_status',
        'failed_message',
        'completed_at'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function technic(): BelongsTo {
        return $this->belongsTo(Technic::class);
    }
}
