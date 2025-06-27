<?php

namespace App\Http\Controllers\Api;

use App\Models\Lokasi;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
{
    public function index()
    {
        return ApiResponse::success(Lokasi::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|unique:lokasis',
            'nama_lokasi' => 'required',
        ]);

        $lokasi = Lokasi::create($request->all());

        return ApiResponse::success($lokasi, 201);
    }

    public function show(Lokasi $lokasi)
    {
        return  ApiResponse::success($lokasi);
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'kode_lokasi' => 'required|unique:lokasis,kode_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required',
        ]);

        $lokasi->update($request->all());

        return ApiResponse::success($lokasi, 'data berhasil di update');
    }


    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return ApiResponse::error('Data tidak ditemukan', null, 404);
        }

        $lokasi->delete();

        return response()->json([
            'message' => 'data berhasil dihapus.'
        ]);
    }
}
