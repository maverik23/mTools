<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Soporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_id',
        'user_id',
        'name',
        'path',
        'file'
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            if (Storage::exists($model->path)) {
                Storage::delete($model->path);
            }
        });
    }

    public function poliza()
    {
        return $this->hasOne(Poliza::class, 'id', 'poliza_id');
    }
}
