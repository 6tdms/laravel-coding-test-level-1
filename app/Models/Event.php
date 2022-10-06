<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = ['name', 'slug'];

    protected $keyType = 'string';

    public $incrementing = false;
}
