<?php

namespace App\Controllers;

use App\Models\Home;

class HomeController {
    public function index(): void
    {
        $home = new Home();
        $message = $home->getMessage();

        if(empty($message)){
            $message = "No message";
        }

        require_once 'app/views/home.php';
    }
}