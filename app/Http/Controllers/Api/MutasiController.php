<?php

namespace App\Http\Controllers\Api;

use App\Models\Mutasi;
use App\Helpers\ApiResponse;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mutasi = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])->latest()->get();

        return ApiResponse::success($mutasi, "data berhasil diambil");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'produk_lokasi_id' => 'required|exists:produk_lokasis,id',
        ]);

        $produkLokasi = ProdukLokasi::findOrFail($request->produk_lokasi_id);

        if ($request->jenis_mutasi === 'keluar' && $produkLokasi->stok < $request->jumlah) {
            return response()->json([
                'message' => 'Stok tidak mencukupi untuk mutasi keluar.'
            ], 422);
        }

        // Update stok sesuai jenis mutasi
        if ($request->jenis_mutasi === 'masuk') {
            $produkLokasi->stok += $request->jumlah;
        } else {
            $produkLokasi->stok -= $request->jumlah;
        }

        $produkLokasi->save();

        $mutasi = Mutasi::create([
            'tanggal' => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'produk_lokasi_id' => $request->produk_lokasi_id,
            'user_id' => Auth::id()
        ]);

        return ApiResponse::success($mutasi, 'Mutasi berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $mutasi = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])->findOrFail($id);

        return ApiResponse::success($mutasi, 'Detail mutasi berhasil diambil');
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $validated = $request->validate([
            'tanggal' => 'date',
            'jenis_mutasi' => 'in:masuk,keluar',
            'jumlah' => 'integer|min:1',
            'produk_lokasi_id' => 'exists:produk_lokasis,id',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($mutasi, $validated) {
            // Ambil stok sekarang
            $produkLokasi = $mutasi->produkLokasi;

            // Kembalikan stok lama
            if ($mutasi->jenis_mutasi === 'masuk') {
                $produkLokasi->stok -= $mutasi->jumlah;
            } else {
                $produkLokasi->stok += $mutasi->jumlah;
            }

            // Terapkan mutasi baru
            if (isset($validated['produk_lokasi_id']) && $validated['produk_lokasi_id'] != $mutasi->produk_lokasi_id) {
                $produkLokasi->save(); // simpan rollback lama

                // Update produk lokasi baru
                $produkLokasi = ProdukLokasi::findOrFail($validated['produk_lokasi_id']);
            }

            if (($validated['jenis_mutasi'] ?? $mutasi->jenis_mutasi) === 'masuk') {
                $produkLokasi->stok += $validated['jumlah'] ?? $mutasi->jumlah;
            } else {
                $produkLokasi->stok -= $validated['jumlah'] ?? $mutasi->jumlah;
            }

            $produkLokasi->save();

            $mutasi->update($validated);
        });

        return ApiResponse::success($mutasi->fresh(), 'Mutasi berhasil diperbarui dan stok disesuaikan');
    }


    public function destroy($id)
    {

        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return ApiResponse::error('Data tidak ditemukan', null, 404);
        }

        $mutasi->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
