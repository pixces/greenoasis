<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 22/02/14
 * Time: 2:57 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Package_Rate extends Model {

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function saveAll($data,$id){

        foreach($data as $aRates){
            if (!empty($aRates['price'])){
                $aRates['package_id'] = $id;
                $this->setAttributes($aRates);
                $this->save();
            }
        }
    }

}
