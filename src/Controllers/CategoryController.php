<?php

namespace App\Controllers;

use App\Models\Category;
use App\Controller;

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index(){
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");
        // $categories = $this->categoryModel->getAllCategories();
        // $this->render('categories\index', ['categories' => $categories]);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 2; // Số bản ghi mỗi trang
        $keyword = $_GET['keyword'] ?? "";

        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $customers = $this->categoryModel->getPaginated($page, $limit, $keyword);
        $totalUsers = $this->categoryModel->getTotal($keyword);

        // Tính toán số trang
        $totalPages = ceil($totalUsers / $limit);

        // Gửi dữ liệu tới view
        $this->render('categories/index', [
            'categories' => $customers,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

    public function create()
    {
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            // Display the form for creating a new category            
            $this->render('categories\add', ['category' => []]);
        }
        
    }

    private function processForm(){
            // Retrieve form data
            $categoryName = $_POST['categoryName'];
            $description = $_POST['description'];

            // Call the model to create a new category
            $category = $this->categoryModel->createCategory($categoryName, $description);

            if ($category) {
                // Redirect to the category list page or show a success message
                header('Location: /category/index');
                exit();
            } else {
                // Handle the case where the category creation failed
                echo 'Category creation failed.';
            }
    }
       

    public function update($categoryId)
    {
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");
        // Handle form submission to update a category
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($categoryId);            
        } else {
            // Fetch the category data and display the form to update
            $category = $this->categoryModel->getCategoryById($categoryId);       
            
            $this->render('categories\edit', ['category' => $category]);

        }
    }
    
    private function processFormUpdate($categoryId){
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");
        // Retrieve form data
        $categoryName = $_POST['categoryName'];
        $description = $_POST['description'];
        
        // Call the model to update the category
        $category = $this->categoryModel->updateCategory($categoryId, $categoryName, $description);

        if ($category) {
            // Redirect to the category list page or show a success message
            header('Location: /category/index');
            exit();
        } else {
            // Handle the case where the category creation failed
            echo 'Category update failed.';
        }
    }

    public function delete($categoryId)
    {
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoryModel->deleteCategory($categoryId);
            header('Location: /category/index');    
        } else {
            // Fetch the category data and display the form to update
            $category = $this->categoryModel->getCategoryById($categoryId);       
            
            $this->render('categories\delete', ['category' => $category]);

        }
    }
}
