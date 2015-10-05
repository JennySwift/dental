<?php namespace App\Http\Transformers;

use App\Models\Folder;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;

/**
 * Class FolderTransformer
 */
class FolderTransformer extends TransformerAbstract
{

    public function transform(Folder $folder)
    {
        return [
            'id' => $folder->id,
            'name' => $folder->name
        ];
    }
}