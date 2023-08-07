<?php

namespace Database\Seeders;

use App\Models\Statistik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            $day = rand(-7,20);
            $statistik = new Statistik();
            $statistik->perangkat_id = rand(1, 2);
            $statistik->tanggal = date("Y-m-d", strtotime("+$day day", strtotime("now")));
            $statistik->jam = date("H:i");
            $statistik->tegangan = rand(1, 250);
            $statistik->save();
            sleep(1);
        }
    }
}
