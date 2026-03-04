<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

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
            'items.*.foto' => 'nullable|image|max:5120'
        ]);

        $manager = new ImageManager(new Driver());

        foreach ($request->items as $item) {

            $path = null;

            if (isset($item['foto'])) {

                $image = $manager->read($item['foto']);

                // Resize aman (tidak merusak detail)
                $image->scaleDown(width: 1600);

                $tempPath = storage_path('app/temp_' . Str::random(10) . '.webp');

                // Simpan WebP kualitas stabil
                $image->toWebp(80)->save($tempPath);

                // Jika masih >500KB, turunkan sedikit (tanpa brutal)
                if (filesize($tempPath) > 500 * 1024) {
                    $image->toWebp(70)->save($tempPath);
                }

                $finalPath = 'barang/' . Str::random(20) . '.webp';
                Storage::disk('public')->put($finalPath, file_get_contents($tempPath));

                unlink($tempPath);

                $path = $finalPath;
            }

            Katalog::create([
                'nama' => $item['nama'],
                'harga_modal' => $item['harga_modal'],
                'harga_dalam' => $item['harga_dalam'],
                'harga_luar' => $item['harga_luar'],
                'foto' => $path,
            ]);
        }

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambah!');
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
            'foto' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('foto'));

            $image->scaleDown(width: 1600);

            $tempPath = storage_path('app/temp_' . Str::random(10) . '.webp');

            $image->toWebp(80)->save($tempPath);

            if (filesize($tempPath) > 500 * 1024) {
                $image->toWebp(70)->save($tempPath);
            }

            $finalPath = 'barang/' . Str::random(20) . '.webp';
            Storage::disk('public')->put($finalPath, file_get_contents($tempPath));

            unlink($tempPath);

            $data['foto'] = $finalPath;
        }

        $barang->update($data);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Katalog $barang)
    {
        if ($barang->foto) Storage::disk('public')->delete($barang->foto);
        $barang->delete();
        return back();
    }
}
