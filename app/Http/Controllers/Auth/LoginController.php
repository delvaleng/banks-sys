<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\PasswordValidationRule;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest',['only' => 'showLoginForm'])->except('logout');
      $this->url                      = config('app.url');
      $this->passport_client_id       = config('passport.personal_access_client.id');
      $this->passport_client_secret   = config('passport.personal_access_client.secret');


    }


    public function login(){

      $credentials = $this->validate(request(), [
        'identy'      => 'required|digits:10|exists:users,identy',
        'password'    => ['required', new PasswordValidationRule, 'digits:4'],
      ],
      [
        'identy.required'    => 'Este campo es obligatorio',
        'identy.exists'      => 'El usuario no se encuentra registrado.',
        'password.required'  => 'Este campo es obligatorio',
      ]);

      if(Auth::attempt($credentials)){


        if (auth()->user()->status == false){
          Auth::logout();
          return back()
          ->withErrors(['identy' => 'Su usuario no se encuentra activo.'])
          ->withInput(request(['identy']));
        }

        $password = request()->password;
        $username = request()->identy;

        $data = [
          'grant_type' => 'password',
          'client_id' => $this->passport_client_id,
          'client_secret' =>  $this->passport_client_secret,
          'username' => $username,
          'password' => $password,
          'scope' => ''
        ];


        $ch   = curl_init($this->url.'/oauth/token');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result         = curl_exec($ch);
        $myArray        = json_decode($result);;

        $user = User::find(auth()->user()->id);
        $user->token = $myArray->access_token;
        // $user = $user->status = 1;
        $user->update();

        return redirect()->route('home');

      }

      return back()
      ->withErrors($credentials,'login');

    }
    public function logout() {
      Auth::logout();
      return redirect('/')->with('error_message', 'Session Finalizada');
    }
    public function home()
    {
      $main = new MainClass();
      $main = $main->getMain();
      return view('home', compact('main'));
    }
}
