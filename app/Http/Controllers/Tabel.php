<?php

namespace App\Http\Controllers;

use App\Models\Departamentes;
use Illuminate\View\View;

class Tabel extends Controller
{
    /**
     * @return View
     */
    public function show()
    {
        $departments = Departamentes::all();
//        $allDepartments = [];
//        foreach ($departments as $department) {
////            dd($department->toArray());
//            $allDepartments[]= $department->nume;
//        }
//        dd($allData);

        return view('tabel', [
            'departamente' => $departments
        ]);
    }
}
