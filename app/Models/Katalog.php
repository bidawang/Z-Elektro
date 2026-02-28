<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama', 'foto', 'harga_modal', 'harga_dalam', 'harga_luar'];
}
