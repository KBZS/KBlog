<?php

use Illuminate\Database\Seeder;

class AdditionalInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AdditionalInfo::class, 15)->create();
    }
}
