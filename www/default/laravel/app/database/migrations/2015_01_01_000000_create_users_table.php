<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    public function up() {
        Schema::create('users', function($table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->string('name',64)->unique();
            $table->string('email',128)->unique();
            $table->string('password', 64);
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('users');
    }
}
