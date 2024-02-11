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
        Schema::create('settings', function (Blueprint $table) {
            $table->foreignId('gebruiker_id')->constrained('users');
            $table->time('start_tijd_standaard');
            $table->time('eind_tijd_standaard');
            $table->Integer('pauze_standaard');
            $table->string('praktijkopleider');
            $table->string('stagebegeleider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
