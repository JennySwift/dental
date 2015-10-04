<?php

use App\Models\Folder;
use App\Models\RestorationType;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class RestorationTypesSeeder extends Seeder {

    public function run()
    {
        RestorationType::truncate();

        RestorationType::create(['name' => 'crown/onlay']);
        RestorationType::create(['name' => 'occlusal']);
        RestorationType::create(['name' => 'veneer']);
        RestorationType::create(['name' => 'implant']);
        RestorationType::create(['name' => 'composite bridge']);
        RestorationType::create(['name' => 'maryland bridge']);
        RestorationType::create(['name' => 'root canal therapy']);
        RestorationType::create(['name' => 'chip repair']);
        RestorationType::create(['name' => 'incisal']);
    }

}