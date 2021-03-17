<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class
RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        DB::table('roles')->insert(array(
            array(
                'name' => 'Owner',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Admin',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Staffs',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Customer',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
        ));
    }

}
