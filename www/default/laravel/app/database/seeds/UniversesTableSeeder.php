<?php

class UniversesTableSeeder extends Seeder {
    public function run() {
        DB::table('universes')->delete();

        DB::table('universes')->insert(array(
            array('name'=>"Universe Development 1"),
            array('name'=>"Universe Development 2")
        ));
    }
}
