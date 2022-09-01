<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Poliza extends Model
{
    use HasFactory;

    protected $fillable = [
        'n_poliza',
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
            foreach ($model->soportes as $soporte) {
                $soporte->delete();
            }
        });
    }

    public function soportes()
    {
        return $this->hasMany(Soporte::class, 'poliza_id', 'id');
    }
}
