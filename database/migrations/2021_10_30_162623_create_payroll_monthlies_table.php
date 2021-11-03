<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollMonthliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_monthlies', function (Blueprint $table) {
            $table->id();
            $table->string('Transaction_id')->unique();
            $table->foreignId('user_id')->constrained('memployees')->onDelete('cascade');
            $table->string('salary_deductions')->nullable();
            $table->string('salary_increase')->nullable();
            $table->string('overtime')->nullable();
            $table->integer('salary_payment');
            $table->integer('basic_payment');
            $table->integer('total_payment');
            $table->boolean('Approve')->default(false);
            $table->string('month')->nullable();
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
        Schema::dropIfExists('payroll_monthlies');
    }
}
