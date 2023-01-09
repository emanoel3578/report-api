<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report')->insert([
            'id' => 5,
            'sql' => "Select * from transfer where \${created_at} < '2022-01-01 00:00:00' and \${updated_at} > '2021-05-01 00:00:00'",
        ]);
        DB::table('report')->insert([
            'id' => 6,
            'sql' => "Select * from user where \${name} = 'userTest'",
        ]);
    }
}
