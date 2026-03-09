<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $fillable = [
        'kategori_id',
        'tanggal',
        'foto',
        'text'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}