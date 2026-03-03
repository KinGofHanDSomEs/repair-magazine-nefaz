<?php

namespace App\Models;

use Database\Factories\TypeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


/**
 * @mixin Builder
 */
class Type extends Model
{
    /** @use HasFactory<TypeFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'model'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function technic(): BelongsTo {
        return $this->belongsTo(Technic::class);
    }
}
