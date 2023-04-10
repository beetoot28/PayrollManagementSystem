<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->id('payroll_details_id');
            // $table->unsignedBigInteger('payroll_id');
            // $table->foreign('payroll_id')->references('payroll_id')->on('payrolls');
            $table->unsignedBigInteger('cutoff_id');
            $table->foreign('cutoff_id')->references('cutoff_id')->on('cutoffs');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->unsignedBigInteger('attendance_id');
            $table->foreign('attendance_id')->references('attendance_id')->on('attendances');
            $table->decimal('working_hours', 8, 2)->nullable();
            $table->decimal('working_hours_overtime', 8, 2)->nullable();
            $table->integer('holiday_type')->nullable();
            $table->boolean('is_restday')->nullable();
            $table->boolean('is_work')->nullable();
            $table->decimal('pay')->nullable();
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
        Schema::dropIfExists('payroll_details');
    }
}
