<?php

namespace App\Http\Controllers;

use App\Models\setting;
use App\Models\login_log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = setting::first();
        return view('admin.setting.indexsetting',compact('data'));
    }
    public function update(Request $request, setting $setting)
    {
       $setting->update([
            'nama_toko' => $request->nama_toko,
            'copyright_toko' => $request->copyright_toko,
            'email_toko' => $request->email_toko,
            'is_register_admin' => $request->is_register_admin,
        ]);
       if($setting){
        return to_route('setting.index')->with(['success' => 'Berhasil Ubah Data']);
       }else{
        return redirect()->back()->with(['error' => 'gagal Update Data']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $data = login_log::where('date_login_at','<>',Carbon::now()->format('Y-m-d'));
        $data->delete();
         if($data){
        return to_route('setting.index')->with(['success' => 'Berhasil Hapus Data']);
       }else{
        return redirect()->back()->with(['error' => 'gagal Hapus Data']);
       }
    }
}
