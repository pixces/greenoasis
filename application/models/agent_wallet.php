<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 21/09/13
 * Time: 2:09 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Agent_Wallet extends Model{

    var $hasOne = array('Agent' => 'Agent');


    public function getAll(){
        $this->showHasOne();
        return $this->search();
    }

    public function getById()
    {
        if(!isset($this->id)){
            return false;
        }

        $this->showHasOne();
        return $this->search();

    }

    public function getSummary($id){
        $total = 0;
        $used = 0;

        $sQl = 'SELECT sum(`value`) as amount,`type` FROM `'.$this->_table.'` where `agent_id` = '.$id.' group by `type`';
        $res = $this->custom($sQl);

        if ($res){
            foreach($res as $item){

                if($item['Agent_wallet']['type'] == 'deposite'){
                    $total = $item[0]['amount'];
                }
                else if($item['Agent_wallet']['type'] == 'withdrawl'){
                    $used = $item[0]['amount'];
                }
            }
        }

        return array(
            'total' => $total,
            'used' => $used,
            'balance' => $total -  $used
        );

    }

    public function getByAgent($agentId){
        if (is_null($agentId)){
            return false;
        }
        $this->where('agent_id',$agentId);
        $this->orderBy('date','ASC');
        return $this->search();
    }
}
