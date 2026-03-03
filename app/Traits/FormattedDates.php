<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

trait FormattedDates
{
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d.m.Y') : null,
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d.m.Y') : null,
        );
    }

    protected function completedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d.m.Y') : null,
        );
    }
}
