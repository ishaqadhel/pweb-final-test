<?php

    class User
    {
        private $_db;

        public function __construct()
        {
            $this->_db = Database::getInstance();
        }

        public function register($fields = array())
        {
            if ($this->_db->insert('users', $fields))
            {
                return true;
            }
            else
            {
                return false;
            }
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

        public function getRole ($email)
        {
            $data = $this->_db->getInfo('users', 'email', $email);
            return $data['role'];
        }

        public function getUser ($email)
        {
            if ($this->checkEmail($email))
                return $this->_db->getInfo('users', 'email', $email);
            else
                return false;
        }

        public function getAllByRole($role)
        {
            return $this->_db->getAllInfo('users', 'role', $role);
        }

        public function getAllUsers()
        {
            return $this->_db->getInfo('users');
        }
    }

    error_reporting(0);

?>