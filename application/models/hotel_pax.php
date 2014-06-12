<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 09/03/14
 * Time: 10:11 PM
 * To change this template use File | Settings | File Templates.
 */
class Hotel_Pax extends Model {

    var $hasOne = array('Hotel_Reservations' => 'Hotel_Reservations');

    public function getById() {
        // TODO: Implement getById() method.
    }

    public function getCustomerSummary($id) {
        $sQl = 'SELECT *  FROM `' . $this->_table . '` where `reservation_id` = ' . $id;
        $res = $this->custom($sQl);
        if ($res) {
            return $res[0]['Hotel_paxis']['first_name'] . '' . $res[0]['Hotel_paxis']['last_name'];
        }

        return;
    }

}
