<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryWritersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_writers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('story_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('on_turn');
            $table->integer('round');
            $table->timestamps();
        });

        Schema::table('story_writers', function (Blueprint $table) {
            $table->foreign('story_id')->references('id')->on('stories');
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
        Schema::table('story_writers', function (Blueprint $table) {
            $table->dropForeign('story_writers_story_id_foreign');
            $table->dropColumn('story_id');

            $table->dropForeign('story_writers_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('story_writers');
    }
}
