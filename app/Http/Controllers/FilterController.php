<?php

namespace App\Http\Controllers;

use App\Repositories\EntriesRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    /**
     * @var EntriesRepository
     */
    private $entriesRepository;

    public function __construct(EntriesRepository $entriesRepository)
    {
        $this->entriesRepository = $entriesRepository;
    }

    public function entries(Request $request)
    {
        $entries = $this->entriesRepository->getFilteredEntries($request->get('last_names'));
        return $entries;
    }
}
