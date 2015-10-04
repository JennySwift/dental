<?php namespace App\Http\Transformers;

use App\Models\Entry;
use League\Fractal\TransformerAbstract;

/**
 * Class EntryTransformer
 */
class EntryTransformer extends TransformerAbstract
{
    public function transform(Entry $entry)
    {
        return [
            'first_name' => $entry->first_name,
            'last_name' => $entry->last_name,
            'tooth_number' => $entry->tooth_number,
            'restoration_type_id' => $entry->restoration_type_id,
            'original_restoration_date' => [
                'sql' => $entry->original_restoration_date,
                'user' => convertDate($entry->original_restoration_date)
            ],
            'last_photo_date' => [
                'sql' => $entry->last_photo_date,
                'user' => convertDate($entry->last_photo_date)
            ],
            'restoration_age' => $entry->restoration_age,
            'note' => $entry->note,
            'restoration_type' => [
                $entry->restorationType->name
            ],
            'folders' => $entry->folders

        ];
    }

}