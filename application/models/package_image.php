<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 22/09/13
 * Time: 1:36 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Package_Image extends Model{

    var $hasOne = array('Package' => 'Package');

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function findAll(){

    }

    public function findByPackage($id){

        $this->showHasOne();
        $this->where('package_id',$id);

        $result = $this->search();

        if ($result){
            $imageList = array();
            $packageDet = array();
            foreach($result as $imageSet){
                $imageList[] = $imageSet['Package_Image'];
                if($imageSet['Package']['id'] == $id) {
                    $packageDet[$imageSet['Package']['id']] = $imageSet['Package'];
                }
            }
            return array('Package_image'=>$imageList,'Package'=>$packageDet);
        } else {
            return false;
        }
    }


}
