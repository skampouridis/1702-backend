<?php

use Illuminate\Database\Seeder;
use App\Vessel;
use App\VesselTrack;

class VesselTracksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        $file = base_path() . '/ship_positions.csv';
        $data = fopen($file, 'r');

        if ($data) {

            $header = fgetcsv($data, 0, ';');

            while ($row = fgetcsv($data, 0, ';')) {

                $vessel = Vessel::where('mmsi', $row[0])->get();

                if ($vessel->count() == 1) {

                    $vessel = $vessel->first();

                    VesselTrack::create([
                        'vessel_id' => $vessel->id,
                        'status' => $row[1],
                        //'station' => $row[0],
                        'speed' => $row[2],
                        'lon' => str_replace(',', '.', $row[3]),
                        'lat' => str_replace(',', '.', $row[4]),
                        'course' => $row[5],
                        'heading' => $row[6],
                        'rot' => $row[7],
                        'timestamp' => $row[8]
                    ]);

                }

            }

        }

    }

}
