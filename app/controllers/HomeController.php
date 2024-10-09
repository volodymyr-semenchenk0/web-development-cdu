<?php

require_once 'app/models/HomeModel.php';

class HomeController {
    public function index(): void
    {
        $home = new HomeModel();
        $message = $home->getMessage();

        if(empty($message)){
            $message = "No message";
        }

        require_once 'app/views/home.php';
    }
}