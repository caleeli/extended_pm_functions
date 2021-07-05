<?php
use Illuminate\Support\Facades\Schema;
use ProcessMaker\Package\Extended_pm_functions\Seeds\PackageSeeder;

Artisan::command('extended_pm_functions:install', function () {
    PackageSeeder::install();

    $this->info('Extended_pm_functions has been installed');
})->describe('Installs the required js files and table in DB');


