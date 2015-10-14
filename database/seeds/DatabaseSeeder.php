<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(ProductCategTableSeeder::class);
        $this->call(PostTypeTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        Model::reguard();
    }
}
