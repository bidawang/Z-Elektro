<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Katalog::latest()->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'items.*.nama' => 'required',
            'items.*.harga_modal' => 'required|numeric',
            'items.*.harga_dalam' => 'required|numeric',
            'items.*.harga_luar' => 'required|numeric',
            'items.*.foto' => 'nullable|image|max:2048'
        ]);

        foreach ($request->items as $item) {
            $path = null;
            if (isset($item['foto'])) {
                $path = $item['foto']->store('barang', 'public');
            }

            Katalog::create([
                'nama' => $item['nama'],
                'harga_modal' => $item['harga_modal'],
                'harga_dalam' => $item['harga_dalam'],
                'harga_luar' => $item['harga_luar'],
                'foto' => $path,
            ]);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambah!');
    }

    public function show(Katalog $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Katalog $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Katalog $barang)
    {
        $data = $request->validate([
            'nama' => 'required',
            'harga_modal' => 'required|numeric',
            'harga_dalam' => 'required|numeric',
            'harga_luar' => 'required|numeric',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($barang->foto) Storage::disk('public')->delete($barang->foto);
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($data);
        return redirect()->route('barang.index');
    }

    public function destroy(Katalog $barang)
    {
        if ($barang->foto) Storage::disk('public')->delete($barang->foto);
        $barang->delete();
        return back();
    }
}