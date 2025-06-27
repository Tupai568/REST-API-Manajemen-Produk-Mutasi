<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_lokasis')
            ->withPivot('stok')
            ->withTimestamps();
    }

    public function produkLokasi()
    {
        return $this->hasMany(ProdukLokasi::class);
    }
}
