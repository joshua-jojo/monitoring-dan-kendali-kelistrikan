<?php

use App\Events\InfoPerangkatEvent;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\monitoring\MonitoringController;
use App\Http\Controllers\perangkat\PerangkatController;
use App\Http\Controllers\settings\UserController;
use App\Models\Perangkat;
use App\Models\Statistik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
    $login = auth()->check();
    if ($login) {
        return redirect()->route("dashboard.index");
    }
    return redirect()->route("login");
});

Route::apiResource('dashboard', DashboardController::class)->middleware('isLogin');
Route::apiResource('monitoring', MonitoringController::class)->middleware('isLogin');
Route::apiResource('perangkat', PerangkatController::class)->middleware('isLogin');

Route::get("test/{id}/{data}", function ($id, $data) {

    $statistik_terakhir_perangkat = Statistik::where("tanggal", date("Y-m-d"))->where("perangkat_id", $id)->latest()->first();
    $perangkat = Perangkat::find($id);

    if ($perangkat->kondisi == "hidup") {
        if (empty($statistik_terakhir_perangkat)) {
            $statistik = new Statistik();
            $statistik->perangkat_id = $id;
            $statistik->tanggal = date("Y-m-d");
            $statistik->jam = date("H:i");
            $statistik->tegangan = $data;
            $statistik->status = "hidup";
            $statistik->user_id = auth()->user()->id;
            $statistik->save();
        } else if (!empty($statistik_terakhir_perangkat) && $statistik_terakhir_perangkat->created_at->lte(Carbon::now()->subHour())) {
            $statistik = new Statistik();
            $statistik->perangkat_id = $id;
            $statistik->tanggal = date("Y-m-d");
            $statistik->jam = date("H:i");
            $statistik->tegangan = $data;
            $statistik->status = "hidup";
            $statistik->user_id = $statistik_terakhir_perangkat->user_id;
            $statistik->save();
        } else if ($statistik_terakhir_perangkat->status == "mati") {
            $statistik = new Statistik();
            $statistik->perangkat_id = $id;
            $statistik->tanggal = date("Y-m-d");
            $statistik->jam = date("H:i");
            $statistik->tegangan = $data;
            $statistik->status = "hidup";
            $statistik->user_id = auth()->user()->id;
            $statistik->save();
        }
        event(new InfoPerangkatEvent($id, $data, strtotime("now")));
    } else {
        if (!empty($statistik_terakhir_perangkat) && $statistik_terakhir_perangkat->status == "hidup") {
            $statistik = new Statistik();
            $statistik->perangkat_id = $id;
            $statistik->tanggal = date("Y-m-d");
            $statistik->jam = date("H:i");
            $statistik->tegangan = $data;
            $statistik->status = "mati";
            $statistik->user_id = auth()->user()->id;
            $statistik->save();
        }
        event(new InfoPerangkatEvent($id, 0, strtotime("now")));
    }

    return response()->json("ok", 200);
});

Route::get("status-perangkat/{id}", function ($id) {
    $perangkat = Perangkat::find($id);
    $kondisi = $perangkat->kondisi;
    return $kondisi;
});

Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.submit');

Route::group(['prefix' => 'settings', 'as' => 'settings.', 'middleware' => 'isLogin'], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'post'])->name('user.post');
    Route::post('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/hapus', [UserController::class, 'hapus'])->name('user.hapus');
});
