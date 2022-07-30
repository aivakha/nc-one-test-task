<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apartment::truncate();

        $csv_data = file(base_path() . '/database/data/apartments.csv');

        if (!empty($csv_data)) {
            foreach ($csv_data as $key => $row) {
                if ($key > 0) {
                    $data = explode(',', trim($row));
                    $apartment = Apartment::create([
                        'title' => $data[0],
                        'price' => $data[1],
                        'bedrooms' => $data[2],
                        'bathrooms' => $data[3],
                        'storeys' => $data[4],
                        'garages' => $data[5],
                    ]);

                    $apartment->save();
                }
            }
        }
    }
}
