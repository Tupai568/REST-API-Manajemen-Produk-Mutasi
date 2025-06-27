<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Lokasi;
use App\Models\Mutasi;
use App\Models\Produk;
use App\Models\ProdukLokasi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Produk::factory(10)->create();
        Lokasi::factory(10)->create();

        $produkList = Produk::all();
        $lokasiList = Lokasi::all();

        foreach ($produkList as $produk) {
            $lokasiList->random(2)->each(function ($lokasi) use ($produk) {
                ProdukLokasi::create([
                    'produk_id' => $produk->id,
                    'lokasi_id' => $lokasi->id,
                    'stok' => rand(10, 100),
                ]);
            });
        }


        $users = User::all();
        $produkLokasiList = ProdukLokasi::all();

        foreach ($produkLokasiList as $produkLokasi) {
            Mutasi::create([
                'tanggal' => now(),
                'jenis_mutasi' => rand(0, 1) ? 'masuk' : 'keluar',
                'jumlah' => rand(1, 20),
                'keterangan' => 'Mutasi data dummy',
                'user_id' => $users->random()->id,
                'produk_lokasi_id' => $produkLokasi->id,
            ]);
        }
    }
}
