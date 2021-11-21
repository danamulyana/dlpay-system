<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryDeviceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_device_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->foreignId('user_id')->constrained('memployees')->onDelete('cascade');
            $table->string('keterangan');
            $table->boolean('is_attendance')->default(false);
            $table->string('remark_log')->nullable();
            $table->integer('count_access')->default(0);
            $table->string('createdBy')->nullable();
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
        Schema::dropIfExists('history_device_logs');
    }
}
