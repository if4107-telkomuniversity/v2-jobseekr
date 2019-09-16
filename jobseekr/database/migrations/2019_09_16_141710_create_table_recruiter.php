<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecruiter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('password');
            $table->string('username');
            $table->string('address');
            $table->string('phoneNumber');
            $table->string('company_id');
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
