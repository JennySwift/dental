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

        Debugbar::info('all', $request->all());
        Debugbar::info('type_id', $request->get('restoration_type_id'));
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
    public function update()
    {
        $entry = json_decode(file_get_contents('php://input'), true)["entry"];

        $entry_id = $entry['entry_id'];
        $first_name = $entry['first_name'];
        $last_name = $entry['last_name'];
        $tooth_number = $entry['tooth_number'];
        $restoration_type_id = $entry['restoration_type_id'];
        $OR_date = $entry['original_restoration_date']['sql'];
        $LP_date = $entry['last_photo_date']['sql'];
        $restoration_age = $entry['restoration_age'];
        $where_kept = $entry['where_kept'];
        $note = $entry['note'];

        $sql = "UPDATE info SET first_name = '$first_name', last_name = '$last_name', tooth_number = '$tooth_number', restoration_type = $restoration_type_id, original_restoration_date = ?, last_photo_date = ?, restoration_age = ?, note = ? WHERE id = $entry_id;";

        $sql_result = $db->prepare($sql);
        $sql_result->bindParam(1, $OR_date);
        $sql_result->bindParam(2, $LP_date);
        $sql_result->bindParam(3, $restoration_age);
        $sql_result->bindParam(4, $note);
        $sql_result->execute();

        updateWhereKept($db, $entry);
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
