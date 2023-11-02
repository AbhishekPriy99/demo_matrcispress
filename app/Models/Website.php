<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected function url(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => rtrim($value,  '/'),
        );
    }

    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
