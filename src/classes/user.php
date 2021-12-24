<?php

    class User
    {
        private $_db;

        public function __construct()
        {
            $this->_db = Database::getInstance();
        }

        public function login($email, $password)
        {
            $data = $this->_db->getInfo('users', 'email', $email);
        
            if ( password_verify($password, $data['password']) )
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function checkEmail($email)
        {
            $data = $this->_db->getInfo('users', 'email', $email);

            if (empty($data))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    }

    error_reporting(-1);

?>