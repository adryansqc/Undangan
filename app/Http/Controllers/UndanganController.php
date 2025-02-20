<?php

namespace App\Http\Controllers;

use App\Models\CeritaKami;
use App\Models\Config;
use App\Models\Galeri;
use App\Models\Undangan;
use Illuminate\Http\Request;

class UndanganController extends Controller
{
    public function index()
    {
        $configs = Config::pluck('value', 'key');
        return view('fe-partial.undangan', compact('configs'));
    }

    public function show($slug)
    {
        // $undangan = Undangan::where('slug', $slug)->firstOrFail();
        // $configs = Config::pluck('value', 'key');

        // return view('fe-partial.tamuundangan', compact('undangan', 'configs'));

        $undangan = Undangan::where('slug', $slug)->firstOrFail();
        $configs = Config::pluck('value', 'key');
        $ceritaKamis = CeritaKami::orderBy('tanggal', 'asc')->get();
        $galeris = Galeri::all();

        return view('fe-partial.tamuundangan', compact('undangan', 'configs', 'ceritaKamis', 'galeris'));
    }
}
