<?php

class Page extends Model {

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

    public function getByIdentifier($identifier){
        if (!$identifier){
            return false;
        }
        if ($result = $this->getByField('slug',$identifier)){

            if (count($result) >= 1){
                return $result[0];
            } else {
                return $result;
            }
        }
        return false;
    }

    public function getById()
    {
        if (!$this->id){ return false; }
        $result = $this->search();
        return $result;
    }

    public function getByField($field, $value)
    {
        $this->orderBy('date_modified','DESC');
        $this->where('status','active');
        $this->where($field,$value);
        return $this->search();
    }

    /**
     * @param int $parentID
     * @return array
     */
    public function fetchPageTree($parentID = 0){

        $sql = "select * from ".$this->_table." where ";

        if (is_array($parentID)){
            $parentID = implode(',', $parentID);
            $sql .= "parent_id in ({$parentID})";
        } else {
            $sql .= "parent_id = {$parentID}";
        }

        $tree = array();
        $idList = array();

        $res = $this->custom($sql);
        if ( $res ) {
            foreach($res as $page){
                $row = $page['Page'];
                $row['children'] = array();
                $tree[$row['id']] = $row;
                $idList[] = $row['id'];
            }
            if ( $idList ) {
                $children = $this->fetchPageTree($idList);
                foreach ( $children as $child ) {
                    $tree[$child['parent_id']]['children'][] = $child;
                }
            }
        }
        return $tree;
    }

    /**
     * method returns a simple
     * array of key => value only
     */
    public function getListSimple(){

        $pageList = $this->fetchPageTree();

        if (!$pageList){
            return false;
        }

        $collection = array();
        foreach($pageList as $page){
            $collection[$page['id']] = $page['title'];
            if ( $pageList['children'] ){
                foreach( $page['children'] as $child ){
                    $collection[$child['id']] = "-".$child['title'];
                }
            }
        }
        return $collection;
    }


    public function updateStatus($oldStatus){
        #get all page details
        $newStatus = ($oldStatus == 'active') ? 'inactive' : 'active';
        $details = $this->getById();

        #set the new status
        $page = $details['Page'];

        #update page now
        $page['status'] = $newStatus;

        foreach($page as $key=>$value){
            $this->{$key} = $value;
        }

        if ( $this->save() ){
            return $newStatus;
        } else {
            return false;
        }
    }


}