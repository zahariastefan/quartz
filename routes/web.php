<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Angajatis;
use App\Http\Resources\AngajatisResource;
use App\Http\Resources\AngajatisCollection;
use App\Http\Controllers\Tabel;
use App\Http\Controllers\AjaxController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tabel', [Tabel::class, 'show']);

Route::any('/ajax', function(){
    return AjaxController::ajax();
});

Route::get('/angajat/{id}', function ($id) {
    return new AngajatisResource(Angajatis::find($id));
});


Route::get('/angajati', function () {
    $paginated = Angajatis::paginate(15);
    return AngajatisResource::collection($paginated);
});


Route::get('/tabel-react', function () {
    return view('tabel-react');
});

Route::get('/salarii-departament', [Tabel::class, 'salariiDepartamentApi']);

