<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('url')->unique();
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('approved')->default(0);
            $table->boolean('verified')->default(0);
            $table->boolean('promoted')->default(0);
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
        Schema::dropIfExists('games');
    }
}
