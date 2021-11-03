<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->foreignId('user_id')->constrained('memployees')->onDelete('cascade');
            $table->string('jam_masuk');
            $table->string('jam_masuk_photo_path', 2048)->nullable();
            $table->string('jam_Keluar')->nullable();
            $table->string('jam_Keluar_photo_path', 2048)->nullable();
            $table->integer('overtime')->default(0);
            $table->string('createdBy')->nullable();
            $table->string('updatedBy')->nullable();
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
        Schema::dropIfExists('collect_attendances');
    }
}
