<?php

use App\Events\InfoPerangkatEvent;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\monitoring\MonitoringController;
use App\Http\Controllers\perangkat\PerangkatController;
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
    for ($i = 0; $i < 50; $i++) {
        event(new InfoPerangkatEvent(rand(2, 4), rand(1, 110), strtotime("now")));
        usleep(1000000);
    }
});
