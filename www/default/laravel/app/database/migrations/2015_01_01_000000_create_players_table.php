<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration {

    public function up() {
        Schema::create('players', function($table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('universe_id')->unsigned();
            $table->foreign('universe_id')->references('id')->on('universes')->onDelete('cascade');
            $table->string('name');
            $table->integer('faction_id')->unsigned();
            $table->foreign('faction_id')->references('id')->on('factions');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');

            $table->unique(array('user_id','universe_id'));
            $table->unique(array('name','universe_id'));
        });
    }

    public function down() {
        Schema::drop('players');
    }
}
