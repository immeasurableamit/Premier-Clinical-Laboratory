<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            'id' => '1',
            'name' => 'Phase, 7, Sahibzada Ajit Singh Nagar',
            'address' => 'Booth No : 52, Phase, 7, Sahibzada Ajit Singh Nagar, 160055',
            'created_at' => now(),
        ]);

        DB::table('sites')->insert([
            'id' => '2',
            'name' => 'Sector 70, Sahibzada Ajit Singh Nagar, Punjab',
            'address' => 'SCO 678 GROUND FLOOR, Sector 70, Sahibzada Ajit Singh Nagar, Punjab 160071',
            'created_at' => now(),
        ]);

        DB::table('sites')->insert([
            'id' => '3',
            'name' => 'PHASE 5, Sahibzada Ajit Singh Nagar, Punjab',
            'address' => 'SCF 82, FIRST FLOOR, PHASE 5, Sahibzada Ajit Singh Nagar, Punjab 160059',
            'created_at' => now(),
        ]);

        DB::table('sites')->insert([
            'id' => '4',
            'name' => 'Phase 10, Sahibzada Ajit Singh Nagar, Punjab',
            'address' => 'SCO 46, First Floor, Phase 10, Sahibzada Ajit Singh Nagar, Punjab 160062',
            'created_at' => now(),
        ]);

        DB::table('sites')->insert([
            'id' => '5',
            'name' => 'Phase 9, Sahibzada Ajit Singh Nagar',
            'address' => 'SCO- 25, Industrial Area, Industrial Area Mohali Phase 9, Sahibzada Ajit Singh Nagar, Punjab 140308',
            'created_at' => now(),
        ]);
    }
}
