<?php

namespace App\Http\Controllers;

use App\Models\diskon;
use App\Models\databarang;
use Illuminate\Http\Request;
use App\Http\Requests\DiskonRequest;

class DiskonController extends Controller
{
    public function index()
    {
        $datadiskon = diskon::with('databarang')->select('id_diskon','id_barang','harga_potongan','tgl_awal_diskon','tgl_akhir_diskon','status_diskon','nama_diskon','harga_setelah_potongan')->paginate(10);
        return view('admin.diskon.indexdiskon',compact('datadiskon'));
    }
     public function search(Request $request)
    {
        $datadiskon = diskon::with('databarang')->select('id_diskon','id_barang','harga_potongan','tgl_awal_diskon','tgl_akhir_diskon','status_diskon','nama_diskon','harga_setelah_potongan')
            ->where('nama_diskon','like','%'.$request->search.'%')
            ->Orwhere('harga_potongan',$request->search)
            
            ->paginate(10);
         return view('admin.diskon.indexdiskon',compact('datadiskon'));
    }
    public function create()
    {
        $searchbarang = null;
        $show_modal = false;
        return view('admin.diskon.creatediskon',compact('searchbarang','show_modal'));
    }
    public function searchbarang(Request $request)
    {
        $searchbarang = databarang::select('nama_barang','id_barang','harga_barang')
        ->where('nama_barang','like','%'.$request->cari_barang.'%')
        ->Orwhere('barcode','like','%'.$request->cari_barang.'%')
        ->get();
        if (count($searchbarang) > 0) {
           $show_modal = true;
       }

       return view('admin.diskon.creatediskon',compact('searchbarang','show_modal'));

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
   $data = diskon::with('databarang')->findOrFail($id);

   return view('admin.diskon.editdiskon',compact('searchbarang','show_modal','data'));
   }
    public function store(DiskonRequest $request)
    {
      $validate = $request->validated;
      $data = diskon::create([
        'id_barang' => $request->id_barang,
        'nama_diskon' => $request->nama_diskon,
        'harga_potongan' => $request->harga_potongan,
        'tgl_awal_diskon' => $request->tgl_awal_diskon,
        'tgl_akhir_diskon' => $request->tgl_akhir_diskon,
        'harga_setelah_potongan'=> $request->harga_setelah_potongan,
        'status_diskon' => 'aktif',
    ]);
      if ($data) {
        return redirect()->route('Diskon.index')->with('success', 'Data Berhasil Disimpan');
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
        $data = diskon::with('databarang')->findOrFail($diskon);
        return view('admin.diskon.editdiskon',compact('data','searchbarang','show_modal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(DiskonRequest $request,$diskon)
    {
        $validate = $request->validated;
        $data = diskon::findOrFail($diskon);
        $data->update([
            'id_barang' => $request->id_barang,
            'nama_diskon' => $request->nama_diskon,
            'harga_potongan' => $request->harga_potongan,
            'status_diskon' => $request->status_diskon,
            'tgl_awal_diskon' => $request->tgl_awal_diskon,
            'tgl_akhir_diskon' => $request->tgl_akhir_diskon,
            'harga_setelah_potongan'=> $request->harga_setelah_potongan,
        ]);
        if ($data) {
            return redirect()->route('Diskon.index')->with('success', 'Data Berhasil Di Ubah');
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
       $data = diskon::findOrFail($diskon);
       $data->delete();

       if($data){
         return redirect()->route('Diskon.index')->with('success', 'Data Berhasil Di Hapus');
       }else{
         return redirect()->back()->with('danger', 'Data Tidak Berhasil Di Hapus');
       }
    }
}
