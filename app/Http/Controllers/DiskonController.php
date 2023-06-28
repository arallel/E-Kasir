<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\diskon;

class diskonController extends Controller
{
    public function index(){
        $data = diskon::paginate(10);
        return view('admin.diskon.indexdiskon',compact('data'));
    }
    public function create(){
        return view('admin.diskon.creatediskon');
    }
    public function store(Request $request){
        $data = diskon::create([
             'kode_promo' => $request->kode_promo,
             'persen_diskon' => $request->persen_diskon,
             'tgl_mulai_promo' => $request->tgl_mulai_promo,
             'tgl_selesai_promo' => $request->tgl_selesai_promo,
             'status_diskon' => 'aktif',
        ]);
         if ($data) {
                return redirect()->route('diskon.index')->with('success', 'Data Berhasil Disimpan');
            } else {
                 return redirect()
                ->back()
                ->withErrors($validate)
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
            }
    }
    public function edit(diskon $diskon){
        // dd($diskon);
        return view('admin.diskon.editdiskon',compact('diskon'));
    }
    public function update(Request $request,diskon $diskon){

        $diskon->update([
             'kode_promo' => $request->kode_promo,
             'persen_diskon' => $request->persen_diskon,
             'tgl_mulai_promo' => $request->tgl_mulai_promo,
             'tgl_selesai_promo' => $request->tgl_selesai_promo,
             'status_diskon' => $request->status_diskon,
        ]);
         if ($diskon) {
                return redirect()->route('diskon.index')->with('success', 'Data Berhasil Dirubah');
            } else {
                 return redirect()
                ->back()
                ->withErrors($validate)
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
            }
    }
    public function show($id){

    }
    public function destroy($diskon){
        $diskon = diskon::findOrFail($diskon);
        $diskon->delete();
        if ($diskon) {
                return redirect()->route('diskon.index')->with('success', 'Data Berhasil Di Hapus');
            } else {
                 return redirect()
                ->back()
                ->withErrors($validate)
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
            }
    }
   
}
