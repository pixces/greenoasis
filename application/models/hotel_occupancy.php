<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 09/03/14
 * Time: 10:11 PM
 * To change this template use File | Settings | File Templates.
 */ 
class Hotel_Occupancy extends Model {

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function saveAll($entities){

        if(!is_array($entities)){
            return false;
        }

        foreach($entities as $entity){
            $this->setAttributes($entity);
            if ( !parent::save() ){
                return false;
            }
        }
        return true;
    }

}
