<?php

    class IndexController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function cars()
        {
            return $this->model->retreiveCars();
        }

        public function bikes()
        {
            return $this->model->retreiveBikes();
        }

        public function trucks()
        {
            return $this->model->retreiveTrucks();
        }

    }
