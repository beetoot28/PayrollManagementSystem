<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_payments', function (Blueprint $table) {
            $table->id('loan_payment_id');
            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id')->references('loan_id')->on('loans');
            $table->unsignedBigInteger('cutoff_id');
            $table->foreign('cutoff_id')->references('cutoff_id')->on('cutoffs');
            $table->decimal('amount', 6, 2);
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
        Schema::dropIfExists('loan_payments');
    }
}
