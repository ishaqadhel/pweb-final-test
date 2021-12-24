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

        public function getAllByUser($id_user)
        {
            return $this->_db->getAllInfo('invoice', 'id_user', $id_user);
        }

        public function getAll()
        {
            return $this->_db->getInfo('invoice');
        }
    }

    error_reporting(0);

?>