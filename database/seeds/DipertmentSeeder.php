<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DipertmentSeeder extends Seeder
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
        DB::table('dipertments')->insert(array(
            array(
                'name' => 'Policy Making Department',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Hr Admin',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Accounts',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Commercial',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Store',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'name' => 'Sales',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
        ));
    }
}
