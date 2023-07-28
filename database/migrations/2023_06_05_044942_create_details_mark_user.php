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
        Schema::create('details_mark_user', function (Blueprint $table) {
            $table->id();

            $table->json('gpa_grade_11');
            $table->json('gpa_grade_12');
            $table->json('gpa_semeter_1_grade_12');
            $table->integer('admission_plan');
            $table->integer('language_certificate_id');
            $table->json('priority_major_1');
            $table->json('priority_major_2');
            $table->json('priority_major_3');

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
        Schema::dropIfExists('details_mark_user');
    }
};
