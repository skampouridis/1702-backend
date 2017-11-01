<?php

use Illuminate\Database\Seeder;
use App\Vessel;

class VesselsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $vessels = [];
        $file = base_path() . '/ship_positions.csv';
        $data = fopen($file, 'r');

        if ($data) {

            $header = fgetcsv($data, 0, ';');

            while ($row = fgetcsv($data, 0, ';')) {

                if (!in_array($row[0], $vessels)) {
                    $vessels[] = $row[0];
                }

            }

            if (sizeof($vessels)) {
                foreach ($vessels as $vessel) {
                    Vessel::create([
                        'mmsi' => $vessel
                    ]);
                }
            }

        }
    }
}
