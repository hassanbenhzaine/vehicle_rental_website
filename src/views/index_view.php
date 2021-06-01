<?php

    class IndexView
    {
        private $model;
        private $controller;

        function __construct($controller, $model)
        {
            $this->controller = $controller;
            $this->model = $model;
        }

        public function details(){
?>


        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
            </div>
            <div class="modal-body">
                <form id="login" action="account/signin" method="POST">
                    <div class="mb-3 inputbox">
                        <label for="email2" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email2" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="notremember" class="form-check-input" id="notremember" value="Yes">
                        <label class="form-check-label" for="notremember">Don't remember me</label>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button id="signupinstead" type="button" class="btn btn-primary" data-bs-target="#Signup" data-bs-toggle="modal" data-bs-dismiss="modal">Signup</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="login" name="submit" value="submit">Login</button>
            </div>

<?php
        }


        public function default()
        {
            session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="overlay"></div>
    <div class="modal fade" id="details" tabindex="-1" aria-hidden="true"></div>
    <?php if(!isset($_COOKIE['stay'])) { ?>
    <div class="modal fade" id="Signup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"">Signup</h5>
            </div>
            <div class="modal-body">
                <form id="signup" action="account/signup" method="POST">
                    <div class="mb-3 inputbox">
                        <label for="firstname" class="form-label">First name</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" required>
                    </div>
                        <div class="mb-3 inputbox">
                        <label for="lastname" class="form-label">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" required>
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="telephone" class="form-label">Phone</label>
                        <input type="tel" name="telephone" class="form-control" id="telephone" required>
                        </div>
                    <div class="mb-3 inputbox">
                        <label for="password2" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password2" data-bv-identical="true"
                data-bv-identical-field="repeatpassword"
                data-bv-identical-message="The password and its confirm are not the same" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="repeatpassword" class="form-label">Repeat password</label>
                        <input type="password" name="repeatpassword" class="form-control" id="repeatpassword" aria-describedby="passwordHelp" required>
                    </div>
                    <div class="form-text mb-3" id="passwordHelp">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces or emoji.</div>
                    </form>
            </div>
            <div class="modal-footer">
                <button id="logininstead" type="button" class="btn btn-primary" data-bs-target="#Login" data-bs-toggle="modal" data-bs-dismiss="modal">Login</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="signup" name="submit" value="submit">Signup</button>
            </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="Login" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
            </div>
            <div class="modal-body">
                <form id="login" action="account/signin" method="POST">
                    <div class="mb-3 inputbox">
                        <label for="email2" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email2" required>
                    </div>
                    <div class="mb-3 inputbox">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="notremember" class="form-check-input" id="notremember" value="Yes">
                        <label class="form-check-label" for="notremember">Don't remember me</label>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button id="signupinstead" type="button" class="btn btn-primary" data-bs-target="#Signup" data-bs-toggle="modal" data-bs-dismiss="modal">Signup</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="login" name="submit" value="submit">Login</button>
            </div>
            </div>
        </div>
        </div>
        <?php } ?>
    <nav class="navbar navbar-expand-lg" id="mainnav">
        <div class="container">
            <a class="navbar-brand" href="#"><img id="logo" src="assets/img/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <img src="assets/img/icons/menu-button-of-three-horizontal-lines.svg" alt="menu" class="oi"/> Menu
	        </button>
            <div class="justify-content-end navbar-collapse collapse" id="ftco-nav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link navlink" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="index.html">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="index.html">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="index.html">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="index.html">Vehicles</a>
                </li>
                <li class="nav-item">
                    <?php if(isset($_COOKIE['stay'])) { ?>
                    <a class="nav-link navlink" href="account">Dashboard</a>
                    <?php } else{ ?>
                    <a class="nav-link navlink" data-bs-toggle="modal" data-bs-target="#Signup">Login / Signup</a>
                    <?php } ?>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="home">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-lg-8 text-light fw-bold intro">
                <p class="mb-4">Fast & Easy Way To Rent A Car</p>
                <form class="d-flex" id="search">
                    <input class="form-control" type="text" placeholder="What vehicle you looking for?">
                    <button type="submit"><img src="assets/img/icons/magnifying-glass.svg" alt="search"></button>
                    </form>
            </div>
        </div>
    </div>
    <div class="skew"></div>
    <section class="bg-light home">
        <div class="container spacer">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-5">
                    <span class="subheading">What we offer</span>
                    <h2 class="mb-2 subheading2">Featured vehicles</h2>
                </div>
            </div>
            <div class="row">
                <div id="slider1" class="col-md-12 carousel slide carousel-multi-item" data-bs-ride="carousel">
                    <div class="owl-outer carousel-inner">
                        <div class="carousel-item active">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $cars1 = $this->controller->cars();
                            if($cars1){
                                $i=0;
                                foreach($cars1 as $k=>$row) {
                                    if($i < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/cars/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $cars2 = $this->controller->cars();
                            if($cars2){
                                $i1=0;
                                foreach($cars2 as $k=>$row) {
                                    if($i1 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/cars/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i1++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $cars3 = $this->controller->cars();
                            if($cars3){
                                $i2=0;
                                foreach($cars3 as $k=>$row) {
                                    if($i2 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/cars/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i2++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-bs-target="#slider1" data-bs-slide-to="0" class="active" aria-current="true"></li>
                        <li data-bs-target="#slider1" data-bs-slide-to="1"></li>
                        <li data-bs-target="#slider1" data-bs-slide-to="2"></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div id="slider2" class="col-md-12 carousel slide carousel-multi-item" data-bs-ride="carousel">
                    <div class="owl-outer carousel-inner">
                        <div class="carousel-item active">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $bikes1 = $this->controller->bikes();
                            if($bikes1){
                                $i4=0;
                                foreach($bikes1 as $k=>$row) {
                                    if($i4 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/motorcycles/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i4++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $bikes2 = $this->controller->bikes();
                            if($bikes2){
                                $i5=0;
                                foreach($bikes2 as $k=>$row) {
                                    if($i5 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/motorcycles/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i5++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $bikes3 = $this->controller->bikes();
                            if($bikes3){
                                $i6=0;
                                foreach($bikes3 as $k=>$row) {
                                    if($i6 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/motorcycles/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i6++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-bs-target="#slider2" data-bs-slide-to="0" class="active" aria-current="true"></li>
                        <li data-bs-target="#slider2" data-bs-slide-to="1"></li>
                        <li data-bs-target="#slider2" data-bs-slide-to="2"></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div id="slider3" class="col-md-12 carousel slide carousel-multi-item" data-bs-ride="carousel">
                    <div class="owl-outer carousel-inner">
                        <div class="carousel-item active">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                            $trucks1 = $this->controller->trucks();
                            if($trucks1){
                                $i10=0;
                                foreach($trucks1 as $k=>$row) {
                                    if($i10 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/trucks/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i10++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                                $trucks2 = $this->controller->trucks();
                                if($trucks2){
                                $i11=0;
                                foreach($trucks2 as $k=>$row) {
                                    if($i11 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/trucks/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i11++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row d-flex justify-content-center flex-wrap">
                            <?php 
                                $trucks3 = $this->controller->trucks();
                                if($trucks3){
                                $i12=0;
                                foreach($trucks3 as $k=>$row) {
                                    if($i12 < 3){
                                        echo '
                                            <div class="owl-item">
                                                <div class="car-wrap rounded">
                                                    <img class="rounded d-flex align-items-end" src="assets/img/vehicles/trucks/'.$row['photo'].'">
                                                    <div class="text">
                                                        <h2 class="mb-0"><a href="#">'.$row['model'].' '.$row['year'].'</a></h2>
                                                        <div class="d-flex mb-3">
                                                            <span class="cat">'.$row['brand'].'</span>
                                                            <p class="price">'.$row['price'].' DH<span>/day</span></p>
                                                        </div>
                                                        <p class="d-flex mb-0 d-block itembuttons">';
                                                        if(isset($_COOKIE['stay'])) {
                                                        echo '<a href="account/reserve/'.$row['id'].'" class="btn btn-primary py-2 mr-1">Book now</a>';
                                                        } else {
                                                        echo '<a data-bs-toggle="modal" data-bs-target="#Login" class="btn btn-primary py-2 mr-1">Book now</a>';   
                                                        }
                                                        echo '<a href="#" class="loadDetails btn btn-secondary py-2 ml-1" data-bs-toggle="modal" data-bs-target="#details">Details</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $i12++;
                                    } else{
                                        break;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-bs-target="#slider3" data-bs-slide-to="0" class="active" aria-current="true"></li>
                        <li data-bs-target="#slider3" data-bs-slide-to="1"></li>
                        <li data-bs-target="#slider3" data-bs-slide-to="2"></li>
                    </ol>
                </div>
            </div>
           
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row mb-5">
            <div class="col-md">
                <div class="mb-4 widget">
                <h2><a href="#" class="logo"><img src="assets/img/logo.png" alt="logo"></a></h2>
                <p>This project aim to simplify the process of renting a vehicle from car a rental agency all in one app.</p>
                <ul class="list-unstyled mt-5">
                    <li class="social"><a class="d-flex justify-content-center align-items-center" href="https://www.linkedin.com/in/hassanbenhzaine/" target="_blank"><img src="assets/img/icons/linkedin.svg" alt="linkedin"></a></li>
                    <li class="social"><a class="d-flex justify-content-center align-items-center" href="https://twitter.com/hassanbenhzaine" target="_blank"><img src="assets/img/icons/twitter.svg" alt="twitter"></a></li>
                </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-4 ml-md-5 widget">
                <h2>Information</h2>
                <ul class="list-unstyled">
                    <li><a href="#" class="py-2 d-block">About</a></li>
                    <li><a href="#" class="py-2 d-block">Services</a></li>
                    <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                    <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                    <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
                </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-4 widget">
                <h2 class="ftco-heading-2">Customer Support</h2>
                <ul class="list-unstyled">
                    <li><a href="#" class="py-2 d-block">FAQ</a></li>
                    <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                    <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                    <li><a href="#" class="py-2 d-block">How it works</a></li>
                    <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-4 widget">
                    <h2>Have a Questions?</h2>
                    <div class=" block-23 mb-3">
                    <ul>
                        <li><span class="icon"><img src="assets/img/icons/pin.svg" alt="location"></span><span class="ques">YouCode, Youssoufia 46300 Maroc</span></li>
                        <li><span class="icon"><a href="tel:00212607873886"><img  src="assets/img/icons/phone-call.svg" alt="location"></span><span class="ques">+212 (607) 873-886</span></a></li>
                        <li><span class="icon"><a href="mailto:cbenhzaine@gmail.com"><img src="assets/img/icons/envelope.svg" alt="location"></span><span class="ques">cbenhzaine@gmail.com</span></a></li>
                    </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 text-center">
                <p class="copyright">Copyright ©2021 All rights reserved | Made by <a href="https://twitter.com/hassanbenhzaine" target="_blank">Hassan Benhzaine</a></p>
            </div>
            </div>
        </div>
        </footer>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/index.js"></script>
</body>
</html>


<?php
        }


    }

?>