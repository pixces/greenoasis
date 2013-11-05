<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 10/10/13
 * Time: 8:04 PM
 * To change this template use File | Settings | File Templates.
 */ 
class Hotel_Session extends Model{

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function fetchBySession($session=null){

        if (!isset($this->search_session)){
            return false;
        }

        //check and set user session
        if (!isset($this->user_session)){
            $this->user_session = $_SESSION['user']['_session'];
        }

        $this->where('search_session',$this->search_session);
        $this->where('user_session',$this->user_session);

        $details = $this->search();

        if($details[0]['Hotel_Session']['params']){
            return json_decode( $details[0]['Hotel_Session']['params'], true);
        }
        return false;
    }

    public function insertSession($data){

        print_r($data);

    }

    public function updateSession($data){

        if (!isset($this->search_session)){
            throw new Exception("Search SessionId should be set before update request is made.");
        }

        //get the search session details
        //add new details to the params and update the session details

    }


}
