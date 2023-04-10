<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id('payroll_id');
            $table->unsignedBigInteger('cutoff_id');
            $table->foreign('cutoff_id')->references('cutoff_id')->on('cutoffs');
            $table->Integer('employee_code');
            $table->foreign('employee_code')->references('employee_code')->on('employees');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->decimal('no_of_workingdays', 8, 2);
            $table->decimal('holiday_pay', 8, 2);
            $table->decimal('overtime_pay', 8, 2);
            $table->decimal('holiday_overtime_pay', 8, 2);
            $table->decimal('absences');
            $table->decimal('absences_amount', 8, 2);
            $table->decimal('late_undertime');
            $table->decimal('late_undertime_pay', 8, 2);
            $table->decimal('gross_pay', 8, 2);
            // $table->decimal('rice_allowance');
            $table->decimal('employees_dr', 8, 2); //
            $table->decimal('dr_to_other_company', 8, 2); //
            $table->decimal('due_from', 8, 2); //
            $table->decimal('total_deductions', 8, 2);
            $table->decimal('total_allowance', 8, 2);
            $table->decimal('leave_pay', 8, 2);
            $table->decimal('net_salary', 8, 2); // with deductions

            $table->unsignedBigInteger('sss_contribution_id')->nullable();;
            $table->foreign('sss_contribution_id')->references('id')->on('sss_contributions');
            $table->unsignedBigInteger('philhealth_contribution_id')->nullable();;
            $table->foreign('philhealth_contribution_id')->references('id')->on('philhealth_contributions');
            $table->unsignedBigInteger('hdmf_contribution_id')->nullable();;
            $table->foreign('hdmf_contribution_id')->references('id')->on('hdmf_contributions');
            $table->unsignedBigInteger('ef_contribution_id')->nullable();;
            $table->foreign('ef_contribution_id')->references('id')->on('ef_contributions');
            $table->string('payroll_cycle');
            $table->boolean('status')->default(false);
            $table->text('remarks');

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
        Schema::dropIfExists('payrolls');
    }
}
