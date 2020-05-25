<?php

use Illuminate\Database\Seeder;


class Test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            'name' => 'um',

        ]);
    }
}
