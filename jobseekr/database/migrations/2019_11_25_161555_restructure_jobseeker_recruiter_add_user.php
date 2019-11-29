<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestructureJobseekerRecruiterAddUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->string('phone', 12);
            $table->string('email', 75);
            $table->string('password', 191);
            $table->string('remember_token', 191);
            $table->enum('role', ['recruiter', 'jobseeker', 'admin']);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            $table->unique(['phone', 'role']);
            $table->unique(['email', 'role']);
        });

        Schema::table('recruiter', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('is_deleted');
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('jobseeker', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('is_deleted');
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
        Schema::dropIfExists('user');

        Schema::table('recruiter', function (Blueprint $table) {
            $table->string('name', 50)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('email', 75)->nullable();
            $table->string('password', 191)->nullable();
            $table->boolean('is_deleted')->default(false);

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('jobseeker', function (Blueprint $table) {
            $table->string('name', 50)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('email', 75)->nullable();
            $table->string('password', 191)->nullable();
            $table->boolean('is_deleted')->default(false);

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
