<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public static function ajax()
    {
        $data = $_POST['sortBy'];
        return view('salary-sorted', [
        ]);
    }
}
