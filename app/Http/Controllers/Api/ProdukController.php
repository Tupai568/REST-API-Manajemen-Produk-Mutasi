<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('lokasi')->get();
        return ApiResponse::success($produk);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'kode_produk' => 'required|string|unique:produks,kode_produk',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
        ]);

        $produk = Produk::create($request->all());
        return ApiResponse::success($produk, 'Produk berhasil ditambahkan', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        return ApiResponse::success($produk->load('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'string',
            'kode_produk' => 'required|string|max:100|unique:produks,kode_produk,' . $produk->id,
            'kategori' => 'string',
            'satuan' => 'string',
        ]);

        $produk->update($request->all());
        return ApiResponse::success($produk, 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return ApiResponse::error('Data tidak ditemukan', null, 404);
        }

        $produk->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
