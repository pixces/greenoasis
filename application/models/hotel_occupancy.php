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

    public function fetchOne(){

        if ($this->hotel_tariff_id){
            $this->where('hotel_tariff_id',$this->hotel_tariff_id);
        }
        if ($this->occupancy_type){
            $this->where('occupancy_type',$this->occupancy_type);
        }
        parent::fetchOne();
        //return $this;
    }

}
