<?php

namespace App\Controllers;

use App\Models\User;
use App\Controller;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(){
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 2; // Số bản ghi mỗi trang

        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $customers = $this->userModel->getPaginatedUsers($page, $limit);
        $totalUsers = $this->userModel->getTotalUsers();

        // Tính toán số trang
        $totalPages = ceil($totalUsers / $limit);

        // Gửi dữ liệu tới view
        $this->render('users/index', [
            'customers' => $customers,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

    public function show($userId)
    {
        //if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        // Fetch a single user by ID and display in a view
        $user = $this->userModel->getUserById($userId);
        
        $this->render('users\user-form', ['user' => $user]);

    }

    public function create()
    {
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $provinces = $this->userModel->getProvinces();
            $this->render('users\add', [
                'user' => [],
                'provinces' => $provinces
            ]);
        }
    }

    private function processForm(){
        // Retrieve form data
        $customerName = $_POST['customerName'];
        $isLocked = $_POST['isLocked'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $province = $_POST['province'];

        // Call the model to create a new user
        $user = $this->userModel->createUser($customerName, $email, $address, $province, $isLocked);

        if ($user) {
            // Redirect to the user list page or show a success message
            header('Location: /user/index');
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'User creation failed.';
        }
    }
       

    public function update($userId)
    {
        if (empty($_SESSION['currentUser'])) return header("Location: /auth/login");
        // Handle form submission to update a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($userId);            
        } else {
            // Fetch the user data and display the form to update
            $customer = $this->userModel->getUserById($userId);       
            $provinces = $this->userModel->getProvinces();
            $this->render('users\edit', [
                'customer' => $customer,
                'provinces' => $provinces
            ]);
        }
    }
    
    private function processFormUpdate($userId){
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        // Retrieve form data
        $customerName = $_POST['customerName'];
        $isLocked = $_POST['isLocked'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $province = $_POST['province'];
       
        
        // Call the model to update the user
        $user = $this->userModel->updateUser($userId, $customerName, $email, $address, $province, $isLocked);

        if ($user) {
            // Redirect to the user list page or show a success message
            header('Location: /user/index');
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'User update failed.';
        }
    }

    public function delete($userId)
    {
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->deleteUser($userId);
            header('Location: /index.php');    
        } else {
            // Fetch the user data and display the form to update
            $customer = $this->userModel->getUserById($userId);       
            
            $this->render('users\delete', ['customer' => $customer]);
        }
    }
}
