<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 09/03/14
 * Time: 10:11 PM
 * To change this template use File | Settings | File Templates.
 */ 
class Hotel_Reservation extends Model {

    var $hasOne = array('Hotel' => 'Hotel', 'Hotel_Tariff' => 'Hotel_Tariff');

    public function getById()
    {
        if (!$this->id){
            return false;
        }

        $this->showHasOne();
        return $this->search();
    }



}
