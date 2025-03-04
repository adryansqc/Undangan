<?php

namespace App\Http\Controllers;

use App\Models\CeritaKami;
use App\Models\Config;
use App\Models\Galeri;
use App\Models\Kehadiran;
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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1|max:5',
            'status' => 'required|in:Hadir,Tidak Hadir',
        ]);

        Kehadiran::create([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Konfirmasi kehadiran berhasil dikirim!');
    }
}
