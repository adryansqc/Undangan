<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Undangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'pronoun', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($undangan) {
            $undangan->slug = Str::slug($undangan->nama);
        });
    }
}
