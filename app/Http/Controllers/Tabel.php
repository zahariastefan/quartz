<?php

namespace App\Http\Controllers;

use App\Models\Angajatis;
use App\Models\Departamentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Tabel extends Controller
{
    /**
     * @return View
     */
    public function show(Request $request)
    {
        $searchTerm = $request->input('searchTerm', '');
        if(!empty($searchTerm)){
            $angajati = Angajatis::where('nume', 'like', '%'.$searchTerm.'%')->paginate(5);
        }else{
            $angajati = Angajatis::paginate(15);
        }
        return view('tabel', [
            'angajati' => $angajati
        ]);
    }
}
