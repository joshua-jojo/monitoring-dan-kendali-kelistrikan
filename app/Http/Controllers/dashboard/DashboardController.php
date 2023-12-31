<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Perangkat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perangkat = Perangkat::all();
        $perangkat->map(function ($q) {
            $q->series = [
                [
                    "name" => $q->perangkat,
                    "data" => [
                        [strtotime("now"), 0]
                    ],
                ]
            ];

            $q->chartOptions = [
                "chart" => [
                    "id" => "realtime",
                    "type" => "line",
                    "animations" =>  [
                        "enabled" => false,
                        "easing" => "linear",
                        "dynamicAnimation" => [
                            "speed" => 600
                        ]
                    ],
                    "toolbar" =>  [
                        "show" =>  false
                    ],
                    "zoom" =>  [
                        "enabled" =>  false
                    ]
                ],
                "dataLabels" => [
                    "enabled" => false,
                ],
                "stroke" => [
                    "curve" => "smooth",
                ],
                "xaxis" => [
                    "title" => [
                        "text" =>  "Waktu"
                    ],
                    "type" => "datetime",
                    "tickAmount" => 3,
                ],
                "tooltip" => [
                    "x" => [
                        "format" => "HH:mm",
                    ],
                ],
                "yaxis" => [
                    "max" => 300,
                    "min" => 0,
                    "tickAmount" => 4,
                    "title" => [
                        "text" =>  "Voltase"
                    ],
                ]
            ];

            $q->daya = 0;
            return json_decode($q);
        });
        $data = [
            'list_perangkat' => $perangkat
        ];
        return inertia()->render("dashboard/dashboard_page", $data);
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
