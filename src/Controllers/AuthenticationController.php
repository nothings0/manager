<?php
namespace App\Controllers;
require_once 'bootstrap.php';  // Khởi động session từ file bootstrap

use App\Models\Employee;
use App\Controller;

class AuthenticationController extends Controller {
    
    private $employeeModel;
    public function __construct(){
        $this->employeeModel = new Employee();
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new Employee())->getEmployeeByEmail($email);
            if ($password == $user['Password']) {
                // Employee authenticated, save user to session
                // session_start();
                $_SESSION['currentUser'] = $user;
    
                // Redirect to index.php
                $_SESSION['flash_message'] = "Login was successful";
                header("Location: /");
                exit();
            } else {
                // Authentication failed, redirect to signin.php
                $_SESSION['flash_message'] = "Login has failed";
                header("Location: /auth/login");
                exit();
            }
        }else{
            $pageTitle = 'Đăng nhập tài khoản';

            $this->render('users\login', ['pageTitle' => $pageTitle]);
        }
    }

    public function logout(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // session_start();
            if(isset($_SESSION['currentUser'])){
                unset($_SESSION['currentUser']);
                session_destroy();
                header("Location: /");
                exit();
            }
        }
    }
}