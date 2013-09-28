<?php

class Hotel extends Model {

    #has many tariffs
    var $hasMany = array('Hotel_Tariff' => 'Hotel_Tariff');

    public function getById()
    {
        $this->showHasMany();
        $result = $this->search();
        if ($result){
            return $result;
        } else {
            return false;
        }
    }

    public function getAll(){

        $this->showHasMany();
        $this->orderBy('date_modified','DESC');
        $result = $this->search();
        if ($result){
            return $result;
        }
        return false;

    }

    public function toggleStatus($status = 'active')
    {
        #get the details of this profile
        $details = $this->getById();
        $newStatus = ($status == 'active') ? 'inactive' : 'active';

        $data = $details['Hotel'];
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

}