<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
        DB::table('users')->insert(array(
            array(
                'name' => 'UTB Application',
                'role_id' => '1',
                'staf_id' => NULL,
                'email' => 'samad1230@gmail.com',
                'creat_by' => '1',
                'email_verified_at' => NULL,
                'password' => '$2y$10$R7L3AYru2Nf5ZT7fDNchJOA5gTGybQk72cEaOvnBwUGG8h4mrS4Yy',
                'status' => '1',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ),
        ));
    }
}
