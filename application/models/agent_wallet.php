<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 21/09/13
 * Time: 2:09 AM
 * To change this template use File | Settings | File Templates.
 */
class Agent_Wallet extends Model {

    var $hasOne = array('Agent' => 'Agent');

    public function getAll() {
        $this->showHasOne();
        return $this->search();
    }

    public function getById() {
        if (!isset($this->id)) {
            return false;
        }
        $this->showHasOne();
        return $this->search();
    }

    public function getSummary($id) {
        $total = 0;
        $used = 0;
        $lasttransactionAmt = 0;
        $lasttransactionDate = '';
        $sQl = 'SELECT sum(`value`) as amount,`type` FROM `' . $this->_table . '` where `agent_id` = ' . $id . ' group by `type`';
        $res = $this->custom($sQl);

        if ($res) {
            foreach ($res as $item) {

                if ($item['Agent_wallet']['type'] == 'deposite') {
                    $total = $item[0]['amount'];
                } else if ($item['Agent_wallet']['type'] == 'withdrawl') {
                    $used = $item[0]['amount'];
                }
            }
        }

        $sQ2 = 'SELECT value,date FROM `' . $this->_table . '` where `agent_id` = ' . $id . ' 
            and `type`="withdrawl" order by date DESC LIMIT 0,1';
        $res2 = $this->custom($sQ2);
        if ($res2) {
            $lasttransactionAmt = $res2[0]['Agent_wallet']['value'];
            $lasttransactionDate = $res2[0]['Agent_wallet']['date'];
            
        }
        return array(
            'total' => $total,
            'used' => $used,
            'balance' => $total - $used,
            'lastTranAmt'=> $lasttransactionAmt,
            'lastTranDate'=>$lasttransactionDate
        );
    }

    public function getByAgent($agentId) {
        if (is_null($agentId)) {
            return false;
        }
        $this->where('agent_id', $agentId);
        $this->orderBy('date', 'ASC');
        return $this->search();
    }

}
