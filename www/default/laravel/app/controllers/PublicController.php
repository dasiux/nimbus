<?php

class PublicController extends BaseController {

    public function anyIndex () {
        // List universes
        $universes = Universe::all();
        // Changelog info
        $changelogs = false;
        if (Auth::check()&&Auth::user()->admin) {$changelogs = Changelog::orderBy('dated_at','DESC')->get();}
        // View
        return View::make('public.index',array(
            'changelogs'=>$changelogs,
            'universes'=>$universes
        ));
    }
    public function missingMethod($parameters = array()) {
        return View::make('public.errors.404');
    }
}
