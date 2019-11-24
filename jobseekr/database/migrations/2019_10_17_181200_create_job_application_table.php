<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('jobseeker_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->string('summary', 200);
            $table->integer('cv_id')->unsigned();
            $table->integer('resume_id')->unsigned();
            $table->boolean('is_accepted')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            $table->unique(['jobseeker_id', 'job_id']);
            $table->foreign('jobseeker_id')->references('id')->on('jobseeker');
            $table->foreign('job_id')->references('id')->on('job');
            $table->foreign('cv_id')->references('id')->on('cv');
            $table->foreign('resume_id')->references('id')->on('resume');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application');
    }
}
