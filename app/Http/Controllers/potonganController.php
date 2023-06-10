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
        $datapotongan = potongan::with('databarang')->select('id_potongan','id_barang','harga_potongan','tgl_awal_potongan','tgl_akhir_potongan','status_potongan','nama_potongan','harga_setelah_potongan')->paginate(10);
        return view('admin.potongan.indexpotongan',compact('datapotongan'));
    }
     public function search(Request $request)
    {
        $datapotongan = potongan::with('databarang')->select('id_potongan','id_barang','harga_potongan','tgl_awal_potongan','tgl_akhir_potongan','status_potongan','nama_potongan','harga_setelah_potongan')
            ->where('nama_potongan','like','%'.$request->search.'%')
            ->Orwhere('harga_potongan',$request->search)
            
            ->paginate(10);
         return view('admin.potongan.indexpotongan',compact('datapotongan'));
    }
    public function create()
    {
        $searchbarang = null;
        $show_modal = false;
        return view('admin.potongan.createpotongan',compact('searchbarang','show_modal'));
    }
    public function searchbarang(Request $request)
    {
        $searchbarang = databarang::select('nama_barang','id_barang','harga_barang')
        ->where('nama_barang','like','%'.$request->cari_barang.'%')
        ->Orwhere('barcode','like','%'.$request->cari_barang.'%')
        ->get();
        // dd($searchbarang);
        if (count($searchbarang) > 0) {
           $show_modal = true;
       }

       return view('admin.potongan.createpotongan',compact('searchbarang','show_modal'));

   }
   public function searchedit(Request $request,$id)
   {
    $searchbarang = databarang::select('nama_barang','id_barang','harga_barang')
    ->where('nama_barang','like','%'.$request->cari_barang.'%')
    ->Orwhere('barcode','like','%'.$request->cari_barang.'%')
    ->get();
    if (count($searchbarang) > 0) {
       $show_modal = true;
   }
   $data = potongan::with('databarang')->findOrFail($id);

   return view('admin.potongan.editpotongan',compact('searchbarang','show_modal','data'));
   }
    public function store(Request $request)
    {
      $data = potongan::create([
        'id_barang' => $request->id_barang,
        'nama_potongan' => $request->nama_potongan,
        'harga_potongan' => $request->harga_potongan,
        'tgl_awal_potongan' => $request->tgl_awal_potongan,
        'tgl_akhir_potongan' => $request->tgl_akhir_potongan,
        'harga_setelah_potongan'=> $request->harga_setelah_potongan,
        'status_potongan' => 'aktif',
    ]);
      if ($data) {
        return redirect()->route('potongan.index')->with('success', 'Data Berhasil Disimpan');
    } else {
     return redirect()
     ->back()
     ->withErrors($validate)
     ->with('error', 'Gagal Menyimpan Data')
     ->withInput();
 }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function show(diskon $diskon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function edit($diskon)
    {
        $searchbarang = null;
        $show_modal = false;
        $data = potongan::with('databarang')->findOrFail($diskon);
        return view('admin.potongan.editpotongan',compact('data','searchbarang','show_modal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$diskon)
    {
        $validate = $request->validated;
        $data = potongan::findOrFail($diskon);
        $data->update([
            'id_barang' => $request->id_barang,
            'nama_potongan' => $request->nama_potongan,
            'harga_potongan' => $request->harga_potongan,
            'status_potongan' => $request->status_potongan,
            'tgl_awal_potongan' => $request->tgl_awal_potongan,
            'tgl_akhir_potongan' => $request->tgl_akhir_potongan,
            'harga_setelah_potongan'=> $request->harga_setelah_potongan,
        ]);
        if ($data) {
            return redirect()->route('potongan.index')->with('success', 'Data Berhasil Di Ubah');
        } else {
           return redirect()
           ->back()
           ->withErrors($validate)
           ->with('error', 'Gagal Menyimpan Data')
           ->withInput();
       }
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function destroy($diskon)
    {
       $data = potongan::findOrFail($diskon);
       $data->delete();

       if($data){
         return redirect()->route('potongan.index')->with('success', 'Data Berhasil Di Hapus');
       }else{
         return redirect()->back()->with('danger', 'Data Tidak Berhasil Di Hapus');
       }
    }
}
