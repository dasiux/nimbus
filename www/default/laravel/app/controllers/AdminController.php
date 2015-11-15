<?php

class AdminController extends BaseController {

	public function anyIndex () {
        return View::make('admin.index');
	}

}
