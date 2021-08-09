
<?php

use Illuminate\Support\Facades\Route;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('home');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/verify/{email}', function () {
  $user = User::where('email', request()->email)->first();
  $user->status = true;
  $user->update();
  return redirect()->route('login')
    ->withErrors(['identy' => 'Su usuario se activo exitosamente.'])
    ->withInput(request(['identy']));
});

Route::get('{slug?}', function () {
  return view('home');
});
