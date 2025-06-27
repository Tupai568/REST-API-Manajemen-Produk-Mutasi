<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
   use HasFactory;
   protected $guarded = ['id'];

   public function lokasi()
   {
      return $this->belongsToMany(Lokasi::class, 'produk_lokasis')
         ->withPivot('stok')
         ->withTimestamps();
   }

   public function produkLokasi()
   {
      return $this->hasMany(ProdukLokasi::class);
   }
}
