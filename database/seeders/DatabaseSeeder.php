<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\AngajatisFactory;
use Illuminate\Database\Seeder;
use App\Models\Departamentes;
use App\Models\Angajatis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arrayDepartamente = ['finante' => 'Departamentul financiar este cel care primește, așa cum sugerează și numele său, finanțare. Această finanțare trebuie să fie necesară, astfel încât compania să poată acoperi costurile nevoilor sale. În plus, departamentul planifică ceea ce este necesar pentru ca organizația să aibă întotdeauna bani și să își poată face față plăților la timp, având o situație financiară sănătoasă.',
            'IT' => 'Fiind într-o era a internetului considerăm că necesitatea consultanței în acest domeniu și sprijinul companiilor care au nevoie de aceste servici este mai mult decât necesar.',
            'Comitetul director'=>'Asigură punerea în executare a hotărârilor Adunării Generale. El poate fi alcătuit şi din persoane din afara asociaţiei, în limita a cel mult o pătrime din componenţa sa.',
            'resurse umane' => 'Obiectivul departamentului de resurse umane are legătură cu asigurați-vă că grupul uman care lucrează în organizație funcționează corect. Acest departament asigură angajarea celor mai potriviți oameni pentru locul de muncă, prin recrutare, selecție, instruire și dezvoltare.',
            'marketing' => 'Departamentul de marketing colaborează cu departamentul comercial (în unele companii, acestea sunt același departament) pentru obțineți vânzări mai multe și mai buneÎn plus față de asigurarea faptului că clienții sunt tratați corespunzător, invitându-i să solicite din nou produsul sau serviciul oferit de organizație.',
            'commercial' => 'În cazul în care există o diferențiere față de departamentul de marketing, departamentul comercial trebuie să se asigure că obiectivele de afaceri, departamentale și individuale sunt bine definite. Responsabilitatea și autoritatea necesare pentru obținerea rezultatelor ar trebui delegate, în măsura posibilului.',
            'achizitii' => 'Funcția principală a departamentului de achiziții este să achiziționeze materii prime sau piese bune pentru a fi utilizate în fabricație, cu un cost redus, de calitate și, ori de câte ori este posibil, fără defecte de fabricație.',
            'logistica' => 'Departamentul de logistică și operațiuni este considerat unul dintre cele mai importante, deoarece este motorul esențial pentru competitivitatea organizației și dezvoltarea sa economică. Mai mult, pe măsură ce noile tehnologii sunt din ce în ce mai puternice, acest departament devine din ce în ce mai necesar, mai ales la vânzarea produselor pe cale electronică.',
            'control de management' => 'Departamentul de control al managementului este o parte a companiei, creată și susținută de conducere, care îi permite să obțină informațiile necesare și fiabile atunci când ia deciziile operaționale adecvate. <br> Controlul managementului măsoară utilizarea eficientă și permanentă a resurselor organizației, pentru a atinge obiectivele stabilite anterior de conducere.',
            'management' => 'Se poate spune că conducerea generală este șeful companiei. De obicei, în companiile mici, conducerea generală cade pe figura proprietarului, în timp ce în cele mai mari cade asupra mai multor persoane.<br>Acest departament este cel care știe unde merge compania, stabilindu-și obiectivele în ansamblu. Pe baza ei elaborează un plan de afaceri, cu obiective organizaționale și cunoștințe despre organizație în ansamblu pe care le veți folosi pentru luarea deciziilor în situații critice.'
        ];
        $arrayFunctii = [
            'finante'=>'contabil',
            'IT'=>'web developer',
            'Comitetul director'=>'director',
            'resurse umane'=>'recruiter',
            'marketing'=>'marketer',
            'commercial'=>'agent vanzari',
            'achizitii'=>'achizitioner',
            'logistica'=>'logistician',
            'control de management'=>'contolor de manageri',
            'management'=>'manager'
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Angajatis::query()->truncate();
        Departamentes::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $departamentNou = [];
        foreach ($arrayDepartamente as $numeDep => $descriere) {
            $departamentNou[] = Departamentes::factory()->create([
                'nume' => $numeDep,
                'descriere' => $descriere
            ]);
        }

        Angajatis::factory(50000)->create(function () use ($departamentNou,$arrayFunctii) {
            $dep = $departamentNou[array_rand($departamentNou)];
            return [
                'id_departament' => $dep->id,
                'functie' => $arrayFunctii[$dep->nume],
            ];
        });
    }
}
