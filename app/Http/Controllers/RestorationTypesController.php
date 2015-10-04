<?php

namespace App\Http\Controllers;

use App\Models\RestorationType;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RestorationTypesController extends Controller
{

    public function index () {
        return RestorationType::get();
    }

}
