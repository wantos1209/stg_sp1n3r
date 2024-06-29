<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\GenerateVoucherController;
use App\Http\Controllers\HadiahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UrlSpinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PemiluController;
use App\Http\Controllers\ImlekController;
use App\Http\Controllers\JenisvoucherController;
use App\Http\Controllers\KeteranganController;
use App\Http\Controllers\ListPrizeController;
use App\Http\Controllers\NewYearController;
use App\Http\Controllers\UrlEventController;
use App\Http\Controllers\WebsiteController;
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

    /*--  Jenis Voucher --*/
    Route::get('/jenisvoucher', [JenisvoucherController::class, 'index']);
    Route::get('/jenisvoucher/add', [JenisvoucherController::class, 'create']);
    Route::get('/jenisvoucher/edit/{id}', [JenisvoucherController::class, 'edit']);
    Route::post('/jenisvoucher/store', [JenisvoucherController::class, 'store']);
    Route::post('/jenisvoucher/update', [JenisvoucherController::class, 'update']);
    Route::delete('/jenisvoucher/delete', [JenisvoucherController::class, 'destroy']);
    Route::get('/jenisvoucher/view/{id}', [JenisvoucherController::class, 'views']);

    //URL SPIN
    Route::get('/urlspin/index/', [UrlSpinController::class, 'index']);
    Route::get('/urlspin/edit/{id}', [UrlSpinController::class, 'edit']);
    Route::get('/urlspin/view/{id}', [UrlSpinController::class, 'view']);
    Route::post('/urlspin/update/{id}', [UrlSpinController::class, 'update']);
    Route::get('/getDataUrl', [UrlSpinController::class, 'getDataUrl']);
    Route::post('/event/updateurl_spinner/{website}/{id}', [EventController::class, 'updateurl_spinner']);

    /*--  Keterangan --*/
    Route::get('/keterangan', [KeteranganController::class, 'index']);
    Route::get('/keterangan/add', [KeteranganController::class, 'create']);
    Route::get('/keterangan/edit/{id}', [KeteranganController::class, 'edit']);
    Route::post('/keterangan/store', [KeteranganController::class, 'store']);
    Route::post('/keterangan/update', [KeteranganController::class, 'update']);
    Route::delete('/keterangan/delete', [KeteranganController::class, 'destroy']);
    Route::get('/keterangan/view/{id}', [KeteranganController::class, 'views']);

    /* URL Event */
    Route::get('/urlevent/index/', [UrlEventController::class, 'index']);
    Route::get('/urlevent/edit/{id}', [UrlEventController::class, 'edit']);
    Route::get('/urlevent/view/{id}', [UrlEventController::class, 'vew']);
    Route::post('/urlevent/update', [UrlEventController::class, 'update']);

    /* Hadiah */
    Route::get('/hadiah/index/', [HadiahController::class, 'index']);
    Route::get('/hadiah/add/', [HadiahController::class, 'create']);
    Route::post('/hadiah/store/', [HadiahController::class, 'store']);
    Route::get('/hadiah/edit/{id}', [HadiahController::class, 'edit']);
    Route::get('/hadiah/view/{id}', [HadiahController::class, 'view']);
    Route::post('/hadiah/update/', [HadiahController::class, 'update']);
    Route::delete('/hadiah/delete/', [HadiahController::class, 'destroy']);

    /* Budget */
    Route::get('/budget/index/', [BudgetController::class, 'index']);
    Route::get('/budget/add/', [BudgetController::class, 'create']);
    Route::post('/budget/store/', [BudgetController::class, 'store']);
    Route::get('/budget/edit/{id}', [BudgetController::class, 'edit']);
    Route::get('/budget/view/{id}', [BudgetController::class, 'view']);
    Route::post('/budget/update/', [BudgetController::class, 'update']);
    Route::delete('/budget/delete/', [BudgetController::class, 'destroy']);

    /* Gambar */
    Route::get('/gambar/index/', [GambarController::class, 'index']);
    Route::get('/gambar/add/', [GambarController::class, 'create']);
    Route::post('/gambar/store/', [GambarController::class, 'store']);
    Route::get('/gambar/edit/{id}', [GambarController::class, 'edit']);
    Route::get('/gambar/view/{id}', [GambarController::class, 'view']);
    Route::post('/gambar/update/', [GambarController::class, 'update']);
    Route::delete('/gambar/delete/', [GambarController::class, 'destroy']);

    /* listprize */
    Route::get('/listprize/index/', [ListPrizeController::class, 'index']);
    Route::get('/listprize/add/', [ListPrizeController::class, 'create']);
    Route::post('/listprize/store/', [ListPrizeController::class, 'store']);
    Route::get('/listprize/edit/{id}', [ListPrizeController::class, 'edit']);
    Route::get('/listprize/view/{id}', [ListPrizeController::class, 'view']);
    Route::post('/listprize/update/', [ListPrizeController::class, 'update']);
    Route::delete('/listprize/delete/', [ListPrizeController::class, 'destroy']);

    /* website */
    Route::get('/website/index/', [WebsiteController::class, 'index']);
    Route::get('/website/add/', [WebsiteController::class, 'create']);
    Route::post('/website/store/', [WebsiteController::class, 'store']);
    Route::get('/website/edit/{id}', [WebsiteController::class, 'edit']);
    Route::get('/website/view/{id}', [WebsiteController::class, 'view']);
    Route::post('/website/update/', [WebsiteController::class, 'update']);
    Route::delete('/website/delete/', [WebsiteController::class, 'destroy']);
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
Route::get('/l21newyear/{jenis_event}/{website}/{deviceid}', [NewYearController::class, 'l21newyear']);
Route::get('/l21newyear/cek/{jenis_event}/{website}/{deviceid}/{username}', [NewYearController::class, 'l21newyear_update']);
