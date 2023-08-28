<?php

use App\Events\InfoPerangkatEvent;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\monitoring\MonitoringController;
use App\Http\Controllers\perangkat\PerangkatController;
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
    return redirect()->route("dashboard.index");
});

Route::apiResource('dashboard', DashboardController::class);
Route::apiResource('monitoring', MonitoringController::class);
Route::apiResource('perangkat', PerangkatController::class);

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
            $statistik->save();
        } else if (!empty($statistik_terakhir_perangkat) && $statistik_terakhir_perangkat->created_at->lte(Carbon::now()->subHour())) {
            $statistik = new Statistik();
            $statistik->perangkat_id = $id;
            $statistik->tanggal = date("Y-m-d");
            $statistik->jam = date("H:i");
            $statistik->tegangan = $data;
            $statistik->status = "hidup";
            $statistik->save();
        } else if ($statistik_terakhir_perangkat->status == "mati") {
            $statistik = new Statistik();
            $statistik->perangkat_id = $id;
            $statistik->tanggal = date("Y-m-d");
            $statistik->jam = date("H:i");
            $statistik->tegangan = $data;
            $statistik->status = "hidup";
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
