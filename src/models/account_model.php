<?php

    require 'core/db.php';
    require 'core/redirect.php';

    class AccountModel
    {

        function __construct()
        {

        }

        public function vehicles(){
            $sql = "SELECT * FROM `vehicles`";
            $conn = new Database();
            $result = $conn->select($sql);
            $conn = null;
            if ($result == false){
                return false;
            } else{
                return $result;
            }
        }

        public function deletevehicle($para){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $sql = "DELETE FROM `vehicles` WHERE `vehicles`.`id` = $para[0]";
                $conn = new Database();
                $conn->insert($sql);
                RedirectURL('account/vehicles');
            }else{
                RedirectURL('');
            }
        }

        public function deleteuser($para){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $sql = "DELETE FROM `users` WHERE `users`.`id` = $para[0]";
                $conn = new Database();
                $conn->insert($sql);
                RedirectURL('account/users');
            }else{
                RedirectURL('');
            }
        }

        public function userDetails($para){

            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                if(isset($para[0])){
                    $sql = "SELECT * FROM `users` WHERE `id` = $para[0]";
                    $conn = new Database();
                    $result = $conn->select($sql);
                    $conn = null;
                    return $result;
                }
            } else{
                RedirectURL('');
            }
        }

        public function vehicleDetails($para){

            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                if(isset($para[0])){
                    $sql = "SELECT * FROM `vehicles` WHERE `id` = $para[0]";
                    $conn = new Database();
                    $result = $conn->select($sql);
                    $conn = null;
                    return $result;
                }
            } else{
                RedirectURL('');
            }
        }

        public function reservationDetails($para){

            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                if(isset($para[0])){
                    $sql = "SELECT * FROM `reservations` WHERE `id` = $para[0]";
                    $conn = new Database();
                    $result = $conn->select($sql);
                    $conn = null;
                    return $result;
                }
            } elseif($_SESSION['privilege'] == "user" && isset($_COOKIE['stay'])){
                if(isset($para[0])){
                    $sql = "SELECT `pickup`,`dropoff` FROM `reservations` WHERE `id` = $para[0]";
                    $conn = new Database();
                    $result = $conn->select($sql);
                    $conn = null;
                    return $result;
                }
            }
            else{
                RedirectURL('');
            }
        }

        public function modifyReservation($para,$pickup,$dropoff,$vehicle,$status){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){

                $sql = "UPDATE `reservations` SET `status` = '$status', `vehicle` = '$vehicle', `dropoff` = '$dropoff', `pickup` = '$pickup' WHERE `reservations`.`id` = $para[0]";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/reservations');
            } elseif($_SESSION['privilege'] == "user" && isset($_COOKIE['stay'])){
                $sql = "UPDATE `reservations` SET `status` = 'pendingmodification', `dropoff` = '$dropoff', `pickup` = '$pickup' WHERE `reservations`.`id` = $para[0]";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/reservations');
            }else{
                RedirectURL('');
            }
        }

        public function modifyvehicle($para,$brand,$model,$year,$price,$type,$photoName,$photoTmpName){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){

                $newPhotoName = $para[0] .'_'. $photoName;
                if($type == "car"){
                    $folder = "cars";
                } elseif($type == "truck"){
                    $folder = "trucks";
                } elseif($type == "bike"){
                    $folder = "motorcycles";
                }
                $uploadPath = getcwd(). "\assets\img\\vehicles\\".$folder."\\".$newPhotoName; 

                move_uploaded_file($photoTmpName, $uploadPath);
    
                if(empty($photoName)){
                    $newPhotoName = "default.jpg";
                }

                $sql = "UPDATE `vehicles` SET `brand` = '$brand', `model` = '$model', `year` = '$year', `price` = '$price', `type` = '$type', `photo` = '$newPhotoName' WHERE `vehicles`.`id` = '{$para[0]}'";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/vehicles');
            }else{
                RedirectURL('');
            }
        }

        public function modifyUser($para,$firstname,$lastname,$email,$phone,$password,$privilege){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){

                if($password == "*****"){
                    $hashed_password = $_SESSION['password'];
                } else{
                    $hashed_password =  password_hash($password, PASSWORD_DEFAULT);
                }

                $sql = "UPDATE `users` SET `firstName` = '$firstname', `lastName` = '$lastname', `email` = '$email', `phone` = '$phone', `pass` = '$hashed_password', `privilege` = '$privilege' WHERE `users`.`id` = '{$para[0]}'";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/users');
            }else{
                RedirectURL('');
            }
        }

        public function submitUser(){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $email = $_POST['email'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $phone = $_POST['telephone'];
                $password = $_POST['password'];
                $privilege = $_POST['privilege'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`email`, `pass`, `firstName`, `lastName`, `createdAt`, `phone`, `privilege`) VALUES ('$email', '$hashed_password', '$firstname', '$lastname', current_timestamp(), '$phone', '$privilege')";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/users');
            }
        }

        public function submitReservation(){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $pickup = $_POST['pickup'];
                $dropoff = $_POST['dropoff'];
                $status = $_POST['status'];
                $vehicle = $_POST['vehicle'];
                $user = $_POST['user'];
                $sql = "INSERT INTO `reservations` (`id`, `createdAt`, `user`, `vehicle`, `status`, `pickup`, `dropoff`) VALUES (NULL, current_timestamp(), '$user', '$vehicle', '$status', '$pickup', '$dropoff')";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/reservations');
            }
        }

        public function submitVehicle(){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $brand = $_POST['brand'];
                $model = $_POST['model'];
                $year = $_POST['year'];
                $price = $_POST['price'];
                $type = $_POST['type'];
                $photoName = $_FILES['vehiclephoto']['name'];
                $photoTmpName = $_FILES['vehiclephoto']['tmp_name'];

                $newPhotoName = $photoName;
                if($type == "car"){
                    $folder = "cars";
                } elseif($type == "truck"){
                    $folder = "trucks";
                } elseif($type == "bike"){
                    $folder = "motorcycles";
                }
                $uploadPath = getcwd(). "\assets\img\\vehicles\\".$folder."\\".$newPhotoName; 

                move_uploaded_file($photoTmpName, $uploadPath);
    
                if(empty($photoName)){
                    $newPhotoName = "default.jpg";
                }

                $sql = "INSERT INTO `vehicles` (`brand`, `model`, `year`, `price`, `type`, `photo`) VALUES ('$brand', '$model', '$year', '$price', '$type', '$newPhotoName')";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                RedirectURL('account/vehicles');
            }
        }

        public function users(){
            $sql = "SELECT * FROM `users`";
            $conn = new Database();
            $result = $conn->select($sql);
            if ($result == false){
                return false;
            } else{
                return $result;
            }
            $conn = null;
        }

        public function reservations(){
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $sql = "SELECT x.id, x.status, x.createdAt, x.pickup, x.dropoff, y.brand, y.model, y.year, z.firstName, z.lastName FROM `reservations` x INNER JOIN `vehicles` y ON x.vehicle = y.id INNER JOIN `users` z ON x.user = z.id";
                $conn = new Database();
                $result = $conn->select($sql);
                $conn = null;
                if ($result == false){
                    return false;
                } else{
                    return $result;
                }

            } elseif($_SESSION['privilege'] == "user" && isset($_COOKIE['stay'])){
                $sql = "SELECT x.id, x.status, x.createdAt, x.pickup, x.dropoff, y.brand, y.model, y.year, z.firstName, z.lastName FROM `reservations` x INNER JOIN `vehicles` y ON x.vehicle = y.id INNER JOIN `users` z ON x.user = z.id WHERE x.user = {$_SESSION['id']}";
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

        public function statistics(){
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $sql = "SELECT COUNT(x.vehicle) as count, y.brand, y.model, y.year FROM `reservations` x INNER JOIN `vehicles` y ON x.vehicle = y.id GROUP BY x.vehicle;";
                $conn = new Database();
                $result[] = $conn->select($sql);
                $sql2 = "SELECT DATE_FORMAT(createdAt, '%M') as months, COUNT(id) as count FROM `reservations` x GROUP BY DATE_FORMAT(createdAt, '%Y%m')";
                $result[] = $conn->select($sql2);
                $conn = null;
                return $result;
                
            }
        }

        public function deletereservation($para){
            session_start();
            if($_SESSION['privilege'] == "admin" && isset($_COOKIE['stay'])){
                $sql = "DELETE FROM `reservations` WHERE `reservations`.`id` = $para[0]";
                $conn = new Database();
                $conn->insert($sql);
                RedirectURL('account/reservations');
            }elseif($_SESSION['privilege'] == "user" && isset($_COOKIE['stay'])){
                $sql = "UPDATE `reservations` SET `status` = 'pendingdelete' WHERE `reservations`.`id` = $para[0];";
                $conn = new Database();
                $conn->insert($sql);
                RedirectURL('account/reservations');
            }else{
                RedirectURL('');
            }
        }

        public function logout(){
                session_unset();
                // session_destroy();
                setcookie("stay","1",time(),"/");
                RedirectURL('');
                
        }

        public function reserve($para){
            session_start();
            if(isset($_COOKIE['stay'])){
                $sql = "SELECT * FROM `vehicles` WHERE `id` = '$para[0]'";
                $conn = new Database();
                $result = $conn->select($sql);
                $conn = null;
                return $result;
            }
        }

        public function reservevehicle($para,$pickup,$dropoff){
            session_start();
            if(isset($_COOKIE['stay'])){
                $user = $_SESSION['id'];
                $vehicle = $para[0];
                $sql = "INSERT INTO `reservations` (`createdAt`, `user`, `vehicle`, `status`, `pickup`, `dropoff`) VALUES (current_timestamp(), '$user', '$vehicle', 'pending', '$pickup', '$dropoff')";
                $conn = new Database();
                $result = $conn->select($sql);
                $conn = null;

                RedirectURL("account/reservesuccess/{$this->sucessdata($user)}");
            }
        }

        public function ReserveSuccess($para){
            $sql = "SELECT x.pickup, x.dropoff, x.id, y.firstName,y.lastName, z.brand, z.model, z.year FROM `reservations` x INNER JOIN `users`y ON x.user = y.id INNER JOIN `vehicles` z ON x.vehicle = z.id WHERE x.id = $para[0]";
            $conn = new Database();
            $result = $conn->select($sql);
            $conn = null;

                return $result;
        }

        public function sucessdata($user){
            $sql = "SELECT * FROM `reservations` WHERE `user`='$user' ORDER BY `id` DESC LIMIT 1";
            $conn = new Database();
            $result = $conn->select($sql);
            $conn = null;
            foreach($result as $k=>$row) {
                return $row['id'];
            }
        }

        public function updateProfile($firstname,$lastname,$email,$phone,$password){

            if(isset($_POST['submit']) && isset($_COOKIE['stay'])){

                if($password == "*****"){
                    $hashed_password = $_SESSION['password'];
                } else{
                    $hashed_password =  password_hash($password, PASSWORD_DEFAULT);
                }

                $sql = "UPDATE `users` SET `firstName` = '$firstname', `lastName` = '$lastname', `email` = '$email', `phone` = '$phone', `pass` = '$hashed_password' WHERE `users`.`id` = '{$_SESSION['id']}'";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
            }
        }

        public function signup($firstname,$lastname,$email,$phone,$password)
        {
            if(isset($_POST['submit'])){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`email`, `pass`, `firstName`, `lastName`, `createdAt`, `phone`, `privilege`) VALUES ('$email', '$hashed_password', '$firstname', '$lastname', current_timestamp(), '$phone', 'user')";
                $conn = new Database();
                $conn->insert($sql);
                $conn = null;
                
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["firstName"] = $firstname;
                $_SESSION["lastName"] = $lastname;
                $_SESSION["phone"] = $phone;
                $_SESSION["password"] = $password;
                $_SESSION["privilege"] = "user";
                setcookie("stay","1",time()+3600*24*365,"/");

                RedirectURL('account');
            } else{
                RedirectURL('');
            }
        }

        public function login($email,$password,$notremember){
            if(isset($_POST['submit'])){

                if(isset($_POST['notremember']) && $_POST['notremember'] == 'Yes'){
                    $notremember = true;
                }
                $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
                $conn = new Database();
                $result = $conn->select($sql);
                $conn = null;
                if ($result == false){
                    die('Email not found');
                } else{
                    foreach($result as $k=>$row) {
                        if(password_verify($password, $row['pass'])){
                            session_start();
                            $_SESSION["email"] = $row['email'];
                            $_SESSION["firstName"] = $row["firstName"];
                            $_SESSION["lastName"] = $row["lastName"];
                            $_SESSION["privilege"] = $row["privilege"];
                            $_SESSION["phone"] =  $row['phone'];
                            $_SESSION["password"] = $row['pass'];
                            $_SESSION["id"] = $row['id'];

                            if($notremember == true){
                                setcookie("stay","1",time()+20,"/");
                            } else{
                                setcookie("stay","1",time()+3600*24*365,"/");
                            }
                            RedirectURL('account');
                        } else{
                            die('Password incorrect');
                        }
                    }
                }
            } else{
                RedirectURL('');
            }

        }
    }
