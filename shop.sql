-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 12:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Description`, `created_at`) VALUES
(1, 'Điện tử', 'Danh mục các sản phẩm điện tử như điện thoại, máy tính, thiết bị gia dụng, máy móc', '2024-12-30 03:04:00'),
(2, 'Quần áo', 'Danh mục các sản phẩm quần áo, giày dép, phụ kiện thời trang.', '2024-12-30 03:04:00'),
(3, 'Sách', 'Danh mục các loại sách, giáo trình, tài liệu học tập.', '2024-12-30 03:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Province` varchar(150) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `IsLocked` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CustomerName`, `Username`, `Email`, `Province`, `Address`, `Password`, `IsLocked`, `created_at`) VALUES
(1, 'Nguyen Van Anh', 'Nguyen Van Anh', 'nguyenvananh@example.com', 'Tuyên Quang', '123 Hoang Hoa Tham', 'password123', 0, '2024-12-30 02:41:47'),
(2, 'Tran Thi B', 'tranthib', 'tranthib@example.com', 'Vĩnh Long', '456 Le Loi', 'pass456', 1, '2024-12-30 02:41:47'),
(3, 'Le Van C', 'levanc', 'levanc@example.com', 'Da Nang', '789 Nguyen Van Linh', 'secure789', 0, '2024-12-30 02:41:47'),
(4, 'Pham Thi D', 'phamthid', 'phamthid@example.com', 'Hai Phong', '101 Tran Hung Dao', 'admin2023', 1, '2024-12-30 02:41:47'),
(5, 'Do Van E', 'dovane', 'dovane@example.com', 'Can Tho', '202 Le Duan', 'qwertyui', 0, '2024-12-30 02:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Province` varchar(150) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `Role` varchar(150) DEFAULT NULL,
  `IsWorking` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `EmployeeName`, `Email`, `Province`, `Address`, `Password`, `Role`, `IsWorking`, `created_at`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', 'Hà Nội', 'Số 10, Phố Láng Hạ', '1', 'Admin', 1, '2024-12-30 03:00:58'),
(4, 'Phạm Thanh D', 'phamthanhd@example.com', 'Hải Phòng', 'Số 40, Đường Lạch Tray', 'password101', 'Employee', 1, '2024-12-30 03:00:58'),
(5, 'Hoàng Thị E', 'hoangthie@example.com', 'Cần Thơ', 'Số 50, Đường Lê Lợi', 'password202', 'Employee', 0, '2024-12-30 03:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `ProductDescription` varchar(250) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Photo` varchar(100) NOT NULL,
  `IsSelling` tinyint(1) DEFAULT 0,
  `CategoryID` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `ProductDescription`, `Price`, `Photo`, `IsSelling`, `CategoryID`, `created_at`) VALUES
(2, 'iPhone 15 Pro Max', 'Điện thoại thông minh cao cấp của Apple', '33999.99', 'images/iphone_15_pro_max.jpg', 1, 1, '2024-12-30 03:05:55'),
(3, 'Sony WH-1000XM5', 'Tai nghe chống ồn đỉnh cao', '6999.99', 'images/sony_wh_1000xm5.jpg', 1, 1, '2024-12-30 03:05:55'),
(4, 'Samsung Galaxy Watch 6', 'Đồng hồ thông minh cao cấp của Samsung', '7999.99', 'images/galaxy_watch_6.jpg', 1, 1, '2024-12-30 03:05:55'),
(5, 'Canon EOS R5', 'Máy ảnh không gương lật chuyên nghiệp', '94999.99', 'images/canon_eos_r5.jpg', 0, 1, '2024-12-30 03:05:55'),
(6, 'Laptop Dell XPS 13 NEW', 'Laptop Dell XPS 13', '2999999.00', '', 1, 1, '2024-12-30 09:35:15'),
(7, 'Laptop Dell XPS 13 NEW', 'Laptop Dell XPS 13', '3434343.00', 'ao.jpg', 1, 1, '2024-12-30 09:39:15'),
(8, 'Quần áo phao', 'Quần áo phao', '290000.00', 'ao.jfif', 1, 2, '2024-12-30 09:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `ProvinceName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`ProvinceName`) VALUES
('An Giang'),
('Bà Rịa - Vũng Tàu'),
('Bắc Giang'),
('Bắc Kạn'),
('Bạc Liêu'),
('Bắc Ninh'),
('Bến Tre'),
('Bình Định'),
('Bình Dương'),
('Bình Phước'),
('Bình Thuận'),
('Cà Mau'),
('Cần Thơ'),
('Cao Bằng'),
('Đà Nẵng'),
('Đắk Lắk'),
('Đắk Nông'),
('Điện Biên'),
('Đồng Nai'),
('Đồng Tháp'),
('Gia Lai'),
('Hà Giang'),
('Hà Nam'),
('Hà Nội'),
('Hà Tĩnh'),
('Hải Dương'),
('Hải Phòng'),
('Hậu Giang'),
('Hòa Bình'),
('Hưng Yên'),
('Khánh Hòa'),
('Kiên Giang'),
('Kon Tum'),
('Lai Châu'),
('Lâm Đồng'),
('Lạng Sơn'),
('Lào Cai'),
('Long An'),
('Nam Định'),
('Nghệ An'),
('Ninh Bình'),
('Ninh Thuận'),
('Phú Thọ'),
('Phú Yên'),
('Quảng Bình'),
('Quảng Nam'),
('Quảng Ngãi'),
('Quảng Ninh'),
('Quảng Trị'),
('Sóc Trăng'),
('Sơn La'),
('Tây Ninh'),
('Thái Bình'),
('Thái Nguyên'),
('Thanh Hóa'),
('Thành phố Hồ Chí Minh'),
('Thừa Thiên Huế'),
('Tiền Giang'),
('Trà Vinh'),
('Tuyên Quang'),
('Vĩnh Long'),
('Vĩnh Phúc'),
('Yên Bái');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `fk_category` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
