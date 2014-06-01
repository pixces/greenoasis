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
        $request = $this->_request;
        if (!$request['pid'] || empty($request['pid'])){

            //debug_print_backtrace();
            header('This is not the page you are looking for', true, 404);
            $this->setTemplate('404_page.php');
            exit();
        }

        $model = new Package();
        $id = $this->_request['pid'];
        $packageDet = $model->getById($id);
        $this->set('package',$packageDet);
    }



}
