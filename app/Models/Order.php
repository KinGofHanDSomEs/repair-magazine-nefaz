<?php

namespace App\Models;

use App\Traits\FormattedDates;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\HigherOrderCollectionProxy;


/**
 *@mixin Builder
 */
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory, Notifiable, SoftDeletes, FormattedDates;

    /**
     * @var HigherOrderCollectionProxy|mixed
     */

    protected $fillable = [
        'user_id',
        'type_id',
        'count',
        'status',
        'price',
        'payment_status',
        'failed_message',
        'created_at',
        'completed_at',
        'updated_at',
        'completed_at'
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class);
    }
    public function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
}
