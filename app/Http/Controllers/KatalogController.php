<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Katalog::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('max_price')) {
            $query->where('harga_luar', '<=', $request->max_price);
        }

        $barangs = $query->paginate(10);

        if ($request->ajax()) {
            return view('partials.katalog-cards', compact('barangs'))->render();
        }

        return view('katalog', compact('barangs'));
    }
    public function show($id)
    {
        $barang = Katalog::findOrFail($id);

        $cicilanList = [];

        for ($tenor = 2; $tenor <= 12; $tenor++) {

            $tambahan = $barang->harga_luar * 0.10 * $tenor;
            $totalBayar = round($barang->harga_luar + $tambahan);
            $perBulan = round($totalBayar / $tenor);

            $cicilanList[] = [
                'tenor' => $tenor,
                'total' => $totalBayar,
                'per_bulan' => $perBulan,
            ];
        }

        return view('katalog-show', compact('barang', 'cicilanList'));
    }
}
