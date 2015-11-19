<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactionsTable extends Migration {

    public function up() {
        Schema::create('factions', function($table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->string('name')->unique();
        });
    }

    public function down() {
        Schema::drop('factions');
    }
}
