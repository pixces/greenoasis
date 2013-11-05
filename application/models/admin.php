<?php

class Admin extends Model {

    //var $abstract = true;

    public function doLogin($data){

        $this->where('username',$data['username']);
        $this->where('password',sha1( $data['password']) );
        $result = $this->search();

        if ($result){
            return $result;
        }

        return false;

    }

    public function getById()
    {
        if ($this->id){
            $this->showHasOne();
            return $this->search();
        }
        return false;
    }

    public function getBySlug()
    {
        // TODO: Implement getBySlug() method.
    }

    public function getByField($field, $value)
    {
        // TODO: Implement getByField() method.
    }

    public function getByTitle()
    {
        // TODO: Implement getByTitle() method.
    }
}