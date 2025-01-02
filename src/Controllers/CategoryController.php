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
        $pageTitle = 'Quản lý loại hàng';
        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $categories = $this->categoryModel->getPaginated($page, $limit, $keyword);
        $total = $this->categoryModel->getTotal($keyword);

        // Tính toán số trang
        $totalPages = ceil($total / $limit);

        // Gửi dữ liệu tới view
        $this->render('categories/index', [
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'pageTitle' => $pageTitle
        ]);
    }

    public function create()
    {
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $pageTitle = 'Thêm mới loại hàng';
            $this->render('categories\add', ['category' => [], 'pageTitle' => $pageTitle]);
        }
        
    }

    private function processForm(){
        $categoryName = $_POST['categoryName'];
        $description = $_POST['description'];

        if(!$categoryName || !$description) {
            $error = 'Vui lòng điền đầy đủ thông tin';
            $pageTitle = 'Thêm mới loại hàng';
            return $this->render('categories\add', [
                'category' => [],
                'error' => $error,
                'pageTitle' => $pageTitle
            ]);
        }

        $category = $this->categoryModel->createCategory($categoryName, $description);

        if ($category) {
            header('Location: /category');
            exit();
        } else {
            echo 'Category creation failed.';
        }
    }
    
    public function update($categoryId)
    {
        // if (empty($_SESSION['currentCategory'])) return header("Location: ../category/signin");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($categoryId);            
        } else {
            $pageTitle = 'Cập nhật loại hàng';
            $category = $this->categoryModel->getCategoryById($categoryId);       
            
            $this->render('categories\edit', ['category' => $category, 'pageTitle' => $pageTitle]);

        }
    }
    
    private function processFormUpdate($categoryId)
    {
        $categoryName = $_POST['categoryName'];
        $description = $_POST['description'];

        if(!$categoryName || !$description) {
            $error = 'Vui lòng điền đầy đủ thông tin';
            $pageTitle = 'Cập nhật loại hàng';
            $category = $this->categoryModel->getCategoryById($categoryId);  
            return $this->render('categories\edit', [
                'category' => $category,
                'error' => $error,
                'pageTitle' => $pageTitle
            ]);
        }

        $result = $this->categoryModel->updateCategory($categoryId, $categoryName, $description);

        if ($result === true) {
            header('Location: /category');
            exit();
        } else {
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
            $pageTitle = 'Xóa loại hàng';
            $category = $this->categoryModel->getCategoryById($categoryId);       
            $this->render('categories\delete', ['category' => $category, 'pageTitle' => $pageTitle]);
        }
    }
}
