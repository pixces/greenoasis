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
    public function getById()
    {
        if(isset($this->id)){
            $this->showHasMany();
            $result = $this->search();

            if ($result){
                return $result;
            }
        }

        echo "Please set the id";
        return false;

    }



}
