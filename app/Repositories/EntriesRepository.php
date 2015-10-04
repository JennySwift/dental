<?php

namespace App\Repositories;

use App\Models\Entry;

class EntriesRepository {

    public function getEntries()
    {
        return Entry::with('restorationType')
            ->with('folders')
            ->get();
    }
}