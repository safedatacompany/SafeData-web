<?php

namespace App\Models\System\Settings\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FontSize extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = ['size', 'created_user_id'];
    
}
