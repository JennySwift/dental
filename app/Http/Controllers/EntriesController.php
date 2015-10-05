<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\RestorationType;
use App\Models\WhereKept;
use App\Repositories\EntriesRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Debugbar;
use Symfony\Component\Debug\Debug;

/**
 * Class EntriesController
 * @package App\Http\Controllers
 */
class EntriesController extends Controller
{

    /**
     * @var EntriesRepository
     */
    private $entriesRepository;

    public function __construct(EntriesRepository $entriesRepository)
    {
        $this->entriesRepository = $entriesRepository;
    }
    /**
     *
     * @param null $filter
     * @return array
     */
    public function index ($filter = null) {
//        if ($filter) {
//            $entries = Entry::join('restoration_types', 'info.restoration_type', '=', 'restoration_types.id')
//                ->whereIn('last_name', $filter)
//                ->orderBy('last_name', 'asc');
//        }
//        else {
//            $entries = Entry::join('restoration_types', 'info.restoration_type', '=', 'restoration_types.id')
//                ->orderBy('last_name', 'asc');
//        }

        $entries = $this->entriesRepository->getEntries()['data'];
        return $entries;
    }

    /**
     * Insert a new entry
     * @param Request $request
     */
    public function store(Request $request)
    {
        $entry = new Entry($request->except(['restoration_type_id', 'folders']));

        $restorationType = RestorationType::find($request->get('restoration_type_id'));
        $entry->restorationType()->associate($restorationType);
        $entry->save();

        //Attach the folders
        foreach ($request->get('folders') as $folder_id) {
            $entry->folders()->attach($folder_id);
        }
    }

    /**
     *
     */
    public function update(Request $request, $id)
    {
        $entry = Entry::find($id);

        $data = array_filter(array_diff_assoc(
            $request->except(['restoration_type_id', 'folders']),
            $entry->toArray()
        ), 'removeFalseKeepZero');

        $entry->update($data);

        $restorationType = RestorationType::find($request->get('restoration_type_id'));
        $entry->restorationType()->associate($restorationType);

        $entry->save();

        $entry->folders()->sync($request->get('folder_ids'));

        return $this->responseOk($entry);
    }

    /**
     *
     * @param $id
     */
    public function destroy($id)
    {
        Entry::find($id)->delete();
        return $this->responseNoContent();
    }

}
