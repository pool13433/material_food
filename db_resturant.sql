-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2015 at 09:32 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_resturant`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_menu`
--

CREATE TABLE IF NOT EXISTS `food_menu` (
`food_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'ชนิดอาหาร',
  `recipe_id` int(11) NOT NULL COMMENT 'ใบสั่ง',
  `food_name` varchar(255) NOT NULL COMMENT 'ชื่ออาหาร',
  `food_price` int(11) NOT NULL COMMENT 'ราคาอาหาร',
  `food_picture` varchar(255) NOT NULL COMMENT 'ภาพ',
  `food_cost` int(11) NOT NULL COMMENT 'ต้นทุน',
  `food_status` int(11) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_recipe`
--

CREATE TABLE IF NOT EXISTS `food_recipe` (
`recipe_id` int(11) NOT NULL,
  `mat_id` int(11) NOT NULL,
  `volume_use` float NOT NULL,
  `food_id` int(11) NOT NULL,
  `recipe_modifieddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_recipe`
--

INSERT INTO `food_recipe` (`recipe_id`, `mat_id`, `volume_use`, `food_id`, `recipe_modifieddate`) VALUES
(1, 1, 0, 0, '2015-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE IF NOT EXISTS `food_type` (
`type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_modifieddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`type_id`, `type_name`, `type_modifieddate`) VALUES
(1, 'ทอด', '2015-07-03'),
(2, 'ต้ม', '2015-07-03'),
(3, 'ผัด', '2015-07-03'),
(4, 'แกง', '2015-07-03'),
(5, 'ตุ๋น', '2015-07-03'),
(6, 'นึ่ง', '2015-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
`mat_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'ชนิดวัตถุดิบ',
  `quan_id` int(11) NOT NULL COMMENT 'หน่วยเรยก',
  `mat_name` varchar(255) NOT NULL COMMENT 'ชื่อวัตถุดิบ',
  `mat_volume` int(11) NOT NULL,
  `mat_price` int(11) NOT NULL COMMENT 'ราคา',
  `mat_buydate` date NOT NULL COMMENT 'วันที่ซื้อ',
  `mat_expdate` date NOT NULL COMMENT 'วันหมดอายุ',
  `mat_picture` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `mat_status` int(1) NOT NULL,
  `mat_modifieddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`mat_id`, `type_id`, `quan_id`, `mat_name`, `mat_volume`, `mat_price`, `mat_buydate`, `mat_expdate`, `mat_picture`, `mat_status`, `mat_modifieddate`) VALUES
(1, 6, 4, 'กระเทียม', 100, 100, '2015-07-03', '2015-07-03', '1435918287-pic1.jpg', 0, '2015-07-03'),
(2, 2, 7, 'หัวหอม', 11, 11, '2015-07-03', '2015-07-03', '1435918271-pic2.jpg', 0, '2015-07-03'),
(3, 3, 7, 'น้ำปลา', 111111, 111111, '2015-07-03', '2015-07-03', '1435918354-pic3.jpg', 0, '2015-07-03'),
(4, 1, 7, 'หมูเนื้อแดง', 22222, 22222, '2015-07-03', '2015-07-03', '1435918407-pic4.jpg', 0, '2015-07-03'),
(5, 1, 7, 'ปลากระพง', 333, 333, '2015-07-03', '2015-07-03', '1435918443-pic5.jpg', 0, '2015-07-03'),
(6, 1, 3, 'กุ้ง', 100, 1000, '2015-07-03', '2015-07-03', '1435918521-pic6.jpg', 0, '2015-07-03'),
(7, 1, 1, 'ปูม้า', 100, 100, '2015-07-03', '2015-07-03', '1435918623-pic7.jpg', 0, '2015-07-03'),
(8, 3, 7, 'พริกไทย', 100, 90, '2011-02-02', '2015-07-03', '1435934381-pic8.jpg', 0, '2015-07-03'),
(9, 3, 1, 'น้ำมันพืช', 1, 100, '2015-07-03', '2015-07-03', '1435934440-pic9.jpg', 0, '2015-07-03'),
(10, 3, 1, 'เกลือ', 1, 90, '2015-07-03', '2015-07-03', '1435934989-pic10.jpg', 0, '2015-07-03'),
(11, 3, 1, 'ผงชูรส', 1, 100, '2015-07-03', '2015-07-03', '1435935076-pic11.jpg', 0, '2015-07-03'),
(12, 2, 7, 'ผักกาด', 1, 10, '2015-07-03', '2015-07-03', '1435935167-pic12.jpg', 0, '2015-07-03'),
(13, 2, 10, 'กะหล่ำปลี', 100, 10, '2015-07-03', '2015-07-03', '1435935210-pic13.jpg', 1, '2015-07-03'),
(14, 5, 7, 'ข้าวสาร', 100, 500, '2015-07-03', '2015-07-03', '1435935317-pic14.jpg', 0, '2015-07-03'),
(15, 3, 3, 'ซีอิ้วขาว', 5, 100, '2015-07-03', '2015-07-03', '1435935378-pic15.jpg', 0, '2015-07-03'),
(16, 3, 3, 'ซอสปรุงรส', 100, 100, '2015-07-03', '2015-07-03', '1435935465-pic16.jpg', 2, '2015-07-03'),
(17, 3, 1, 'น้ำตาล', 100, 10000, '2015-07-03', '2015-07-03', '1435938957-pic17.jpg', 0, '2015-07-03'),
(18, 6, 3, 'พริกป่น', 100, 100000, '2015-07-03', '2015-07-03', '1435941386-pic18.jpg', 0, '2015-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `material_type`
--

CREATE TABLE IF NOT EXISTS `material_type` (
`type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_modifieddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `material_type`
--

INSERT INTO `material_type` (`type_id`, `type_name`, `type_modifieddate`) VALUES
(1, 'เนื้อสัตว์', '2015-07-02'),
(2, 'ผัก', '2015-07-01'),
(3, 'เครื่องปรุง', '2015-07-01'),
(4, 'เครื่องดื่ม', '2015-07-01'),
(5, 'วัตถุดิบอื่นๆ', '2015-07-01'),
(6, 'เครื่องเทศ', '2015-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `nation`
--

CREATE TABLE IF NOT EXISTS `nation` (
`nat_id` int(11) NOT NULL,
  `nat_name` varchar(255) NOT NULL,
  `nat_modifieddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nation`
--

INSERT INTO `nation` (`nat_id`, `nat_name`, `nat_modifieddate`) VALUES
(1, 'ไทย', '2015-07-02'),
(2, 'ลาว', '2015-07-02'),
(3, 'พม่า', '2015-07-02'),
(4, 'เวียดนาม', '2015-07-02'),
(5, 'มาเลเซีย', '2015-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `quantity`
--

CREATE TABLE IF NOT EXISTS `quantity` (
`quan_id` int(11) NOT NULL,
  `quan_name` varchar(255) NOT NULL,
  `quan_modifieddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quantity`
--

INSERT INTO `quantity` (`quan_id`, `quan_name`, `quan_modifieddate`) VALUES
(1, 'กิโลกรัม', '2015-07-02'),
(2, 'ขีด', '2015-07-02'),
(3, 'ขวด', '2015-07-02'),
(4, 'ช้อนโต๊ะ', '2015-07-02'),
(5, 'ช้อนชา', '2015-07-02'),
(6, 'ถ้วย', '2015-07-02'),
(7, 'กำ', '2015-07-02'),
(8, 'ถุง', '2015-07-02'),
(9, 'ลิตร', '2015-07-03'),
(10, 'หัว', '2015-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
`rec_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `rec_quintity` int(11) NOT NULL,
  `rec_totalprice` int(11) NOT NULL,
  `rec_modifieddate` date NOT NULL,
  `rec_modifiedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL COMMENT 'ลำดับผู้ใช้งาน',
  `code` varchar(20) NOT NULL COMMENT 'รหัสพนักงาน',
  `username` varchar(100) NOT NULL COMMENT 'username',
  `password` varchar(100) NOT NULL COMMENT 'password',
  `fname` varchar(100) NOT NULL COMMENT 'ชื่อจริง',
  `lname` varchar(100) NOT NULL COMMENT 'สกุล',
  `nation_id` int(11) NOT NULL,
  `tel` varchar(10) NOT NULL COMMENT 'มือถือ',
  `email` varchar(50) NOT NULL COMMENT 'อีเมลล์',
  `sex` enum('M','F') NOT NULL COMMENT 'เพศ',
  `age` int(3) NOT NULL COMMENT 'อายุ',
  `card_id` varchar(13) NOT NULL COMMENT 'เลขประชาชน',
  `address` text NOT NULL COMMENT 'ที่อยู่',
  `picture` varchar(255) NOT NULL,
  `modifieddate` date NOT NULL COMMENT 'วันที่ปรับปรุง',
  `type` int(2) NOT NULL COMMENT '1=employee,2=onwer'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `code`, `username`, `password`, `fname`, `lname`, `nation_id`, `tel`, `email`, `sex`, `age`, `card_id`, `address`, `picture`, `modifieddate`, `type`) VALUES
(1, 'AD0580001', 'admin', '1234', 'admin', 'admin', 3, '1234567890', 'admin@gmail.com', 'M', 20, '1234567890101', 'กทม', '1435919309-user-female-icon.png', '2015-07-03', 1),
(2, 'OWN00001', 'ONWER', 'ONWER', 'ONWER', 'ONWER', 3, 'ONWER', 'ONWER', 'M', 20, '0', 'ONWER', '1435934246-user-female-icon.png', '2015-07-03', 2),
(5, 'EMP00001', 'EMPOYEE', 'EMPOYEE', 'EMPOYEE', 'EMPOYEE', 2, 'EMPOYEE', 'EMPOYEE', 'F', 20, '0', 'EMPOYEE', '1435934216-user-female-icon.png', '2015-07-03', 1),
(6, 'OWN00001', 'HEADER', 'HEADER', 'HEADER', 'HEADER', 2, 'HEADER', 'HEADER', 'F', 39, '0', 'HEADER', '1435934234-user-female-icon.png', '2015-07-03', 2),
(7, 'OWN580002', 'OWN580002', 'OWN580002', 'OWN580002', 'OWN580002', 2, 'OWN580002', 'OWN580002@gmail.com', 'F', 23, 'OWN580002', 'OWN580002', '1435897501-user-female-icon.png', '2015-07-03', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_menu`
--
ALTER TABLE `food_menu`
 ADD PRIMARY KEY (`food_id`), ADD KEY `type_id` (`type_id`), ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `food_recipe`
--
ALTER TABLE `food_recipe`
 ADD PRIMARY KEY (`recipe_id`), ADD KEY `mat_id` (`mat_id`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
 ADD PRIMARY KEY (`mat_id`), ADD KEY `type_id` (`type_id`), ADD KEY `quan_id` (`quan_id`), ADD KEY `type_id_2` (`type_id`);

--
-- Indexes for table `material_type`
--
ALTER TABLE `material_type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `nation`
--
ALTER TABLE `nation`
 ADD PRIMARY KEY (`nat_id`);

--
-- Indexes for table `quantity`
--
ALTER TABLE `quantity`
 ADD PRIMARY KEY (`quan_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
 ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_menu`
--
ALTER TABLE `food_menu`
MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food_recipe`
--
ALTER TABLE `food_recipe`
MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `material_type`
--
ALTER TABLE `material_type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nation`
--
ALTER TABLE `nation`
MODIFY `nat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `quantity`
--
ALTER TABLE `quantity`
MODIFY `quan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับผู้ใช้งาน',AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_menu`
--
ALTER TABLE `food_menu`
ADD CONSTRAINT `food_menu_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `food_type` (`type_id`),
ADD CONSTRAINT `food_menu_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `food_recipe` (`recipe_id`);

--
-- Constraints for table `food_recipe`
--
ALTER TABLE `food_recipe`
ADD CONSTRAINT `food_recipe_ibfk_1` FOREIGN KEY (`mat_id`) REFERENCES `material` (`mat_id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `material_type` (`type_id`),
ADD CONSTRAINT `material_ibfk_2` FOREIGN KEY (`quan_id`) REFERENCES `quantity` (`quan_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
