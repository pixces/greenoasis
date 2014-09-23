<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 18/11/13
 * Time: 1:23 AM
 * To change this template use File | Settings | File Templates.
 */
class Visa_Booking extends Model {

    var $hasMany = array('Visa_Pax' => 'Visa_Pax');
    var $hasOne = array('Visa' => 'Visa');

    /**
     * Method to get details by Id
     */
    public function getById() {
        if (isset($this->id)) {
            $this->showHasMany();
            $result = $this->search();
            if ($result) {
                return $result;
            }
        }
        echo "Please set the id";
        return false;
    }

    public function getAll() {
        $this->showHasMany();
        $details = $this->search();
        if ($details) {
            foreach ($details as &$visa) {
                $visa['agent_name'] = $this->getAgentSummary($visa['Visa_Booking']['agent_id']);
                $visa['customer_name'] = $visa['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['lname'];
                $visa['passport'] = $visa['Visa_Pax'][0]['Visa_Pax']['passport'];
                $visa['status']=$visa['Visa_Booking']['status'];
                $visa['Visa'] = $this->getVisaDetail($visa['Visa_Booking']['visa_id']);
            }
            return $details;
        }
        return false;
    }

    public function getByAgent($id) {
        $this->showHasMany();

        if (!isset($this->agent_id)){
            $this->agent_id = $id;
        }

        $details = $this->getByField('agent_id',$this->agent_id);
        if ($details) {
            foreach ($details as &$visa) {
                $visa['agent_name'] = $this->getAgentSummary($visa['Visa_Booking']['agent_id']);
                $visa['customer_name'] = $visa['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['lname'];
                $visa['passport'] = $visa['Visa_Pax'][0]['Visa_Pax']['passport'];
                $visa['status']=$visa['Visa_Booking']['status'];
                $visa['Visa'] = $this->getVisaDetail($visa['Visa_Booking']['visa_id']);
            }

            return $details;
        }
        return false;
    }

    public function getAgentSummary($agent_id) {
        $summary = $this->getAgent()->getAgentSummary($agent_id);
        return $summary;
    }

    public function getVisaDetail($id){
        $this->getVisa()->setId($id);
        $details = $this->getVisa()->getById();
        return $details['Visa'];
    }

    public function getAgent() {
        if (is_null($this->_agentname)) {
            $this->_agentname = new Agent();
        }
        return $this->_agentname;
    }
    
    protected function getVisa(){
        if (is_null($this->_visa)){
            $this->_visa = new Visa();
        }
        return $this->_visa;
    }


    
    public function getDetailsByDate($condition) {
        // echo $sQl = 'SELECT *  FROM `' . $this->_table . '` where  ' . $condition;
        // $details = $this->custom($sQl);
        //$this->showHasOne();
        $this->showHasMany();
        $this->setDate($condition);
        $details = $this->search();

        if ($details) {
            foreach ($details as &$visa) {
                $visa['agent_name'] = $this->getAgentSummary($visa['Visa_Booking']['agent_id']);
                $visa['customer_name'] = $visa['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['lname'];
                $visa['passport'] = $visa['Visa_Pax'][0]['Visa_Pax']['passport'];
                $visa['status'] = 'Pending';
                $visa['price'] = 0;
            }
            return $details;
        }
        return false;
    }

    public function getByBookingId($bookingId = null){
        if (!is_null($bookingId)){
            $this->showHasMany();
            $this->where('visa_booking_id',$bookingId);
            $result = $this->search();
            return $result;
        }
        return false;
    }

}
