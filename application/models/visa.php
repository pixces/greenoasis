<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 18/11/13
 * Time: 1:23 AM
 * To change this template use File | Settings | File Templates.
 */
class Visa extends Model {

    //define show has many;
    var $hasMany = array('Visa_Pax' => 'Visa_Pax');

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
                $visa['agent_name'] = $this->getAgentSummary($visa['Visa']['agent_id']);
                $visa['customer_name'] = $visa['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['lname'];
                $visa['passport'] = $visa['Visa_Pax'][0]['Visa_Pax']['passport'];
                $visa['status']='Pending';
                $visa['price']=135;
            }

            return $details;
        }
        return false;
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
    
    
    
    public function getDetailsByDate($condition) {
        
//        echo $sQl = 'SELECT *  FROM `' . $this->_table . '` where  ' . $condition;
//        $details = $this->custom($sQl);
        
          $this->showHasMany();
          $this->setDate( $condition);
          $details = $this->search();
         if ($details) {
            foreach ($details as &$visa) {
                $visa['agent_name'] = $this->getAgentSummary($visa['Visa']['agent_id']);
                $visa['customer_name'] = $visa['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $visa['Visa_Pax'][0]['Visa_Pax']['lname'];
                $visa['passport'] = $visa['Visa_Pax'][0]['Visa_Pax']['passport'];
                $visa['status']='Pending';
                $visa['price']=135;
            }

            return $details;
        }
        return false;
    }

}
