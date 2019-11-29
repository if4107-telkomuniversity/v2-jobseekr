<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCvAndResumeChangeJobseekerIdToUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cv', function (Blueprint $table) {
            $table->dropForeign(['jobseeker_id']);
            $table->dropColumn('jobseeker_id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('resume', function (Blueprint $table) {
            $table->dropForeign(['jobseeker_id']);
            $table->dropColumn('jobseeker_id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cv', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user');

            $table->bigInteger('jobseeker_id')->unsigned();
            $table->foreign('jobseeker_id')->references('id')->on('jobseeker');
        });

        Schema::table('resume', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user');

            $table->bigInteger('jobseeker_id')->unsigned();
            $table->foreign('jobseeker_id')->references('id')->on('jobseeker');
        });
    }
}
