<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruiterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 75)->unique();
            $table->string('password', 191);
            $table->string('name', 50);
            $table->string('phone', 12);
            $table->integer('company_id')->unsigned();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

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
        Schema::dropIfExists('recruiter');
    }
}
