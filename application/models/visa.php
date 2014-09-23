<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 18/11/13
 * Time: 1:23 AM
 * To change this template use File | Settings | File Templates.
 */
class Visa extends Model {

    /**
     * Method to get details by Id
     */
    public function getById() {
        if (isset($this->id)) {
            $result = $this->search();
            if ($result) {
                return $result;
            }
        }
        echo "Please set the id";
        return false;
    }

    public function getAll(){
        $result = $this->search();
        return $result;
    }

    public function toggleStatus($status = 'active')
    {
        #get the details of this profile
        $details = $this->getById();

        if (!$details){
            return false;
        }
        $newStatus = ($status == 'active') ? 'inactive' : 'active';

        $data = $details['Visa'];
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

}
