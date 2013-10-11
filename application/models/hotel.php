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

    public function doPrimarySearch($data){
        $this->showHasMany();
        $this->where('status','active');
        foreach($data as $field => $value){
            if (!is_array($value)){
               $this->where($field,$value);
            } else {
                $this->setOr($value);
            }
        }

        if (!isset($data['sortBy'])){
            $this->orderBy('hotel_name','ASC');
        }

        $details = $this->search();
        if (!$details){
             return false;
        }

        #selected hotel Ids
        foreach($details as $hotel){
            $hotelId[] = $hotel['Hotel']['id'];
        }
        return $hotelId;

    }


    public function fetchDetails($ids){

        if (!isset($ids)){
            return false;
        }
        $this->showHasMany();

        if (!is_array($ids)){
            $this->setId($ids);
        } else {
            $this->in('id',$ids);
        }

        return $this->search();
    }

    public function fetchFacet($ids,$type = 'area'){

        if ($type == 'area'){
            $field = 'hotel_area';
        } else if ($type == 'star'){
            $field = 'hotel_stars';
        }

        if (is_array($ids)){
            $whrCls = " `id` IN ('".implode("','",$ids)."') ";
        } else {
            $whrCls = " `id` = '".$ids."' ";
        }

        $sQl = "SELECT `".$field."` AS facet, count(`id`) AS count FROM `".$this->_table."` WHERE ".$whrCls." GROUP BY `".$field."`" ;

        $result = $this->custom($sQl);
        if ($result){
            $list = array();
            foreach($result as $facet){
                $list[$facet['Hotel']['facet']] = $facet[0]['count'];
            }
            return $list;
        }
        return false;

    }


}