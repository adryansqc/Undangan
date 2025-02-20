<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeritaKami extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'tanggal', 'cerita', 'foto'];
}
