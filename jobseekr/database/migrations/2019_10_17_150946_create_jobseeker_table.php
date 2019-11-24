<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobseekerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobseeker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 75)->unique();
            $table->string('password', 191);
            $table->string('name', 50);
            $table->string('address', 200)->nullable();
            $table->string('phone', 12)->nullable()->unique();
            $table->string('summary', 200)->nullable();
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('jobseeker');
    }
}
