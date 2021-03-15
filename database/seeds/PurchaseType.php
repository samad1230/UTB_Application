<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseType extends Seeder
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
        DB::table('purchase__types')->insert(array(
            array(
                'purchase_type' => 'Local Purchase',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'purchase_type' => 'LC Purchase',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
        ));
    }
}
