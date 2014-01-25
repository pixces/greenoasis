-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2014 at 11:45 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greenoasis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `admin_email` varchar(150) CHARACTER SET latin1 NOT NULL,
  `role` int(1) NOT NULL DEFAULT '2',
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `last_login` varchar(20) CHARACTER SET latin1 NOT NULL,
  `logout_time` varchar(20) CHARACTER SET latin1 NOT NULL,
  `admin_status` tinyint(5) NOT NULL DEFAULT '1',
  `man_home` int(1) NOT NULL DEFAULT '0',
  `man_link` int(1) NOT NULL DEFAULT '0',
  `man_content` int(1) NOT NULL DEFAULT '0',
  `man_event` int(1) NOT NULL DEFAULT '0',
  `man_admin` int(1) NOT NULL DEFAULT '0',
  `man_products` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `admin_email`, `role`, `username`, `password`, `last_login`, `logout_time`, `admin_status`, `man_home`, `man_link`, `man_content`, `man_event`, `man_admin`, `man_products`) VALUES
(1, 'Admin', '', 'pixces@yahoo.com', 1, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', '', '', 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `address` text,
  `city` varchar(150) DEFAULT NULL,
  `province` varchar(150) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `alt_phone` varchar(50) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` enum('pending','approved','inactive','expired','deleted') NOT NULL DEFAULT 'pending',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_approved` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `company`, `contact`, `address`, `city`, `province`, `country`, `zip`, `phone`, `fax`, `alt_phone`, `email`, `password`, `status`, `date_added`, `date_modified`, `date_approved`) VALUES
(2, 'Xpression Solutions', 'Zainul Abdeen', NULL, 'Bangalore', NULL, 'Karnataka', NULL, '+91 9742074452', NULL, NULL, 'pixces@yahoo.com', '', 'pending', '2013-12-28 12:41:25', '2013-12-28 11:41:25', '0000-00-00 00:00:00'),
(3, 'Innoveins', 'Zainul Abdeen', NULL, 'Bangalore', NULL, 'Karnataka', NULL, '+91 9742074452', NULL, NULL, 'pixces@gmail.com', '', 'pending', '2013-12-29 08:29:55', '2013-12-29 19:29:55', '0000-00-00 00:00:00'),
(4, 'Zareen Travels', 'Zarina', NULL, 'Bangalore', NULL, 'India', NULL, '9742074452', NULL, NULL, 'zareena@gmail.com', '', 'pending', '2014-01-22 07:50:53', '2014-01-22 18:50:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `reference_no` int(11) NOT NULL,
  `pax_adults` int(11) NOT NULL,
  `pax_child` int(11) NOT NULL,
  `pax_name` varchar(150) NOT NULL,
  `service` enum('Hotel','Visa','Tours') NOT NULL DEFAULT 'Hotel',
  `service_type` varchar(150) NOT NULL COMMENT 'for hotels: room type',
  `rate_type` varchar(150) NOT NULL COMMENT 'for hotels: occupancy',
  `rate_basis` varchar(150) NOT NULL COMMENT 'for hotels: meal plan',
  `amount` int(11) NOT NULL,
  `currency` enum('AED','USD') NOT NULL DEFAULT 'AED',
  `spl_instruction` text NOT NULL,
  `addl_instructions` text NOT NULL,
  `status` enum('confirmed','re-confirmed','on-request','cancelled') NOT NULL DEFAULT 'confirmed',
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`key`, `value`) VALUES
('site_url', 'http://localhost:8888/greenoasis'),
('encryption_seed', '3782adf93db49e7239836bb23072f31'),
('environment', 'development');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(250) NOT NULL,
  `hotel_address` text NOT NULL,
  `hotel_logo` varchar(150) DEFAULT NULL,
  `hotel_city` varchar(150) NOT NULL,
  `hotel_area` varchar(150) DEFAULT NULL,
  `hotel_country` varchar(150) NOT NULL,
  `hotel_phone` varchar(50) DEFAULT NULL,
  `hotel_fax` varchar(50) DEFAULT NULL,
  `hotel_email` varchar(150) DEFAULT NULL,
  `hotel_website` varchar(150) DEFAULT NULL,
  `hotel_stars` varchar(2) DEFAULT '0',
  `hotel_details` text,
  `manager` varchar(250) DEFAULT NULL,
  `release_period` int(11) NOT NULL DEFAULT '5' COMMENT 'in days',
  `policy_room_terms` text,
  `amenities` text,
  `policy_occupancy` text,
  `policy_child` text,
  `policy_checkinout` text,
  `policy_cancellation` text,
  `infant_max_age` int(2) NOT NULL DEFAULT '5',
  `child_max_age` int(2) NOT NULL DEFAULT '12',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=281 ;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `hotel_address`, `hotel_logo`, `hotel_city`, `hotel_area`, `hotel_country`, `hotel_phone`, `hotel_fax`, `hotel_email`, `hotel_website`, `hotel_stars`, `hotel_details`, `manager`, `release_period`, `policy_room_terms`, `amenities`, `policy_occupancy`, `policy_child`, `policy_checkinout`, `policy_cancellation`, `infant_max_age`, `child_max_age`, `status`, `date_modified`, `date_added`) VALUES
(1, 'Hotel Hilton International', 'Baniyas Street PO Box 33398, Dubai, 00001', 'logo.jpg', 'Dubai', 'Baniyas Street', 'uae', '971-4-227-1111', '971-4-227-1131', 'hilton@dubaihotels.com', 'http://dubaihotels.com', '5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Zainul Abdeen', 0, 'he right info helps make planning effective and stays comfortable. Here you can find details of Hotel Policies on items such as Smoking, Check-In/Check-Out times, Cancellation Policies, Payment, Pets and parking. For additional details, please call the hotel or email frontdeskadmin.creek@hilton.com.', '["laundry","wifi","pool","restaurant","gym","Parking","spa","banquet","ballroom","conference","room_service","security","safe_deposite","business","transport","av_equipments"]', 'he right info helps make planning effective and stays comfortable. Here you can find details of Hotel Policies on items such as Smoking, Check-In/Check-Out times, Cancellation Policies, Payment, Pets and parking. For additional details, please call the hotel or email frontdeskadmin.creek@hilton.com.', 'he right info helps make planning effective and stays comfortable. Here you can find details of Hotel Policies on items such as Smoking, Check-In/Check-Out times, Cancellation Policies, Payment, Pets and parking. For additional details, please call the hotel or email frontdeskadmin.creek@hilton.com.', 'he right info helps make planning effective and stays comfortable. Here you can find details of Hotel Policies on items such as Smoking, Check-In/Check-Out times, Cancellation Policies, Payment, Pets and parking. For additional details, please call the hotel or email frontdeskadmin.creek@hilton.com.', 'he right info helps make planning effective and stays comfortable. Here you can find details of Hotel Policies on items such as Smoking, Check-In/Check-Out times, Cancellation Policies, Payment, Pets and parking. For additional details, please call the hotel or email frontdeskadmin.creek@hilton.com.', 0, 0, 'active', '2013-11-01 10:10:45', '2013-09-20 02:55:19'),
(3, 'AURIS PLAZA HOTEL', 'P.O.Box : 390531, Dubai', '', 'Dubai', 'Al Barsha', 'uae', '+971 4 455 4800', '+9714 455 8929', 'reservation.plaza@auris-hotels', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-21 19:35:17', '2020-09-13 02:55:00'),
(4, 'COPTHORNE HOTEL', 'PORT SAEED - DEIRA - DUBAI', '', 'Dubai', 'Deira', 'uae', '+971 4 295 0500', '+971 4 295 0551', '', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-21 19:35:16', '2020-09-13 02:55:00'),
(8, 'CARLTON TOWER HOTEL', 'P.O Box 1955 baniyas Street Deira Dubai', '', 'Dubai', 'Deira', 'uae', '009714-222 71 1', '009714- 222 82', 'carlton@emirates.net.ae', 'www.carltontower.net', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(9, 'SHERATON DEIRA HOTEL', 'AL MUTEENA STREET, P.O. BOX 5772, DUBAI, UNITED AR', '', 'Dubai', 'Deira', 'uae', '00971 4 2688888', '00971 4 262 502', 'sheratondeira@sheraton.com', 'www.starwoodhotels.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'MS.BUSHRA', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-21 19:35:13', '2020-09-13 02:55:00'),
(17, 'COMFORT INN HOTEL', 'Al Rigga Road, Dubai, UAE.', '', 'Dubai', 'Deira', 'uae', '00971 4 222 73', '00971 4 222 44', '', 'www.hotelcomfortinn.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-21 19:35:14', '2020-09-13 02:55:00'),
(22, 'IBIS MALL OF THE EMIRATES', 'Mall of Emirates', '', 'Dubai', 'Al Barsha', 'uae', '+971 4 3823000', '+971 4 3823001', 'h6493@accor.com', 'www.accorgroupsofhotel.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Mr. Sufian', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(40, 'SUN & SANDS HOTEL', 'PO BOX 35659 DUBAI, UAE', '', 'Dubai', 'Deira', 'uae', '+971 4 223 9000', '+971 4 228 3455', 'sales@dubaigot.com', 'www.sunandsandshotel.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(45, 'ARABIAN COURTYARD HOTEL & SPA', 'Al Fahidi Street - Opposite Dubai Museum', '', 'Dubai', 'Bur Dubai', 'uae', '04 351 9111', '+971-4-3517744', 'sales@arabiancourtyard.com', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(130, 'ASIANA HOTEL', 'SALAHUDDIN STREET - DUBAI', '', 'Dubai', 'Deira', 'uae', '04 238 7777', '+971 4 238 7776', 'asianahotel@asianahoteldubai.c', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(131, 'CLARIDGE HOTEL', 'Al Muteena, Fish Roundabout', '', 'Dubai', '', 'uae', '971-4-2716666', '+971 272 2626', '', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(136, 'COUNTRY CLUB HOTEL', 'PORT RASHID ROAD - DUBAI', '', 'Dubai', 'Bur Dubai', 'uae', '+971 4 398 8840', '+971 4 398 5352', '', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(148, 'HILTON DUBAI CREEK', 'Baniyas Street PO Box 33398, Dubai, 00001, U.A.E', '', 'Dubai', 'Dubai Creek', 'uae', '+971-4-227-1111', '+971-4-227-1131', 'reservations.dubai@hilton.com', 'www.hilton.com/Sale', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(154, 'NOVOTEL DEIRA CITY CENTER', '8th str Port Saeed District Front of Deira City Ce', '', 'Dubai', '', 'uae', '+971 4 292 52 0', '+971 4 292 52 0', 'h6482@accor.com', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(157, 'IBN BATUTA GATE', 'Adjacent to Ibn Battuta Shopping Mall | P.O.Box 21', '', 'Dubai', 'Adjacent to Ibn Batt', 'uae', '+971 4 444 0000', '', 'hotel.dubai.ibnbattuta@moevenp', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(177, 'SUHA CITY HOTEL', 'P. O. BOX 11954, DUBAI, UAE', '', 'Dubai', 'Deira', 'uae', '04 341 6111', '', '', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(181, 'RAMADA HOTEL - SHARJAH', 'Al Nahda Street, PO Box 60553, Sharjah, UAE', '', 'Sharjah', '', 'uae', '06 5300003', '06 5259808', 'reservations@ramadasharjah.com', 'www.ramadahsharjah.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Dian Sarsonas', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(188, 'HOLIDAY INN AL BARSHA', 'Al Barsha, Nr Mall of the Emirates', '', 'Dubai', '', 'uae', '+971-4-3234333', '+971-4-3234334', '', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(200, 'RADISSON BLU FUJEIRAH HOTEL', 'Dibba, Fujairah', '', 'Fujairah', 'Dibba, Fujairah', 'uae', '+971 9 244 9700', '+971 9 244 9777', 'info.resort.fujairah@radissonb', 'www.radissonblu.com/resort-fuj', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-11-01 10:10:47', '2020-09-13 02:55:00'),
(203, 'GRAND EXCESIOR HOTEL', 'Al Barsha', '', 'Dubai', '', 'uae', '009714 4449999', '009714 4477223', 'mohammed.saeed@grandexcelsior.', 'www.grandexcelsior.ae', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'MR. Mohammad Said', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(207, 'AL JAWHARA GARDENS', 'P.O. BOX 121711 DUBAI, UAE', '', 'Dubai', 'Deira', 'uae', '04-2107777', '04-2944577', 'sales@aljawharahotel.com', 'www.jawhara.ae', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'MR. YASSER DAHMAN', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(211, 'RADISSON BLU HOTEL DAWNTOWN', 'Downtown', '', 'Dubai', 'Dubai', 'uae', '009714 450 20 0', '009714 450 20 9', 'hazem.aouad@radissonblu.com', '', '5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-11-01 10:10:48', '2020-09-13 02:55:00'),
(276, 'DOLPHIN HOTEL APARTMENTS', 'P.O. Box 121678, Dubai, UAE', '', 'Dubai', 'Bur Dubai', 'uae', '+971 4 359 7999', '+971 4 359 8282', 'dolphin@emirates.net.ae', 'www.dolphinhotel.ae', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'SANJIV SHINGADIA - Hotel Manager', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-21 19:35:15', '2020-09-13 02:55:00'),
(277, 'DHOW PALACE HOTEL', 'P.O. Box 121545, Dubai, UAE', '', 'Dubai', 'Bur Dubai', 'uae', '+971 4 359 9992', '+971 4 359 5511', 'sales@dhowpalacedubai.com', '', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'FADOUA EL MESBAHI - Sales & Marketi', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(279, 'SUHA HOTEL APARTMENTS', 'P. O. Box 282481, Dubai, UAE', '', 'Dubai', 'Jumeirah', 'uae', '+9714 392 7171', '+971 4 450 3766', 'reservations.uae@mondohospital', 'www.mondohospitality.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '', '', '', '', '', '', 0, 0, 'active', '2013-09-19 20:43:19', '2020-09-13 02:55:00'),
(280, 'AL BARSHA HOTEL APARTMENTS', 'P. O. BOX 125707, DUBAI, UAE', '', 'Dubai', 'Al Barsha', 'uae', '+9714 392 7171', '+971 4 450 3766', 'reservations.uae@mondohospital', 'www.mondohospitality.com', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, 'Not valid', '["laundry","wifi","pool","restaurant","gym","Parking","spa","conference","room_service","security","safe_deposite","av_equipments"]', 'Not valid', 'Child below 5 years are free. Between 5 years to 12 years should have extra bed. Above 12 years will be considered as adults.', '24 hours check-in and check-out policy.', 'Reservation can be cancelled before 48 hours, otherwise no refund can be claimed.', 0, 0, 'active', '2013-09-21 19:43:33', '2020-09-13 02:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `image_type` enum('logo','main','gallery') NOT NULL DEFAULT 'gallery',
  `image_caption` varchar(250) DEFAULT NULL,
  `image_name` varchar(250) NOT NULL,
  `image_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`id`, `hotel_id`, `image_type`, `image_caption`, `image_name`, `image_status`, `date_modified`) VALUES
(13, 1, 'gallery', NULL, '1391237249.jpg', 'active', '2013-10-30 21:34:06'),
(14, 276, 'gallery', NULL, '1309183242.jpg', 'active', '2013-10-30 21:34:06'),
(15, 177, 'gallery', NULL, '1274400556.jpg', 'active', '2013-10-30 21:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_occupancy`
--

CREATE TABLE `hotel_occupancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_tariff_id` int(11) NOT NULL,
  `occupancy_type` enum('single','double','triple','quad','unit') NOT NULL DEFAULT 'single',
  `room_count` int(11) NOT NULL DEFAULT '20',
  `room_rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `hotel_occupancy`
--

INSERT INTO `hotel_occupancy` (`id`, `hotel_tariff_id`, `occupancy_type`, `room_count`, `room_rate`) VALUES
(1, 1, 'single', 20, 100),
(2, 1, 'double', 20, 105),
(3, 1, 'triple', 20, 125),
(5, 2, 'double', 20, 110),
(6, 2, 'triple', 20, 130),
(8, 1, 'unit', 0, 0),
(9, 2, 'single', 20, 456),
(10, 3, 'single', 20, 580),
(11, 4, 'double', 20, 656),
(12, 5, 'triple', 20, 563),
(13, 6, 'single', 20, 256),
(14, 7, 'double', 20, 256),
(15, 8, 'single', 20, 856),
(16, 9, 'unit', 20, 846),
(17, 10, 'single', 20, 505),
(18, 11, 'single', 20, 422),
(19, 12, 'single', 20, 338),
(20, 13, 'single', 20, 255),
(21, 14, 'double', 20, 172),
(22, 15, 'triple', 20, 860),
(23, 16, 'single', 20, 750),
(24, 17, 'double', 20, 741),
(25, 18, 'single', 20, 162),
(26, 19, 'unit', 20, 245),
(27, 20, 'single', 20, 328),
(28, 21, 'single', 20, 412),
(29, 22, 'single', 20, 496),
(30, 23, 'single', 20, 579),
(31, 24, 'double', 20, 663),
(32, 25, 'triple', 20, 746),
(33, 26, 'single', 20, 829),
(34, 27, 'double', 20, 913),
(35, 28, 'single', 20, 990),
(36, 29, 'unit', 20, 179),
(37, 30, 'single', 20, 163),
(38, 31, 'single', 20, 246),
(39, 32, 'single', 20, 330),
(40, 33, 'single', 20, 413),
(41, 34, 'double', 20, 590),
(42, 35, 'triple', 20, 65),
(43, 36, 'single', 20, 566),
(44, 37, 'double', 20, 56),
(45, 38, 'single', 20, 656),
(46, 39, 'unit', 20, 695),
(47, 40, 'single', 20, 951),
(48, 41, 'single', 20, 753),
(49, 42, 'single', 20, 952),
(50, 43, 'single', 20, 750),
(51, 44, 'double', 20, 953),
(52, 45, 'triple', 20, 452),
(53, 46, 'single', 20, 225),
(54, 47, 'double', 20, 157),
(55, 48, 'single', 20, 955),
(56, 49, 'unit', 20, 985),
(57, 50, 'single', 20, 451),
(58, 51, 'single', 20, 456),
(59, 52, 'single', 20, 456),
(60, 53, 'single', 20, 253),
(61, 54, 'double', 20, 852),
(62, 55, 'triple', 20, 651),
(63, 56, 'single', 20, 658),
(64, 57, 'double', 20, 552),
(65, 58, 'single', 20, 856),
(66, 59, 'unit', 20, 785),
(67, 60, 'single', 20, 965),
(68, 61, 'single', 20, 456),
(69, 62, 'single', 20, 123),
(70, 63, 'single', 20, 321),
(71, 64, 'double', 20, 852),
(72, 65, 'triple', 20, 952),
(73, 66, 'single', 20, 658),
(74, 67, 'double', 20, 658),
(75, 68, 'single', 20, 952),
(76, 69, 'unit', 20, 658),
(77, 70, 'single', 20, 952),
(78, 71, 'single', 20, 952),
(79, 72, 'single', 20, 658),
(80, 73, 'single', 20, 952),
(81, 74, 'double', 20, 658),
(82, 75, 'triple', 20, 952),
(83, 76, 'single', 20, 952),
(84, 77, 'double', 20, 658),
(85, 78, 'single', 20, 952),
(86, 79, 'unit', 20, 952),
(87, 80, 'single', 20, 658),
(88, 81, 'single', 20, 952),
(89, 82, 'single', 20, 658);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_reservation`
--

CREATE TABLE `hotel_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `hotel_tariff_id` int(11) DEFAULT NULL,
  `fromDate` date DEFAULT NULL,
  `toDate` date DEFAULT NULL,
  `room_count` int(11) DEFAULT NULL,
  `hotel_occupancy_id` int(11) DEFAULT NULL,
  `booking_pax_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_sessions`
--

CREATE TABLE `hotel_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_session` varchar(150) NOT NULL,
  `search_session` varchar(50) NOT NULL,
  `type` enum('basic','advance') NOT NULL DEFAULT 'basic',
  `params` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `hotel_sessions`
--

INSERT INTO `hotel_sessions` (`id`, `user_session`, `search_session`, `type`, `params`, `date_added`) VALUES
(1, '0.62142000 13814068155256985f97e6c', '13814159641028442456', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":"a1c0","checkin":"10102013","checkout":"11102013","nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '0000-00-00 00:00:00'),
(2, '0.62142000 13814068155256985f97e6c', '13814162323915838', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":"a1c0","checkin":"10102013","checkout":"11102013","nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '0000-00-00 00:00:00'),
(3, '0.62142000 13814068155256985f97e6c', '13814282251153800073', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":"a1c0","checkin":"10102013","checkout":"11102013","nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '0000-00-00 00:00:00'),
(4, '5257e02f2c36b', '13814907351916874997', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":"a1c0","checkin":"11102013","checkout":"12102013","nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 11:25:35'),
(5, '5257e02f2c36b', '13815019401664898382', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":"11102013","checkout":"12102013","nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 14:32:20'),
(6, '5257e02f2c36b', '13815047211909617123', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 15:18:41'),
(7, '5257e02f2c36b', '13815050751411536506', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":"","rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 15:24:35'),
(8, '5257e02f2c36b', '13815051521338781052', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1381512811.08,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 15:25:52'),
(9, '5257e02f2c36b', '13815052312061713014', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 15:27:11'),
(10, '5257e02f2c36b', '13815255211345412287', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Fujairah, United Arab Emirates"}', '2013-10-11 21:05:21'),
(11, '5257e02f2c36b', '13815259471506700018', 'basic', '{"city":"Sharjah","country":" United Arab Emirates","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Sharjah, United Arab Emirates"}', '2013-10-11 21:12:27'),
(12, '5257e02f2c36b', '13815259771062172577', 'basic', '{"city":"Sharjah","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Sharjah, United Arab Emirates"}', '2013-10-11 21:12:57'),
(13, '5257e02f2c36b', '13815259941015706140', 'basic', '{"city":"Fujairah","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Fujairah, United Arab Emirates"}', '2013-10-11 21:13:14'),
(14, '5257e02f2c36b', '1381526121289581488', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381442400,"checkout":1381528800,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-11 21:15:21'),
(15, '525a568f80aec', '13816521111506218447', 'basic', '{"city":"Khorfakkan","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381615200,"checkout":1381701600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Khorfakkan, United Arab Emirates"}', '2013-10-13 08:15:11'),
(16, '525a568f80aec', '13816521311561034246', 'basic', '{"city":"Fujairah","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381615200,"checkout":1381701600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Fujairah, United Arab Emirates"}', '2013-10-13 08:15:31'),
(17, '525a568f80aec', '13816528641229392177', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381615200,"checkout":1381701600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-13 08:27:44'),
(18, '525a568f80aec', '13816862391374846691', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381615200,"checkout":1381701600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-13 17:43:59'),
(19, '525a568f80aec', '1381690398947245012', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381615200,"checkout":1381701600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-13 18:53:18'),
(20, '525a568f80aec', '13816915101239018784', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381615200,"checkout":1381701600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-13 19:11:50'),
(21, '525c3f9258712', '138177729861654827', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1381701600,"checkout":1381788000,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-14 19:01:38'),
(22, '52700bf10f1e9', '1383074801115203781', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1383001200,"checkout":1383087600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-29 19:26:41'),
(23, '52700bf10f1e9', '1383077477739562', 'basic', '{"city":"Dubai","country":"UAE","area":"","pax":{"adult":1,"children":0},"checkin":1383001200,"checkout":1383087600,"nights":1,"rooms":"1","roomtype":"Sgl","location":"Dubai, United Arab Emirates"}', '2013-10-29 20:11:17'),
(24, '527033cf805dd', '1383085750810540819', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383001200,"checkout":1383087600,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-29 22:29:10'),
(25, '527033cf805dd', '1383155520965985757', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383087600,"checkout":1383606000,"nights":6,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-30 17:52:00'),
(26, '527033cf805dd', '13831717061382098641', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383087600,"checkout":1383174000,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-30 22:21:46'),
(27, '527033cf805dd', '13831718361811642031', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383087600,"checkout":1383778800,"nights":8,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-30 22:23:56'),
(28, '5271d6e08cae5', '1383192288891804381', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1396476000,"checkout":1383087600,"nights":-154.958333333,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-31 04:04:48'),
(29, '5271d6e08cae5', '1383192316216651577', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383174000,"checkout":1383346800,"nights":2,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-31 04:05:16'),
(30, '5271d6e08cae5', '1383192858350063813', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383174000,"checkout":1383260400,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-10-31 04:14:18'),
(31, '5271d6e08cae5', '1383291510441446351', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383260400,"checkout":1383346800,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-01 07:38:30'),
(32, '5271d6e08cae5', '13833122151347085180', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383260400,"checkout":1383346800,"nights":1,"rooms":"2","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-01 13:23:35'),
(33, '527552ff2a4c4', '1383420671585928540', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383346800,"checkout":1383433200,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-02 19:31:11'),
(34, '52760d377c790', '1383468343226374196', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383433200,"checkout":1383519600,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-03 08:45:43'),
(35, '52760d377c790', '13836768021172743181', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383865200,"checkout":1384297200,"nights":5,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-05 18:40:02'),
(36, '527a8c768e687', '1383763062549901467', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383692400,"checkout":1383778800,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-06 18:37:42'),
(37, '527a8c768e687', '13837632311067955294', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383692400,"checkout":1383778800,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-06 18:40:31'),
(38, '527e163786c3a', '1383994935955681477', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1383951600,"checkout":1384038000,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-09 11:02:15'),
(39, '527e163786c3a', '1384072694909218947', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1384038000,"checkout":1384124400,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-10 08:38:14'),
(40, '528873f283402', '1384674290828976463', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1384642800,"checkout":1384729200,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-17 07:44:50'),
(41, '528873f283402', '13846783381870928886', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1384642800,"checkout":1384729200,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-17 08:52:18'),
(42, '528873f283402', '1384678723241550150', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1384642800,"checkout":1384729200,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-17 08:58:43'),
(43, '529117359ceaa', '1385240373755414954', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1385161200,"checkout":1385247600,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-23 20:59:33'),
(44, '5294f5126ef91', '13854937782136025133', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1385420400,"checkout":1385506800,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-26 19:22:58'),
(45, '5294f5126ef91', '13854987902104643884', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1385420400,"checkout":1385506800,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-26 20:46:30'),
(46, '5296469bb72bc', '13855801871036749365', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1385506800,"checkout":1385593200,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-27 19:23:07'),
(47, '52978f779d530', '13856643751832333805', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1385593200,"checkout":1385679600,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-11-28 18:46:15'),
(48, '52a60e23e19d2', '1386614307175922476', 'basic', '{"city":"Dubai","country":"uae","area":"","pax":{"adult":1},"checkin":1386543600,"checkout":1386630000,"nights":1,"rooms":"1","roomtype":"single","location":"Dubai, United Arab Emirates"}', '2013-12-09 18:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_tariffs`
--

CREATE TABLE `hotel_tariffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `season_name` varchar(150) NOT NULL,
  `room_count` int(5) NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `market` enum('GCC','Intl','All') NOT NULL DEFAULT 'All',
  `room_type` varchar(150) NOT NULL,
  `meal_plan` enum('RO','BB','HB','FB') NOT NULL DEFAULT 'BB',
  `single` int(5) NOT NULL DEFAULT '0',
  `double` int(5) NOT NULL DEFAULT '0',
  `triple` int(5) NOT NULL DEFAULT '0',
  `unit` int(5) NOT NULL DEFAULT '0',
  `infant_meal` int(5) NOT NULL DEFAULT '0',
  `child_breakfast` int(5) NOT NULL DEFAULT '0',
  `child_lunch` int(5) NOT NULL DEFAULT '0',
  `child_dinner` int(5) NOT NULL DEFAULT '0',
  `adult_breakfast` int(5) NOT NULL DEFAULT '0',
  `adult_lunch` int(5) NOT NULL DEFAULT '0',
  `adult_dinner` int(11) NOT NULL DEFAULT '0',
  `adult_extra_bed` int(11) NOT NULL DEFAULT '0',
  `child_extra_bed` int(11) NOT NULL DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `hotel_tariffs`
--

INSERT INTO `hotel_tariffs` (`id`, `hotel_id`, `season_name`, `room_count`, `date_start`, `date_end`, `market`, `room_type`, `meal_plan`, `single`, `double`, `triple`, `unit`, `infant_meal`, `child_breakfast`, `child_lunch`, `child_dinner`, `adult_breakfast`, `adult_lunch`, `adult_dinner`, `adult_extra_bed`, `child_extra_bed`, `date_modified`, `date_added`) VALUES
(1, 1, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Standard Room ', 'RO', 100, 105, 125, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(2, 1, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Standard Room ', 'BB', 105, 110, 130, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(3, 1, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Standard Room ', 'HB', 115, 120, 150, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(4, 1, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Standard Room ', 'FB', 115, 120, 155, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(5, 9, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Executive Room ', 'RO', 150, 155, 170, 0, 0, 4, 5, 5, 0, 10, 10, 75, 50, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(6, 9, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Executive Room ', 'BB', 155, 160, 190, 0, 0, 4, 5, 5, 0, 10, 10, 75, 50, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(7, 136, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Deluxe Room ', 'BB', 200, 205, 0, 0, 0, 4, 5, 5, 0, 10, 10, 100, 75, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(8, 148, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Deluxe Room ', 'HB', 105, 110, 0, 0, 0, 4, 5, 5, 0, 10, 10, 100, 75, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(9, 1, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Premium Room', 'RO', 0, 0, 0, 300, 0, 4, 5, 5, 0, 10, 10, 125, 100, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(10, 1, 'Winter 2013', 20, '2013-10-15', '2013-12-20', 'GCC', 'Premium Room', 'BB', 0, 0, 0, 350, 0, 4, 5, 5, 0, 10, 10, 125, 100, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(11, 1, 'Winter Premium 2013', 20, '2013-12-21', '2014-02-14', 'All', 'Standard Room ', 'RO', 100, 105, 180, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(12, 1, 'Winter Premium 2013', 20, '2013-12-21', '2014-02-14', 'All', 'Standard Room ', 'BB', 105, 110, 190, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(13, 1, 'Winter Premium 2013', 20, '2013-12-21', '2014-02-14', 'All', 'Standard Room ', 'HB', 125, 130, 185, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(14, 1, 'Winter Premium 2013', 20, '2013-12-21', '2014-02-14', 'All', 'Standard Room ', 'FB', 135, 140, 210, 0, 0, 4, 5, 5, 0, 10, 10, 50, 25, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(15, 1, 'Winter Extended', 20, '2014-02-15', '2014-03-15', 'All', 'Executive Room ', 'RO', 150, 155, 250, 0, 0, 4, 5, 5, 0, 10, 10, 75, 50, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(16, 1, 'Winter Extended', 20, '2014-02-15', '2014-03-15', 'All', 'Executive Room ', 'BB', 155, 160, 300, 0, 0, 4, 5, 5, 0, 10, 10, 75, 50, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(17, 1, 'Winter Extended', 20, '2014-02-15', '2014-03-15', 'All', 'Deluxe Room ', 'BB', 200, 205, 0, 0, 0, 4, 5, 5, 0, 10, 10, 100, 75, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(18, 1, 'Winter Extended', 20, '2014-02-15', '2014-03-15', 'All', 'Deluxe Room ', 'HB', 105, 110, 0, 0, 0, 4, 5, 5, 0, 10, 10, 100, 75, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(19, 1, 'Winter Extended', 20, '2014-02-15', '2014-03-15', 'All', 'Premium Room', 'RO', 0, 0, 0, 325, 0, 4, 5, 5, 0, 10, 10, 125, 100, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(20, 1, 'Winter Extended', 20, '2014-02-15', '2014-03-15', 'All', 'Premium Room', 'BB', 0, 0, 0, 375, 0, 4, 5, 5, 0, 10, 10, 125, 100, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(21, 276, 'Winter Rates', 20, '2013-10-25', '2014-02-20', 'All', 'EXECUTIVE SUITE (1 BDR)', 'BB', 415, 429, 0, 0, 0, 0, 0, 0, 0, 0, 0, 88, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(22, 276, 'Winter Rates', 20, '2013-10-25', '2014-02-20', 'All', 'EXECUTIVE SUITE (1 BDR)', 'FB', 515, 529, 0, 0, 0, 0, 0, 0, 0, 0, 0, 88, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(23, 276, 'Winter Rates', 20, '2013-10-25', '2014-02-20', 'All', 'PREMIUM SUITE (2 BDR)', 'BB', 0, 0, 0, 645, 0, 0, 0, 0, 0, 0, 0, 88, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(24, 276, 'Winter Rates', 20, '2013-10-25', '2014-02-20', 'All', 'STANDARD STUDIO', 'BB', 315, 354, 0, 0, 0, 0, 0, 0, 0, 0, 0, 88, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(25, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'SUPERIOR ROOM', 'BB', 490, 524, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(26, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'DELUXE ROOM', 'BB', 540, 579, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(27, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'JUNIOR SUITE', 'BB', 700, 734, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(28, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'ONE BEDROOM SUITE', 'BB', 800, 869, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(29, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'SUPERIOR ROOM', 'BB', 355, 394, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(30, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'DELUXE ROOM', 'BB', 410, 449, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(31, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'JUNIOR SUITE', 'BB', 540, 579, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(32, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'ONE BEDROOM SUITE', 'BB', 665, 734, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(33, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'SUPERIOR ROOM', 'BB', 510, 554, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(34, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'DELUXE ROOM', 'BB', 565, 604, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(35, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'JUNIOR SUITE', 'BB', 700, 734, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(36, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'ONE BEDROOM SUITE', 'BB', 800, 869, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(37, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'SUPERIOR ROOM', 'RO', 440, 454, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(38, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'DELUXE ROOM', 'RO', 490, 504, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(39, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'JUNIOR SUITE', 'RO', 645, 659, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(40, 177, 'High Season 1', 20, '2013-11-25', '2014-02-14', 'All', 'ONE BEDROOM SUITE', 'RO', 750, 764, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(41, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'SUPERIOR ROOM', 'RO', 330, 344, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(42, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'DELUXE ROOM', 'RO', 380, 394, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(43, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'JUNIOR SUITE', 'RO', 510, 524, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(44, 177, 'Low Season', 20, '2013-09-25', '2013-11-24', 'All', 'ONE BEDROOM SUITE', 'RO', 615, 629, 0, 0, 0, 0, 0, 0, 0, 0, 0, 163, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(45, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'SUPERIOR ROOM', 'RO', 460, 474, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(46, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'DELUXE ROOM', 'RO', 505, 519, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(47, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'JUNIOR SUITE', 'RO', 645, 659, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(48, 177, 'High Season 2', 20, '2009-01-14', '0000-00-00', 'All', 'ONE BEDROOM SUITE', 'RO', 750, 764, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-09-12 19:26:00', '2021-09-12 19:26:00'),
(60, 1, 'New Year 2014', 20, '2013-12-20', '2014-01-04', 'All', 'Standard Room', 'BB', 120, 150, 210, 0, 0, 0, 15, 15, 0, 35, 35, 35, 35, '2013-09-26 19:55:49', '2013-09-26 04:25:49'),
(61, 1, 'New Year 2014', 20, '2013-12-20', '2014-01-04', 'All', 'Standard Room', 'FB', 150, 200, 250, 0, 0, 0, 0, 0, 0, 0, 0, 50, 50, '2013-09-26 19:55:49', '2013-09-26 04:25:49'),
(62, 1, 'New Year 2014', 20, '2013-12-20', '2014-01-04', 'All', 'Executive Room', 'BB', 250, 325, 400, 0, 0, 0, 15, 15, 0, 35, 35, 50, 50, '2013-09-26 19:55:49', '2013-09-26 04:25:49'),
(63, 1, 'New Year 2014', 20, '2013-12-20', '2014-01-04', 'All', 'Executive Room', 'HB', 500, 550, 600, 0, 0, 0, 50, 50, 0, 50, 50, 0, 0, '2013-09-26 19:55:49', '2013-09-26 04:25:49'),
(64, 1, 'New Year 2014', 20, '2013-12-20', '2014-01-04', 'All', 'Executive Room', 'FB', 500, 550, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013-09-26 19:55:49', '2013-09-26 04:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `type` enum('tour','combo') NOT NULL DEFAULT 'tour',
  `duration` varchar(150) DEFAULT NULL,
  `aside` text,
  `recommended` int(1) NOT NULL DEFAULT '0',
  `featured` int(1) NOT NULL DEFAULT '0',
  `class` enum('family','friend','alone','spouse','honeymoon') NOT NULL DEFAULT 'family',
  `hotel` text,
  `transport` text,
  `others` text,
  `details` text,
  `visa` text,
  `tnc` text,
  `cancellation` text,
  `price` int(8) NOT NULL,
  `price_terms` varchar(250) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` enum('active','inactive','expired') NOT NULL DEFAULT 'active',
  `date_added` datetime DEFAULT NULL,
  `date_modifed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `video_url` varchar(250) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `url` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keyword`, `image`, `video_url`, `file_name`, `template_name`, `url`, `status`, `date_modified`) VALUES
(14, 0, 'About Us', 'about-us', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'This is the meta title of the page', 'this is the meta description of the page', 'this is the meta keyword of the page', '1420066936.jpg', 'http://youtu.be/leXo4-QLNVc', '', '', '/about-us/', 'active', '2013-07-27 20:34:23'),
(15, 0, 'FAQ''s : Frequent Questions', 'faqs', '<p>What is Lorem Ipsum?<br />\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Where does it come from?<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>Why do we use it?<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Where can i get some?<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', '', '', '', '', '', '', '', '/faqs/', 'active', '2013-07-27 20:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `visas`
--

CREATE TABLE `visas` (
  `id` int(10) NOT NULL,
  `agent_id` varchar(25) NOT NULL,
  `type` varchar(50) NOT NULL,
  `validity` int(11) NOT NULL COMMENT 'validity in days',
  `arrival` date NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pax_count` int(11) NOT NULL,
  `date_issue` date DEFAULT NULL,
  `date_expiry` date DEFAULT NULL,
  `visa_file_name` varchar(250) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visas`
--

INSERT INTO `visas` (`id`, `agent_id`, `type`, `validity`, `arrival`, `phone`, `email`, `pax_count`, `date_issue`, `date_expiry`, `visa_file_name`, `date_added`, `date_modified`) VALUES
(95080, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 08:58:45', '2013-11-17 19:58:45'),
(80647, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:08:59', '2013-11-17 20:08:59'),
(3622, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:10:54', '2013-11-17 20:10:54'),
(5797, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:11:32', '2013-11-17 20:11:32'),
(42338, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:12:54', '2013-11-17 20:12:54'),
(1315, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:13:29', '2013-11-17 20:13:29'),
(3969, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:17:38', '2013-11-17 20:17:38'),
(91555, '1', 'Tourist Visa', 30, '2013-11-22', '91-9742074452', 'pixces@yahoo.com', 2, NULL, NULL, NULL, '2013-11-17 09:20:33', '2013-11-17 20:20:33'),
(31022, '1', 'Service Visa', 14, '2013-11-21', '91-9742074452', 'pixces@yahoo.com', 1, NULL, NULL, NULL, '2013-11-17 09:22:45', '2013-11-17 20:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `visa_paxes`
--

CREATE TABLE `visa_paxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visa_id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `passport` varchar(15) NOT NULL,
  `issue` date NOT NULL,
  `expiry` date NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `visa_paxes`
--

INSERT INTO `visa_paxes` (`id`, `visa_id`, `fname`, `mname`, `lname`, `dob`, `age`, `gender`, `nationality`, `passport`, `issue`, `expiry`, `image`, `date_added`) VALUES
(1, 0, 'Zainul', '', 'Abdeen', '0000-00-00', 0, 'male', 'Indian', 'K-589567', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-01_at_5.07.24 pm.png","Screen_Shot_2013-11-10_at_2.04.47 pm.png"]', '2013-11-17 20:11:32'),
(2, 0, 'Zarina', 'Anju', 'Abdeen', '0000-00-00', 0, 'female', 'Indian', 'K-256756', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-10_at_2.37.55 pm.png","Screen_Shot_2013-11-10_at_2.38.02 pm.png"]', '2013-11-17 20:11:32'),
(3, 0, 'Zainul', '', 'Abdeen', '0000-00-00', 0, 'male', 'Indian', 'K-589567', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-01_at_5.07.24 pm.png","Screen_Shot_2013-11-10_at_2.04.47 pm.png"]', '2013-11-17 20:12:54'),
(4, 0, 'Zarina', 'Anju', 'Abdeen', '0000-00-00', 0, 'female', 'Indian', 'K-256756', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-10_at_2.37.55 pm.png","Screen_Shot_2013-11-10_at_2.38.02 pm.png"]', '2013-11-17 20:12:54'),
(5, 1315, 'Zainul', '', 'Abdeen', '0000-00-00', 0, 'male', 'Indian', 'K-589567', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-01_at_5.07.24 pm.png","Screen_Shot_2013-11-10_at_2.04.47 pm.png"]', '2013-11-17 20:13:29'),
(6, 1315, 'Zarina', 'Anju', 'Abdeen', '0000-00-00', 0, 'female', 'Indian', 'K-256756', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-10_at_2.37.55 pm.png","Screen_Shot_2013-11-10_at_2.38.02 pm.png"]', '2013-11-17 20:13:29'),
(7, 3969, 'Zainul', '', 'Abdeen', '0000-00-00', 0, 'male', 'Indian', 'K-589567', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-01_at_5.07.24 pm.png","Screen_Shot_2013-11-10_at_2.04.47 pm.png"]', '2013-11-17 20:17:38'),
(8, 3969, 'Zarina', 'Anju', 'Abdeen', '0000-00-00', 0, 'female', 'Indian', 'K-256756', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-10_at_2.37.55 pm.png","Screen_Shot_2013-11-10_at_2.38.02 pm.png"]', '2013-11-17 20:17:38'),
(9, 91555, 'Zainul', '', 'Abdeen', '0000-00-00', 0, 'male', 'Indian', 'K-589567', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-01_at_5.07.24 pm.png","Screen_Shot_2013-11-10_at_2.04.47 pm.png"]', '2013-11-17 20:20:33'),
(10, 91555, 'Zarina', 'Anju', 'Abdeen', '0000-00-00', 0, 'female', 'Indian', 'K-256756', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-10_at_2.37.55 pm.png","Screen_Shot_2013-11-10_at_2.38.02 pm.png"]', '2013-11-17 20:20:33'),
(11, 31022, 'Zoya', '', 'Abdeen', '0000-00-00', 0, 'female', 'Indian', 'K-589567', '2012-02-10', '2022-02-10', '["Screen_Shot_2013-11-10_at_2.28.40 pm.png","Screen_Shot_2013-11-10_at_2.37.55 pm.png"]', '2013-11-17 20:22:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
