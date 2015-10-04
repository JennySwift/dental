<?php

namespace App\Repositories;

use App\Http\Transformers\EntryTransformer;
use App\Models\Entry;

class EntriesRepository {

    public function getEntries()
    {
        $entries = Entry::with('restorationType')
            ->with('folders')
            ->get();

        //Transform
        $resource = createCollection($entries, new EntryTransformer);
        return transform($resource);

//        $item = $this->createItem(
//            $transaction,
//            new TransactionTransformer
//        );
//
//        return $this->responseWithTransformer($item, Response::HTTP_CREATED);
    }
}