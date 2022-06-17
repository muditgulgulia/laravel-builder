<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class PermissionSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'permissions';
        $this->filename = base_path().'/database/seeders/csvs/permissions.csv';
    }
    public function run()
    {
        parent::run();
    }
}