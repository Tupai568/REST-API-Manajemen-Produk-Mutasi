<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukLokasiController extends Controller
{
    public function index()
    {
        return ApiResponse::success(ProdukLokasi::with(['produk', 'lokasi'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'stok' => 'required|integer|min:0'
        ]);

        $exists = ProdukLokasi::where('produk_id', $request->produk_id)
            ->where('lokasi_id', $request->lokasi_id)
            ->first();

        if ($exists) {
            return response()->json(['message' => 'Produk sudah terdaftar di lokasi ini.'], 409);
        }

        $data = ProdukLokasi::create($request->all());

        return ApiResponse::success($data, 'Data berhasil di tambah', 201);
    }

    public function show($id)
    {
        $data = ProdukLokasi::with(['produk', 'lokasi'])->findOrFail($id);
        return ApiResponse::success($data);
    }

    public function update(Request $request, $id)
    {
        $data = ProdukLokasi::findOrFail($id);

        $request->validate([
            'stok' => 'required|integer|min:0'
        ]);

        $data->update($request->only('stok'));

        return ApiResponse::success($data, 'Data berhasil di update');
    }

    public function destroy($id)
    {

        $produkLokasi = ProdukLokasi::find($id);

        if (!$produkLokasi) {
            return ApiResponse::error('Data tidak ditemukan', null, 404);
        }

        $produkLokasi->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
