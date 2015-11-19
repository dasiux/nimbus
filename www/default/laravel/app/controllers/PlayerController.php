<?php

class PlayerController extends ApiController {

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
