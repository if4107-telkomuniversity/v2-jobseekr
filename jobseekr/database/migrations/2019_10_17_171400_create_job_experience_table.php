<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('jobseeker_id')->unsigned();
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('company_name', 50)->nullable();
            $table->string('position', 30);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('jobseeker_id')->references('id')->on('jobseeker');
            $table->foreign('company_id')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_experience');
    }
}
