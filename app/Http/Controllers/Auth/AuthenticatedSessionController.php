<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\login_log;
use Carbon\Carbon;
use Hash;
use Jenssegers\Agent\Facades\Agent;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $browser = Agent::browser();
        $timenow = Carbon::now();
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email',$email)->orWhere('nama_pengguna',$email)->first();
        if($user && $user->status_akun == 'aktif'){
            if(Hash::check($password, $user->password)){
               Auth::login($user);
               $user->update([
                'status' => 'online',
            ]);
               $ceklog = login_log::where('user_id',$user->id_user)->where('date_login_at', $timenow->format('Y-m-d'))->count();
               if($ceklog ==  0){
                   $log = login_log::create([
                       'user_id' => Auth::user()->id_user,
                       'user_agent' => $browser,
                       'ip_address' => $request->ip(),
                       'date_login_at' => $timenow->format('Y-m-d'),
                       'time_login_at' => $timenow->format('H:i:s'),
                   ]);    
               }
               return redirect()->intended(RouteServiceProvider::HOME);
           }else{
            return redirect()
            ->back()
            ->with('salah', 'Maaf, Sepertinya Password Salah')
            ->withInput();
           }
       }else{
          return redirect()
          ->back()
          ->with('salah', 'Maaf, Sepertinya Email Tidak Ditemukan Atau Diblokir ')
          ->withInput();
    }
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if(Auth::user() != null){
            $timenow = Carbon::now();
            $id = Auth::user()->id_user;
            $user = User::findOrFail($id);
            $user->update([
                'status' => 'offline',
            ]);
            $log = login_log::where('user_id',$id)->where('date_login_at',$timenow->format('Y-m-d'))->first();
            if($log != null){     
                $log->update([
                 'date_logout_at' => $timenow->format('Y-m-d'),
                 'time_logout_at' => $timenow->format('H:i:s'),
             ]);
            }
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
    }
}
