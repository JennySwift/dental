<?php

use App\Models\Entry;
use App\Models\Folder;
use App\Models\RestorationType;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;


class EntriesSeeder extends Seeder {

    public function run()
    {
        $this->faker = Faker::create();

        Entry::truncate();

        foreach (range(0, 20) as $index) {
            $entry = new Entry([
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'tooth_number' => $this->faker->numberBetween(1, 6),
                'original_restoration_date' => $this->faker->date('Y-m-d'),
                'last_photo_date' => $this->faker->date('Y-m-d'),
                'restoration_age' => $this->faker->numberBetween(1, 5),
                'note' => $this->faker->sentence(),
            ]);

            $restorationTypeIds = RestorationType::lists('id')->all();
            $restorationTypeId = $this->faker->randomElement($restorationTypeIds);
            $restorationType = RestorationType::find($restorationTypeId);

            $entry->restorationType()->associate($restorationType);

            $entry->save();
        }
    }

}