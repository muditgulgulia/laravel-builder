<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class RolesSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'roles';
        $this->filename = base_path().'/database/seeders/csvs/roles.csv';
    }
    public function run()
    {
        parent::run();
    }
}