<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 75);
            $table->string('address', 150);
            $table->string('city', 50)->index();
            $table->string('website')->nullable();
            $table->string('about', 500);
            $table->integer('industry_id')->unsigned();
            $table->string('img_name', 80);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            
            $table->foreign('industry_id')->references('id')->on('industry');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
