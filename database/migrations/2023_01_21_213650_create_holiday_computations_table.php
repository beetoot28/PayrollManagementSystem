<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayComputationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_computations', function (Blueprint $table) {
            $table->id('computation_id');
            $table->String('computation_field1')->nullable();
            $table->String('computation_field2')->nullable();
            $table->String('computation_field3')->nullable();
            $table->String('computation_field4')->nullable();
            $table->String('computation_field5')->nullable();
            $table->String('computation_field6')->nullable();
            $table->String('computation_field7')->nullable();
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
        Schema::dropIfExists('holiday_computations');
    }
}
