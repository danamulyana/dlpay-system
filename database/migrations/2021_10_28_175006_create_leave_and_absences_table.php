<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveAndAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_and_absences', function (Blueprint $table) {
            $table->id();
            $table->enum('category',['payroll deductions','salary increase'])->comment('payroll deductions(pemotongan),salary increase(penambahan)');
            $table->string('remark')->comment('keterangan');
            $table->integer('value_1A')->default(0);
            $table->integer('value_1B')->default(0);
            $table->integer('value_1C')->default(0);
            $table->integer('value_1D')->default(0);
            $table->integer('value_1E')->default(0);
            $table->integer('value_1F')->default(0);
            $table->integer('value_2A')->default(0);
            $table->integer('value_2B')->default(0);
            $table->integer('value_2C')->default(0);
            $table->integer('value_2D')->default(0);
            $table->integer('value_2E')->default(0);
            $table->integer('value_2F')->default(0);
            $table->integer('value_3A')->default(0);
            $table->integer('value_3B')->default(0);
            $table->integer('value_3C')->default(0);
            $table->integer('value_3D')->default(0);
            $table->integer('value_3E')->default(0);
            $table->integer('value_3F')->default(0);
            $table->integer('value_4A')->default(0);
            $table->integer('value_4B')->default(0);
            $table->integer('value_4C')->default(0);
            $table->integer('value_4D')->default(0);
            $table->integer('value_4E')->default(0);
            $table->integer('value_4F')->default(0);
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
        Schema::dropIfExists('leave_and_absences');
    }
}
