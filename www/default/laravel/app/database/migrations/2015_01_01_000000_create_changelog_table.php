<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangelogTable extends Migration {

    public function up() {
        Schema::create('changelog', function($table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->integer('user_id')->default(1);
            $table->date('dated_at');
            $table->string('commit',64)->unique();
            $table->text('notice');
        });
    }

    public function down() {
        Schema::drop('changelog');
    }
}
