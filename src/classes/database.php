<?php

    class Database
    {
        private static $INSTANCE = null;
        private $mysqli,
                $HOST = 'mysql',
                $USER = 'root',
                $PASS = 'root',
                $DBNAME = 'database_docker';
        
        public function __construct()
        {
            $this->mysqli = new mysqli( $this->HOST, $this->USER, $this->PASS, $this->DBNAME );

            if (mysqli_connect_error())
            {
                die ('Failed to connect Database');
            }
        }

        // singleton pattern menguji koneksi agar tidak double
        public static function getInstance()
        {
            if ( !isset(self::$INSTANCE) )
            {
                self::$INSTANCE = new Database();
            }

            return self::$INSTANCE;
        }

        public function getInfo($table, $column = '', $value = '')
        {
          if( !is_int($value) )
            $value = "'". $value . "'";
      
            if( $column != '' ) {
              $query  = "SELECT * FROM $table WHERE $column = $value";
              $result = $this->mysqli->query($query);
      
              while($row = $result->fetch_assoc()){
                 return $row;
              }
            } else {
              $query  = "SELECT * FROM $table";
              $result = $this->mysqli->query($query);
      
              while($row = $result->fetch_assoc()){
                 $results[] = $row;
              }
      
              return $results;
            }
        }

        public function getAllInfo($table, $column = '', $value = '')
        {
          if( !is_int($value) )
            $value = "'". $value . "'";
      
            if( $column != '' ) {
              $query  = "SELECT * FROM $table WHERE $column = $value";
              $result = $this->mysqli->query($query);
      
              while($row = $result->fetch_assoc()){
                 $results[] = $row;
              }
              return $results;
            } else {
              $query  = "SELECT * FROM $table";
              $result = $this->mysqli->query($query);
      
              while($row = $result->fetch_assoc()){
                 $results[] = $row;
              }
      
              return $results;
            }
        }

        public function escape ($name)
        {
            return $this->mysqli->real_escape_string($name);
        }

        public function executeQuery($query, $msg)
        {
            if ($this->mysqli->query($query))
            {
                return true;
            }
            else
            {
                die($msg);
            }
        }

        public function insert($table, $fields = array())
        {
            // mengambil kolom
            $column = implode(", ", array_keys($fields));

            // mengambil nilai
            $valueArrays = array();
            $i = 0;
            foreach($fields as $key=>$values)
            {
                if( is_int($values) )
                {
                    $valueArrays[$i] = $this->escape($values);
                }
                else
                {
                    $valueArrays[$i] = "'" . $this->escape($values) . "'";
                }
                $i++;
            }

            $values = implode(", ", $valueArrays);

            $query = "INSERT INTO $table ($column) VALUES ($values)";
                      
            return $this->executeQuery($query, 'Error while insert data');
            
        }

    }   

    error_reporting(-1);

?>