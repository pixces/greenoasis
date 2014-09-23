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

        $pkgType = isset($this->_request['queryString'][0]) ? $this->_request['queryString'][0] : Package::TYPE_HOLIDAY;
        $packages = array(
            Package::TYPE_HOLIDAY => array('label'=>'Holiday Package', 'data'=>array()),
            Package::TYPE_TOURS =>  array('label'=>'Tour Package', 'data'=>array()),
            Package::TYPE_COMBO =>  array('label'=>'Combo Offers', 'data'=>array()),
        );

        //get all packages
        $packageModel = new Package();

        switch($pkgType){
            case Package::TYPE_COMBO:
                $packages[Package::TYPE_COMBO]['data'] = $packageModel->fetchAll(Package::TYPE_COMBO);
                break;
            case Package::TYPE_TOURS:
                $packages[Package::TYPE_TOURS]['data'] = $packageModel->fetchAll(Package::TYPE_TOURS);
                break;
            case Package::TYPE_HOLIDAY:
                default:
                $packages[Package::TYPE_HOLIDAY]['data'] = $packageModel->fetchAll(Package::TYPE_HOLIDAY);
                break;
        }
        $this->set('packageList',$packages);
    }

    public function view(){
        $request = $this->_request;

        if (!$request['pid'] || empty($request['pid'])){
            //debug_print_backtrace();
            header('This is not the page you are looking for', true, 404);
            $this->setTemplate('404');
            exit();
        }

        $model = new Package();
        $id = $this->_request['pid'];
        $packageDet = $model->getById($id);

        if ($packageDet){
            $this->set('package',$packageDet);
        } else {
            header('This is not the page you are looking for', true, 404);
            $this->setTemplate('404');
            exit();
        }
    }
}
