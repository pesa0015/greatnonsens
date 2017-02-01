<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('words');
            $table->integer('story_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('rows', function (Blueprint $table) {
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
        Schema::table('rows', function (Blueprint $table) {
            $table->dropForeign('rows_story_id_foreign');
            $table->dropColumn('story_id');

            $table->dropForeign('rows_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('rows');
    }
}
