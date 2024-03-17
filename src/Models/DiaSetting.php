<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiaSetting extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'dia_settings';

    protected $fillable = ['id', 'session_id', 'created_at', 'updated_at', 'deleted_at'];

}
