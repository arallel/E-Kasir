<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\login_log;
use App\Models\setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterUser;


class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datauser = User::select('nama_pengguna','email','password','status','status_akun','level','id_user')->get();
        $setting = setting::first();
        return view('admin.userdata.indexdatauser',compact('datauser','setting'));
    }
    public function loguser()
    {
        $datauser = login_log::with('users')->get();
        return view('admin.userdata.loguser',compact('datauser'));

    }
    public function create()
    {
        $setting = setting::first();
        return view('admin.userdata.createuser',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mail($id)
    {
        $data = User::findOrFail($id);
        if($data == null){abort(404);}
        return view('vendor.mail.mail',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'level' => 'required'
        ]);
         $data = User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'status' => 'offline',
            'status_akun' => 'aktif',
            'password' => ($request->password != null)?$request->password:null,
            'level' => $request->level,
            'id_user' => Str::uuid()->toString(),
         ]);
         if(setting::first()->is_register_admin == 'false'){
          Mail::to($request->email)->send(new RegisterUser($data));
         }
         if($data){
            return redirect()->route('UserData.index')->with('success', 'Data Pengguna Berhasil Disimpan');
         }else{
            return redirect()
            ->back()
            ->withErrors($validate)
            ->with('error', 'Gagal Menyimpan Data Pengguna')
            ->withInput();
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        if($data == null){abort(404);}
        return view('admin.userdata.editdatauser',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_pengguna' => 'required', 
            'email' => 'required', 
            'status' => 'required', 
            'status_akun' => 'required', 
            'level' => 'required', 
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'status' => $request->status,
            'status_akun' => $request->status_akun,
            'level' => $request->level,
        ]);
        if ($user) {
            return redirect()->route('UserData.index')->with('success','berhasil Merubah Data');
        } else {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data = User::findOrFail($id);
       if($data == null){abort(404);}
       $data->delete($id);
       if ($data) {
        return redirect()->route('UserData.index')->with('success','berhasil Menghapus Data');
    } else {
        return redirect()
            ->back()
            ->withErrors($validate)
            ->with('danger', 'Gagal Menghapus Data')
            ->withInput();
    }
    }
}
