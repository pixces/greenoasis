<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 27/11/13
 * Time: 2:38 AM
 * To change this template use File | Settings | File Templates.
 */ 
class TourController extends Controller {

    public function index(){

    }

    public function view(){

        /*
         * pid  => package Id
         * city => City name
         * pType => package Type {1:tour;2:Combo}
         */
        print_r($this->_request);

    }



}
