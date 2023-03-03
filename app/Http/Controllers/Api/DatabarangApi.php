<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\databarang;


class DatabarangApi extends Controller
{
    public function index()
    {
       $databarang = databarang::all();
       return response()->json($databarang);
    }
    public function store(ProductRequest $request)
    {
        if ($request->foto_barang == null) {
            $validate = $request->safe()->except(['foto_barang']);
           $data = databarang::create([
            'nama_barang' => $request->nama_barang,       
             'foto_barang' => $request->file('foto_barang')->store('images'),
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,            
            'status_barang' => $request->status_barang,  
            'barcode' => $request->barcode,
           ]);
           return response()->json($data);
         }
      }
    public function update(Request $request, $databarang)
    {
       $validate = $request->validated();
       $data = databarang::findOrFail($databarang);
       if ($validate->fails()) {
           return response()->json(['error' => $validate->errors()]);
       }else{
          if ($request->foto_barang == null) {
            $validate = $request->safe()->except(['foto_barang']);
            $data->update([
            'nama_barang' => $request->nama_barang,       
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,            
            'status_barang' => $request->status_barang,  
            'barcode' => $request->barcode,
            ]);
          } else {
             $validate = $request->validated();
             $data->update([
            'nama_barang' => $request->nama_barang,       
             'foto_barang' => $request->file('foto_barang')->store('images'),
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,            
            'status_barang' => $request->status_barang,  
            'barcode' => $request->barcode,
           ]);
          }
       }

        
    }
    public function destroy($databarang)
    {
         $data = databarang::findOrFail($databarang);
        $photoPath = $data->foto_barang;
        if (Storage::exists($photoPath)) {
        Storage::delete($photoPath);
        }
        $data->delete();
        return response()->json([
        'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
