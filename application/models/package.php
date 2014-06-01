<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 22/02/14
 * Time: 12:13 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Package extends Model{

    const CATEGORY_DESERT_SAFARI = 1;
    const CATEGORY_DHOW_CRUISE = 2;
    const CATEGORY_CITY_TOURS = 3;
    const CATEGORY_LUXURY_TOURS = 4;
    const CATEGORY_THEME_PARK = 5;
    const CATEGORY_WATER_PARKS = 6;
    const CATEGORY_SEA_ADVENTURE = 7;

    const TYPE_TOURS = "tour";
    const TYPE_COMBO = "combo";

    #has many tariffs
    var $hasMany = array('Package_Rate' => 'Package_Rate', 'Package_Image' => 'Package_image', 'Package_Time' => 'Package_Time');
    //var $hasMany = array('Package_Rate' => 'Package_Rate');


    public function getAll(){
        $this->showHasMany();
        $this->orderBy('id','DESC');
        $result = $this->search();

        if ($result){
            return $result;
        }
        return false;
    }


    public function getById($id=null)
    {
        if (!isset($this->id)){
            if (isset($id)){
                $this->id = $id;
            } else {
                echo "Missing ID Field";
                return false;
            }
        }

        $this->showHasMany();
        $this->showHasOne();
        $result = $this->search();
        if ($result){
            return $result;
        } else {
            return false;
        }
    }

    public function getCategoryOptions(){
        return array(
            self::CATEGORY_DESERT_SAFARI => 'Desert Safari',
            self::CATEGORY_DHOW_CRUISE => 'Dhow Cruise',
            self::CATEGORY_CITY_TOURS => 'City Tours',
            self::CATEGORY_LUXURY_TOURS => 'Luxury Tours',
            self::CATEGORY_THEME_PARK => 'Theme Parks',
            self::CATEGORY_WATER_PARKS => 'Water Activities',
            self::CATEGORY_SEA_ADVENTURE => 'Sea Adventure',
        );
    }

    public function getTypeOptions(){
        return array(
            self::TYPE_TOURS => 'Tour Package',
            self::TYPE_COMBO => 'Combo Deals',
        );
    }

    public function updateField($field,$value){
        $details = $this->getById();
        if (!$details){
            return false;
        }

        switch($field){
            case 'featured':
                $newValue = ($value == 1) ? 0 : 1;
                break;
        }

        $data = $details['Package'];
        $data[$field] = $newValue;

        $this->setAttributes($data);

        if (parent::save()){
            return $newValue;
        } else {
            return false;
        }

    }

    public function toggleStatus($status = 'active')
    {
        #get the details of this profile
        $details = $this->getById();

        if (!$details){
            return false;
        }
        $newStatus = ($status == 'active') ? 'inactive' : 'active';

        $data = $details['Package'];
        $data['status'] = $newStatus;

        //unset the date_added and date_modified
        unset($data['date_modified']);
        unset($data['date_added']);

        $this->setAttributes($data);

        if (parent::save()) {
            return $newStatus;
        } else {
            return false;
        }
    }

    public function getFeatured($type,$limit){

        $this->where('type',$type);
        $this->where('featured',1);
        $this->limit = $limit;
        $this->orderBy('date_modified', 'DESC');

        $this->showHasMany();
        $result = $this->search();

        if ($result){
            $categories = $this->getCategoryOptions();
            $packList = array();
            foreach($result as $package){
                if ($package['Package_Image']){
                    $image = $package['Package_Image'][0]['Package_Image']['image_name'];
                } else {
                    $image = "no-image.png";
                }
                $packList[] = array(
                    'id'=>$package['Package']['id'],
                    'title'=>$package['Package']['title'],
                    'slug'=>$package['Package']['slug'],
                    'type'=>$package['Package']['type'],
                    'category'=>$categories[$package['Package']['category']],
                    'details' => Utils::smartSubStr($package['Package']['description'],75),
                    'image' => $image,
                );
            }
            return $packList;
        } else {
            return false;
        }
    }
}
