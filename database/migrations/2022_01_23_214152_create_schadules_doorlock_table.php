<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchadulesDoorlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schadules_doorlock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schadules_id');
            $table->unsignedBigInteger('doorlock_id');

            $table->foreign('schadules_id')
                ->references('id')
                ->on('schadules')
                ->onDelete('cascade');
            $table->foreign('doorlock_id')
                ->references('id')
                ->on('doorlock_devices')
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
        Schema::dropIfExists('schadules_doorlock');
    }
}
