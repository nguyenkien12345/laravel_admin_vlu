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
        Schema::create('details_user', function (Blueprint $table) {
            $table->id();

            $table->integer('graduation_year');
            $table->integer('type_academic_grade_12');
            $table->integer('type_conduct_grade_12');
            $table->string('type_curriculum_grade_12');
            $table->integer('province_code');
            $table->integer('district_code');
            $table->integer('school_code');
            $table->integer('class_name_grade_12');
            $table->integer('area_code');
            $table->integer('priority_user');

            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('details_user');
    }
};
