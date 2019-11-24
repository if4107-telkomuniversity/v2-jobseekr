<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmittedExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_experience', function (Blueprint $table) {
            $table->bigInteger('job_application_id')->unsigned();
            $table->integer('job_experience_id')->unsigned();
            $table->timestamps();

            $table->primary(['job_application_id', 'job_experience_id'], 'application_experience_relation');
            $table->foreign('job_application_id')->references('id')->on('job_application');
            $table->foreign('job_experience_id')->references('id')->on('job_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submitted_experience');
    }
}
