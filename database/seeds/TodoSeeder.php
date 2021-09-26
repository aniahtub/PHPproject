<?php

use Illuminate\Database\Seeder;
use App\Todo;
use App\User;
class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Todo::class,5)->create();

    }
}