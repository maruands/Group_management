<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\SetdepositController;
use app\Http\Controllers\PaymentController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\DairyController;
use App\Http\Controllers\AccountController;


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
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/home/', [HomeController::class, 'adminHome'])->name('admin.home');

//Members
Route::get('/members', [HomeController::class, 'members'])->name('members');
Route::get('register', [RegisterController::class, 'index']);
Route::post('newMember', [RegisterController::class, 'store']);
Route::get('/member/edit/{id}', [RegisterController::class, 'edit'])->name('member.edit');
Route::post('/member/update/{id}', [RegisterController::class, 'update'])->name('member.update');
Route::post('members/destroy', [RegisterController::class, 'destroy'])->name('members.destroy');

Route::resource('Finance', FinanceController::class);
Route::resource('setdeposit', SetdepositController::class);
Route::get('addmember/create/{deposit_id}', [SetdepositController::class, 'addmember'])->name('addmember.create');
Route::post('addmember/store', [SetdepositController::class, 'storemember'])->name('addmember.store');
Route::post('addmember/delete', [SetdepositController::class, 'deleting'])->name('addmember.delete');


//Route::get('payment/make/{id}', [PaymentController::class, 'makepayment'])->name('payment.make');

Route::get('make/payment/{user_id}/{setdeposit_id}', [PayController::class, 'makepayment'])->name('payment');
Route::post('payment.store', [SetdepositController::class, 'payment_store'])->name('payment.store');
Route::resource('pay', PayController::class);

//dairy routes
Route::resource('dairy', DairyController::class);

//Accounts
Route::get('account/{id}', [AccountController::class, 'show_pay'])->name('account.show');
Route::get('account/add/{id}', [AccountController::class, 'add'])->name('add');
Route::post('account/add/{id}', [AccountController::class, 'adding'])->name('add');
Route::resource('account', AccountController::class);