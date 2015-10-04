<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Traits\ForCurrentUserTrait;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FoldersController extends Controller
{
    use ForCurrentUserTrait;

    public function getFolders ($entry_id) {

        $folders = DB::table('where_kept')
            ->where('entry_id', $entry_id)
            ->join('folders', 'folders_id', '=', 'folders.id')
            ->get();

        return $folders;
    }

    public function index () {
        return Folder::get();
    }
}
