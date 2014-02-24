<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 22/02/14
 * Time: 2:58 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Package_Time extends Model {

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function saveAll($data,$id){

        foreach($data as $aTime){
            if (!empty($aTime['duration'])){
                $aTime['package_id'] = $id;
                $this->setAttributes($aTime);
                $this->save();
            }
        }
    }

}
