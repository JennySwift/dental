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
        return transform($resource)['data'];
    }

    public function getFilteredEntries($lastNames)
    {
        $entries = Entry::with('restorationType')
            ->with('folders')
            ->whereIn('last_name', $lastNames)
            ->get();

        //Transform
        $resource = createCollection($entries, new EntryTransformer);
        return transform($resource)['data'];
    }
}