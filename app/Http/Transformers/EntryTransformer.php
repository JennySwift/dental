<?php namespace App\Http\Transformers;

use App\Models\Entry;
use App\Models\Folder;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;

/**
 * Class EntryTransformer
 */
class EntryTransformer extends TransformerAbstract
{
//    protected $defaultIncludes = [
//        'folders'
//    ];

    public function transform(Entry $entry)
    {
        return [
            'id' => $entry->id,
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
                'name' => $entry->restorationType->name
            ],
            'folders' => $entry->folders,
            'folder_ids' => $entry->folders->lists('id')->all()

        ];
    }

//    public function includeFolders(Entry $entry)
//    {
//        $folders = $entry->folders;
//
//        return createCollection($folders, new FolderTransformer);
//    }

}