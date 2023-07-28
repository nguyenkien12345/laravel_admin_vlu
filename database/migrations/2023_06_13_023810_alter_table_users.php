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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique();
            $table->boolean('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->integer('ethnicity_code')->nullable();
            $table->integer('religion_code')->nullable();
            $table->string('identity_number')->unique()->nullable();
            $table->string('candidate_number')->nullable();
            $table->string('country_code')->nullable();
            $table->json('permanent_address')->nullable();
            $table->json('temporary_address')->nullable();
            $table->string('reference_email')->nullable();
            $table->string('reference_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
