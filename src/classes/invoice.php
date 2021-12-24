<?php

    class Invoice
    {
        private $_db;

        public function __construct()
        {
            $this->_db = Database::getInstance();
        }

        public function create($fields = array())
        {
            if ($this->_db->insert('invoice', $fields))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    error_reporting(-1);

?>