<?php

class GameController extends BaseController {

    public function anyIndex () {
        return 'game-index';
    }
    public function anyUni ($id=0) {
        $id = (int)$id;
        $uni = Universe::find($id);
        if ($uni) {
            return View::make('game.game',array('universe'=>$uni));
        } else {
            return 'game-invalid';
        }
    }
    public function anyMap ($id=0) {
        $id = (int)$id;
        $uni = Universe::find($id);
        if ($uni) {
            return View::make('game.map',array('universe'=>$uni));
        } else {
            return 'game-invalid';
        }
    }
    public function missingMethod($parameters = array()) {
        return 'game-404';
    }
}
