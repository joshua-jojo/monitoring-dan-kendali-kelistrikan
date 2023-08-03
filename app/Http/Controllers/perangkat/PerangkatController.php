<?php

namespace App\Http\Controllers\perangkat;

use App\Events\StatusPerangkatEvent;
use App\Http\Controllers\Controller;
use App\Models\Perangkat;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perangkat = Perangkat::latest()->get();
        $data = [
            "perangkat" => $perangkat,
        ];
        return inertia()->render("data/perangkat/perangkat_page", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'perangkat' => "required|unique:perangkats,perangkat",
        ]);

        $perangkat = new Perangkat();
        $perangkat->perangkat = $request->perangkat;
        $perangkat->kondisi = $request->kondisi;
        $perangkat->save();
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
        $request->validate([
            "id" => "required|exists:perangkats,id",
            "perangkat" => "required"
        ]);

        $perangkat = Perangkat::find($request->id);

        if ($request->perangkat != $perangkat->perangkat) {
            $request->validate([
                "perangkat"   => "unique:perangkats,perangkat"
            ]);

            $perangkat->perangkat = $request->perangkat;
        }

        $perangkat->kondisi = $request->kondisi;

        $perangkat->save();

        event(new StatusPerangkatEvent($id,$request->kondisi == "hidup" ? true : false));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perangkat = Perangkat::find($id);
        $perangkat->delete();
    }
}
