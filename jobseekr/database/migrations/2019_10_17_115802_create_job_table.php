<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position', 50);
            $table->string('summary', 1000);
            $table->enum('employment_type', ['full_time', 'part_time', 'intern']);
            $table->enum('min_education', ['high_school', 'bachelor', 'master', 'doctorate'])->nullable();
            $table->date('expire_date');
            $table->integer('salary')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('category_id')->references('id')->on('job_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job');
    }
}
