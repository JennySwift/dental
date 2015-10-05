<?php

use App\Models\Entry;
use App\Models\Folder;
use App\Models\RestorationType;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class EntriesSeeder extends Seeder {

    public function run()
    {
        $this->faker = Faker::create();

        Entry::truncate();
        DB::table('entry_folder')->truncate();

        foreach (range(0, 20) as $index) {
            $originalRestorationDate = $this->faker->dateTimeBetween('-10 years', '-2 years')->format('Y-m-d');
            $lastPhotoDate = $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d');
            $restorationAge = Carbon::createFromFormat('Y-m-d', $lastPhotoDate)->diffInMonths(Carbon::createFromFormat('Y-m-d', $originalRestorationDate)) / 12;
            $restorationAge = round($restorationAge * 2) / 2;
            
            $entry = new Entry([
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'tooth_number' => $this->faker->numberBetween(1, 6),
                'original_restoration_date' => $originalRestorationDate,
                'last_photo_date' => $lastPhotoDate,
                'restoration_age' => $restorationAge,
                'note' => $this->faker->sentence(),
            ]);

            $restorationTypeIds = RestorationType::lists('id')->all();
            $restorationTypeId = $this->faker->randomElement($restorationTypeIds);
            $restorationType = RestorationType::find($restorationTypeId);

            $entry->restorationType()->associate($restorationType);

            $entry->save();

            $folderCount = $this->faker->numberBetween(1,2);

            $folder_ids = $this->faker->randomElements(Folder::lists('id')->all(), $folderCount);

            foreach ($folder_ids as $folder_id) {
                $entry->folders()->attach($folder_id);
            }

        }
    }

}