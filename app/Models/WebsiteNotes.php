<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteNotes extends Model
{
    use HasFactory;
    protected $table='website_notes';
    protected $primaryKey='id';
    protected $guarded = ['id'];
    protected $fillable = [];
}
