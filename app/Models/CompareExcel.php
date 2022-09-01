<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompareExcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_import',
        'name',
        'path',
        'file'
    ];
}
