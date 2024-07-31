<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
