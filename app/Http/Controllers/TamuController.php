<?php

namespace App\Http\Controllers;

use App\Http\Resources\GaleriCollection;
use App\Http\Resources\GaleriResource;
use App\Http\Resources\UndanganCollection;
use App\Http\Resources\UndanganResource;
use App\Models\Galeri;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TamuController extends Controller
{
    public function index()
    {
        // $tamu = Undangan::paginate(5);
        // $galeri = Galeri::all();

        // return Inertia::render('welcome', [
        //     'tamu' => new UndanganCollection($tamu),
        //     'galeri' => $galeri,
        // ]);

        $tamus = Undangan::paginate(5);
        $galeri = Galeri::all();

        return Inertia::render('welcome', [
            // 'tamu' => (new UndanganCollection($tamu))->toArray(request()),
            // 'tamu' => new UndanganResource($tamu),
            'tamu' => UndanganResource::collection($tamus),
            'galeri' => $galeri,
        ]);
        // $tamu = Undangan::paginate(5);
        // $galeri = Galeri::all();
        // dd(new UndanganCollection($tamu));
        // return Inertia::render('welcome', [
        //     'tamu' => new UndanganCollection($tamu), // Menggunakan TamuCollection
        //     'galeri' => $galeri,
        // ]);
    }

    public function galeri()
    {

        $galeri = Galeri::paginate(6);
        return Inertia::render('galeri', [
            'galeri' => GaleriResource::collection($galeri),
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
                'message' => session('message')
            ],
        ]);
    }
    public function galeriApi()
    {

        // $galeri = Galeri::paginate(6);
        // return Inertia::render('galeri', [
        //     'galeri' => GaleriResource::collection($galeri),
        //     'flash' => [
        //         'success' => session('success'),
        //         'error' => session('error'),
        //         'message' => session('message')
        //     ],
        // ]);
        $galeri = Galeri::paginate(6);
        return GaleriResource::collection($galeri);
    }

    public function tambahFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'foto' => $path
        ]);

        return redirect()->route('tamu.galeri')->with('success', 'Foto Baru berhasil ditambahkan!');
    }

    public function create()
    {
        return Inertia::render('create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'pronoun' => 'required|string|max:50',
        ]);


        $slug = Str::slug($validatedData['nama']);

        Undangan::create([
            'nama' => $validatedData['nama'],
            'pronoun' => $validatedData['pronoun'],
            'slug' => $slug,
        ]);
        return redirect('/tamu')->with('success', 'Data tamu berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $tamu = Undangan::findOrFail($id);
        $tamu->delete();
        return redirect()->route('tamu.index')->with('message', 'Data tamu berhasil dihapus!');
    }

    public function updateFoto(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if (file_exists(public_path('storage/' . $galeri->foto))) {
                unlink(public_path('storage/' . $galeri->foto));
            }

            $path = $request->file('foto')->store('galeri', 'public');
            $galeri->foto = $path;
        }

        $galeri->save();

        return redirect()->route('tamu.galeri')->with('success', 'Foto berhasil diperbarui!');
    }

    public function hapusFoto($id)
    {
        $galeri = Galeri::findOrFail($id);

        if (file_exists(public_path('storage/' . $galeri->foto))) {
            unlink(public_path('storage/' . $galeri->foto));
        }

        $galeri->delete();

        return redirect()->route('tamu.galeri')->with('success', 'Foto berhasil dihapus!');
    }

    public function show($slug)
    {
        $tamu = Undangan::where('slug', $slug)->firstOrFail();

        return Inertia::render('tamu_show', [
            'tamu' => $tamu,
        ]);
    }
}
