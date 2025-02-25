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

    public function getUndanganMessage()
    {
        $namaLaki = Config::where('key', 'panggilan laki')->value('value') ?? 'Nama Laki-laki';
        $namaPerempuan = Config::where('key', 'panggilan perempuan')->value('value') ?? 'Nama Perempuan';

        return "Assalamu'alaikum Wr. Wb\n\n" .
            "Bismillahirahmanirrahim\n\n" .
            "Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara kami.\n\n" .
            "*{$namaPerempuan} & {$namaLaki}*\n\n" .
            "Berikut link undangan kami, untuk info lengkap dari acara bisa kunjungi :\n\n" .
            url('/undangan/' . $this->slug) . "\n\n" .
            "Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir memberikan doa & restu, serta kami ucapkan terima kasih.\n\n" .
            "Mohon maaf perihal undangan hanya dibagikan melalui pesan ini. Terima kasih banyak atas perhatiannya.\n\n" .
            "Wassalamu'alaikum Wr. Wb.";
    }
}
