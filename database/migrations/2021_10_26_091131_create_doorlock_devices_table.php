<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorlockDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doorlock_devices', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('name');
            $table->foreignId('location_id')->constrained('data_locations')->onDelete('cascade');
            $table->foreignId('departement_id')->constrained('mdepartements')->onDelete('cascade');
            $table->enum('type',['restricted','public'])->default('public');
            $table->enum('access_type',['in','out']);
            $table->boolean('access_mode')->default(false);
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
        Schema::dropIfExists('doorlock_devices');
    }
}
