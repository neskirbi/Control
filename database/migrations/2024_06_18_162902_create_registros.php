<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_medico',32);

            $table->datetime('checkin');  
            $table->string('latin',20);
            $table->string('lonin',20);  

            $table->datetime('checkout');
            $table->string('latout',20);
            $table->string('lonout',20);

            $table->string('in',1)->default(0);
            $table->string('out',1)->default(0);

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
        Schema::dropIfExists('registros');
    }
}
