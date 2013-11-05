<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 21/09/13
 * Time: 2:09 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Hotel_Tariff extends Model{

    var $hasOne = array('Hotel' => 'Hotel');


    public function getById()
    {
        if(!isset($this->id)){
            return false;
        }

        $this->showHasOne();
        return $this->search();

    }

    public function getSeasons($hotel_id){

        $sQl = "SELECT * FROM `".$this->_table."` WHERE `hotel_id` = '".$hotel_id."' GROUP BY `season_name`";
        $result = $this->custom($sQl);
        if ($result){
            $list = array();
            $t=0;
            foreach($result as $season){
                $seasonName = $season['Hotel_tariff']['season_name'];
                $list[$t++] = array('Season'=>$season['Hotel_tariff'],'Tariff'=> $this->getTariffBySeason($seasonName));
            }
            return $list;
        }
        return false;
    }

    public function getTariffBySeason($season){

        $sQl = "SELECT * FROM `".$this->_table."` WHERE `season_name` = '".$season."'";
        $result = $this->custom($sQl);
        if ($result){
            return $result;
        }
        return false;
    }

    public function saveAll($list){

        if(!is_array($list)){
            return false;
        }

        foreach($list as $tariff){

            foreach($tariff as $field => $value){
                $this->{$field} = $value;
            }
            if ( !parent::save() ){
                return false;
            }
        }
        return true;
    }

}
