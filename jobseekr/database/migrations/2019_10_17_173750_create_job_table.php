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
            $table->bigIncrements('id');
            $table->text('summary');
            $table->string('name', 191);
            $table->integer('salary')->unsigned();
            $table->enum('type', ['internship', 'full_time', 'part_time']);
            $table->enum('min_qualification', [
                'not_specified',
                'high_school',
                'diploma',
                'bachelor',
                'master',
                'doctor'
            ]);
            $table->integer('company_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->date('expired_at');
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
