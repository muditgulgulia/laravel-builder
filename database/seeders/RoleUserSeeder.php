<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class RoleUserSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'role_user';
        $this->filename = base_path().'/database/seeders/csvs/role_user.csv';
    }
    public function run()
    {
        parent::run();
    }
}