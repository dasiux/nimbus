<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversesTable extends Migration {

    public function up() {
        Schema::create('universes', function($table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->string('name',64)->unique();
            $table->text('settings');
        });
    }

    public function down() {
        Schema::drop('universes');
    }
}
