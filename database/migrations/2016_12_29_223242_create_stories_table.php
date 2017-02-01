<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('rounds');
            $table->integer('max_writers');
            $table->integer('num_of_writers');
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('stories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeign('stories_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('stories');
    }
}
