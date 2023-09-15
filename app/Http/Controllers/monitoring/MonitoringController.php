<?php

namespace App\Http\Controllers\monitoring;

use App\Http\Controllers\Controller;
use App\Models\Perangkat;
use App\Models\Statistik;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perangkat_default = Perangkat::first();
        $id_perangkat_default = empty($perangkat_default) ? 0 : $perangkat_default->id;
        $params = [
            'perangkat' => empty($request->perangkat) ? $id_perangkat_default : $request->perangkat,
            'cari' => empty($request->cari) ? "" : $request->cari,
            'show' => empty($request->show) ? 5 : $request->show,
            'waktu_mulai' => empty($request->waktu_mulai) ? date("Y-m-d") : $request->waktu_mulai,
            'waktu_selesai' => empty($request->waktu_selesai) ? date("Y-m-d") : $request->waktu_selesai,
        ];
        $statistik = Statistik::with(['perangkat','user']);
        $statistik = $statistik->where(function ($q) use ($params) {
            $q->whereBetween("tanggal",[$params['waktu_mulai'],$params['waktu_selesai']]);
            $q->whereHas("perangkat", function ($data_perangkat) use ($params) {
                $data_perangkat->where("id", "like", "%{$params['perangkat']}%");
            });
        });
        $statistik = $statistik->orderBy("tanggal","asc")->paginate($params['show'])->withQueryString();
        $perangkat = Perangkat::get();
        $data = [
            "statistik" => $statistik,
            "perangkat" => $perangkat,
            "params" => $params,
        ];
        return inertia()->render("data/monitoring/monitoring_page", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
