<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\register;
use App\Models\Reset_password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class Authentifikasi extends Controller
{

    public function index(request $request)
    {

        return view('login');
    }

    public function loginProses(Login $request)
    {
                $data = array(
                  "email"     => $request->input('email'),
                  "password"  => $request->input('password'),
                );
                $query = User::where('email', $request->email);
                if ($query->get()[0]->verif == '0') {
                    if ($query->get()[0]->hit >= '2') {
                        if($_SERVER["REQUEST_TIME"] - $request->session()->get('time') > 50) {
                            $query->update(['hit' => '']);
                        } else {
                            Alert::error('Gagal', 'Anda terlalu banyak melakukan verifikasi tunggu hingga 60 detik');
                            date_default_timezone_set('Asia/Jakarta');
                            $date   = date_create(date("Y-m-d H:i:s")); date_modify($date,"+60 second");
                            $hasil  = date_format($date,"Y-m-d H:i:s");
                            back()->with('danger', $hasil);
                            return redirect('/login');
                        }
                    }
                    $token          = Str::random(64);
                    User::where('email', $request->email)->update(["remember_token" => $token]);
                    Mail::send('email.email_login', ['token' => $token, "user" => User::where('email', $request->email)->get()[0]], function($message) use($request){
                        $message->to($request->email);
                        $message->subject('Verifikasi Akun Baru');
                    });
                    $request->session()->put('token', $token);
                    $request->session()->put('time', $_SERVER["REQUEST_TIME"]);
                    $query->update(['hit' => floatval($query->get()[0]->hit) + 1]);
                    Alert::warning('Verifikasi','Email belum verifikasi, Silahkan Cek email pada '.$request->email.' untuk mengaktifkan.');
                    return redirect('/login');
                } else {
                    if (Auth::attempt($data)) {
                            Alert::success('Success', 'Login Berhasil');
                            return redirect('/dashboard');
                    } else {
                        Alert::error('Gagal', 'Username Atau Password Salah');
                        return redirect('/login');
                    }
                }
    }

    public function veriflogin(Request $request,$token) {
        date_default_timezone_set('Asia/Jakarta');
        $query      = User::where('remember_token',$token);
        if ($request->session()->get('token') == $token) {
           if ($query->update(['verif' => '1', 'email_verified_at' => date("Y-m-d\TH:i:s")])) {
            Alert::success('Berhasil', 'Akun anda sudah verifikasi ! Silahkan login untuk melanjutkan');
            return redirect('/login');
           }
        } else {
            Alert::error('Gagal', 'Token Tidak Valid !');
            return redirect('/login');
        }
    }

    public function register()
    {
        $id = DB::table('users')->select(DB::raw('RIGHT (users.id_user,3) AS kode','FALSE'))
                                ->orderBy('id_user','DESC')
                                ->limit(1)->get();
        if ($id->count()<>0) {
            $kode = intval($id[0]->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode,2,"0",STR_PAD_LEFT);
        $rand = rand(64,10);
        $kodejadi = "USER-".$rand.$kodemax;
        return view('register', ["id" => $kodejadi]);
    }

    public function registerProses(register $request)
    {
        if ($request->password1 != $request->password2) {
            Alert::error('Gagal', 'Password Tidak Sama');
            return redirect('/register');
        }

        $nama               = $request->nama_depan." ".$request->nama_belakang;
        $model              = new User();
        $model->id_user     = $request->id_user;
        $model->name        = $nama;
        $model->email       = $request->email;
        $model->password    = bcrypt($request->password2);

        $users_count = DB::table('users')
                       ->where('email', '=', $model->email)
                       ->count();

        if ($users_count > 0) {
            Alert::error('Gagal', 'Data telah di input sebelumnya');
            return redirect('/register');
        } else {
            $model->save();
            Alert::success('Success', 'Registrasi Berhasil ! Silahkan Login');
            return redirect('/login');
          }

    }

    public function logout()
    {
        Alert::success('Success', 'logout Berhasil !');
        Auth::logout();
        return redirect('/login');

    }

    public function lupa_password(Request $request)
    {
        if ($request->has('submit')) {
            $this->validate($request, [
                "email"     => 'required|min:5|max:50|exists:users,email'
            ]);

            $token                  = Str::random(64);
            $model                  = new Reset_password();
            $model->remember_token  = $token;
            $model->email           = $request->email;
            $model->save();

            Mail::send('email.email', ['token' => $token, "user" => User::where('email', $request->email)->get()[0]], function($message) use($request){
                $message->to($request->email);
                $message->subject('Pengaturan Ulang Kata Sandi');
            });
            $request->session()->put('token', $token);
            return back()->with('message', 'We have e-mailed your password reset link!');

        }
        return view('lupa-password');
    }

    public function showResetPasswordForm(Request $request,$token)
    {
        $query = Reset_password::where('remember_token',$token);
        if ($query->count() >= 1) {
            if ($query->get()[0]->status == 0) {
                if ($request->has('submit')) {
                    $this->validate($request, [
                        "email"             => "required|email|min:5",
                        'first_password'    =>'required|min:6|max:30',
                        'secound_password'    =>'required|same:first_password|min:6|max:30'
                    ]);

                    $update = User::where('email',$request->email)->update(["password" => bcrypt($request->secound_password)]);
                    if ($update) {
                        $query->update(["status" => '1']);
                        Alert::success('Berhasil', 'Data telah diubah !');
                        return redirect('/login');
                    }
                }
                return view('email.verif', ["email" => $query->get()[0]->email]);
            }
        }
        Alert::error('Gagal', 'Token Tidak Valid !');
        return redirect('/lupa-password');

    }
}
