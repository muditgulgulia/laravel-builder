<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class ThemeSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'frontend_theme_settings';
        $this->filename = base_path().'/database/seeders/csvs/theme.csv';
    }
    public function run()
    {
        parent::run();
    }
}