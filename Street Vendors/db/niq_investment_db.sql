-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2022 at 05:24 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `niq_investment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `names` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `cell` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `names`, `email`, `cell`, `id_number`) VALUES
(1, 'Siyanda Cele', 'syandangwane1998@gmail.com', '7876765657', '6787654543454'),
(2, 'Siyanda', 'syanda@gmail.com', '8787676565', '5654545454545');

-- --------------------------------------------------------

--
-- Table structure for table `client_bank_details`
--

CREATE TABLE `client_bank_details` (
  `id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `btype` varchar(100) NOT NULL,
  `acc_no` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mphone` varchar(100) NOT NULL,
  `hphone` varchar(100) NOT NULL,
  `mstatus` varchar(100) NOT NULL,
  `saddress` varchar(1000) NOT NULL,
  `surburb` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `pcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_bank_details`
--

INSERT INTO `client_bank_details` (`id`, `id_number`, `bname`, `btype`, `acc_no`, `fname`, `lname`, `mphone`, `hphone`, `mstatus`, `saddress`, `surburb`, `country`, `province`, `pcode`) VALUES
(3, '9821239898767', 'ABSA', 'Savings Account', '6767676', 'Siyanda', 'Cele', '0987654321', '0987654321', 'Married', 'MUT Highway 878', 'Umlazi', 'South Africa', 'KwaZulu-Natal', '4001'),
(4, '9876767687676', 'ABSA', 'Savings Account', '65565556', 'Siyanda', 'Cele', '0987654321', '0987654321', 'Single', 'MUT Highway 878', 'Umlazi', 'South Africa', 'KwaZulu-Natal', '4001'),
(6, '8767876767565', 'Standard Bank', 'Savings Account', '776767', 'Siyanda', 'Cele', '0987654321', 'N/A', 'Married', 'MUT Highway 878', 'N/A', 'South Africa', 'KwaZulu-Natal', '4001'),
(7, '8987876765654', 'ABSA', 'Savings Account', '556565656', 'Siyanda', 'Cele', '0987654321', 'N/A', 'Single', 'MUT Highway 878', 'Durban', 'South Africa', 'KwaZulu-Natal', '4001'),
(8, '8987876765656', 'Standard Bank', 'Cheque Account', '767676766', 'Siyanda', 'Cele', '0987654321', 'N/A', 'Married', 'MUT Highway 878', 'N/A', 'South Africa', 'Free State', '4001'),
(9, '9810248787676', 'ABSA', 'Savings Account', '6576767676', 'Siyanda', 'Cele', '0987654321', 'N/A', 'Separated', 'MUT Highway 878', 'Durban', 'South Africa', 'Mpumalanga', '4001');

-- --------------------------------------------------------

--
-- Table structure for table `client_collections`
--

CREATE TABLE `client_collections` (
  `id` int(11) NOT NULL,
  `id_number` varchar(1000) NOT NULL,
  `loan_date` varchar(1000) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_collections`
--

INSERT INTO `client_collections` (`id`, `id_number`, `loan_date`, `amount`, `date`) VALUES
(2, '9821239898767', '2022/09/23 - 11:34:04am', '500', '2022/09/26 - 02:36:16pm'),
(3, '9821239898767', '2022/09/23 - 11:34:04am', '1000', '2022/09/26 - 02:41:27pm'),
(6, '9821239898767', '2022/09/26 - 02:58:02pm', '55', '2022/09/26 - 03:57:39pm'),
(7, '9821239898767', '2022/09/26 - 02:58:02pm', '1', '2022/09/26 - 03:58:40pm'),
(8, '9821239898767', '2022/09/26 - 02:58:02pm', '0.96', '2022/09/26 - 04:05:47pm'),
(9, '9821239898767', '2022/09/23 - 11:34:04am', '200', '2022/09/26 - 04:12:57pm'),
(10, '9821239898767', '2022/09/26 - 02:58:02pm', '2000', '2022/09/26 - 04:13:15pm'),
(11, '9821239898767', '2022/09/26 - 02:58:02pm', '3000', '2022/09/26 - 04:18:01pm'),
(12, '9821239898767', '2022/09/26 - 02:58:02pm', '800', '2022/09/26 - 04:18:22pm');

-- --------------------------------------------------------

--
-- Table structure for table `client_employee_details`
--

CREATE TABLE `client_employee_details` (
  `id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `pcode` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `emp_no` varchar(100) NOT NULL,
  `wphone` varchar(100) NOT NULL,
  `waddress` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `surburb` varchar(1000) NOT NULL,
  `province` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_employee_details`
--

INSERT INTO `client_employee_details` (`id`, `id_number`, `cname`, `pcode`, `fax`, `emp_no`, `wphone`, `waddress`, `country`, `surburb`, `province`) VALUES
(3, '9821239898767', 'Company', '4031', '7767676', '65656656', '0765654543', 'MUT Highway 101', 'South Africa', 'Umlazi', 'KwaZulu-Natal'),
(4, '9876767687676', 'Company', '4031', '7676767', '767676', '0765654543', 'MUT Highway 101', 'South Africa', 'Umlazi', 'KwaZulu-Natal'),
(5, '8767876767565', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A'),
(6, '8987876765654', 'Company', '4031', 'N/A', 'N/A', '0765654543', 'MUT Highway 101', 'South Africa', 'N/A', 'KwaZulu-Natal'),
(7, '8987876765656', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A'),
(8, '9810248787676', 'Company', '4031', 'N/A', 'N/A', '0765654543', 'MUT Highway 101', 'South Africa', 'N/A', 'KwaZulu-Natal');

-- --------------------------------------------------------

--
-- Table structure for table `client_employer_info`
--

CREATE TABLE `client_employer_info` (
  `id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `employer` varchar(1000) NOT NULL,
  `reg_date` varchar(100) NOT NULL,
  `statuss` varchar(100) NOT NULL,
  `pay_date` varchar(100) NOT NULL,
  `bphone` varchar(100) NOT NULL,
  `emp_started_date` varchar(100) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `hrname` varchar(1000) NOT NULL,
  `surburb` varchar(1000) NOT NULL,
  `province` varchar(1000) NOT NULL,
  `addresss` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `zcode` varchar(100) NOT NULL,
  `note` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_employer_info`
--

INSERT INTO `client_employer_info` (`id`, `id_number`, `employer`, `reg_date`, `statuss`, `pay_date`, `bphone`, `emp_started_date`, `country`, `hrname`, `surburb`, `province`, `addresss`, `city`, `zcode`, `note`) VALUES
(2, '8767876767565', 'N/A', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A'),
(3, '8987876765656', 'Siyanda Cele', 'N/A', '', 'N/A', '0987654321', 'N/A', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A'),
(4, '9810248787676', 'N/A', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `client_personal_details`
--

CREATE TABLE `client_personal_details` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fname` varchar(1000) NOT NULL,
  `lname` varchar(1000) NOT NULL,
  `mphone` varchar(100) NOT NULL,
  `hphone` varchar(100) NOT NULL,
  `id_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emp_no` varchar(100) NOT NULL,
  `mstatus` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_personal_details`
--

INSERT INTO `client_personal_details` (`id`, `title`, `fname`, `lname`, `mphone`, `hphone`, `id_no`, `email`, `emp_no`, `mstatus`, `language`, `address`) VALUES
(4, 'Mr', 'Siyanda', 'Cele', '0987654321', '0765654543', '9821239898767', 'syandangwane1998@gmail.com', '65656556', 'Single', 'IsiZulu', 'No'),
(5, 'Dr', 'Siyanda Cele', 'Cele', '0987654321', '0765654543', '9876767687676', 'syandangwane1998@gmail.com', '54444', 'Single', 'IsiZulu', 'No'),
(7, 'Mr', 'Siyanda', 'Cele', '0987654321', 'N/A', '9898787676565', 'syandangwane1998@gmail.com', 'N/A', 'Single', 'IsiZulu', 'No'),
(8, 'Mr', 'Siyanda', 'Cele', '0987654321', 'N/A', '8767876767565', 'N/A', 'N/A', 'Married', 'IsiZulu', 'No'),
(9, 'Mr', 'Siyanda Cele', 'Cele', '0987654321', 'N/A', '8987876765654', 'syandangwane1998@gmail.com', 'N/A', 'Single', 'IsiZulu', 'No'),
(10, 'Mr', 'Siyanda', 'Cele', '0987654321', 'N/A', '8987876765656', 'syandangwane1998@gmail.com', 'N/A', 'Single', 'IsiZulu', 'No'),
(11, 'Mr', 'Siyanda', 'Cele', '0987654321', 'N/A', '9810248787676', 'syandangwane1998@gmail.com', 'N/A', 'Married', 'English', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `id_number` varchar(1000) NOT NULL,
  `contract_number` varchar(1000) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `id_number`, `contract_number`, `amount`, `date`) VALUES
(5, '9821239898767', '1300', '1000', '2022/09/25 - 12:10:43am'),
(6, '9821239898767', '1300', '500', '2022/09/25 - 12:10:53am');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `periods` varchar(100) NOT NULL,
  `interest` varchar(1000) NOT NULL,
  `statuss` varchar(1000) NOT NULL,
  `dates` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `id_number`, `amount`, `periods`, `interest`, `statuss`, `dates`) VALUES
(1, '5654545454545', '1000', '4 Months', '25', 'Active', '2022/09/07'),
(2, '5654545454545', '2000', '1 Month', '30', 'Not Active', '2022/09/07'),
(3, '5654545454545', '3000', '6 Months', '35', 'Active', '2022/09/07'),
(4, '5654545454545', '1000', '6 Months', '35', 'Active', '2022/09/10');

-- --------------------------------------------------------

--
-- Table structure for table `loan_affordability_assessment`
--

CREATE TABLE `loan_affordability_assessment` (
  `id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `gross` varchar(100) NOT NULL,
  `bonus` varchar(100) NOT NULL,
  `allowance` varchar(100) NOT NULL,
  `other` varchar(100) NOT NULL,
  `tax` varchar(1000) NOT NULL,
  `uif` varchar(1000) NOT NULL,
  `pfund` varchar(1000) NOT NULL,
  `garnishees` varchar(100) NOT NULL,
  `medical_aid` varchar(100) NOT NULL,
  `other_deductions` varchar(100) NOT NULL,
  `loan_deductions` varchar(100) NOT NULL,
  `insurance` varchar(100) NOT NULL,
  `shop_accounts` varchar(100) NOT NULL,
  `l_expenses` varchar(100) NOT NULL,
  `nlr_loan` varchar(100) NOT NULL,
  `cp_loan` varchar(100) NOT NULL,
  `total_earning` varchar(100) NOT NULL,
  `net_salary` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_affordability_assessment`
--

INSERT INTO `loan_affordability_assessment` (`id`, `id_number`, `gross`, `bonus`, `allowance`, `other`, `tax`, `uif`, `pfund`, `garnishees`, `medical_aid`, `other_deductions`, `loan_deductions`, `insurance`, `shop_accounts`, `l_expenses`, `nlr_loan`, `cp_loan`, `total_earning`, `net_salary`) VALUES
(13, '9821239898767', '100000', '878', '7878', '7878', '7878', '7878', '7878', '787', '878', '787', '878', '787', '878', '787', '87', '878', '0.00', '0'),
(14, '9876767687676', '10000', '77', '877', '8787', '8787', '878', '7878', '787', '878', '787', '87', '878', '78', '787', '87', '878', '0.00', '0'),
(15, '9821239898767', '100000', '878', '7878', '787', '877', '8787', '87', '878', '787', '87', '87', '78', '7', '77', '87', '878', '0.00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `loan_dates`
--

CREATE TABLE `loan_dates` (
  `id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `contract_type` varchar(100) NOT NULL,
  `loan_purpose` varchar(1000) NOT NULL,
  `ndate` varchar(100) NOT NULL,
  `ldate` varchar(100) NOT NULL,
  `loan_date` varchar(1000) NOT NULL,
  `loan_amount` varchar(1000) NOT NULL,
  `lend_amount` varchar(1000) NOT NULL,
  `installment` varchar(1000) NOT NULL,
  `contract_number` varchar(1000) NOT NULL,
  `loan` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_dates`
--

INSERT INTO `loan_dates` (`id`, `id_number`, `contract_type`, `loan_purpose`, `ndate`, `ldate`, `loan_date`, `loan_amount`, `lend_amount`, `installment`, `contract_number`, `loan`, `status`) VALUES
(14, '9821239898767', '2 Months', 'Tuition Fee', '2022-09-24', '2023-03-24', '2022/09/23 - 11:34:04am', '2600', '7628', '1938', '1300', '2000', 'Active'),
(15, '9876767687676', 'Weekly Term', 'Tuition Fee', '2022-09-29', '2022-10-08', '2022/09/26 - 09:03:55am', '2600', '2958.48', '', '1301', '2000', 'Active'),
(16, '9821239898767', 'Weekly Term', 'Rent', '2022-09-30', '2022-09-30', '2022/09/26 - 02:58:02pm', '5200', '5856.96', '1469', '1302', '4000', 'Paid off');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(1000) NOT NULL,
  `id_number` varchar(1000) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `dates` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `loan_id`, `id_number`, `amount`, `dates`) VALUES
(12, '1', '5654545454545', '100', '2022/09/07'),
(14, '3', '5654545454545', '300', '2022/09/07'),
(16, '1', '5654545454545', '250', '2022/09/08'),
(17, '2', '5654545454545', '2600', '2022/09/08'),
(18, '1', '5654545454545', '500', '2022/09/10');

-- --------------------------------------------------------

--
-- Table structure for table `street_vendors`
--

CREATE TABLE `street_vendors` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fname` varchar(1000) NOT NULL,
  `lname` varchar(1000) NOT NULL,
  `mphone` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `date` varchar(100) NOT NULL,
  `userid` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `street_vendors`
--

INSERT INTO `street_vendors` (`id`, `title`, `fname`, `lname`, `mphone`, `address`, `date`, `userid`) VALUES
(8, 'Mr', 'Siyanda Cele', 'Cele', '0987654321', 'MUT Highway 878', '2022/09/25 - 09:56:33am', '0987654321-2022/09/25 - 09:56:33am'),
(9, 'Dr', 'Siyanda', 'Khanyile', '0788676765', 'MUT 878', '2022/09/25 - 11:38:40am', '0788676765-2022/09/25 - 11:38:40am'),
(10, 'Dr', 'Admin', 'Admin', '0989878767', 'MUT Highway 100', '2022/09/26 - 12:09:06pm', '0989878767-2022/09/26 - 12:09:06pm');

-- --------------------------------------------------------

--
-- Table structure for table `street_vendor_collections`
--

CREATE TABLE `street_vendor_collections` (
  `id` int(11) NOT NULL,
  `loan_id` varchar(1000) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `street_vendor_collections`
--

INSERT INTO `street_vendor_collections` (`id`, `loan_id`, `amount`, `date`) VALUES
(1, '2022/09/25 - 10:24:40am', '200', '2022/09/25 - 11:32:37am'),
(3, '2022/09/25 - 10:24:40am', '1000', '2022/09/25 - 11:33:07am'),
(4, '2022/09/25 - 10:24:40am', '1000', '2022/09/25 - 11:37:08am'),
(5, '2022/09/25 - 09:56:33am', '1300', '2022/09/25 - 11:39:10am'),
(10, '2022/09/25 - 11:38:40am', '600', '2022/09/25 - 02:11:22pm'),
(11, '2022/09/25 - 11:38:40am', '300', '2022/09/26 - 09:55:30am');

-- --------------------------------------------------------

--
-- Table structure for table `street_vendor_loans`
--

CREATE TABLE `street_vendor_loans` (
  `id` int(11) NOT NULL,
  `userid` varchar(1000) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `date` text NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `street_vendor_loans`
--

INSERT INTO `street_vendor_loans` (`id`, `userid`, `amount`, `interest`, `total`, `date`, `due_date`, `status`) VALUES
(1, '0987654321-2022/09/25 - 09:56:33am', '1000', '300', '1300', '2022/09/25 - 09:56:33am', '2022-12-17', 'Paid off'),
(2, '0987654321-2022/09/25 - 09:56:33am', '2000', '200', '2200', '2022/09/25 - 10:24:40am', '2022-10-08', 'Paid off'),
(3, '0788676765-2022/09/25 - 11:38:40am', '3000', '900', '3900', '2022/09/25 - 11:38:40am', '2023-01-27', 'Active'),
(4, '0989878767-2022/09/26 - 12:09:06pm', '1000', '300', '1300', '2022/09/26 - 12:09:06pm', '2022-10-08', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `names` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `passwords` varchar(1000) NOT NULL,
  `role` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `names`, `email`, `passwords`, `role`) VALUES
(1, 'Syanda Ngwane', 'admin@gmail.com', 'admin123', 'admin'),
(2, 'Ntakaso Khubone', 'staff@gmail.com', 'staff123', 'staff'),
(3, 'Ntakaso Khubone', 'staff1@gmail.com', 'staff1123', 'staff'),
(4, 'Siyanda Cele', 'syandangwane1998@gmail.com', '12345', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_bank_details`
--
ALTER TABLE `client_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_collections`
--
ALTER TABLE `client_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_employee_details`
--
ALTER TABLE `client_employee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_employer_info`
--
ALTER TABLE `client_employer_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_personal_details`
--
ALTER TABLE `client_personal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_affordability_assessment`
--
ALTER TABLE `loan_affordability_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_dates`
--
ALTER TABLE `loan_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `street_vendors`
--
ALTER TABLE `street_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `street_vendor_collections`
--
ALTER TABLE `street_vendor_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `street_vendor_loans`
--
ALTER TABLE `street_vendor_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_bank_details`
--
ALTER TABLE `client_bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_collections`
--
ALTER TABLE `client_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `client_employee_details`
--
ALTER TABLE `client_employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client_employer_info`
--
ALTER TABLE `client_employer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_personal_details`
--
ALTER TABLE `client_personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_affordability_assessment`
--
ALTER TABLE `loan_affordability_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loan_dates`
--
ALTER TABLE `loan_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `street_vendors`
--
ALTER TABLE `street_vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `street_vendor_collections`
--
ALTER TABLE `street_vendor_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `street_vendor_loans`
--
ALTER TABLE `street_vendor_loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
