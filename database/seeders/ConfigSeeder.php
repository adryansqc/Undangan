<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'laki',
                'value' => 'Jhon Doe',
                'type' => 'text',
            ],
            [
                'key' => 'perempuan',
                'value' => 'Scarlet',
                'type' => 'text',
            ],
            [
                'key' => 'panggilan laki',
                'value' => 'Jhon Doe',
                'type' => 'text',
            ],
            [
                'key' => 'panggilan perempuan',
                'value' => 'Scarlet',
                'type' => 'text',
            ],
            [
                'key' => 'tanggal acara',
                'value' => '2025-02-20',
                'type' => 'date',
            ],
            [
                'key' => 'kota',
                'value' => 'Jambi',
                'type' => 'text',
            ],
            [
                'key' => 'provinsi',
                'value' => 'Jambi',
                'type' => 'text',
            ],
            [
                'key' => 'alamat',
                'value' => 'Jl. Iswahyudi no.20',
                'type' => 'text',
            ],
            [
                'key' => 'foto laki',
                'value' => null,
                'type' => 'file',
            ],
            [
                'key' => 'foto perempuan',
                'value' => null,
                'type' => 'file',
            ],
            [
                'key' => 'keterangan laki',
                'value' => 'Keterangan Laki Laki',
                'type' => 'text',
            ],
            [
                'key' => 'keterangan perempuan',
                'value' => 'Keterangan perempuan',
                'type' => 'text',
            ],
            [
                'key' => 'nama bapak laki',
                'value' => 'Keterangan perempuan',
                'type' => 'text',
            ],
            [
                'key' => 'nama ibu laki',
                'value' => 'Keterangan perempuan',
                'type' => 'text',
            ],
            [
                'key' => 'nama bapak perempuan',
                'value' => 'Keterangan perempuan',
                'type' => 'text',
            ],
            [
                'key' => 'nama ibu perempuan',
                'value' => 'Keterangan perempuan',
                'type' => 'text',
            ],
            [
                'key' => 'jam akad',
                'value' => '09.00-10.00',
                'type' => 'text',
            ],
            [
                'key' => 'tanggal akad',
                'value' => '2025-02-20',
                'type' => 'date',
            ],
            [
                'key' => 'jam resepsi',
                'value' => '11.00-selesai',
                'type' => 'text',
            ],
            [
                'key' => 'tanggal resepsi',
                'value' => '2025-02-20',
                'type' => 'date',
            ],
            [
                'key' => 'link maps',
                'value' => 'https://maps.app.goo.gl/RMtGzGUhh3i3pbQMA?g_st=ac',
                'type' => 'text',
            ],
            [
                'key' => 'link embed google maps',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.212674202111!2d103.63787957510725!3d-1.6255508360913014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e258fa31df8e5b1%3A0x46e1b710715649d!2sMasjid%20An%20Nur%20(LDII)!5e0!3m2!1sen!2sid!4v1739954759282!5m2!1sen!2sid',
                'type' => 'text',
            ],
            [
                'key' => 'nama bank',
                'value' => 'BCA',
                'type' => 'text',
            ],
            [
                'key' => 'keterangan bank',
                'value' => 'no rek 1234567890 a/n Jhon Doe',
                'type' => 'text',
            ],

        ];

        foreach ($data as $item) {
            Config::firstOrCreate($item);
        }
    }
}
