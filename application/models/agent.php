<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 28/12/13
 * Time: 4:54 PM
 * To change this template use File | Settings | File Templates.
 */
class Agent extends Model {

    var $hasMany = array('Agent_Wallet' => 'Agent_Wallet');
    //var $hasOne = array('Hotel_Image' => 'Hotel_Image');

    private $_wallet = null;

    public function getById() {
        $this->showHasMany();
        $result = $this->search();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    //get the list of all agents
    //order by latest added
    public function getAll() {
        $this->showHasMany();
        $details = $this->search();
        if ($details) {
            foreach ($details as &$agent) {
                $agent['Summary'] = $this->getWalletSummary($agent['Agent']['id']);
            }
            return $details;
        }
        return false;
    }

    public function fetchByField($field, $value) {
        
    }

    public function getWalletSummary($agent_id) {
        $summary = $this->getWallet()->getSummary($agent_id);
        return $summary;
    }

    public function getWallet() {
        if (is_null($this->_wallet)) {
            $this->_wallet = new Agent_Wallet();
        }

        return $this->_wallet;
    }

    public function toggleStatus($status = 'approved') {
        #get the details of this profile
        $details = $this->getById();
        $newStatus = ($status == 'approved') ? 'inactive' : 'approved';

        $data = $details['Agent'];
        $data['status'] = $newStatus;

        foreach ($data as $key => $value) {
            $this->{$key} = trim($value);
        }

        if (parent::save()) {
            return $newStatus;
        } else {
            return false;
        }
    }

    public function doLogin($data) {
        $this->where('email', $data['username']);
        $this->where('password', md5($data['password']));
        $this->where('status', "approved");
        $result = $this->search();
        if ($result) {
            return $result;
        }

        return false;
    }

    public function getAgentSummary($id) {
        $sQl = 'SELECT *  FROM `' . $this->_table . '` where `id` = ' . $id;
        $res = $this->custom($sQl);

        if ($res) {
            return isset($res[0]['Agent']['contact']) ? $res[0]['Agent']['contact'] : $res[0]['Agent']['company'];
        }

        return;
    }
    
    public function getNewAgent() {
        $sQl = 'SELECT *  FROM `' . $this->_table . '` where `status` ="pending" ';
        $res = $this->custom($sQl);

        if ($res) {
           return $res;
        }

        return;
    }

}
