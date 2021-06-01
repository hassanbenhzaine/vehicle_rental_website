<?php

    include 'core/config.php';

    class AccountView
    {
        private $model;
        private $controller;
        private $email;
        private $password;
        private $firstname;
        private $lastname;
        private $phone;

        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function vehicles(){
            session_start();
            if(isset($_COOKIE['stay']) && $_SESSION["privilege"] == "admin") {
                $this->start();
?>
<div class="modal-header">
    <h5 class="modal-title">Vehicles</h5>
</div>
<div class="modal-body">
<table class="table table-striped ">
    <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Brand</th>
      <th scope="col">Model</th>
      <th scope="col">Year</th>
      <th scope="col">Price</th>
      <th scope="col">Type</th>
      <th scope="col">Created at</th>
      <th scope="col">Photo</th>
      <th scope="col">Modify</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $vehicles = $this->controller->showVehicles();
        foreach($vehicles as $k=>$row) {
          echo '<tr>';
            echo '<th scope="row">'.$row['id'].'</th>';
            echo '<td>'.$row['brand'].'</td>';
            echo '<td>'.$row['model'].'</td>';
            echo '<td>'.$row['year'].'</td>';
            echo '<td>'.$row['price'].' DH</td>';
            echo '<td>'.$row['type'].'</td>';
            echo '<td>'.$row['createdAt'].'</td>';
            if($row['type'] == 'car'){
                echo '<td><a href="../assets/img/vehicles/cars/'.$row['photo'].'" target="_blank">
                <img class="vehiclephoto" src="../assets/img/vehicles/cars/'.$row['photo'].'"/>
                </td>';
            } elseif($row['type'] == 'bike'){
                echo '<td><a href="../assets/img/vehicles/motorcycles/'.$row['photo'].'" target="_blank">
                <img class="vehiclephoto" src="../assets/img/vehicles/motorcycles/'.$row['photo'].'"/>
                </td>';
            } elseif($row['type'] == 'truck'){
                echo '<td><a href="../assets/img/vehicles/trucks/'.$row['photo'].'" target="_blank">
                <img class="vehiclephoto" src="../assets/img/vehicles/trucks/'.$row['photo'].'"/>
                </td>';
            }
           
            echo '<td class="d-flex justify-content-evenly align-items-center">
            <a href="../account/deletevehicle/'.$row['id'].'"><img class="icon" src="../assets/img/icons/trash.svg"/></a>
            <a href="../account/vehicledetails/'.$row['id'].'"><img class="icon" src="../assets/img/icons/edit.svg"/></a>
            </td>';
          echo '</tr>';
    }
    ?>
  </tbody>
</table>
</div>
<div class="modal-footer">
    <a class="btn btn-primary" href="../account/addvehicle">Add vehicle</a>
 </div>
<?php
                $this->end();
            } else{
                RedirectURL('');
            }
        }

        public function deletereservation($para){
            return $this->controller->callDeleteReservation($para);
        }

        public function reserve($para){
            $result = $this->controller->callReserve($para);
            $this->start();
?>
<div class="modal-header">
                <h5 class="modal-title">Booking of <?php echo $result[0]['brand'].' '.$result[0]['model'].' - '.$result[0]['year']; ?></h5>
            </div>
            <div class="modal-body">
            <form id="reservevehicle" action="../reservevehicle/<?php echo $result[0]['id']; ?>" method="POST">
                    <div class="mb-3 inputbox">
                        <label for="pickup" class="form-label">Pick-up date</label>
                        <input min="<?php echo date("Y-m-d"); ?>" type="date" name="pickup" class="form-control" id="pickup" required>
                    </div>
                        <div class="mb-3 inputbox">
                        <label for="dropoff" class="form-label">Drop off date</label>
                        <input min="<?php echo date('Y-m-d', strtotime("+1 day")); ?>" type="date" name="dropoff" class="form-control" id="dropoff" required>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="../../" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="reservevehicle" name="submit" value="submit">Continue</button>
            </div>
<?php
            $this->end();
        }

        public function reservevehicle($para){
            $pickup = $_POST['pickup'];
            $dropoff = $_POST['dropoff'];
            return $this->controller->callReserveVehicle($para,$pickup,$dropoff);
        }

        public function reservesuccess($para){
            session_start();
            if(isset($_COOKIE['stay'])){
                $result = $this->controller->callReserveSuccess($para);
            $this->start();
?>
            <div class="modal-header">
                <h5 class="modal-title">Booking successful</h5>
            </div>
            <div class="modal-body">
            <table id="print" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: #fff;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" >

                    <tr>
                        <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" >
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px"> <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                        <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">

                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="60%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> Order Confirmation # </td>
                                                <td width="40%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> <?php echo $result[0]['id']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Pickup date </td>
                                                <td width="40%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> <?php echo $result[0]['pickup']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> Dropoff date </td>
                                                <td width="40%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> <?php echo $result[0]['dropoff']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> User </td>
                                                <td width="40%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> <?php echo $result[0]['firstName'].' '.$result[0]['lastName']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> Vehicle </td>
                                                <td width="40%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> <?php echo $result[0]['brand'].' '.$result[0]['model'].' - '.$result[0]['year']; ?> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                
                </table>
            </td>
        </tr>
    </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="printDiv('print')" form="modifyuser" name="submit" value="submit">Print</button>
            </div>
<?php
            $this->end();
            } else{
                RedirectURL('');
            }
        }

        
        public function deletevehicle($para){
            return $this->controller->callDeleteVehicle($para);
        }

        public function modifyuser($para){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email= $_POST['email'];
            $phone = $_POST['telephone'];
            $password = $_POST['password'];
            $privilege = $_POST['privilege'];
            return $this->controller->callModifyUser($para,$firstname,$lastname,$email,$phone,$password,$privilege);
        }

        public function modifyreservation($para){
            $pickup = $_POST['pickup'];
            $dropoff = $_POST['dropoff'];
            $vehicle= $_POST['vehicle'];
            $status = $_POST['status'];
            return $this->controller->callModifyReservation($para,$pickup,$dropoff,$vehicle,$status);
        }

        public function modifyvehicle($para){
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $year= $_POST['year'];
            $price = $_POST['price'];
            $type = $_POST['type'];
            $photoName = $_FILES['vehiclephoto']['name'];
            $photoTmpName = $_FILES['vehiclephoto']['tmp_name'];

            return $this->controller->callModifyVehicle($para,$brand,$model,$year,$price,$type,$photoName,$photoTmpName);
        }

        public function reservationdetails($para){
            session_start();
            $this->start();
            $result =$this->controller->showReservationDetails($para);
?>
            <div class="modal-header">
                <h5 class="modal-title">Modify reservation</h5>
            </div>
            <div class="modal-body">
            <form id="modifyreservation" action="../modifyreservation/<?php echo $para[0] ?>" method="POST">

                    <div class="mb-3 inputbox">
                        <label for="pickup" class="form-label">Pickup date</label>
                        <input value="<?php echo $result[0]['pickup'] ?>" type="date" name="pickup" class="form-control" id="pickup" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="dropoff" class="form-label">Dropoff date</label>
                        <input value="<?php echo $result[0]['dropoff'] ?>" type="date" name="dropoff" class="form-control" id="dropoff" required>
                    </div>
                    <?php if(isset($_COOKIE['stay']) && $_SESSION["privilege"] == "admin") {?>
                    <div class="mb-3 inputbox">
                    <label for="privilege" class="form-label">Status</label>
                    <select id="privilege" class=" form-select" name="status">
                            <option value="<?php echo $result[0]['status'] ?>" selected><?php echo $result[0]['status'] ?></option>
                            <option value="pending">pending</option>
                            <option value="canceled">canceled</option>
                            <option value="active">active</option>
                    </select>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="vehicle" class="form-label">Vehicle ID</label>
                        <input value="<?php echo $result[0]['vehicle'] ?>" type="number" name="vehicle" class="form-control" id="vehicle" required>
                    </div>
                    <?php } ?>
                    </form>
            </div>

            <div class="modal-footer">
                <a href="../reservations" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="modifyreservation" name="submit" value="submit">Modify</button>
            </div>

<?php
            $this->end();
        }

        public function userdetails($para){
            session_start();
            $this->start();
            $result =$this->controller->showUserDetails($para);
?>
            <div class="modal-header">
                <h5 class="modal-title">Modify user</h5>
            </div>
            <div class="modal-body">
            <form id="modifyuser" action="../modifyuser/<?php echo $para[0] ?>" method="POST">
                    <div class="mb-3 inputbox">
                        <label for="firstname" class="form-label">First name</label>
                        <input value="<?php echo $result[0]['firstName'] ?>" type="text" name="firstname" class="form-control" id="firstname" required>
                    </div>
                        <div class="mb-3 inputbox">
                        <label for="lastname" class="form-label">Last name</label>
                        <input value="<?php echo $result[0]['lastName'] ?>" type="text" name="lastname" class="form-control" id="lastname" required>
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="email" class="form-label">Email address</label>
                        <input value="<?php echo $result[0]['email'] ?>" type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="telephone" class="form-label">Phone</label>
                        <input value="<?php echo $result[0]['phone'] ?>" type="tel" name="telephone" class="form-control" id="telephone" required>
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="password2" class="form-label">Password</label>
                        <input value="*****" type="password" name="password" class="form-control" id="password2" data-bv-identical="true"
                data-bv-identical-field="repeatpassword"
                data-bv-identical-message="The password and its confirm are not the same" required>
                    </div>

                    <div class="mb-3 inputbox">
                    <label for="privilege" class="form-label">Privilege</label>
                    <select id="privilege" class=" form-select" name="privilege">
                            <option value="<?php echo $result[0]['privilege'] ?>" selected><?php echo $result[0]['privilege'] ?></option>
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                            </select>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="../users" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="modifyuser" name="submit" value="submit">Modify</button>
            </div>

<?php
            $this->end();
        }

        public function vehicledetails($para){
            session_start();
            $this->start();
            $result =$this->controller->showVehicleDetails($para);
?>
            <div class="modal-header">
                <h5 class="modal-title">Modify vehicle</h5>
            </div>
            <div class="modal-body">
            <form id="modifyvehicle" action="../modifyvehicle/<?php echo $para[0] ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 inputbox">
                        <label for="brand" class="form-label">Brand</label>
                        <input id="brand" value="<?php echo $result[0]['brand'] ?>" type="text" name="brand" class="form-control">
                    </div>
                        <div class="mb-3 inputbox">
                        <label for="model" class="form-label">Model</label>
                        <input id="model" value="<?php echo $result[0]['model'] ?>" type="text" name="model" class="form-control">
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" value="<?php echo $result[0]['year'] ?>" type="number" name="year" class="form-control">
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="price" class="form-label">Price</label>
                        <input id="price" value="<?php echo $result[0]['price'] ?>" type="number" name="price" class="form-control">
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="type" class="form-label">Type</label>
                        <select id="type" class="form-select" name="type">
                            <option value="<?php echo $result[0]['type'] ?>" selected><?php echo $result[0]['type'] ?></option>
                            <option value="car">car</option>
                            <option value="truck">truck</option>
                            <option value="bike">bike</option>
                        </select>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="photo" class="form-label">Photo</label>
                        <input id="photo" type="file" accept=".jpeg,.jpg,.png" name="vehiclephoto" class="form-control">
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="../vehicles" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="modifyvehicle" name="submit" value="submit">Modify</button>
            </div>

<?php
            $this->end();
        }

        public function submituser(){
            $this->controller->callSubmitUser();
        }
        public function submitreservation(){
            $this->controller->callSubmitReservation();
        }

        public function submitvehicle(){
            $this->controller->callSubmitVehicle();
        }

        public function addreservation(){
            session_start();
            $this->start();
?>
 <div class="modal-header">
                <h5 class="modal-title">Add reservation</h5>
            </div>
            <div class="modal-body">
            <form id="modifyreservation" action="../account/submitreservation" method="POST">

                    <div class="mb-3 inputbox">
                        <label for="pickup" class="form-label">Pickup date</label>
                        <input type="date" name="pickup" class="form-control" id="pickup" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="dropoff" class="form-label">Dropoff date</label>
                        <input type="date" name="dropoff" class="form-control" id="dropoff" required>
                    </div>
                    <div class="mb-3 inputbox">
                    <label for="privilege" class="form-label">Status</label>
                    <select id="privilege" class=" form-select" name="status" required>
                            <option value="pending">pending</option>
                            <option value="canceled">canceled</option>
                            <option value="canceled">active</option>
                    </select>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="vehicle" class="form-label">Vehicle ID</label>
                        <input type="number" name="vehicle" class="form-control" id="vehicle" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="user" class="form-label">User ID</label>
                        <input type="number" name="user" class="form-control" id="user" required>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="../reservations" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="modifyreservation" name="submit" value="submit">Add</button>
            </div>
<?php
            $this->end();
        }

        public function adduser(){
            session_start();
            $this->start();
?>
 <div class="modal-header">
                <h5 class="modal-title">Add user</h5>
            </div>
            <div class="modal-body">
            <form id="submituser" action="../account/submituser" method="POST">
                    <div class="mb-3 inputbox">
                        <label for="vehicle" class="form-label">First name</label>
                        <input type="text" name="firstname" class="form-control" id="firstname">
                    </div>
                        <div class="mb-3 inputbox">
                        <label for="lastname" class="form-label">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="lastname">
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="telephone" class="form-label">Phone</label>
                        <input type="tel" name="telephone" class="form-control" id="telephone">
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>

                    <div class="mb-3 inputbox">
                        <label for="privilege" class="form-label">Privilege</label>
                        <select id="privilege" class="form-select" name="privilege">
                            <option value="user" selected>user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="../account/users" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="submituser" name="submit" value="submit">Add user</button>
            </div>
<?php
            $this->end();
        }

        public function addvehicle(){
            session_start();
            $this->start();
?>
            <div class="modal-header">
                <h5 class="modal-title">Add vehicle</h5>
            </div>
            <div class="modal-body">
            <form id="submitvehicle" action="../account/submitvehicle" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 inputbox">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control" id="brand">
                    </div>
                        <div class="mb-3 inputbox">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" id="model">
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" id="year">
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price">
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="type" class="form-label">Type</label>
                        <select id="type" class="form-select" name="type">
                            <option value="car">car</option>
                            <option value="bike">bike</option>
                            <option value="truck">truck</option>
                        </select>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="photo" class="form-label">Photo</label>
                        <input id="photo" type="file" accept=".jpeg,.jpg,.png" name="vehiclephoto" class="form-control">
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="../account/vehicles" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" form="submitvehicle" name="submit" value="submit">Add vehicle</button>
            </div>
<?php
            $this->end();
        }

        public function signup()
        {
            $this->firstname = $_POST['firstname'];
            $this->lastname = $_POST['lastname'];
            $this->email= $_POST['email'];
            $this->phone = $_POST['telephone'];
            $this->password = $_POST['password'];

            $this->controller->callSignup($this->firstname,$this->lastname,$this->email,$this->phone,$this->password);
        }

        public function signin(){
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $notremember = false;
            $this->controller->callLogin($this->email,$this->password,$notremember);
        }

        public function logout(){
            $this->controller->callLogout();
        }

        public function updateProfile(){
            $this->firstname = $_POST['firstname'];
            $this->lastname = $_POST['lastname'];
            $this->email= $_POST['email'];
            $this->phone = $_POST['telephone'];
            $this->password = $_POST['password'];
            $this->controller->callUpdateProfile($this->firstname,$this->lastname,$this->email,$this->phone,$this->password);
        }

        public function users(){
            session_start();
            if(isset($_COOKIE['stay']) && $_SESSION["privilege"] == "admin") {
                $this->start();
?>
<div class="modal-header">
    <h5 class="modal-title">Users</h5>
</div>
<div class="modal-body">
<table class="table table-striped ">
    <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Privilege</th>
      <th scope="col">Created at</th>
      <th scope="col">Modify</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $result = $this->controller->showUsers();
        foreach($result as $k=>$row) {
            echo '<tr>';
            echo '<th scope="row">'.$row['id'].'</th>';
            echo '<td>'.$row['firstName'].'</td>';
            echo '<td>'.$row['lastName'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['phone'].'</td>';
            echo '<td>'.$row['privilege'].'</td>';
            echo '<td>'.$row['createdAt'].'</td>';
            echo '<td class="d-flex justify-content-evenly align-items-center">
            <a href="../account/deleteuser/'.$row['id'].'"><img class="icon" src="../assets/img/icons/trash.svg"/></a>
            <a href="../account/userdetails/'.$row['id'].'"><img class="icon" src="../assets/img/icons/edit.svg"/></a>
            </td>';
            echo '</tr>';
    }
    ?>
  </tbody>
</table>
</div>
<div class="modal-footer">
    <a class="btn btn-primary" href="../account/adduser">Add user</a>
 </div>
<?php
                $this->end();
            } else{
                RedirectURL('');
            }
        }

        public function reservations(){
            session_start();
            if(isset($_COOKIE['stay'])) {
                $this->start();
?>
<div class="modal-header">
    <h5 class="modal-title">Reservations</h5>
</div>
<div class="modal-body table-responsive">
<?php 
        $result = $this->controller->showReservations();
        if($result){ ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Booked at</th>
        <?php if ($_SESSION['privilege'] == "admin"){ ?>
        <th scope="col">User</th>
        <?php } ?>
        <th scope="col">Vehicle</th>
        <th scope="col">Status</th>
        <th scope="col">Pickup date</th>
        <th scope="col">Dropoff date</th>
        <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($result as $k=>$row) {
            echo '<tr>';
            echo '<th scope="row">'.$row['id'].'</th>';
            echo '<td>'.$row['createdAt'].'</td>';

           if ($_SESSION['privilege'] == "admin"){
            echo '<td>'.$row['firstName'].' '.$row['lastName'].'</td>';
           };
            echo '<td>'.$row['brand'].' '.$row['model'].' - '.$row['year'].'</td>';
            if ($row['status'] == "pendingdelete"){
                echo '<td>Pending delete</td>';
            } else if($row['status'] == "pending"){
                echo '<td>Pending</td>';
            }else if($row['status'] == "canceled"){
                echo '<td>Canceled</td>';
            }else if($row['status'] == "active"){
                echo '<td>Active</td>';
            }else if($row['status'] == "pendingmodification"){
                echo '<td>Pending modification</td>';
            }


            echo '<td>'.$row['pickup'].'</td>';
            echo '<td>'.$row['dropoff'].'</td>';
            echo '<td class="d-flex justify-content-evenly align-items-center">
            <a href="../account/reservationdetails/'.$row['id'].'"><img class="icon" src="../assets/img/icons/edit.svg"/></a>
            ';
            echo '<a href="../account/deletereservation/'.$row['id'].'"><img class="icon" src="../assets/img/icons/trash.svg"/></a>
            </td>';
            echo '</tr>';
    } ?>
</tbody>
</table>
<?php    
    }else{ ?>
<?php 
        echo '<h2 class="text-center">You have no reservations</h2>';
        echo '</tbody>
        </table>';
    }
    ?>

</div>
<?php if($_SESSION["privilege"] == "admin") { ?>
<div class="modal-footer">

    <a class="btn btn-primary" href="../account/addreservation">Add reservation</a>
   
 </div> <?php }?>
<?php
                $this->end();
            } else{
                RedirectURL('');
            }
        }

        public function start(){
            global $folder_location;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $folder_location; ?>assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $folder_location; ?>assets/css/account.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-auto bg-dark sticky-top">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-dark align-items-center sticky-top">
                <a href="<?php echo $folder_location; ?>" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                <img src="<?php echo $folder_location; ?>assets/img/icons/home.svg" alt="home" class="bi"/>
                </a>
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                <?php if($_SESSION["privilege"] == "admin") { ?>
                    <li class="nav-item">
                        <a href="<?php echo $folder_location; ?>account/vehicles" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                            <img src="<?php echo $folder_location; ?>assets/img/icons/car.svg" alt="home" class="bi"/>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $folder_location; ?>account/users" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Users">
                        <img src="<?php echo $folder_location; ?>assets/img/icons/users.svg" alt="home" class="bi"/>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $folder_location; ?>account" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Statistics">
                        <img src="<?php echo $folder_location; ?>assets/img/icons/statistics.svg" alt="home" class="bi"/>
                        </a>
                    </li>
                <?php } ?>
                    <li class="nav-item">
                        <a href="<?php echo $folder_location; ?>account/reservations" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                        <img src="<?php echo $folder_location; ?>assets/img/icons/shopping-bag.svg" alt="home" class="bi"/>
                        </a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $folder_location; ?>assets/img/icons/user.svg" alt="home" class="bi h2"/>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                        <li><a class="dropdown-item" id="logout" href="<?php echo $folder_location; ?>account/logout">Logout</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profile" href="">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm p-3 min-vh-100">
<?php
        }

        public function end(){
            global $folder_location;
?>
        </div>
    </div>
</div>
    <script src="<?php echo $folder_location; ?>assets/js/account.js"></script>
    <script src="<?php echo $folder_location; ?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php

        }
        public function default(){
            
            if(isset($_COOKIE['stay'])) {
                session_start();
                if($_SESSION["privilege"] == "admin"){

                $this->start();
?>
<h2 class="text-center">Welcome, <?php echo $_SESSION['firstName'] .' '. $_SESSION['lastName'] ?></h2>
<?php $veh = $this->controller->callStatistics(); 
foreach($veh[0]  as $k=>$row) {
    $array1[] = $row['count'];
    $array2[] = $row['brand'].' '.$row['model'].' '.$row['year'];
}
foreach($veh[1] as $k=>$row) {
    $array4[] = $row['count'];
    $array3[] = $row['months'];
}
?>
<script src="assets/js/chart.min.js"></script>
<div class="container" style="margin-top:0; margin-bottom:0">
    <div class="row d-flex flex-wrap justify-content-center align-items-center">
        <div class="col">
            <div class="chart-container" style="width:99%">
            <canvas  id="chartjs_bar"></canvas> </div>
        </div>

        <div class="col">
            <div class="chart-container" style="width:99%">
            <canvas  id="chartjs_barRes"></canvas> </div>
        </div>
    </div>
</div>
<script type="text/javascript">

      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    responsive: true,maintainAspectRatio: true,
                    data: {
                        labels:<?php echo json_encode($array2); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($array1); ?>,
                        }]
                    },
                    options: {
                        title: {
                                    display: true,
                                    text: 'Total reservations per vehicles'
                                },
                        legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Poppins',
                            fontSize: 10,
                        }
            
                    },
                }
                });
                var ctx1 = document.getElementById("chartjs_barRes").getContext('2d');
                
                var myChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($array3); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($array4); ?>,
                        }]
                    },
                    options: {
                        title: {
                display: true,
                text: 'Total orders per month'
            },
                        legend: {
                        display: false,
                        position: 'bottom',
                        
                            
                        
                    },scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                max: 20
                            }
                        }]
                }
 
 
                }
                });
    </script>
<?php   
                $this->end();
            } else{
                RedirectURL('account/reservations');
            }
          } else{
                RedirectURL('');
            }
        }


    }
?>