<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Folder;
use App\Models\RestorationType;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JavaScript;

class PagesController extends Controller
{

    public function home()
    {
        JavaScript::put([
            'restorationTypes' => RestorationType::get(),
            'folders' => Folder::get(),
            'entries' => Entry::get()
        ]);

        return view('home');
    }

}
