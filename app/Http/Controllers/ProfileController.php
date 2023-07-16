<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id_user;
    if($id == null){
        abort(404);
    }
    $data = User::with('userlog')->where('id_user',$id)->first();
    return view('auth.profile',compact('data'));
  }
  public function update(Request $request,$id){
     $user = User::find($id)->first();
     $user->update([
        'nama_pengguna' => $request->nama_pengguna,
        'email' => $request->email,
     ]);
     if($user){
        return to_route('profile.index')->with('success','Berhasil Update Data');
     }else{
        return to_route('profile.index')->with('error','Gagal Update Data');
     }
 }
 public function updatepassword(Request $request,$id){
     $user = User::find($id)->first();
     $validate = $request->validate([
         'password' => 'required|string',
         'confirm_password' => 'required|string|min:6',
     ]);
      if (!Hash::check($request->password, $user->password)) {
            return to_route('profile.index')->with('error', 'Password Salah');
        }
     $user->update([
        'password' =>  Hash::make($request->confirm_password),
     ]);
     if($user){
        return to_route('profile.index')->with('success','Berhasil Update Data');
     }else{
        return to_route('profile.index')->with('error','Gagal Update Data');
     }
 }
}
