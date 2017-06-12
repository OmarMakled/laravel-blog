<?php

use Illuminate\Database\Seeder as BaseSeeder;

class Seeder extends BaseSeeder{

    protected $tables;

    protected function truncateTables()
    {
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        return $this;
    }

}
