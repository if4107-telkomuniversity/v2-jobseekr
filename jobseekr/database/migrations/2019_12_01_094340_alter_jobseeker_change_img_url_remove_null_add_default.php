<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterJobseekerChangeImgUrlRemoveNullAddDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $defaultValue = '/img/profile/default.png';

        DB::table('jobseeker')->update(['img_url' => $defaultValue]);
        
        Schema::table('jobseeker', function (Blueprint $table) use($defaultValue) {
            $table->string('img_url')->nullable(false)->default($defaultValue)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobseeker', function (Blueprint $table) {
            $table->string('img_url')->nullable()->default(null)->change();
        });
    }
}
