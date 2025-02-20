<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_path', 'is_active'];
    public static function getActiveAudio()
    {
        return self::where('is_active', true)->first();
    }
}
