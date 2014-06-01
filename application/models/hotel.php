<?php

class Hotel extends Model {

    #has many tariffs
    var $hasMany = array('Hotel_Tariff' => 'Hotel_Tariff');
    var $hasOne = array('Hotel_Image' => 'Hotel_Image');

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


    public function doHotelSearch($data){

        $checkIn = date('Y-m-d', $data['checkin']);
        $checkOut = date('Y-m-d', $data['checkout']);

        $searchSql = "SELECT h.id AS hotel_id, ht.id AS tariffID, ht.room_count, ht.season_name, ht.room_type, ht.meal_plan, ho.occupancy_type,
                      Ifnull(ho.room_count-(Select sum(room_count) from hotel_reservation b WHERE hotel_tariff_id=ht.id and hotel_occupancy_id=ho.id and (
                        ( b.fromDate between '".$checkIn."' and '".$checkOut."' ) or ( b.toDate between '".$checkIn."' and '".$checkOut."' )) ),ho.room_count) as RemainingRoom,
                        ho.room_rate FROM hotels as h ";

        $searchSql .= " INNER JOIN hotel_tariffs ht ON h.id=ht.hotel_id AND h.status != 'inactive' and ";

        //checking city
        if ( isset($data['city']) && $data['city'] != '') {
            $searchSql .= " h.hotel_city='".$data['city']."' and ";
        }

        //checking country
        if ( isset($data['country']) && $data['country'] != '') {
            $searchSql .= " h.hotel_country='".$data['country']."' and ";
        }

        //add more checkes
        //for area
        //for star rating

        $searchSql .= " '".$checkIn."' between ht.date_start  and ht.date_end and '".$checkOut."' between ht.date_start  and ht.date_end ";
        $searchSql .= " INNER JOIN hotel_occupancies ho ON ho.hotel_tariff_id=ht.id ";

        //checking for roomtype
        if (isset($data['roomtype']) && $data['roomtype'] != ''){
            $searchSql .= "AND ho.occupancy_type='".$data['roomtype']."'";
        }

        //check for hotel image
        //$searchSql .= " INNER JOIN hotel_images hi ON h.id = hi.hotel_id ";

        $details = $this->custom($searchSql);

        #prepare a result set with hotels and their respective tariff plans where
        #room is available
        #for each of the rooms not available show on-request
        if (!$details){
             return false;
        }

        $hotelList = array();
        foreach($details as $occupancy){
            $availability = 0;

            if ($occupancy[0]['RemainingRoom'] >= $data['rooms']){
                $availability = 1;
            }
            $hotelList[$occupancy['H']['hotel_id']][$occupancy['Ht']['tariffID']] = array('occupancy'=>$occupancy[0]['RemainingRoom'], 'availability'=>$availability);
        }

        return $hotelList;
    }


    public function fetchHotelDetails($ids){

        $id = implode(',',$ids);

        $sQl = "SELECT * from hotels Hotel
                INNER JOIN hotel_tariffs Tariffs ON Hotel.id = Tariffs.hotel_id
                WHERE  Hotel.id in (".$id.") ";

        $details = $this->custom($sQl);

        $result = array();
        if ($details){
            $count = 0;
            foreach($details as $detail){
                //get all hotel details
                $result[$detail['Hotel']['id']]['Hotel'] = $detail['Hotel'];

                //include all hotel images
                //$result[$detail['Image']['hotel_id']]['Hotel']['image'][] = $detail['Image'];

                //include all hotel tariff
                $result[$detail['Tariff']['hotel_id']]['Tariff'][] = $detail['Tariff'];

                $count++;
            }
        }
        return array('Count'=>count($ids),'details'=>$result);
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