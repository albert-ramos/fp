<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('pharmacies')->insert([
            'name' => 'PharmaOne'
        ]);

        DB::table('pharmacies')->insert([
            'name' => 'PharmaTen'
        ]);
    }
}
