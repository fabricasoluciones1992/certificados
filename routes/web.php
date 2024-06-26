<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class)->names('users');
Route::resource('/admins', AdminController::class)->middleware('ADMIN')->names('admins');
Route::resource('/areas', AreaController::class)->middleware('ADMIN')->names('areas');
Route::resource('/posts', PostController::class)->middleware('ADMIN')->names('posts');
Route::resource('/contracts', ContractController::class)->middleware('ADMIN')->names('contracts');
Route::post('/create2', [ContractController::class, 'create2'])->middleware('ADMIN')->name('create2');
Route::get('/certificates/{id}', [AdminController::class, 'certificates'])->name('certificates');
Route::get('/confirm/password', [HomeController::class, 'confirm'])->name('confirm_password');
Route::get('/edit/password', [HomeController::class, 'edit'])->name('edit_password');
Route::get('/error', [HomeController::class, 'error'])->name('error');
Route::get('/export', [AdminController::class, 'export'])->name('export');
Route::get('/histories', [AdminController::class, 'histories'])->name('histories');
Route::get('/select/contract', [HomeController::class, 'select_contract'])->name('select_contract');
Route::get('/select/contracts/{id}', [HomeController::class, 'select_contracts'])->middleware('ADMIN')->name('select_contracts');
Route::put('/update/password', [HomeController::class, 'update'])->name('update_password');
Route::get('/validatecode', [Controller::class, 'validateCode'])->name('validate_code');
Route::post('/valcode', [Controller::class, 'valCode'])->name('valCode');

Route::post('/generate/{id}', function (Request $request, $id) {
    $contract = Contract::find($id);
    if (Auth::user()->id_roles != 2) {
        if ($contract->id_users != Auth::id()) {
            return "No puedes generar este certificado, no es tu certificado >:v";
        }
    }
    if ($request->opc == 'word') {
        return HomeController::generateWord($request, $id);
    }else if ($request->opc == 'pdf') {
        return PDFController::generatePDF($request, $id);
    }else {
        return '<script language="javascript">alert("Selecciona una forma de descargar el certificado(Word/Pdf)");</script>';
    }
    })->name('generate');
