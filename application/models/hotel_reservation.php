<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 09/03/14
 * Time: 10:11 PM
 * To change this template use File | Settings | File Templates.
 */
class Hotel_Reservation extends Model {

    //var $hasOne = array('Agent' => 'Agent');
    private $_hotelname = null;
    private $_agentname = null;
    private $_customername = null;

   var $hasOne = array('Hotel' => 'Hotel', 'Hotel_Tariff' => 'Hotel_Tariff');

    public function getById()
    {
        // TODO: Implement getById() method.
        if (!$this->id){
            return false;
        }

        $this->showHasOne();
        return $this->search();
     }


    public function getAll() {
        $details = $this->search();
        if ($details) {
            foreach ($details as &$reservation) {
                $reservation['hotel_name'] = $this->getHotelSummary($reservation['Hotel_Reservation']['hotel_id']);
                $reservation['agent_name'] = $this->getAgentSummary($reservation['Hotel_Reservation']['agent_id']);
                $reservation['customer_name'] = $this->getCustomerSummary($reservation['Hotel_Reservation']['id']);
            }

            return $details;
        }
        return false;
    }

    public function getHotelSummary($hotel_id) {
        $summary = $this->getHotel()->getHotelSummary($hotel_id);
        return $summary;
    }

    public function getHotel() {
        if (is_null($this->_hotelname)) {
            $this->_hotelname = new Hotel();
        }
        return $this->_hotelname;
    }

    public function getAgentSummary($agent_id) {
        $summary = $this->getAgent()->getAgentSummary($agent_id);
        return $summary;
    }

    public function getAgent() {
        if (is_null($this->_agentname)) {
            $this->_agentname = new Agent();
        }
        return $this->_agentname;
    }

    public function getCustomerSummary($id) {
        $summary = $this->getCustomer()->getCustomerSummary($id);
        return $summary;
    }

    public function getCustomer() {
        if (is_null($this->_customername)) {
            $this->_customername = new Hotel_Pax();
        }
        return $this->_customername;
    }

}
