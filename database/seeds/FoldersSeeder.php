<?php

use App\Models\Folder;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class FoldersSeeder extends Seeder {

    public function run()
    {
        Folder::truncate();

        $folder = Folder::create(['name' => 'Cracked Teeth']);
        $folder = Folder::create(['name' => 'Missing Teeth']);
        $folder = Folder::create(['name' => 'Anteriors']);
        $folder = Folder::create(['name' => 'Decay']);
        $folder = Folder::create(['name' => 'Root Canal Therapy']);
        $folder = Folder::create(['name' => 'Wear']);
    }

}