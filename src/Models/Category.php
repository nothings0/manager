<?php

namespace App\Models;

use System\Core\Model;


class Category extends Model
{

    public function getAllCategories()
    {
        $result = $this->mysqli->query("SELECT * FROM categories");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($categoryId)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);
        $result = $this->mysqli->query("SELECT * FROM categories WHERE CategoryID = $categoryId");

        return $result->fetch_assoc();
    }

    public function createCategory($customerName, $description)
    {
        $customerName = $this->mysqli->real_escape_string($customerName);
        $description = $this->mysqli->real_escape_string($description);

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("INSERT INTO categories (CategoryName, Description) VALUES ('$customerName', '$description')");
    }

    public function updateCategory($categoryId, $customerName, $description)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);
        $customerName = $this->mysqli->real_escape_string($customerName);
        $description = $this->mysqli->real_escape_string($description);

        $query = "UPDATE categories SET CategoryName='$customerName', Description='$description' WHERE CategoryID=$categoryId";

        if ($this->mysqli->query($query)) {
            return true; // Thành công
        } else {
            return $this->mysqli->error; // Trả về lỗi
        }
    }


    public function deleteCategory($categoryId)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);
        $query = "DELETE FROM categories WHERE CategoryID=$categoryId";

        if ($this->mysqli->query($query)) {
            return true; // Thành công
        } else {
            return false; // Trả về lỗi
        }
    }

    public function getPaginated($page, $limit, $keyword)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->mysqli->prepare("SELECT * FROM categories WHERE CategoryName LIKE '%$keyword%' LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset); // Tránh SQL Injection
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) AS total FROM categories WHERE CategoryName LIKE '%$keyword%'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
}
