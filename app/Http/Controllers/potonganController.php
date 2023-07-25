<?php

namespace App\Http\Controllers;

use App\Models\potongan;
use App\Models\databarang;
use Illuminate\Http\Request;
use App\Http\Requests\potonganRequest;

class potonganController extends Controller
{
    public function index()
    {
        $datapotongan = potongan::with('databarang')->get();
        return view('admin.potongan.indexpotongan',compact('datapotongan'));
    }
    public function create()
    {
        return view('admin.potongan.createpotongan');
    }
    public function searchbarang(Request $request)
    {
        $searchbarang = databarang::with('checkpotongan')->select('id_barang','nama_barang','harga_barang','stok','kode_barang')->where('nama_barang','like','%'.$request->cari_barang.'%')
        ->get();
        if(count($searchbarang) == 0 ){
            return response()->json(['message' => 'no data' ]);
        }else{
            return response()->json(['data' => $searchbarang]);
        }
    }
    public function store(potonganRequest $request)
    {
        $cek = potongan::where('id_barang',$request->id_barang)->count();
        if($cek >= 1){
           return redirect()
           ->back()
           ->with('error', 'Gagal Menyimpan Data Sudah Ada')
           ->withInput();
       }else{
        $data = potongan::create([
         'id_barang' => $request->id_barang,
         'harga_awal' => $request->harga_awal,
         'harga_potongan_rp' => ($request->harga_potongan_rp != null)?$request->harga_potongan_rp:null,
         'harga_potongan_persen' => ($request->harga_persen != null)?$request->harga_persen:null,
         'tgl_awal_potongan' => $request->tgl_awal_potongan,
         'tgl_akhir_potongan' => $request->tgl_akhir_potongan,
         'status_potongan' => 'aktif',
         'harga_setelah_potongan' => $request->harga_setelah_potongan,
     ]);
    }

    if ($data){
        return redirect()->route('potongan.index')->with('success', 'Data Berhasil Disimpan');
    } else {
     return redirect()
     ->back()
     ->withErrors($validate)
     ->with('error', 'Gagal Menyimpan Data')
     ->withInput();
 }
}
public function show(Request $request,$id)
{
    $data = potongan::with('databarang')->findOrFail($id);
    $jumlah = $request->jumlah;
    if($data && $jumlah)
    {
        return view('admin.potongan.printlabelpromo',compact('data','jumlah'));
    }else{
        abort(404);
    }
}
public function edit($diskon)
{
    $data = potongan::with('databarang')->findOrFail($diskon);
    if($data == null){abort(404);}
    return view('admin.potongan.editpotongan',compact('data'));
}
public function update(potonganRequest $request,$diskon)
{
    $cek = potongan::where('id_barang',$request->id_barang)->count();
    if($cek >= 2 ){
        return redirect()
           ->back()
           ->with('error', 'Gagal Menyimpan Data Sudah Ada Pada Diskon Harap Di Hapus Apabila Tidak Dipakai')
           ->withInput();
    }else{
     $data = potongan::findOrFail($diskon);
     $data->update([
       'id_barang' => $request->id_barang,
       'harga_awal' => $request->harga_awal,
       'harga_potongan_rp' => ($request->harga_potongan_rp != null)?$request->harga_potongan_rp:null,
       'harga_potongan_persen' => ($request->harga_persen != null)?$request->harga_persen:null,
       'tgl_awal_potongan' => $request->tgl_awal_potongan,
       'tgl_akhir_potongan' => $request->tgl_akhir_potongan,
       'kode_promo' => $request->kode_promo,
       'harga_setelah_potongan' => $request->harga_setelah_potongan,
   ]);
    if ($data) {
        return redirect()->route('potongan.index')->with('success', 'Data Berhasil Di Ubah');
    }else {
       return redirect()
       ->back()
       ->withErrors($validate)
       ->with('error', 'Gagal Menyimpan Data')
       ->withInput();
   }
   }
}
public function destroy($diskon)
{
   $data = potongan::findOrFail($diskon);
   if($data == null){abort(404);}
   $data->delete();
   if($data){
     return redirect()->route('potongan.index')->with('success', 'Data Berhasil Di Hapus');
 }else{
     return redirect()->back()->with('danger', 'Data Tidak Berhasil Di Hapus');
 }
}
public function checkkupon(Request $request)
{
    if($request->kode_promo){
        $data = potongan::where('kode_promo',$request->kode_promo)->first();
        if($data->status_potongan == 'aktif' && $data->diskon_by_code == 'true'){
            return response()->json($data);
        }else{
            return response()->json(['Kupon Kadaluarsa atau Salah Kode']);
        }
    }else{
        return response()->json(['message' => 'Mohon Mengisi Input']);
    }
}
}
