<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\GenerateVoucherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UrlSpinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PemiluController;
use App\Http\Controllers\ImlekController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->intended('/generatevoucher/0');
    }
    return redirect()->intended('/p3dJu4N645');
});

/* Login */
Route::get('/p3dJu4N645', [LoginController::class, 'index'])->name('login')->Middleware('guest');
Route::post('/p3dJu4N645', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->Middleware('auth');


/* Dashboard */
Route::get('/p3dJu4N646', function () {
    return view('layouts.index', [
        'title' => 'dashboard',
        'totalnote' => 0
    ]);
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    /* Generate Voucher */
    Route::get('/generatevoucher/{isdemo?}/{search_data?}', [GenerateVoucherController::class, 'index']);
    Route::get('/generatevoucherdemo/{demoid}', [GenerateVoucherController::class, 'index']);
    Route::get('/generatevoucheredit/{id}', [GenerateVoucherController::class, 'edit']);
    Route::post('/generatevoucherupdate', [GenerateVoucherController::class, 'update']);

    /*--  Voucher --*/
    Route::get('/voucher/{id}/{isdemo?}/{search_data?}', [VoucherController::class, 'index']);
    Route::get('/voucher_search/{id}/{search_data?}', [VoucherController::class, 'index_search']);

    Route::get('/voucherproses/{id}/{isdemo?}/{search_data?}', [VoucherController::class, 'indexProses']);
    Route::get('/voucherprosesall/{search_data?}', [VoucherController::class, 'indexProsesAll']);
    Route::post('/voucher_updatestatus', [VoucherController::class, 'updateStatus']);
    Route::post('/voucher_updateuserklaim', [VoucherController::class, 'updateUserklaim']);
    Route::post('/voucher_deleteuserklaim', [VoucherController::class, 'deleteUserklaim']);
    Route::get('/voucher_print/{id}', [VoucherController::class, 'print']);
    Route::get('/voucher_printview/{id}', [VoucherController::class, 'printView']);
    Route::get('/voucher_printproses/{id}', [VoucherController::class, 'printProses']);
    Route::get('/countvoucher', [VoucherController::class, 'countvoucher']);

    /* URL SPIN */
    Route::get('/urlspin/index/', [UrlSpinController::class, 'index']);
    Route::get('/urlspin/edit/{id}', [UrlSpinController::class, 'edit']);
    Route::get('/urlspin/view/{id}', [UrlSpinController::class, 'view']);
    Route::post('/urlspin/update/{id}', [UrlSpinController::class, 'update']);
    Route::get('/getDataUrl', [UrlSpinController::class, 'getDataUrl']);

    /* Event */
    Route::get('/dataevent/index/{jenis_event}/{website?}', [EventController::class, 'index']);
    Route::get('/dataevent/add/{jenis_event}/{website}', [EventController::class, 'create']);
    Route::get('/dataevent/edit/{jenis_event}/{website}/{id}', [EventController::class, 'edit']);
    Route::get('/dataevent/view/{jenis_event}/{website}/{id}', [EventController::class, 'view']);
    Route::post('/dataevent/store/{jenis_event}', [EventController::class, 'store']);
    Route::post('/dataevent/update/{jenis_event}/{website}', [EventController::class, 'update']);
    Route::delete('/dataevent/delete/{jenis_event}/{website}', [EventController::class, 'destroy']);
    Route::post('/event/updateketerangan/{jenis_event}/{website}/{id}', [EventController::class, 'updateketerangan']);
    Route::post('/event/updateurl_spinner/{jenis_event}/{website}/{id}', [EventController::class, 'updateurl_spinner']);
    Route::post('/dataevent/changestatus/{jenis_event}/{website}/{status}', [EventController::class, 'changestatus']);
    Route::get('/deleteDataBatal', [EventController::class, 'deleteDataBatal']);
    Route::get('/event_print/{jenis_event}', [EventController::class, 'print']);

    /* Proses Event */
    Route::get('/prosesevent/indexproses/{jenis_event}/{website?}', [EventController::class, 'indexproses']);
    Route::get('/eventtable/{jenis_event}/{website?}', [EventController::class, 'eventtable']);
    Route::get('/countevent/{jenis_event}', [EventController::class, 'countproses']);

    /* Find Kode Event */
    Route::get('/findkodeevent/{jenis_event}/{search?}', [EventController::class, 'findkodeevent']);
    Route::get('/findkodeedit/edit/{jenis_event}/{website}/{id}/{search?}', [EventController::class, 'findkodeedit']);
    Route::get('/findkodeview/view/{jenis_event}/{website}/{id}/{search?}', [EventController::class, 'findkodeview']);
    Route::delete('/findkodedelete/delete/{jenis_event}/{website}', [EventController::class, 'findkodedestroy']);

    /* Approval Event */
    Route::get('/approvalevent/indexapproval/{jenis_event}/{website?}', [EventController::class, 'indexapproval']);
    // Route::get('/eventtableapproval/{jenis_event}/{website?}', [EventController::class, 'eventtableApproval']);
    Route::post('/dataeventapproval/changestatus/{jenis_event}/{website}/{status}', [EventController::class, 'changestatusApproval']);
});


Route::middleware(['isAdmin'])->group(function () {
    /*--  Generate Voucher --*/
    Route::get('/generatevoucheradd/{isdemo?}/{search_data?}', [GenerateVoucherController::class, 'create']);
    Route::post('/generatevoucher/store', [GenerateVoucherController::class, 'store']);
    Route::delete('/generatevoucher/delete', [GenerateVoucherController::class, 'destroy']);

    /*--  Data User --*/
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/add', [UserController::class, 'create']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::delete('/user/delete', [UserController::class, 'destroy']);
    Route::get('/user/view/{id}', [UserController::class, 'views']);
});


/* Front Spinner */
// Route::get('/', function () {
//     return view('frontspinner.spinlg.index');
// });

Route::get('spinnerl21', function () {
    return view('frontspinner.spinner.spinner');
});


/* Front Pemilu */
Route::get('/pemilu', [PemiluController::class, 'index']);
Route::get('/l21pemilu/{jenis_event}/{website}/{androidid}/{ip?}', [PemiluController::class, 'l21pemilu']);
Route::post('/l21pemilu/{jenis_event}', [PemiluController::class, 'l21pemilu_store']);
Route::put('/l21pemilu', [PemiluController::class, 'l21pemilu_update']);

/* Front Imlek */
Route::get('/l21imlek/{jenis_event}/{website}/{androidid}/{ip?}', [ImlekController::class, 'l21imlek']);
Route::post('/l21imlek', [ImlekController::class, 'l21imlek_store']);
Route::put('/l21imlek', [ImlekController::class, 'l21imlek_update']);
Route::get('/getDataHadiah', [ImlekController::class, 'getDataHadiah']);
Route::post('/postDataHadiah', [ImlekController::class, 'postDataHadiah']);

/* Front NewYear */
Route::get('/l21newyear/{jenis_event}/{website}/{androidid}/{ip?}', [NewYearController::class, 'l21newyear']);
Route::post('/l21newyear', [NewYearController::class, 'l21newyear_store']);
Route::put('/l21newyear', [NewYearController::class, 'l21newyear_update']);
Route::get('/getDataHadiah', [NewYearController::class, 'getDataHadiah']);
Route::post('/postDataHadiah', [NewYearController::class, 'postDataHadiah']);
