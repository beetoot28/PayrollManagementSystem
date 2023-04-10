<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->integer('employee_no');
            $table->foreign('employee_no')->references('employee_code')->on('employees');
            $table->unsignedBigInteger('cutoff_id');
            $table->foreign('cutoff_id')->references('cutoff_id')->on('cutoffs');
            $table->integer('account_no');
            $table->text('number')->nullable();
            $table->date('date_in')->nullable();
            $table->string('time_in_am')->nullable();
            $table->string('time_out_am')->nullable();
            $table->string('time_in_pm')->nullable();
            $table->string('time_out_pm')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
