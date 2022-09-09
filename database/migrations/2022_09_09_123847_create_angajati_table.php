<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angajatis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_departament')->constrained('departamentes');
            $table->string('nume');
            $table->string('prenume');
            $table->bigInteger('cnp');
            $table->string('functie');
            $table->string('salariu');
            $table->integer('zile_concediu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angajatis');
    }
};
