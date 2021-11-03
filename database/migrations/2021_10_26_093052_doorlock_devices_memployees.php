<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoorlockDevicesMemployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doorlock_has_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('memployes_id');
            $table->unsignedBigInteger('doorlock_id');

            $table->foreign('memployes_id')
                ->references('id')
                ->on('memployees')
                ->onDelete('cascade');
            $table->foreign('doorlock_id')
                ->references('id')
                ->on('doorlock_devices')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doorlock_has_employees');
    }
}
