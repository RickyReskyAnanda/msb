<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*MUSRENBANG*/
    public function postLogin(Request $request){
        // validasi data input
        $this->validate($request,[
            'username' => 'required|min:6|max:32',
            'password' => 'required|min:6|max:32'
        ]);
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password],true)) {

            Auth::login(Auth::user(), true);
            if(Auth::user()->level){
                return redirect(Auth::user()->level);
            }else{
                return redirect('/')->with('aksesmasuk', 'Username atau Password Anda Salah !')->withInput($request->only('username', 'remember'));
            }
        }else{
            return redirect('/')->with('aksesmasuk', 'Username atau Password Anda Salah !')->withInput($request->only('username', 'remember'));
        }
    }
    /*BATAS MUSRENBANG*/

    // /*RKPD*/
    public function postLoginRKPD(Request $request){
        // validasi data input
        $this->validate($request,[
            'username' => 'required|min:6|max:32',
            'password' => 'required|min:6|max:32'
        ]);
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password,'program'=>'RKPD'],true)) {
            Auth::login(Auth::user(), true);
            return redirect('rkpd/administrator');
        }else{
            return redirect('rkpd')->with('aksesmasuk', 'Username atau Password Anda Salah !')->withInput($request->only('username', 'remember'));
        }
    }
    /*BATAS RKPD*/

    public function logout($program){
        Auth::guard('web')->logout();
        if($program == 'rkpd')
            return redirect($program);
        else
            return redirect('/');

        // return 'berhasil keluar';
    }
}
