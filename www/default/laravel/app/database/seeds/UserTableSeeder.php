<?php

class UserTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            array('email'=>'me@siux.info','password'=>Hash::make('lala'),'name'=>'siux','admin'=>true)
        ));
    }
}
