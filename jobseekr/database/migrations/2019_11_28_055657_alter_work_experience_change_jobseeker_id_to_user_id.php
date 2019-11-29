<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWorkExperienceChangeJobseekerIdToUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_experience', function (Blueprint $table) {
            $table->dropForeign('job_experience_jobseeker_id_foreign');
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
        Schema::table('work_experience', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user');

            $table->bigInteger('jobseeker_id')->unsigned();
            $table->foreign('jobseeker_id')->references('id')->on('jobseeker');
        });
    }
}
