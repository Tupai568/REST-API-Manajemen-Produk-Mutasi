<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukLokasi extends Model
{
   use HasFactory;
   protected $guarded = ['id'];

   public function produk()
   {
      return $this->belongsTo(Produk::class);
   }

   public function lokasi()
   {
      return $this->belongsTo(Lokasi::class);
   }

   public function mutasi()
   {
      return $this->hasMany(Mutasi::class);
   }
}
