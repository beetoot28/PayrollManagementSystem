<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id('employee_details_id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->string('block_house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('marital_status');
            $table->integer('no_of_children');
            $table->string('spouse_name');
            $table->string('spouse_occupation');
            $table->text('dependant');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_no');
            $table->string('emergency_contact_address');
            $table->decimal('basic_rate', 6, 2);
            $table->decimal('allowance', 6, 2);
            $table->integer('leave_with_pay');
            $table->boolean('with_ot_pay')->default(true);
            $table->string('department');
            $table->string('position');
            $table->string('employee_history_position')->nullable();
            $table->string('sss_no');
            $table->string('philhealth_no');
            $table->string('tin_no');
            $table->string('hdmf_no');
            $table->date('date_hired');
            $table->date('date_resigned')->nullable();
            $table->string('employment_status');
            $table->decimal('sss_contribution', 7, 2);
            $table->decimal('philhealth_contribution', 7, 2);
            $table->decimal('ef_contribution', 7, 2);
            $table->decimal('hdmf_contribution', 7, 2);
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
        Schema::dropIfExists('employee_details');
    }
}
