<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions_times', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('active')->default(true);
            $table->string('start_time');
            $table->string('end_time');
            $table->string('start_date');
            $table->string('end_date');

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
        Schema::dropIfExists('admissions_time');
    }
};
