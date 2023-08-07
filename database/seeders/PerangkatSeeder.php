<?php

namespace Database\Seeders;

use App\Models\Perangkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 6; $i++) { 
            $perangkat = new Perangkat();
            $perangkat->perangkat = "Perangkat $i";
            $perangkat->kondisi = "mati";
            $perangkat->save();
        }
    }
}
