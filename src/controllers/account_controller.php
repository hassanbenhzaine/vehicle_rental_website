<?php

    class AccountController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function callSignup($firstname,$lastname,$email,$phone,$password){
            return $this->model->signup($firstname,$lastname,$email,$phone,$password);
        }

        public function callLogin($email,$password,$notremember){
            return $this->model->login($email,$password,$notremember);
        }

        public function callReserve($para){
            return $this->model->reserve($para);
        }

        public function callReserveVehicle($para,$pickup,$dropoff){
            return $this->model->reservevehicle($para,$pickup,$dropoff);
        }

        public function callLogout(){
            $this->model->logout();
        }

        public function callUpdateProfile($firstname,$lastname,$email,$phone,$password){
            $this->model->updateProfile($firstname,$lastname,$email,$phone,$password);
        }

        public function showUsers(){
            return $this->model->users();
        }

        public function showReservations(){
            return $this->model->reservations();
        }

        public function callDeleteUser($para){
            return $this->model->deleteuser($para);
        }

        public function callDeleteReservation($para){
            return $this->model->deletereservation($para);
        }

        public function callDeleteVehicle($para){
            return $this->model->deletevehicle($para);
        }

        public function callStatistics(){
            return $this->model->statistics();
        }

        public function callReserveSuccess($para){
            return $this->model->ReserveSuccess($para);
        }

        public function callSubmitUser(){
            return $this->model->submitUser();
        }

        public function callSubmitReservation(){
            return $this->model->submitReservation();
        }

        public function callSubmitVehicle(){
            return $this->model->submitVehicle();
        }

        public function showUserDetails($para){
            return $this->model->userDetails($para);
        }

        public function showReservationDetails($para){
            return $this->model->reservationDetails($para);
        }

        public function showVehicleDetails($para){
            return $this->model->vehicleDetails($para);
        }

        public function showVehicles(){
            return $this->model->vehicles();
        }

        public function callModifyUser($para,$firstname,$lastname,$email,$phone,$password,$privilege){
            return $this->model->modifyuser($para,$firstname,$lastname,$email,$phone,$password,$privilege);
        }

        public function callModifyVehicle($para,$brand,$model,$year,$price,$type,$photoName,$photoTmpName){
            return $this->model->modifyvehicle($para,$brand,$model,$year,$price,$type,$photoName,$photoTmpName);
        }

        public function callModifyReservation($para,$pickup,$dropoff,$vehicle,$status){
            return $this->model->modifyReservation($para,$pickup,$dropoff,$vehicle,$status);
        }

    }
