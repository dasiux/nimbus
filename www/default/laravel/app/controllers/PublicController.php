<?php

class PublicController extends BaseController {

    public function anyIndex () {
        $universes = Universe::all();
        $changelogs = false;
        if (Auth::check()) {$changelogs = Changelog::orderBy('dated_at','DESC')->get();}
        return View::make('public.index',array(
            'changelogs'=>$changelogs,
            'universes'=>$universes
        ));
    }
    public function missingMethod($parameters = array()) {
        return View::make('public.errors.404');
    }
}
