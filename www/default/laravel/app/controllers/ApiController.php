<?php

abstract class ApiController extends \BaseController {

    /* Set to NULL for no default */
    protected static $defaultCallback = 'null';

    /* Get jsonp callback */
    protected static function jsonpCallback () {
        $cb = Input::get('callback',self::$defaultCallback);
        if (is_string($cb)&&strtolower($cb)=='null') {$cb = NULL;}
        return $cb;
    }
    /* Handle errors */
    protected static function returnError ($code,$message) {
        return Response::json(array('error'=>array('code'=>$code,'message'=>$message)), $code)->setCallback(self::jsonpCallback());
    }
    protected static function return501 () {
        return self::returnError(501,'Not Implemented');
    }
    /* Handle output */
    protected static function returnJson ($json,$code=200) {
        return Response::json($json, $code)->setCallback(self::jsonpCallback());
    }
    protected function getUniqueHashForModel ($model,$column) {
        do {
            $hash = $this->getHash();
            $test = $model::where($column, '=', $hash)->first();
        } while ($test);
        return $hash;
    }
    protected function getHash () {
        return uniqid(md5(gethostname().time()));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return self::return501();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return self::return501();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        return self::return501();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return self::return501();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id = 0) {
        return self::return501();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id = 0) {
        return self::return501();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id = 0) {
        return self::return501();
    }

    /**
     * Resource method not implemented.
     *
     * @param  any $parameters
     * @return Response
     */
    public function missingMethod($parameters = array()) {
        return self::returnError(500,'Internal Server Error');
    }
}
