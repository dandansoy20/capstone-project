-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 12:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kld_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
                             `admin_id` int(11) NOT NULL ,
                             `admin_uname` varchar(255) DEFAULT NULL,
                             `admin_pass` varchar(255) DEFAULT NULL,
                             `admin_fname` varchar(255) DEFAULT NULL,
                             `admin_lname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_audit`
--

CREATE TABLE `admin_audit` (
                               `admin_log` int(11) NOT NULL,
                               `admin_id` int(11) DEFAULT NULL,
                               `admin_logtrail` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
                                `category_id` int(11) NOT NULL ,
                                `category_name` varchar(255) DEFAULT NULL,
                                `category_desc` text DEFAULT NULL,
                                `category_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
                              `course_id` int(11) NOT NULL ,
                              `course_name` varchar(255) DEFAULT NULL,
                              `course_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_features`
--

CREATE TABLE `event_features` (
                                  `feature_id` int(11) NOT NULL ,
                                  `event_id` int(11) DEFAULT NULL,
                                  `feature_title` varchar(255) DEFAULT NULL,
                                  `feature_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_gallery`
--

CREATE TABLE `event_gallery` (
                                 `image_id` int(11) NOT NULL ,
                                 `event_id` int(11) DEFAULT NULL,
                                 `image_filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_invitation`
--

CREATE TABLE `event_invitation` (
                                    `event_invitation_id` int(11) NOT NULL ,
                                    `event_id` int(11) DEFAULT NULL,
                                    `course_id` int(11) DEFAULT NULL,
                                    `yearlvl_id` int(11) DEFAULT NULL,
                                    `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_org_tbl`
--

CREATE TABLE `event_org_tbl` (
                                 `event_org_id` int(11) NOT NULL ,
                                 `org_id` int(11) DEFAULT NULL,
                                 `event_org_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_poster`
--

CREATE TABLE `event_poster` (
                                `event_poster_id` int(11) NOT NULL ,
                                `event_id` int(11) DEFAULT NULL,
                                `event_poster_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_pre_reg`
--

CREATE TABLE `event_pre_reg` (
                                 `pre_regform_id` int(11) NOT NULL ,
                                 `event_id` int(11) DEFAULT NULL,
                                 `pre_regform_url` varchar(255) DEFAULT NULL,
                                 `pre_regform_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_reg`
--

CREATE TABLE `event_reg` (
                             `regform_id` int(11) NOT NULL ,
                             `event_id` int(11) DEFAULT NULL,
                             `regform_url` varchar(255) DEFAULT NULL,
                             `regform_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_time`
--

CREATE TABLE `event_time` (
                              `event_time_id` int(11) NOT NULL ,
                              `event_id` int(11) DEFAULT NULL,
                              `event_time_start` time DEFAULT NULL,
                              `event_time_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kld_event`
--

CREATE TABLE `kld_event` (
                             `event_id` int(11) NOT NULL ,
                             `venue_id` int(11) DEFAULT NULL,
                             `event_org_id` int(11) DEFAULT NULL,
                             `category_id` int(11) DEFAULT NULL,
                             `proc_id` int(11) DEFAULT NULL,
                             `event_date` date DEFAULT NULL,
                             `event_time_id` time DEFAULT NULL,
                             `event_title` varchar(255) DEFAULT NULL,
                             `event_desc` text DEFAULT NULL,
                             `event_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_audit`
--

CREATE TABLE `org_audit` (
                             `org_log` int(11) NOT NULL ,
                             `org_id` int(11) DEFAULT NULL,
                             `org_logtrail` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_tbl`
--

CREATE TABLE `org_tbl` (
                           `org_id` int(11) NOT NULL ,
                           `org_name` varchar(255) DEFAULT NULL,
                           `org_uname` varchar(255) DEFAULT NULL,
                           `org_pass` varchar(255) DEFAULT NULL,
                           `org_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proc_tbl`
--

CREATE TABLE `proc_tbl` (
                            `proc_id` int(11) NOT NULL ,
                            `proc_name` varchar(255) DEFAULT NULL,
                            `proc_desc` text DEFAULT NULL,
                            `proc_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_tbl`
--

CREATE TABLE `section_tbl` (
                               `section_id` int(11) NOT NULL ,
                               `course_id` int(11) DEFAULT NULL,
                               `yearlvl_id` int(11) DEFAULT NULL,
                               `section_name` varchar(255) DEFAULT NULL,
                               `section_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_acc`
--

CREATE TABLE `std_acc` (
                           `std_id` int(11) NOT NULL ,
                           `std_kld_id` int(11) DEFAULT NULL,
                           `std_kld_email` varchar(255) DEFAULT NULL,
                           `std_fname` varchar(255) DEFAULT NULL,
                           `std_lname` varchar(255) DEFAULT NULL,
                           `std_sex` varchar(255) DEFAULT NULL,
                           `std_uname` varchar(255) DEFAULT NULL,
                           `std_pass` varchar(255) DEFAULT NULL,
                           `yearlvl_id` int(11) DEFAULT NULL,
                           `course_id` int(11) DEFAULT NULL,
                           `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `venue_tbl` (
                             `venue_id` int(11) NOT NULL ,
                             `venue_name` varchar(255) DEFAULT NULL,
                             `venue_desc` text DEFAULT NULL,
                             `venue_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `yearlvl_tbl` (
                               `yearlvl_id` int(11) NOT NULL ,
                               `yearlvl_name` varchar(255) DEFAULT NULL,
                               `yearlvl_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
    ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_audit`
--
ALTER TABLE `admin_audit`
    ADD PRIMARY KEY (`admin_log`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
    ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
    ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `event_features`
--
ALTER TABLE `event_features`
    ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `event_gallery`
--
ALTER TABLE `event_gallery`
    ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `event_invitation`
--
ALTER TABLE `event_invitation`
    ADD PRIMARY KEY (`event_invitation_id`);

--
-- Indexes for table `event_org_tbl`
--
ALTER TABLE `event_org_tbl`
    ADD PRIMARY KEY (`event_org_id`);

--
-- Indexes for table `event_poster`
--
ALTER TABLE `event_poster`
    ADD PRIMARY KEY (`event_poster_id`);

--
-- Indexes for table `event_pre_reg`
--
ALTER TABLE `event_pre_reg`
    ADD PRIMARY KEY (`pre_regform_id`);

--
-- Indexes for table `event_reg`
--
ALTER TABLE `event_reg`
    ADD PRIMARY KEY (`regform_id`);

--
-- Indexes for table `event_time`
--
ALTER TABLE `event_time`
    ADD PRIMARY KEY (`event_time_id`);

--
-- Indexes for table `kld_event`
--
ALTER TABLE `kld_event`
    ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `org_audit`
--
ALTER TABLE `org_audit`
    ADD PRIMARY KEY (`org_log`);

--
-- Indexes for table `org_tbl`
--
ALTER TABLE `org_tbl`
    ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `proc_tbl`
--
ALTER TABLE `proc_tbl`
    ADD PRIMARY KEY (`proc_id`);

--
-- Indexes for table `section_tbl`
--
ALTER TABLE `section_tbl`
    ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `std_acc`
--
ALTER TABLE `std_acc`
    ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `venue_tbl`
--
ALTER TABLE `venue_tbl`
    ADD PRIMARY KEY (`venue_id`);

--
-- Indexes for table `yearlvl_tbl`
--
ALTER TABLE `yearlvl_tbl`
    ADD PRIMARY KEY (`yearlvl_id`);

