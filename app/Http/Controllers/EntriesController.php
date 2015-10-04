<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\WhereKept;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntriesController extends Controller
{

    public function updateWhereKept ($entry) {
        $entry_id = $entry['entry_id'];
        $where_kept = $entry['where_kept'];

        $sql = "DELETE FROM where_kept WHERE info_id = $entry_id;";

        $sql_result = $db->query($sql);

        foreach ($where_kept as $folder) {
            $folder_id = $folder['id'];

            $sql = "INSERT INTO where_kept (info_id, folders_id) VALUES ($entry_id, $folder_id);";

            $sql_result = $db->query($sql);
        }
    }

    public function getLastEntry ($db) {
        $sql = "SELECT MAX(id) FROM info;";
        $sql_result = $db->query($sql);

        $last_entry_id = $sql_result->fetchColumn();
        return $last_entry_id;
    }

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

        $entries = [];
        return $entries;
    }

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

    public function store()
    {
        //inserting into info table
        $sql = "INSERT INTO info (first_name, last_name, tooth_number, restoration_type, original_restoration_date, last_photo_date, restoration_age, note) VALUES ('$first_name', '$last_name', '$tooth_number', '$restoration_type', ?, ?, ?, '$note');";

        $last_entry_id = getLastEntry($db);

        //inserting into where_kept table
        foreach ($where_kept as $folder_id) {
            $sql = "INSERT INTO where_kept (info_id, folders_id) VALUES ($last_entry_id, $folder_id);";
            $sql_result = $db->query($sql);
        }
    }

    public function destroy($id)
    {
        Entry::find($id)->delete();
    }

}
