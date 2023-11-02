<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function websites(): HasMany
    {
        return $this->hasMany(Website::class);
    }
}
