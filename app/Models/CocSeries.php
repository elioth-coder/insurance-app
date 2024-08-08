<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CocSeries extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];


    public function series_numbers(): HasMany
    {
        return $this->hasMany(CocSeriesNumber::class, 'series_id');
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
