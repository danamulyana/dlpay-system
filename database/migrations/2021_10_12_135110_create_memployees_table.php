<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memployees', function (Blueprint $table) {
            $table->id('id');
            $table->string('nip')->comment('Nomor Induk Pegawai')->unique();
            $table->string('rfid_number')->unique();
            $table->string('fingerprint')->unique()->nullable();
            $table->enum('attendance_type',[1,2]);
            $table->integer('user_DoorTime')->default(5);
            $table->string('nama');
            $table->string('job_title');
            $table->string('alamat')->nullable();
            $table->string('noHandphone')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreignId('departement_id')->constrained('mdepartements')->onDelete('cascade');
            $table->foreignId('subdepartement_id')->constrained('msubdepartements')->onDelete('cascade');
            $table->enum('payment_mode',['weekly','monthly']);
            $table->integer('basic_salary');
            $table->enum('transfer_type',[1,2])->comment('Kalo 1 maka tanpa bank kalo 2 pake bank');
            $table->string('bank_name')->nullable()->comment('nama pemilik rekening');
            $table->string('bank_account')->nullable()->comment('nama Bank');
            $table->string('credited_accont')->unique()->nullable()->comment('nomer rekening');
            $table->enum('pph_type',['pemerintah','perusahaan'])->nullable();
            $table->string('pph_pemerintahan')->nullable()->comment('pajak pemerintah');
            $table->string('pph_perusahaan')->nullable()->comment('pajak perusahaan');
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
        Schema::dropIfExists('memployees');
    }
}
