<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KearifanLokal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penyakit',
        'penanganan_kearifan_lokal',
        'nama_obat',
        'deskripsi_obat',
        'gambar_obat',
        'link_pembelian',
    ];
}
