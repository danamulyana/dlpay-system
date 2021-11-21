<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoorlockDevicesMpriset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doorlock_has_priset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('priset_id');
            $table->unsignedBigInteger('doorlock_id');

            $table->foreign('priset_id')
                ->references('id')
                ->on('mprisets')
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
        Schema::dropIfExists('doorlock_has_priset');
    }
}
