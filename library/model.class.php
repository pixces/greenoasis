<?php
Abstract class Model extends SQLQuery
{
    protected $_model;
    protected $limit;

    function __construct()
    {

        global $inflect;

        $this->connect(HOST, USER, PASSWORD, NAME);
        $this->_limit = $this->limit;
        $this->_model = get_class($this);
        $this->_table = strtolower(Inflection::pluralize($this->_model));
        if (!isset($this->abstract)) {
            $this->_describe();
        }
    }

    function __destruct()
    {
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setAttributes($data){

        foreach ($this->_describe as $field) {
            if ($data[$field]) {
                $this->{$field} = $data[$field];
            }

            //also add date_added by default
            //if it is a new record
            if ($field == 'date_added'){
                if (!$this->id){
                    $this->{$field} = date('Y-m-d h:i:s');
                }
            }
        }
    }

    public abstract function getById();

    public function getByField($field, $value){

        if (!$field || !$value) { return false; }
        $this->where($field, $value);
        $result = $this->search();

        if ($result){
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Method will group posts based on
     * total count, published, private and draft
     * Get total counts
     */
    function getCounts()
    {
        $counts = array('total'=>0);
        $totalSql = 'select count(*) as total from `' . $this->_table . '`';
        $total = $this->custom($totalSql);

        $statusSql = 'select count(*) as total, status from `' . $this->_table . '` group by status ';
        $status = $this->custom($statusSql);

        if ($total) {
            $counts['total'] = $total[0][0]['total'];

            foreach ($status as $stat) {
                $counts[strtolower($stat[$this->_model]['status'])] = $stat[0]['total'];
            }
            return $counts;
        } else {
            return array('total' => 0);
        }
    }
}
