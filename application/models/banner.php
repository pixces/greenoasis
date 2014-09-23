<?php

class Banner extends Model {

    public function setId($id){
        $this->id = $id;
    }

    public function getAll(){
        $this->orderBy('id','ASC');
        $list = $this->search();

        if ($list){
            return $list;
        } else {
            return false;
        }
    }

    public function getAllActive($type = 'large')
    {
        $this->orderBy('id','DESC');
        $this->where('status','active');
        $this->where('type',$type);
        return $this->search();
    }

    public function getById()
    {
        if (!$this->id){ return false; }
        $result = $this->search();
        return $result;
    }

     public function updateStatus($oldStatus){
        #get all page details
        $newStatus = ($oldStatus == 'active') ? 'inactive' : 'active';
        $details = $this->getById();

        #set the new status
        $banner = $details['Banner'];

        #update page now
         $banner['status'] = $newStatus;

        foreach($banner as $key=>$value){
            $this->{$key} = $value;
        }

        if ( $this->save() ){
            return $newStatus;
        } else {
            return false;
        }
    }




}