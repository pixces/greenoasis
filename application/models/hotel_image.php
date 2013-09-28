<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 22/09/13
 * Time: 1:36 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Hotel_Image extends Model{

    var $hasOne = array('Hotel' => 'Hotel');

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function getByHotel($hotelId){

        $this->showHasOne();
        $this->where('hotel_id',$hotelId);

        $result = $this->search();

        if ($result){
            $imageList = array();
            $hotelDet = array();
            foreach($result as $imageSet){
                $imageList[] = $imageSet['Hotel_Image'];
                if($imageSet['Hotel']['id'] == $hotelId) {
                    $hotelDet[$imageSet['Hotel']['id']] = $imageSet['Hotel'];
                }
            }
            return array('Hotel_image'=>$imageList,'Hotel'=>$hotelDet);
        } else {
            return false;
        }
    }


}
