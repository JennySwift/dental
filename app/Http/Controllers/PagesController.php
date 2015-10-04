<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Folder;
use App\Models\RestorationType;
use App\Repositories\EntriesRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JavaScript;

class PagesController extends Controller
{

    /**
     * @var EntriesRepository
     */
    private $entriesRepository;

    public function __construct(EntriesRepository $entriesRepository)
    {

        $this->entriesRepository = $entriesRepository;
    }

    public function home()
    {
//        return $this->entriesRepository->getEntries()['data'];
        JavaScript::put([
            'restorationTypes' => RestorationType::get(),
            'folders' => Folder::get(),
            'entries' => $this->entriesRepository->getEntries()['data']
        ]);

        return view('home');
    }

}
