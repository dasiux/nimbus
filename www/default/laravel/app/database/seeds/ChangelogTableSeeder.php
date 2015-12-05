<?php

class ChangelogTableSeeder extends Seeder {
    public function run() {
        DB::table('changelog')->delete();

        DB::table('changelog')->insert(array(
            array('user_id'=>1,'dated_at'=>'2015-11-15','commit'=>"7140f0d",'notice'=>"Setup base interface."),
            array('user_id'=>1,'dated_at'=>'2015-11-19','commit'=>"f562137",'notice'=>"Infrastructure."),
        ));
    }
}
