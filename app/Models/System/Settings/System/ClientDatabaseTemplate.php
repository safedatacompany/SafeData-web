<?php

namespace App\Models\System\Settings\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientDatabaseTemplate extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    
    use HasFactory;
}
