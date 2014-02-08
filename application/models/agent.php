<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 28/12/13
 * Time: 4:54 PM
 * To change this template use File | Settings | File Templates.
 */ 
class Agent extends Model {


    //get the list of all agents
    //order by latest added
    public function getAll(){

        $details = $this->search();
        if ($details){
            return $details;
        }
        return false;
    }


    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function fetchByField($field,$value){

    }



}
