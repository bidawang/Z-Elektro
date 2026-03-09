<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? Carbon::today()->toDateString();

        $kategoris = Kategori::all();

        foreach ($kategoris as $kategori) {

            Laporan::firstOrCreate(
                [
                    'kategori_id' => $kategori->id,
                    'tanggal' => $tanggal
                ],
                [
                    'foto' => '',
                    'text' => null
                ]
            );
        }

        // create kunci otomatis jika belum ada
        DB::table('kunci_laporans')->updateOrInsert(
            ['tanggal' => $tanggal],
            ['is_open' => true]
        );

        $laporans = Laporan::with('kategori')
            ->whereDate('tanggal', $tanggal)
            ->get();

        $dates = Laporan::selectRaw('DATE(tanggal) as tgl')
            ->groupBy('tgl')
            ->orderBy('tgl', 'desc')
            ->pluck('tgl');

        return view('laporan.index', compact(
            'laporans',
            'tanggal',
            'dates'
        ));
    }

    public function update(Request $request)
    {
        $tanggal = $request->tanggal;

        $kunci = DB::table('kunci_laporans')
            ->where('tanggal', $tanggal)
            ->first();

        if (!$kunci || $kunci->is_open == false) {
            return back()->with('error', 'Laporan sudah dikunci');
        }

        foreach ($request->laporan as $id => $data) {

            $laporan = Laporan::find($id);

            if (!$laporan) continue;

            if (isset($data['foto'])) {

                $path = $data['foto']->store('laporan', 'public');

                $laporan->foto = $path;
            }

            $laporan->text = $data['text'] ?? null;

            $laporan->save();
        }

        $belumLengkap = Laporan::where('tanggal', $tanggal)
            ->where(function ($q) {
                $q->whereNull('foto')
                    ->orWhere('foto', '');
            })
            ->exists();

        if (!$belumLengkap) {

            DB::table('kunci_laporans')
                ->where('tanggal', $tanggal)
                ->update([
                    'is_open' => false
                ]);
        }

        return back()->with('success', 'Laporan diperbarui');
    }
}
