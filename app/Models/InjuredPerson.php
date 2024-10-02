<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InjuredPerson extends Model
{
    use HasFactory;
    protected $table = 'injured_persons';
    protected $guarded = ['id','created_at','updated_at'];
}
