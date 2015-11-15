<?php

use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sessions', function($t) {
            $t->engine = 'MYISAM';
            $t->string('id',128)->unique();
            $t->text('payload');
            $t->integer('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sessions');
    }

}
