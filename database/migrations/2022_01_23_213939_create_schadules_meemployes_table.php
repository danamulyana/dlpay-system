<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchadulesMeemployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schadules_meemployes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schadules_id');
            $table->unsignedBigInteger('memployes_id');

            $table->foreign('schadules_id')
                ->references('id')
                ->on('schadules')
                ->onDelete('cascade');
            $table->foreign('memployes_id')
                ->references('id')
                ->on('memployees')
                ->onDelete('cascade');
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
        Schema::dropIfExists('schadules_meemployes');
    }
}
