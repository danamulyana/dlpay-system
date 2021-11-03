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
            $table->integer('persentation')->default(0);
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
