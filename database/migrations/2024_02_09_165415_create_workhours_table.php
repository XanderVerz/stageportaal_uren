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
        Schema::create('workhours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gebruiker_id')->constrained('users');
            $table->date('datum');
            $table->time('start_tijd');
            $table->time('eind_tijd');
            $table->decimal('pauze', 8, 2)->nullable()->default(0); 
            $table->boolean('vrije_dag')->default(false);
            $table->string('taken')->nullable();
            $table->string('bijzonderheden')->nullable();
            $table->float('gewerkte_uren'); // Of gebruik decimal('gewerkte_uren', 5, 2) afhankelijk van precisiebehoeften
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
        Schema::dropIfExists('workhours');
    }
};
