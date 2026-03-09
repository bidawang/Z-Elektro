<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::latest()->get();
        return view('kategori.index', compact('data'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        Kategori::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori dibuat');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $kategori->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori dihapus');
    }
}
