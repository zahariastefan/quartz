<?php

namespace App\Http\Controllers;

use App\Models\Angajatis;
use App\Models\Departamentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class Tabel extends Controller
{
    /**
     * @return View
     */
    public function show(Request $request)
    {
        $searchTerm = $request->input('searchTerm', '');
        $sortBy = $request->input('sortBy', '');

        $angajati = DB::table('angajatis');
        $departments = DB::table('departamentes');
        $averageSalaryByDepart = [];
        foreach ($departments->get()->toArray() as $department) {
            $idDepartment = $department->id;
            $listAllEmployeeFromADepart = Angajatis::where('id_departament',$idDepartment)->get();
            $listAllSalaryByDepart = [];
            foreach ($listAllEmployeeFromADepart as $singleEmployee) {
                $listAllSalaryByDepart[] = $singleEmployee->salariu;
            }
            if(count($listAllSalaryByDepart) == 0){
                throw new InternalErrorException('Count list is Zero, something wrong');
            }

            $averageSalary = array_sum($listAllSalaryByDepart) / count($listAllSalaryByDepart);
            $averageSalaryByDepart[$department->nume] = number_format($averageSalary, 0);
        }

        if(!empty($searchTerm)){
            $angajati = Angajatis::where('nume', 'like', '%'.$searchTerm.'%');
        }

        if(!empty($sortBy)){
            $angajati = Angajatis::orderBy('nume',$sortBy);
        }

        if(!empty($searchTerm) && !empty($sortBy) ){
            $angajati = Angajatis::where('nume', 'like', '%'.$searchTerm.'%')->orderBy('nume',$sortBy);
        }



        return view('tabel', [
            'angajati' => $angajati->paginate(15),
            'averageSalaryByDepart' => $averageSalaryByDepart
        ]);
    }

    public function salariiDepartamentApi(Request $request)
    {
        $departments = DB::table('departamentes');
        $averageSalaryByDepart = [];
        foreach ($departments->get()->toArray() as $department) {
            $idDepartment = $department->id;
            $listAllEmployeeFromADepart = Angajatis::where('id_departament',$idDepartment)->get();
            $listAllSalaryByDepart = [];
            foreach ($listAllEmployeeFromADepart as $singleEmployee) {
                $listAllSalaryByDepart[] = $singleEmployee->salariu;
            }
            if(count($listAllSalaryByDepart) == 0){
                throw new InternalErrorException('Count list is Zero, something wrong');
            }

            $averageSalary = array_sum($listAllSalaryByDepart) / count($listAllSalaryByDepart);

            $averageSalaryByDepart[]  = ['nume' => $department->nume, 'salariu' => number_format($averageSalary, 0)] ;
        }

        return $averageSalaryByDepart;
    }

}
