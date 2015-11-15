<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversesJoinedTable extends Migration {

    public function up() {
        Schema::create('universes_users', function($table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('universe_id');
        });
    }

    public function down() {
        Schema::drop('universes');
    }
}
