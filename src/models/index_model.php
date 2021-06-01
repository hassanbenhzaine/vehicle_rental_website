<?php

    require 'core/db.php'; 

    class IndexModel
    {

        function __construct()
        {

        }

        public function retreiveCars()
        {
            $sql = "SELECT * FROM `vehicles` WHERE `type` = 'car' ORDER BY RAND() LIMIT 12";
            $conn = new Database();
            $result = $conn->select($sql);
            $conn = null;
            if ($result == false){
                return false;
            } else{
                return $result;
            }

        }

        public function retreiveBikes()
        {
            $sql = "SELECT * FROM `vehicles` WHERE `type` = 'bike' ORDER BY RAND() LIMIT 12";
            $conn = new Database();
            $result = $conn->select($sql);
            $conn = null;
            if ($result == false){
                return false;
            } else{
                return $result;
            }

        }

        public function retreiveTrucks()
        {
            $sql = "SELECT * FROM `vehicles` WHERE `type` = 'truck' ORDER BY RAND() LIMIT 12";
            $conn = new Database();
            $result = $conn->select($sql);
            $conn = null;
            if ($result == false){
                return false;
            } else{
                return $result;
            }

        }

    }
