<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 05/02/14
 * Time: 3:48 AM
 * To change this template use File | Settings | File Templates.
 */
class Setting extends Model {

    public function getById()
    {
        // TODO: Implement getById() method.
    }

    public function fetchAll(){

        return $this->search();

    }

}
