<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\databarang;
use App\Http\Resources\DatabarangResource;
use Illuminate\Support\Str;


class DatabarangApi extends Controller
{
    public function index()
    {
      $databarang = Databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang')->limit(100);
        return DatabarangResource::collection($databarang);
    }
    public function show($databarang)
    {
        $databarang = databarang::with('kategory')->findOrFail($databarang);
        return new DatabarangResource($databarang);
    }
    public function store(Request $request)
    {
        if ($request->foto_barang == null) {
            $validate = $request->safe()->except(['foto_barang']);
            $data = databarang::create([
            'id_barang' => Str::uuid()->toString(),
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => 'aktif',
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
            ]);
        } else {
             $validate = $request->validated();
             $data = databarang::create([
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $request->file('foto_barang')->store('images'),
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => 'aktif',
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
           ]);
        }
         if ($data) {
           return new DatabarangResource($data);
        } else {
            return response()->json(['message' => 'Gagal Menambahkan Barang'], 500);
        }
        
    }
    public function update(ProductRequest $request, $databarang)
    {
        if ($request->foto_barang == null) {
            $validate = $request->safe()->except(['barcode','foto_barang']);
            $validatedData = $request->validate($request->rules($databarang));
            $data = databarang::findOrFail($databarang);
            $data->update([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => 'aktif',
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
            ]);
        } else {
                 $validate = $request->safe()->except(['barcode']);
                 $validatedData = $request->validate($request->rules($databarang));
             $data = databarang::findOrFail($databarang);
            Storage::delete($data->foto_barang);
            $data->update([
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $request->file('foto_barang')->store('images'),
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => 'aktif',
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
           ]);
        }
          if ($data) {
           return new DatabarangResource($data);
        } else {
            return response()->json(['message' => 'Gagal Update Data Barang'], 500);
        }
    }
    public function destroy($databarang)
    {
        $data = databarang::findOrFail($databarang);
        if ($data->foto_barang != null) {
        Storage::delete($data->foto_barang);
        $data->delete();
        }else{
            $data->delete();
        }
        if ($data) {
            return response()->json(['message' => 'Barang Telah Dihapus'], 200);
        } else {
            return response()->json(['message' => 'Gagal Hapus Data Barang'], 500);
        }
    }
}
