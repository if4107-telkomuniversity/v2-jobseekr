<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJob extends Migration
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
            $table->string('name')->index();
            $table->string('employment_type');
            $table->string('job_summary');
            $table->string('min_qualification');
            $table->string('position');
            $table->string('expire_date');
            $table->string('salary')->index();
            $table->string('company_id');
            $table->string('category_id');
            $table->string('industry_id');
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
        //
    }
}
