<?php
class Attendance {
    private $_db,
            $_data;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('attendance', $fields)) {
            throw new Exception('Sorry, there was something went wrong.;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('attendance', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }
	
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function data(){
        return $this->_data;
    }

}