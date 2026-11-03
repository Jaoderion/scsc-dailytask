-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2026 at 10:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `krc_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplishments`
--

CREATE TABLE `accomplishments` (
  `id` int(11) NOT NULL,
  `report_date` varchar(50) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `end_time` varchar(20) DEFAULT NULL,
  `remarks` varchar(20) DEFAULT '-DONE',
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accomplishments`
--

INSERT INTO `accomplishments` (`id`, `report_date`, `activity`, `start_time`, `end_time`, `remarks`, `username`) VALUES
(8288, 'May 01, 2026', 'Attend Flag Ceremony', '08:00 AM', '10:00 PM', '-DONE', 'Darry'),
(8289, 'May 01, 2026', '', '10:01 PM', '', '-DONE', 'Darry'),
(8290, 'May 02, 2026', 'Attend Flag Ceremony', '08:00 AM', '10:00 PM', '-DONE', 'Darry'),
(8291, 'May 02, 2026', '', '10:01 PM', '', '-DONE', 'Darry'),
(11070, 'June 01, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:12 AM ', '09:30 AM', '-DONE', 'mar'),
(11071, 'June 01, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11072, 'June 01, 2026', 'Cleaned and cleaned the back of guard house.', '01:31 PM', '04:43 PM', '-DONE', 'mar'),
(11073, 'June 02, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:18 AM ', '09:30 AM', '-DONE', 'mar'),
(11074, 'June 02, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11075, 'June 02, 2026', 'Placed a stand for the flag to be displayed at the front of admin building.', '01:00 PM ', '04:01 PM', '-DONE', 'mar'),
(11076, 'June 03, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:21 AM ', '09:30 AM', '-DONE', 'mar'),
(11077, 'June 03, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11078, 'June 03, 2026', 'Cleaned the room at the theory building 1&2 and house keeping building.', '01:00 PM ', '04:18 PM', '-DONE', 'mar'),
(11079, 'June 04, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:16 AM ', '09:30 AM', '-DONE', 'mar'),
(11080, 'June 04, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11081, 'June 04, 2026', 'Hauled chair from admin building and library to gym and arranged it.', '01:00 PM ', '04:02 PM', '-DONE', 'mar'),
(11082, 'June 05, 2026', 'Mowed and cleaned the areas around Theory Building 1 and 2.', '06:35 AM  ', '04:08 PM', '-DONE', 'mar'),
(11083, 'June 08, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:22 AM ', '11:30 AM', '-DONE', 'mar'),
(11084, 'June 08, 2026', 'Cleaned and cleared the area affected during the earthquake.', '01:00 PM ', '04:10 PM', '-DONE', 'mar'),
(11085, 'June 09, 2026', 'Cordoned the area around IBEM Bldg and cutted the tree\'s at the back of IALab building.', '06:27 AM ', '04:03 PM', '-DONE', 'mar'),
(11086, 'June 10, 2026', 'Mowed at the front of IALab building and back of Admin building.', '06:30 AM ', '04:10 PM', '-DONE', 'mar'),
(11087, 'June 11, 2026', 'Mowed and cleared the front of agriculture dryer going to SCSC canteen.', '06:30 AM', '04:002PM', '-DONE', 'mar'),
(11088, 'June  12, 2026', 'Rearranged and landscaped the center island front of new gate.', '06:30 AM', '04:11 PM', '-DONE', 'mar'),
(11089, 'June 15, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:30  AM ', '09:30 AM', '-DONE', 'mar'),
(11090, 'June 15, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11091, 'June 15, 2026', 'Checked and repaired water pipe line from bartending to old comfort room.', '01:00 PM ', '04:03 PM', '-DONE', 'mar'),
(11092, 'June 16, 2026', 'Mowed at the front and back of bartending and landscaped the front of guard house.', '06:29  AM', '04:02 PM', '-DONE', 'mar'),
(11093, 'June 17, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:13 AM ', '09:30 AM', '-DONE', 'mar'),
(11094, 'June 17, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11095, 'June 17, 2026', 'Hauled TV set from IBEM for return to supplier.', '11:31 PM ', '04:02 PM', '-DONE', 'mar'),
(11096, 'June 18, 2026', 'Cleaned the water tank and landscaped the back of guard house.', '06:21 AM', '11:08 AM', '-DONE', 'mar'),
(11097, 'June 18, 2026', 'Cleaned the roof and repaired the roof hole at food processing.', '11:11 AM', '04:01 PM', '-DONE', 'mar'),
(11098, 'June 19, 2026', 'Washed the trash bins and removed cobwebs at the Admin Building.', '06:38 AM', '04:03 PM', '-DONE', 'mar'),
(11099, 'June 22, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:22 AM ', '09:30 AM', '-DONE', 'mar'),
(11100, 'June 22, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11101, 'June 22, 2026', 'Hauled tables from marketing office to gym and hauled books from library to gym.', '11:31 PM ', '04:01 PM', '-DONE', 'mar'),
(11102, 'June 23, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:28 AM ', '09:30 AM', '-DONE', 'mar'),
(11103, 'June 23, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11104, 'June 23, 2026', 'Repaired and welded the step holder of the tractor.', '11:31 PM ', '04:02 PM', '-DONE', 'mar'),
(11105, 'June 24, 2026', 'Mowed and cleared the area at the back of Radio Bandera and in between of radio station and new library building.', '06:28 AM ', '04:04 PM', '-DONE', 'mar'),
(11106, 'June 25, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:19 AM ', '09:30 AM', '-DONE', 'mar'),
(11107, 'June 25, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '11:30 AM', '-DONE', 'mar'),
(11108, 'June 25, 2026', 'Repaired the sink and water drainage at the food processing building and cookery building.', '11:31 PM ', '04:04 PM', '-DONE', 'mar'),
(11109, 'June 26, 2026', 'Mowed at the front of faculty and back of old library and cleared the water drainage at the new gate.', '06:46 AM', '04:24 PM', '-DONE', 'mar'),
(11110, 'Jun 29, 2026', 'Trimmed tree\'s at the hall way from IBEM building to school gym and mowed at the front of new gate.', '12:24 PM', '05:26  PM', '-DONE', 'mar'),
(11111, 'Jun 30, 2026', 'Assisted and attended SCSC  51\'st anniversary.', '06:47 AM', '04:01 PM', '-DONE', 'mar'),
(18238, 'Aug 01, 2026', ' Hauled sand and gravel at the front of IBEM and dumped at the front gate. Cleaned the gym and the its sorrounding', '1:16 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18239, 'Aug 03, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18240, 'Aug 03, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18241, 'Aug 04, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18242, 'Aug 04, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18243, 'Aug 04, 2026', 'Installed TV at room 6 Theory Building 2, Arranged the table and chairs in the gymn', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18244, 'Aug 05, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18245, 'Aug 05, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18246, 'Aug 05, 2026', 'Removed the window screen at the FSM room.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18247, 'Aug 06, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18248, 'Aug 06, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18249, 'Aug 06, 2026', 'Filled bricks at the entrance admin building', '02:01 PM', '03:00 PM', '-DONE', 'aavillanueva'),
(18250, 'Aug 06, 2026', 'Hauled tables from marketing area to masonry.', '03:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18251, 'Aug 07, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18252, 'Aug 07, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18253, 'Aug 07, 2026', 'Hauled tables and chairs from oval to masonry and gym. Returned the chairs borrowed from library and cleaned the oval', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18254, 'Aug 08, 2026', 'Assisted the fogging and misting personnel, mowed at the rizal park and cleaned the gymn and its sorrounding.', '07:30 AM', '04:30 PM', '-DONE', 'aavillanueva'),
(18255, 'Aug 10, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18256, 'Aug 10, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18257, 'Aug 10, 2026', 'Transfered tables,chairs,computers and printer from 2nd floor admin to COC building, hauled chairs from 10 doors to AI building.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18258, 'Aug 11, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18259, 'Aug 11, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18260, 'Aug 11, 2026', 'Hauled chairs from 10 doors to TBL room 5 and pest management building. Hauled coco lumber and color roof sin from bambo hub to IBEM and front of new gate.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18261, 'Aug 12, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18262, 'Aug 12, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18263, 'Aug 12, 2026', 'Hauled drawing tables from TB2 to Admin  and chairs from 10 doors to TB1', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18264, 'Aug 13, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18265, 'Aug 13, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18266, 'Aug 13, 2026', 'Installed roof shield at the IBEM.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18267, 'Aug 14, 2026', 'Continued installed roof shield at the IBEM and installed TV at the IBEM BSTM room', '07:30 AM', '04:30 PM', '-DONE', 'aavillanueva'),
(18268, 'Aug 17, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18269, 'Aug 17, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18270, 'Aug 17, 2026', 'Installed TV at the bartending trainer center.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18271, 'Aug 18, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18272, 'Aug 18, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18273, 'Aug 18, 2026', 'Hauled the assembled gate from marketing area to back to 10 doors.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18274, 'Aug 19, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18275, 'Aug 19, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18276, 'Aug 19, 2026', 'Hauled coco lumber from marketing area to back of marketing area to 10 doors', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18277, 'Aug 20, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18278, 'Aug 20, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18279, 'Aug 20, 2026', 'Transfered tables, chairs and computers at the admin office to another office for the room renovations purpose.', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18280, 'Aug 21, 2026', 'Hauled Chairs from masonry to IBEM and repaired it', '7:30  AM ', '04:30  PM', '-DONE', 'aavillanueva'),
(18281, 'Aug 22, 2026', 'Mowed and cleared the back of the theory building 2.', '7:30  AM ', '04:30  PM', '-DONE', 'aavillanueva'),
(18282, 'Aug 24, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18283, 'Aug 24, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18284, 'Aug 24, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18285, 'Aug 25, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18286, 'Aug 25, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18287, 'Aug 25, 2026', 'Fixed the gate at the corner of the  10-doors', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18288, 'Aug 26, 2026', 'Cleaned and repaired roof at the bamboo hub.', '08:00 AM', '05:00 PM', '-DONE', 'aavillanueva'),
(18289, 'Aug 27, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '7:05  AM ', '11:30  AM', '-DONE', 'aavillanueva'),
(18290, 'Aug 27, 2026', 'Cleaned at the back of admin building removed the dry leaves and cutted plants. cut the water pipe line at the old comfort room', '12: 31 PM', '02:00 PM', '-DONE', 'aavillanueva'),
(18291, 'Aug 27, 2026', 'Hauled tables from COC building to organic and poultry ', '02:01 PM', '04:30 PM', '-DONE', 'aavillanueva'),
(18292, 'Aug 28, 2026', 'Cleaned the gym and its sorrounding. installed aircon box at the OSAS Cleaned the IBEM. Arranged the chairs and hauled tables for UEMPC assembly meeting. ', '07:30 AM', '04:30 PM', '-DONE', 'aavillanueva'),
(28882, 'Sept. 01, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs 30 mins', '', '-DONE', 'mnaguila'),
(28883, 'Sept. 01, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30mins', '', '-DONE', 'mnaguila'),
(28884, 'Sept. 01, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28885, 'Sept. 01, 2026', ' Cleaned and arranged the office of CAO.', '3 hrs', '', '-DONE', 'mnaguila'),
(28886, 'Sep 02, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28887, 'Sep 02, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28888, 'Sep 02, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28889, 'Sep 02, 2026', ' Cleaned the OP room and transfered cabines from OP room to auditor\'s office.. Cleaned the GSO stock room.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28890, 'Sep 03, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins', '', '-DONE', 'mnaguila'),
(28891, 'Sep 03, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28892, 'Sep 03, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28893, 'Sep 03, 2026', 'Cleaned Refrigerator at the school board office.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28894, 'Sep 04, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28895, 'Sep 04, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28896, 'Sep 04, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28897, 'Sep 04, 2026', 'Stalled barrel bolt at the theory building room 7', '3 hrs ', '', '-DONE', 'mnaguila'),
(28898, 'Sep 07, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28899, 'Sep 07, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28900, 'Sep 07, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28901, 'Sep 07, 2026', ' Cleaned and arranged the room at.the front of OSAS.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28902, 'Sep 08, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28903, 'Sep 08, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28904, 'Sep 08, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28905, 'Sep 08, 2026', '  Hauled chairs from IBEM to CCT building. Distributed steel cabinets from marketing area to faculty building and OSAS', '3 hrs ', '', '-DONE', 'mnaguila'),
(28906, 'Sep 09, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28907, 'Sep 09, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28908, 'Sep 09, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28909, 'Sep 09, 2026', ' Cleaned the HR office and arranged the cabinet.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28910, 'Sep 10, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28911, 'Sep 10, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28912, 'Sep 10, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28913, 'Sep 10, 2026', ' Cleaned the sink and water drainage at the food processing building.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28914, 'Sep 11, 2026', 'Put a fence above the gate that students always pass by at the back of ten door\'s.', '8 hrs', '', '-DONE', 'mnaguila'),
(28915, 'Sep 12, 2026', 'mowed at the way side of bamboo hub going to IA building. ', '8 hrs', '', '-DONE', 'mnaguila'),
(28916, 'Sep 14, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28917, 'Sep 14, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28918, 'Sep 14, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28919, 'Sep 14, 2026', 'cleaned and arranged the table and cabinet at the HR office.', '3hrs', '', '-DONE', 'mnaguila'),
(28920, 'Sep 15, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28921, 'Sep 15, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28922, 'Sep 15, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr', '', '-DONE', 'mnaguila'),
(28923, 'Sep 15, 2026', ' Fixed leaking water in aircon at the registrar\'s office and at 3rd floor admin building.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28924, 'Sep 16, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28925, 'Sep 16, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28926, 'Sep 16, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28927, 'Sep 16, 2026', ' Removed all the cartoons and garbage at the back of radio station.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28928, 'Sep 17, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28929, 'Sep 17, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28930, 'Sep 17, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28931, 'Sep 17, 2026', ' Mowed at the hallway front of GSO office going to marketing area..', '3 hrs ', '', '-DONE', 'mnaguila'),
(28932, 'Sep 18, 2026', 'Hauled break\'s from front of Admin   building to back of library and mowed at the front of admin building.', '8 hrs', '', '-DONE', 'mnaguila'),
(28933, 'Sep 21, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28934, 'Sep 21, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28935, 'Sep 21, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28936, 'Sep 21, 2026', ' Transfered cabinets and documents from 2nd floor  to 3rd floor admin building and cleaned the room at the side of CR 3rd floor admin building.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28937, 'Sep 22, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28938, 'Sep 22, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28939, 'Sep 22, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28940, 'Sep 22, 2026', ' Cleaned the room at the side of HR office.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28941, 'Sep 23, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28942, 'Sep 23, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28943, 'Sep 23, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28944, 'Sep 23, 2026', ' Put a GI sheets on the fence at the back of CR at COC ', '3 hrs ', '', '-DONE', 'mnaguila'),
(28945, 'Sep 24, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs 30 mins', '', '-DONE', 'mnaguila'),
(28946, 'Sep 24, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28947, 'Sep 24, 2026', 'Attend 126 Civil service anniversary celebration at SCSC school campus.', '4 hrs.', '', '-DONE', 'mnaguila'),
(28948, 'Sep 25, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins', '', '-DONE', 'mnaguila'),
(28949, 'Sep 25, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(28950, 'Sep 25, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(28951, 'Sep 25, 2026', 'Cleaned and hauled the garbage at ten door\'s and demolished the a wall in the admin office and cleaned the area.', '3 hrs ', '', '-DONE', 'mnaguila'),
(28952, 'Sep 26, 2026', 'Cleaned and arranged the room at HR office. Hauled the garbage at the SCSC school campus to MRF.', '8hrs', '', '-DONE', 'mnaguila'),
(28953, 'Sep 28, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(28954, 'Sep 28, 2026', 'cleaned at the front of admin building and made a cement pot.', '5 hrs 30 mins ', '', '-DONE', 'mnaguila'),
(28955, 'Sep 29, 2026', ' Cleaned the OP room and transfered cabines from OP room to auditor\'s office.. Cleaned the GSO stock room. ', '8 hrs', '', '-DONE', 'mnaguila'),
(28956, 'Sep 30, 2026', 'Arranged the cabinet\'s and tables at the Admin office. Made a door way between GSO office and GSO stop house.', '8 hrs', '', '-DONE', 'mnaguila'),
(28958, NULL, NULL, NULL, NULL, '-DONE', ''),
(36225, 'Oct 01, 2026', 'Activity 1', '4 hrs', '', '-DONE', 'crisanto'),
(36226, 'Oct 01, 2026', 'Activity 2', '4 hrs', '', '-DONE', 'crisanto'),
(41075, 'Nov 01, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '2 hrs', '', '-DONE', 'mar'),
(41076, 'Nov 01, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.', '2 hrs', '', '-DONE', 'mar'),
(41077, 'Nov 01, 2026', 'Cleaned and cleaned the back of guard house.', '4 hrs', '', '-DONE', 'mar'),
(41078, 'Nov 02, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:18 AM ', '', '-DONE', 'mar'),
(41079, 'Nov 02, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41080, 'Nov 02, 2026', 'Placed a stand for the flag to be displayed at the front of admin building.', '01:00 PM ', '', '-DONE', 'mar'),
(41081, 'Nov 03, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:21 AM ', '', '-DONE', 'mar'),
(41082, 'Nov 03, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41083, 'Nov 03, 2026', 'Cleaned the room at the theory building 1&2 and house keeping building.', '01:00 PM ', '', '-DONE', 'mar'),
(41084, 'Nov 04, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:16 AM ', '', '-DONE', 'mar'),
(41085, 'Nov 04, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41086, 'Nov 04, 2026', 'Hauled chair from admin building and library to gym and arranged it.', '01:00 PM ', '', '-DONE', 'mar'),
(41087, 'Nov 05, 2026', 'Mowed and cleaned the areas around Theory Building 1 and 2.', '06:35 AM  ', '', '-DONE', 'mar'),
(41088, 'Nov 08, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:22 AM ', '', '-DONE', 'mar'),
(41089, 'Nov 08, 2026', 'Cleaned and cleared the area affected during the earthquake.', '01:00 PM ', '', '-DONE', 'mar'),
(41090, 'Nov 09, 2026', 'Cordoned the area around IBEM Bldg and cutted the tree\'s at the back of IALab building.', '06:27 AM ', '', '-DONE', 'mar'),
(41091, 'Nov 10, 2026', 'Mowed at the front of IALab building and back of Admin building.', '06:30 AM ', '', '-DONE', 'mar'),
(41092, 'Nov 11, 2026', 'Mowed and cleared the front of agriculture dryer going to SCSC canteen.', '06:30 AM', '', '-DONE', 'mar'),
(41093, 'Nov 12, 2026', 'Rearranged and landscaped the center island front of new gate.', '9 hrs 41 mins', '', '-DONE', 'mar'),
(41094, 'Nov 15, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:30  AM ', '', '-DONE', 'mar'),
(41095, 'Nov 15, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41096, 'Nov 15, 2026', 'Checked and repaired water pipe line from bartending to old comfort room.', '01:00 PM ', '', '-DONE', 'mar'),
(41097, 'Nov 16, 2026', 'Mowed at the front and back of bartending and landscaped the front of guard house.', '9 hrs 33 mins', '', '-DONE', 'mar'),
(41098, 'Nov 17, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:13 AM ', '', '-DONE', 'mar'),
(41099, 'Nov 17, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41100, 'Nov 17, 2026', 'Hauled TV set from IBEM for return to supplier.', '11:31 PM ', '', '-DONE', 'mar'),
(41101, 'Nov 18, 2026', 'Cleaned the water tank and landscaped the back of guard house.', '4 hrs 47 mins', '', '-DONE', 'mar'),
(41102, 'Nov 18, 2026', 'Cleaned the roof and repaired the roof hole at food processing.', '4 hrs 50 mins', '', '-DONE', 'mar'),
(41103, 'Nov 19, 2026', 'Washed the trash bins and removed cobwebs at the Admin Building.', '9 hrs 25 mins', '', '-DONE', 'mar'),
(41104, 'Nov 22, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:22 AM ', '', '-DONE', 'mar'),
(41105, 'Nov 22, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41106, 'Nov 22, 2026', 'Hauled tables from marketing office to gym and hauled books from library to gym.', '11:31 PM ', '', '-DONE', 'mar'),
(41107, 'Nov 23, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:28 AM ', '', '-DONE', 'mar'),
(41108, 'Nov 23, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41109, 'Nov 23, 2026', 'Repaired and welded the step holder of the tractor.', '11:31 PM ', '', '-DONE', 'mar'),
(41110, 'Nov 24, 2026', 'Mowed and cleared the area at the back of Radio Bandera and in between of radio station and new library building.', '06:28 AM ', '', '-DONE', 'mar'),
(41111, 'Nov 25, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '06:19 AM ', '', '-DONE', 'mar'),
(41112, 'Nov 25, 2026', 'Checked and cleaned comfort rooms in the front of FBS building.', '09:31 AM ', '', '-DONE', 'mar'),
(41113, 'Nov 25, 2026', 'Repaired the sink and water drainage at the food processing building and cookery building.', '11:31 PM ', '', '-DONE', 'mar'),
(41114, 'Nov 26, 2026', 'Mowed at the front of faculty and back of old library and cleared the water drainage at the new gate.', '9 hrs 38 mins', '', '-DONE', 'mar'),
(41115, 'Nov 29, 2026', 'Trimmed tree\'s at the hall way from IBEM building to school gym and mowed at the front of new gate.', '5 hrs 2 mins', '', '-DONE', 'mar'),
(41116, 'Nov 30, 2026', 'Assisted and attended SCSC  51\'st anniversary.', '9 hrs 14 mins', '', '-DONE', 'mar'),
(42971, 'Oct 05, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42972, 'Oct 05, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Cleaned Office of attorney', '4 hrs', '', '-DONE', 'mar'),
(42973, 'Oct 06, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42974, 'Oct 06, 2026', ' Checked and cleaned comfort rooms in the front of FBS building. Hauled Table and 30 chairs', '4 hrs', '', '-DONE', 'mar'),
(42975, 'Oct 07, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42976, 'Oct 07, 2026', ' Checked and cleaned comfort rooms in the front of FBS building. Repaired Fence at the boundary between high school and college area.', '4 hrs', '', '-DONE', 'mar'),
(42977, 'Oct 08, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42978, 'Oct 08, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Transferred Cabinet and documents from planning office to new office of QA.', '4 hrs', '', '-DONE', 'mar'),
(42979, 'Oct 09, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42980, 'Oct 09, 2026', ' Checked and cleaned comfort rooms in the front of FBS building. Prepared Tables and chairs at coc building for farmers research training. and then assisted roving and monitored SCSC.', '4 hrs', '', '-DONE', 'mar'),
(42981, 'Oct 12, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42982, 'Oct 12, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Travelled to mindanao baptist life center ', '4 hrs', '', '-DONE', 'mar'),
(42983, 'Oct 13, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42984, 'Oct 13, 2026', ' Checked and cleaned comfort rooms in the front of FBS building. Cleaned drainage front guard house', '4 hrs', '', '-DONE', 'mar'),
(42985, 'Oct 14, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42986, 'Oct 14, 2026', ' Checked and cleaned comfort rooms in the front of FBS building. Cleaned CR at the IA Building, Arrange Table and Chairs admin HR Office', '4 hrs', '', '-DONE', 'mar'),
(42987, 'Oct 15, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42988, 'Oct 15, 2026', ' Checked and cleaned comfort rooms in the front of FBS building. Travelled to SKSU ', '4 hrs', '', '-DONE', 'mar'),
(42989, 'Oct 16, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42990, 'Oct 16, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Hauled Table and Cabinet Auditor Office', '4 hrs', '', '-DONE', 'mar'),
(42991, 'Oct 19, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42992, 'Oct 19, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Repaired Mower Machine, Hauled TV at research office ', '4 hrs', '', '-DONE', 'mar'),
(42993, 'Oct 20, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42994, 'Oct 20, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Repaired Mower machine ', '4 hrs', '', '-DONE', 'mar'),
(42995, 'Oct 21, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42996, 'Oct 21, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Hauled carton from ten doors area brought to the library, using ford tractor, and also installed tarpauline of scsc alumni at besides along the highway area.', '4 hrs', '', '-DONE', 'mar'),
(42997, 'Oct 22, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(42998, 'Oct 22, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Prepared tables and chairs at COC building for DPWH and Engineers meeting.', '4 hrs', '', '-DONE', 'mar'),
(42999, 'Oct 23, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(43000, 'Oct 23, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Transferred cabinets from 2nd floor of admin building down to the ground floor of auditor Office. And then hauled coconut and mahogany lumber from at the back of cookery area brought to the masonry building using ford tractor.  installed lights in Ma\'am Laquihon office.', '4 hrs', '', '-DONE', 'mar'),
(43001, 'Oct 26, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(43002, 'Oct 26, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Hauled coconut and mahogany lumber from the back of cookery area brought to masonry building using ford tractor. ', '4 hrs', '', '-DONE', 'mar'),
(43003, 'Oct 27, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(43004, 'Oct 27, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Prepared tables and chairs at COC building for deliberation of Awards and Recognition Committee for Non-Graduating Students Covering AY 2025-2026. installed lights IE 3rd floor and KRC.', '4 hrs', '', '-DONE', 'mar'),
(43005, 'Oct 28, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(43006, 'Oct 28, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Installed lights in HR office and Hauled Materials from  marketing to back of KRC office', '4 hrs', '', '-DONE', 'mar'),
(43007, 'Oct 29, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(43008, 'Oct 29, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Continued Constract at the back of KRC.', '4 hrs', '', '-DONE', 'mar'),
(43009, 'Oct 30, 2026', 'Swept, mopped, cleaned, dusted, watered Plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables, chairs, and cabinets) in the faculty room and the IA building', '4 hrs', '', '-DONE', 'mar'),
(43010, 'Oct 30, 2026', ' Checked and cleaned comfort rooms in the front of FBS building.  Installed TV at the COC Building and IBM building 4th floor.', '4 hrs', '', '-DONE', 'mar'),
(43230, 'Oct 05, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43231, 'Oct 05, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the room of attorney\'s office.', '4 hrs', '', '-DONE', 'mnaguila'),
(43232, 'Oct 06, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43233, 'Oct 06, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Arranged the cabinet\'s at  Focal office.', '4 hrs', '', '-DONE', 'mnaguila'),
(43234, 'Oct 07, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -Put a GI sheets and grill on the fence at the back of cookery building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43235, 'Oct 07, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43236, 'Oct 08, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila');
INSERT INTO `accomplishments` (`id`, `report_date`, `activity`, `start_time`, `end_time`, `remarks`, `username`) VALUES
(43237, 'Oct 08, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Transfered the table, cabinet computer and other office materials of sir Jeff in his new office at 3rd floor admin building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43238, 'Oct 09, 2026', 'Made a cement pot and arranged the cabinet at the 3rd floor admin building at sir QA office.', '8 hrs', '', '-DONE', 'mnaguila'),
(43239, 'Oct 10, 2026', 'Mowed and cleaned from front of admin building to Rizal park.', '8 hrs', '', '-DONE', 'mnaguila'),
(43240, 'Oct 12, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43241, 'Oct 12, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned at COA office.', '4 hrs', '', '-DONE', 'mnaguila'),
(43242, 'Oct 13, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43243, 'Oct 13, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the drainage at guard house.', '4 hrs', '', '-DONE', 'mnaguila'),
(43244, 'Oct 14, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43245, 'Oct 14, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned and arranged the table and cabinet at the HR office.', '4 hrs', '', '-DONE', 'mnaguila'),
(43246, 'Oct 15, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -Made a cement pot and arranged the bougainvillea plant at the front.', '4 hrs', '', '-DONE', 'mnaguila'),
(43247, 'Oct 15, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Made a cement pot and arranged the bougainvillea plant at the front.', '4 hrs', '', '-DONE', 'mnaguila'),
(43248, 'Oct 16, 2026', 'Transfered all documents, tables and cabinets of COA from ground floor to 3rd floor admin building for the new office.', '8 hrs', '', '-DONE', 'mnaguila'),
(43249, 'Oct 17, 2026', 'Mowed at the hallway front of GSO office going to ILab. Hauled chairs from marketing area to theory building.', '8 hrs', '', '-DONE', 'mnaguila'),
(43250, 'Oct 19, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43251, 'Oct 19, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Hauled break\'s from front of Admin   building to back of library and mowed at the front of admin building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43252, 'Oct 20, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43253, 'Oct 20, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Installed TV at the research office. -Transfered cabinets and documents from 2nd floor  to 3rd floor admin building and cleaned the room at the side of CR 3rd floor admin building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43254, 'Oct 21, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43255, 'Oct 21, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Replaced bulbs at the admin office and HR office.-Cleaned the room at the side of HR office.', '4 hrs', '', '-DONE', 'mnaguila'),
(43256, 'Oct 22, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43257, 'Oct 22, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Removed the tarpaulin steel frame at the front and repaired. - Hauled the garbage from MRF to land field area. - Hauled table and office materials from VPAA office to IA building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43258, 'Oct 23, 2026', 'Replanted the bougainvillea plant at the front of guard house. -Transfered cabinets from 2nd floor admin building to the office of the Records ground floor admin building. -Assisted the sensaw operator, and hauled wood and coco lumber.', '8 hrs', '', '-DONE', 'mnaguila'),
(43259, 'Oct 24, 2026', 'Removed the sin sheets at the fence and assisted the sensaw operator at the back of cookery building and MRF.', '8 hrs', '', '-DONE', 'mnaguila'),
(43260, 'Oct 26, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43261, 'Oct 26, 2026', 'Hauled office materials, table and chairs from COC to the office of the attorney at 2nd floor admin building. - Hauled wood and coco lumber at the back of cookery building to masonry building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43262, 'Oct 27, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43263, 'Oct 27, 2026', 'Cleaned and arranged the room at HR office and Internal Audit office. - Hauled wood and coco lumber at the back of cookery building to masonry building.', '4 hrs', '', '-DONE', 'mnaguila'),
(43264, 'Oct 28, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43265, 'Oct 28, 2026', 'Removed the table glass at faculty building and secured at the VPAA office. -Hauled hallow blocks from marketing to back of old library ', '4 hrs', '', '-DONE', 'mnaguila'),
(43266, 'Oct 29, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'mnaguila'),
(43267, 'Oct 29, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Installed tarpaulin at the front gate. - Hauled all office table at faculty building to   house keeping room.', '4 hrs', '', '-DONE', 'mnaguila'),
(43268, 'Oct 30, 2026', 'Assisted the sensaw operator.  -Hauled wood and coco lumber at the back of MRF to masonry building.', '8 hrs', '', '-DONE', 'mnaguila'),
(43269, 'Oct 31, 2026', 'Mowed at the back of admin building. - Hauled wood and coco lumber at the back of MRF to masonry building.', '8 hrs', '', '-DONE', 'mnaguila'),
(43347, 'Oct 05, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43348, 'Oct 05, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the room of attorney\'s office.', '4 hrs', '', '-DONE', 'eduardo'),
(43349, 'Oct 06, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43350, 'Oct 06, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Arranged the cabinet\'s at  Focal office.', '4 hrs', '', '-DONE', 'eduardo'),
(43351, 'Oct 07, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -Put a GI sheets and grill on the fence at the back of cookery building.', '4 hrs', '', '-DONE', 'eduardo'),
(43352, 'Oct 07, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43353, 'Oct 08, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43354, 'Oct 08, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Transfered the table, cabinet computer and other office materials of sir Jeff in his new office at 3rd floor admin building.', '4 hrs', '', '-DONE', 'eduardo'),
(43355, 'Oct 09, 2026', 'Made a cement pot and arranged the cabinet at the 3rd floor admin building at sir QA office.', '8 hrs', '', '-DONE', 'eduardo'),
(43356, 'Oct 10, 2026', 'Mowed and cleaned from front of admin building to Rizal park.', '8 hrs', '', '-DONE', 'eduardo'),
(43357, 'Oct 12, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43358, 'Oct 12, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned at COA office.', '4 hrs', '', '-DONE', 'eduardo'),
(43359, 'Oct 13, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43360, 'Oct 13, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the drainage at guard house.', '4 hrs', '', '-DONE', 'eduardo'),
(43361, 'Oct 14, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43362, 'Oct 14, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned and arranged the table and cabinet at the HR office.', '4 hrs', '', '-DONE', 'eduardo'),
(43363, 'Oct 15, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -Made a cement pot and arranged the bougainvillea plant at the front.', '4 hrs', '', '-DONE', 'eduardo'),
(43364, 'Oct 15, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Made a cement pot and arranged the bougainvillea plant at the front.', '4 hrs', '', '-DONE', 'eduardo'),
(43365, 'Oct 16, 2026', 'Transfered all documents, tables and cabinets of COA from ground floor to 3rd floor admin building for the new office.', '8 hrs', '', '-DONE', 'eduardo'),
(43366, 'Oct 17, 2026', 'Mowed at the hallway front of GSO office going to ILab. Hauled chairs from marketing area to theory building.', '8 hrs', '', '-DONE', 'eduardo'),
(43367, 'Oct 20, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43368, 'Oct 20, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Installed TV at the research office. -Transfered cabinets and documents from 2nd floor  to 3rd floor admin building and cleaned the room at the side of CR 3rd floor admin building.', '4 hrs', '', '-DONE', 'eduardo'),
(43369, 'Oct 23, 2026', 'Replanted the bougainvillea plant at the front of guard house. -Transfered cabinets from 2nd floor admin building to the office of the Records ground floor admin building. -Assisted the sensaw operator, and hauled wood and coco lumber.', '8 hrs', '', '-DONE', 'eduardo'),
(43370, 'Oct 26, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43371, 'Oct 26, 2026', 'Hauled office materials, table and chairs from COC to the office of the attorney at 2nd floor admin building. - Hauled wood and coco lumber at the back of cookery building to masonry building.', '4 hrs', '', '-DONE', 'eduardo'),
(43372, 'Oct 27, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43373, 'Oct 27, 2026', 'Cleaned and arranged the room at HR office and Internal Audit office. - Hauled wood and coco lumber at the back of cookery building to masonry building.', '4 hrs', '', '-DONE', 'eduardo'),
(43374, 'Oct 28, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43375, 'Oct 28, 2026', 'Removed the table glass at faculty building and secured at the VPAA office. -Hauled hallow blocks from marketing to back of old library ', '4 hrs', '', '-DONE', 'eduardo'),
(43376, 'Oct 29, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st,  -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.2nd and 3rd floor of the admin building. -', '4 hrs', '', '-DONE', 'eduardo'),
(43377, 'Oct 29, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Installed tarpaulin at the front gate. - Hauled all office table at faculty building to   house keeping room.', '4 hrs', '', '-DONE', 'eduardo'),
(43378, 'Oct 30, 2026', 'Assisted the sensaw operator.  -Hauled wood and coco lumber at the back of MRF to masonry building.', '8 hrs', '', '-DONE', 'eduardo'),
(43379, 'Oct 31, 2026', 'Mowed at the back of admin building. - Hauled wood and coco lumber at the back of MRF to masonry building.', '8 hrs', '', '-DONE', 'eduardo'),
(43380, 'Nov 03, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building. -Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '4 hrs ', '', '-DONE', 'mnaguila'),
(43381, 'Nov 03, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the room of attorney\'s office.', '4 hr s', '', '-DONE', 'mnaguila'),
(43382, 'Nov 03, 2026', ' Cleaned and arranged the office of CAO.', '3 hrs', '', '-DONE', 'mnaguila'),
(43383, 'Nov 02, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43384, 'Nov 02, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43385, 'Nov 02, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43386, 'Nov 02, 2026', ' Cleaned the OP room and transfered cabines from OP room to auditor\'s office.. Cleaned the GSO stock room.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43387, 'Nov 03, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins', '', '-DONE', 'mnaguila'),
(43388, 'Nov 03, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43389, 'Nov 03, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43390, 'Nov 03, 2026', 'Cleaned Refrigerator at the school board office.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43391, 'Nov 04, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43392, 'Nov 04, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43393, 'Nov 04, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43394, 'Nov 04, 2026', 'Stalled barrel bolt at the theory building room 7', '3 hrs ', '', '-DONE', 'mnaguila'),
(43395, 'Nov 07, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43396, 'Nov 07, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43397, 'Nov 07, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43398, 'Nov 07, 2026', ' Cleaned and arranged the room at.the front of OSAS.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43399, 'Nov 08, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43400, 'Nov 08, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43401, 'Nov 08, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43402, 'Nov 08, 2026', '  Hauled chairs from IBEM to CCT building. Distributed steel cabinets from marketing area to faculty building and OSAS', '3 hrs ', '', '-DONE', 'mnaguila'),
(43403, 'Nov 09, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43404, 'Nov 09, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43405, 'Nov 09, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43406, 'Nov 09, 2026', ' Cleaned the HR office and arranged the cabinet.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43407, 'Nov 10, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43408, 'Nov 10, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43409, 'Nov 10, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43410, 'Nov 10, 2026', ' Cleaned the sink and water drainage at the food processing building.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43411, 'Nov 11, 2026', 'Put a fence above the gate that students always pass by at the back of ten door\'s.', '8 hrs', '', '-DONE', 'mnaguila'),
(43412, 'Nov 12, 2026', 'mowed at the way side of bamboo hub going to IA building. ', '8 hrs', '', '-DONE', 'mnaguila'),
(43413, 'Nov 14, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43414, 'Nov 14, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43415, 'Nov 14, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43416, 'Nov 14, 2026', 'cleaned and arranged the table and cabinet at the HR office.', '3hrs', '', '-DONE', 'mnaguila'),
(43417, 'Nov 15, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43418, 'Nov 15, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43419, 'Nov 15, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr', '', '-DONE', 'mnaguila'),
(43420, 'Nov 15, 2026', ' Fixed leaking water in aircon at the registrar\'s office and at 3rd floor admin building.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43421, 'Nov 16, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43422, 'Nov 16, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43423, 'Nov 16, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43424, 'Nov 16, 2026', ' Removed all the cartoons and garbage at the back of radio station.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43425, 'Nov 17, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43426, 'Nov 17, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43427, 'Nov 17, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43428, 'Nov 17, 2026', ' Mowed at the hallway front of GSO office going to marketing area..', '3 hrs ', '', '-DONE', 'mnaguila'),
(43429, 'Nov 18, 2026', 'Hauled break\'s from front of Admin   building to back of library and mowed at the front of admin building.', '8 hrs', '', '-DONE', 'mnaguila'),
(43430, 'Nov 21, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43431, 'Nov 21, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43432, 'Nov 21, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43433, 'Nov 21, 2026', ' Transfered cabinets and documents from 2nd floor  to 3rd floor admin building and cleaned the room at the side of CR 3rd floor admin building.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43434, 'Nov 22, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43435, 'Nov 22, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43436, 'Nov 22, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43437, 'Nov 22, 2026', ' Cleaned the room at the side of HR office.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43438, 'Nov 23, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43439, 'Nov 23, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43440, 'Nov 23, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43441, 'Nov 23, 2026', ' Put a GI sheets on the fence at the back of CR at COC ', '3 hrs ', '', '-DONE', 'mnaguila'),
(43442, 'Nov 24, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs 30 mins', '', '-DONE', 'mnaguila'),
(43443, 'Nov 24, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43444, 'Nov 24, 2026', 'Attend 126 Civil service anniversary celebration at SCSC school campus.', '4 hrs.', '', '-DONE', 'mnaguila'),
(43445, 'Nov 25, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins', '', '-DONE', 'mnaguila'),
(43446, 'Nov 25, 2026', 'Cleaned and sanitized comfort rooms in the 2nd and 3rd floor admin building.', '1 hr 30 mins ', '', '-DONE', 'mnaguila'),
(43447, 'Nov 25, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building.', '1 hr ', '', '-DONE', 'mnaguila'),
(43448, 'Nov 25, 2026', 'Cleaned and hauled the garbage at ten door\'s and demolished the a wall in the admin office and cleaned the area.', '3 hrs ', '', '-DONE', 'mnaguila'),
(43449, 'Nov 26, 2026', 'Cleaned and arranged the room at HR office. Hauled the garbage at the SCSC school campus to MRF.', '8hrs', '', '-DONE', 'mnaguila'),
(43450, 'Nov 28, 2026', 'Swept, mopped, cleaned, dusted, watered plants, removed cobwebs, disinfected doorknobs, cleaned windows, and furniture (Tables , chairs, and cabinets) in rooms and hallway in 1st, 2nd and 3rd floor of the admin building.', '2 hrs  30 mins ', '', '-DONE', 'mnaguila'),
(43451, 'Nov 28, 2026', 'cleaned at the front of admin building and made a cement pot.', '5 hrs 30 mins ', '', '-DONE', 'mnaguila'),
(43452, 'Nov 29, 2026', ' Cleaned the OP room and transfered cabines from OP room to auditor\'s office.. Cleaned the GSO stock room. ', '8 hrs', '', '-DONE', 'mnaguila'),
(43453, 'Nov 30, 2026', 'Arranged the cabinet\'s and tables at the Admin office. Made a door way between GSO office and GSO stop house.', '8 hrs', '', '-DONE', 'mnaguila'),
(44962, 'Oct 05, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44963, 'Oct 05, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the room of attorney\'s office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44964, 'Oct 06, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44965, 'Oct 06, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Arranged the cabinet\'s at  Focal office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44966, 'Oct 07, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44967, 'Oct 07, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -', '4 hrs', '', '-DONE', 'aavillanueva'),
(44968, 'Oct 08, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44969, 'Oct 08, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Transfered the table, cabinet computer and other office materials of sir Jeff in his new office at 3rd floor admin building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44970, 'Oct 09, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44971, 'Oct 09, 2026', 'Made a cement pot and arranged the cabinet at the 3rd floor admin building at sir QA office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44972, 'Oct 10, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44973, 'Oct 10, 2026', 'Mowed and cleaned from front of admin building to Rizal park.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44974, 'Oct 12, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44975, 'Oct 12, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned at COA office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44976, 'Oct 13, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44977, 'Oct 13, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned the drainage at guard house.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44978, 'Oct 14, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44979, 'Oct 14, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Cleaned and arranged the table and cabinet at the HR office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44980, 'Oct 15, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44981, 'Oct 15, 2026', 'Checked and cleaned comfort rooms in the 2nd and 3rd floor admin building. -Made a cement pot and arranged the bougainvillea plant at the front.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44982, 'Oct 16, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44983, 'Oct 16, 2026', 'Transfered all documents, tables and cabinets of COA from ground floor to 3rd floor admin building for the new office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44984, 'Oct 17, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44985, 'Oct 17, 2026', 'Mowed at the hallway front of GSO office going to ILab. Hauled chairs from marketing area to theory building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44986, 'Oct 19, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44987, 'Oct 19, 2026', 'Hauled break\'s from front of Admin   building to back of library and mowed at the front of admin building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44988, 'Oct 20, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44989, 'Oct 20, 2026', 'Installed TV at the research office. -Transfered cabinets and documents from 2nd floor  to 3rd floor admin building and cleaned the room at the side of CR 3rd floor admin building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44990, 'Oct 21, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44991, 'Oct 21, 2026', 'Replaced bulbs at the admin office and HR office.-Cleaned the room at the side of HR office.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44992, 'Oct 22, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44993, 'Oct 22, 2026', 'Removed the tarpaulin steel frame at the front and repaired. - Hauled the garbage from MRF to land field area. - Hauled table and office materials from VPAA office to IA building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44994, 'Oct 23, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44995, 'Oct 23, 2026', 'Replanted the bougainvillea plant at the front of guard house. -Transfered cabinets from 2nd floor admin building to the office of the Records ground floor admin building. -Assisted the sensaw operator, and hauled wood and coco lumber.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44996, 'Oct 24, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44997, 'Oct 24, 2026', 'Removed the sin sheets at the fence and assisted the sensaw operator at the back of cookery building and MRF.', '4 hrs', '', '-DONE', 'aavillanueva'),
(44998, 'Oct 26, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(44999, 'Oct 26, 2026', 'Hauled office materials, table and chairs from COC to the office of the attorney at 2nd floor admin building. - Hauled wood and coco lumber at the back of cookery building to masonry building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(45000, 'Oct 27, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(45001, 'Oct 27, 2026', 'Cleaned and arranged the room at HR office and Internal Audit office. - Hauled wood and coco lumber at the back of cookery building to masonry building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(45002, 'Oct 28, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(45003, 'Oct 28, 2026', 'Removed the table glass at faculty building and secured at the VPAA office. -Hauled hallow blocks from marketing to back of old library ', '4 hrs', '', '-DONE', 'aavillanueva'),
(45004, 'Oct 29, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(45005, 'Oct 29, 2026', 'Installed tarpaulin at the front gate. - Hauled all office table at faculty building to   house keeping room.', '4 hrs', '', '-DONE', 'aavillanueva'),
(45006, 'Oct 30, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(45007, 'Oct 30, 2026', 'Assisted the sensaw operator.  -Hauled wood and coco lumber at the back of MRF to masonry building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(45008, 'Oct 31, 2026', 'Swept, landscaped, planted new flowers, pruned bushes, cut branches, and watered plants in the front and back of the admin building, and swept the leaves from the road from the admin building to the GSO office', '4 hrs', '', '-DONE', 'aavillanueva'),
(45009, 'Oct 31, 2026', 'Mowed at the back of admin building. - Hauled wood and coco lumber at the back of MRF to masonry building.', '4 hrs', '', '-DONE', 'aavillanueva'),
(48134, 'Nov 03, 2026', 'Cleaned Hallway and Reading Area', '2 hrs', '', '-DONE', 'jmax40'),
(48135, 'Nov 03, 2026', 'Assisted Circulation Area and Faculty', '2 hrs', '', '-DONE', 'jmax40'),
(48136, 'Oct 08, 2026', '', '4 hrs', '', '-DONE', 'djlorana24'),
(48137, 'Oct 08, 2026', '', '4 hrs', '', '-DONE', 'djlorana24'),
(48138, 'Oct 09, 2026', '', '4 hrs', '', '-DONE', 'djlorana24'),
(48139, 'Oct 01, 2026', 'WFH - Updated KRC Inventory User Interface', '8 hrs ', '', '-DONE', 'jmax40'),
(48140, 'Oct 02, 2026', 'WFH  - Updated KRC Inventory User Interface (Assigned Box) ', '8 hrs', '', '-DONE', 'jmax40'),
(48141, 'Oct 05, 2026', 'Cleaned Shelves and Tables', '2 hrs ', '', '-DONE', 'jmax40'),
(48142, 'Oct 05, 2026', 'Assisted and Supervised Students inside the KRC', '2 hrs', '', '-DONE', 'jmax40'),
(48143, 'Oct 05, 2026', 'Updated Inventory System ', '2 hrs', '', '-DONE', 'jmax40'),
(48144, 'Oct 05, 2026', 'Arranged Books', '2 hrs', '', '-DONE', 'jmax40'),
(48145, 'Oct 06, 2026', 'Cleaned Hallway and Reading Area', '2 hrs ', '', '-DONE', 'jmax40'),
(48146, 'Oct 06, 2026', 'Assisted and Supervised Students inside the KRC', '2 hrs', '', '-DONE', 'jmax40'),
(48147, 'Oct 06, 2026', 'Updated Inventory System ', '2 hrs', '', '-DONE', 'jmax40'),
(48148, 'Oct 06, 2026', 'Arranged Books', '2 hrs', '', '-DONE', 'jmax40'),
(48149, 'Oct 07, 2026', 'Cleaned Hallway and Reading Area', '2 hrs ', '', '-DONE', 'jmax40'),
(48150, 'Oct 07, 2026', 'Inventoried Books', '5 hrs', '', '-DONE', 'jmax40'),
(48151, 'Oct 07, 2026', 'Arranged Books', '1 hrs', '', '-DONE', 'jmax40'),
(48152, 'Oct 08, 2026', 'Cleaned Hallway and Reading Area', '2 hrs ', '', '-DONE', 'jmax40'),
(48153, 'Oct 08, 2026', 'Assisted and Supervised Students inside the KRC', '2 hrs', '', '-DONE', 'jmax40'),
(48154, 'Oct 08, 2026', 'Updated Inventory System ', '2 hrs', '', '-DONE', 'jmax40'),
(48155, 'Oct 08, 2026', 'Arranged Books', '2 hrs', '', '-DONE', 'jmax40'),
(48156, 'Oct 09, 2026', 'WFH - Updated KRC Website (Darkmode and Whitemode) ', '4 hrs', '', '-DONE', 'jmax40'),
(48157, 'Oct 12, 2026', 'Cleaned Hallway and Reading Area', '2 hrs ', '', '-DONE', 'jmax40'),
(48158, 'Oct 12, 2026', 'Inventoried Books', '5 hrs', '', '-DONE', 'jmax40'),
(48159, 'Oct 12, 2026', 'Arranged Books', '1 hrs', '', '-DONE', 'jmax40'),
(48160, 'Oct 13, 2026', 'Mopping Hallway and Librarian floor', '2 hrs ', '', '-DONE', 'jmax40'),
(48161, 'Oct 13, 2026', 'Inventoried Books', '5 hrs', '', '-DONE', 'jmax40'),
(48162, 'Oct 13, 2026', 'Arranged Books', '1 hrs', '', '-DONE', 'jmax40'),
(48163, 'Oct 14, 2026', 'Mopping AVR and Librarian floor', '2 hrs', '', '-DONE', 'jmax40'),
(48164, 'Oct 14, 2026', 'Inventoried Books', '4 hrs', '', '-DONE', 'jmax40'),
(48165, 'Oct 14, 2026', 'Assisted and Supervised Students inside the KRC', '2 hrs', '', '-DONE', 'jmax40'),
(48166, 'Oct 15, 2026', 'Mopping AVR and Librarian floor', '2 hrs', '', '-DONE', 'jmax40'),
(48167, 'Oct 15, 2026', 'Inventoried Books', '4 hrs', '', '-DONE', 'jmax40'),
(48168, 'Oct 15, 2026', 'Assisted and Supervised Students inside the KRC', '2 hrs', '', '-DONE', 'jmax40'),
(48169, 'Oct 16, 2026', 'WFH', '8 hrs', '', '-DONE', 'jmax40'),
(48170, 'Oct 19, 2026', 'Attended Flag Ceremony', '30  mins', '', '-DONE', 'jmax40'),
(48171, 'Oct 19, 2026', 'Assisted and Supervised Students inside the KRC', '2 hrs', '', '-DONE', 'jmax40'),
(48172, 'Oct 19, 2026', 'Cleaned Hallway and Reading Area', '2 hrs', '', '-DONE', 'jmax40'),
(48173, 'Oct 19, 2026', 'Updated KRC Website ', '3 hrs 30 mins', '', '-DONE', 'jmax40'),
(48174, 'Oct 20, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48175, 'Oct 20, 2026', 'Designed Canva for Tarpaulin ( 10 x 8 )', '4 hrs', '', '-DONE', 'jmax40'),
(48176, 'Oct 20, 2026', 'Troubleshooted laptop of student', '1 hr', '', '-DONE', 'jmax40'),
(48177, 'Oct 20, 2026', 'Cleaned Hallway and Reading Area', '1 hr', '', '-DONE', 'jmax40'),
(48178, 'Oct 21, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48179, 'Oct 21, 2026', 'Designed Canva for Teaser Video ( Book Week ) ', '4 hrs', '', '-DONE', 'jmax40'),
(48180, 'Oct 21, 2026', 'Troubleshooted laptop of student', '1 hr', '', '-DONE', 'jmax40'),
(48181, 'Oct 21, 2026', 'Cleaned Hallway and Reading Area', '1 hr', '', '-DONE', 'jmax40'),
(48182, 'Oct 22, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48183, 'Oct 22, 2026', 'Packed books ', '4 hrs', '', '-DONE', 'jmax40'),
(48184, 'Oct 22, 2026', 'Troubleshooted laptop of student', '1 hr', '', '-DONE', 'jmax40'),
(48185, 'Oct 22, 2026', 'Cleaned Hallway and Reading Area', '1 hr', '', '-DONE', 'jmax40'),
(48186, 'Oct 23, 2026', 'Attended Zoom meeting ', '4  hrs', '', '-DONE', 'jmax40'),
(48187, 'Oct 23, 2026', 'Packed books ', '4 hrs', '', '-DONE', 'jmax40'),
(48188, 'Oct 26, 2026', 'Attended Flag Ceremony', '30 mins', '', '-DONE', 'jmax40'),
(48189, 'Oct 26, 2026', 'Clean Hallway and AVR', '2 hrs', '', '-DONE', 'jmax40'),
(48190, 'Oct 26, 2026', 'Supervised and Assisted KRC ', '2 hrs', '', '-DONE', 'jmax40'),
(48191, 'Oct 26, 2026', 'Update KRC Website ( Chat Feature)', '2 hrs', '', '-DONE', 'jmax40'),
(48192, 'Oct 26, 2026', 'Edited Canva Programme ( Book Week )', '4 hrs', '', '-DONE', 'jmax40'),
(48193, 'Oct 27, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48194, 'Oct 27, 2026', 'Assisted Circulation Area and Faculty', '2 hrs', '', '-DONE', 'jmax40'),
(48195, 'Oct 27, 2026', 'Update KRC Website', '2 hrs', '', '-DONE', 'jmax40'),
(48196, 'Oct 27, 2026', 'Cleaned Hallway and Reading Area', '2 hrs', '', '-DONE', 'jmax40'),
(48197, 'Oct 28, 2026', 'Mopped Librarian Office ', '1 hr', '', '-DONE', 'jmax40'),
(48198, 'Oct 28, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48199, 'Oct 28, 2026', 'Update KRC Website', '4 hrs', '', '-DONE', 'jmax40'),
(48200, 'Oct 28, 2026', 'Cleaned Hallway and Server Area', '1 hr', '', '-DONE', 'jmax40'),
(48201, 'Oct 29, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48202, 'Oct 29, 2026', 'Update Canva ( Certificate )', '2 hrs', '', '-DONE', 'jmax40'),
(48203, 'Oct 29, 2026', 'Attended Program ( Teacher Day )', '2 hr', '', '-DONE', 'jmax40'),
(48204, 'Oct 30, 2026', 'Supervised and assisted Circulation area', '2 hrs', '', '-DONE', 'jmax40'),
(48205, 'Oct 30, 2026', 'Update Canva ( Certificate )', '2 hrs', '', '-DONE', 'jmax40'),
(48206, 'Oct 30, 2026', 'Attended Program ( Teacher Day )', '2 hr', '', '-DONE', 'jmax40'),
(48207, 'Oct 30, 2026', 'Cleaned Hallway and Reading Area', '2 hrs', '', '-DONE', 'jmax40'),
(50094, 'Oct  01, 2026', 'Work From Home -', '8 hrs.', '', '-DONE', 'MattWiz08'),
(50095, 'Oct 02, 2026', 'Work From Home', '8 hrs.', '', '-DONE', 'MattWiz08'),
(50096, 'Oct 05, 2026', 'Attended Flag Ceremony at SCSC Gym.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50097, 'Oct 05, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50098, 'Oct 05, 2026', 'Encoded of students who are lending books in the KOHA system through RFID.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50099, 'Oct 05, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50100, 'Oct 05, 2026', 'Encoded of Books Catalog Nos. in KOHA and Microsoft Word.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50101, 'Oct 05, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50102, 'Oct 06, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50103, 'Oct 06, 2026', 'Encoded of students who are lending books in the KOHA system through RFID.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50104, 'Oct 06, 2026', 'Encoded of Books Catalog Nos. in KOHA and Microsoft Word.', '2 hrs.', '', '-DONE', 'MattWiz08');
INSERT INTO `accomplishments` (`id`, `report_date`, `activity`, `start_time`, `end_time`, `remarks`, `username`) VALUES
(50105, 'Oct 06, 2026', 'Prepared and Cut of Internet Codes.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50106, 'Oct 06, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50107, 'Oct 06, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50108, 'Oct 07, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50109, 'Oct 07, 2026', 'Inventory of Library Books and Returned it on designated shelves', '7 hrs.', '', '-DONE', 'MattWiz08'),
(50110, 'Oct 08, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50111, 'Oct 08, 2026', 'Inventory of Library Books and Returned it on designated shelves.', '7 hrs.', '', '-DONE', 'MattWiz08'),
(50112, 'Oct 09, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50113, 'Oct 09, 2026', 'Inventory of Library Books and Returned it on designated shelves.', '7 hrs.', '', '-DONE', 'MattWiz08'),
(50114, 'Oct 12, 2026', 'Attended Flag Ceremony at SCSC Gym.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50115, 'Oct 12, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50116, 'Oct 12, 2026', 'Inventory of Library Books and Returned it on designated shelves.', '6 hrs.', '', '-DONE', 'MattWiz08'),
(50117, 'Oct 13, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50118, 'Oct 13, 2026', 'Inventory of Library Books and Returned it on designated shelves.', '7 hrs.', '', '-DONE', 'MattWiz08'),
(50119, 'Oct 14, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50120, 'Oct 14, 2026', 'Encoded of Books Catalog Nos. in KOHA and Microsoft Word.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50121, 'Oct 14, 2026', 'Inventory of Library Books and Returned it on designated shelves.', '3 hrs.', '', '-DONE', 'MattWiz08'),
(50122, 'Oct 14, 2026', 'Prepared and Cut of Internet Codes.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50123, 'Oct 14, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50124, 'Oct 15, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50125, 'Oct 15, 2026', 'Encoded of students who are lending books in the KOHA system through RFID.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50126, 'Oct 15, 2026', 'Encoded of Books Catalog Nos. in KOHA and Microsoft Word.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50127, 'Oct 15, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50128, 'Oct 15, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50129, 'Oct 16, 2026', 'Assisted Supervisors\' meeting regarding revision of Students Handbook at the Library.', '8 hrs.', '', '-DONE', 'MattWiz08'),
(50130, 'Oct 19, 2026', 'Attended Flag Ceremony at SCSC Gym.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50131, 'Oct 19, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50132, 'Oct 19, 2026', 'Encoded of Books Catalog Nos. in KOHA and Microsoft Word.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50133, 'Oct 19, 2026', 'Prepared and Cut of Internet Codes.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50134, 'Oct 19, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50135, 'Oct 19, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50136, 'Oct 20, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50137, 'Oct 20, 2026', 'Encoded of Books Catalog Nos. in KOHA and Microsoft Word.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50138, 'Oct 20, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50139, 'Oct 20, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50140, 'Oct 20, 2026', 'Encoded of students who are lending books in the KOHA system through RFID.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50141, 'Oct 20, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50142, 'Oct 21, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50143, 'Oct 21, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50144, 'Oct 21, 2026', 'Inventory of Library books and Put it in the carton boxes', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50145, 'Oct 21, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50146, 'Oct 21, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50147, 'Oct 22, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50148, 'Oct 22, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '2 hrs', '', '-DONE', 'MattWiz08'),
(50149, 'Oct 22, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50150, 'Oct 22, 2026', 'Inventory of Library books and Put it in the carton boxes.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50151, 'Oct 22, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50152, 'Oct 23, 2026', 'Attended orientation on the Digital Monitoring System (DMS) and Topic: FAST LEAD: Integrity', '6 hrs.', '', '-DONE', 'MattWiz08'),
(50153, 'Oct 23, 2026', 'Inventory of Library books and Put it in the carton boxes', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50154, 'Oct 26, 2026', 'Attended Flag Ceremony at SCSC Gym.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50155, 'Oct 26, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50156, 'Oct 26, 2026', 'Encoded of students who are lending books in the KOHA system through RFID.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50157, 'Oct 26, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50158, 'Oct 26, 2026', 'Prepared and Cut of Internet Codes.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50159, 'Oct 26, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50160, 'Oct 27, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50161, 'Oct 27, 2026', 'Stamped of Thesis Books and Attached a catalog nos. in a designated books.', '2 hrs', '', '-DONE', 'MattWiz08'),
(50162, 'Oct 27, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50163, 'Oct 27, 2026', 'Inventory of Library books and Put it in the carton boxes.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50164, 'Oct 27, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50165, 'Oct 28, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50166, 'Oct 28, 2026', 'Encoded of students who are lending books in the KOHA system through RFID.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50167, 'Oct 28, 2026', 'Inventory of Library books and Put it in the carton boxes.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50168, 'Oct 28, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50169, 'Oct 28, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50170, 'Oct 29, 2026', 'Maintained the cleanliness and tidiness of the library.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50171, 'Oct 29, 2026', 'Inventory of Library books and Put it in the carton boxes.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50172, 'Oct 29, 2026', 'Attended the Teachers\' Day celebration at the SCSC Gym', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50173, 'Oct 29, 2026', 'Accessed of  Thesis dissertation and writing of date received and number sequencing of  Thesis Books.', '2 hrs.', '', '-DONE', 'MattWiz08'),
(50174, 'Oct 29, 2026', 'Returned Books in its designated shelves and Arranged the chairs and tables.', '1 hr.', '', '-DONE', 'MattWiz08'),
(50175, 'Oct 30, 2026', 'Work From Home.', '8 hrs.', '', '-DONE', 'MattWiz08');

-- --------------------------------------------------------

--
-- Table structure for table `daily_task_generation`
--

CREATE TABLE `daily_task_generation` (
  `username` varchar(50) NOT NULL,
  `report_date` date NOT NULL,
  `generated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_task_generation`
--

INSERT INTO `daily_task_generation` (`username`, `report_date`, `generated_at`) VALUES
('jmax40', '2026-11-03', '2026-11-03 13:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `daily_task_templates`
--

CREATE TABLE `daily_task_templates` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `activity` text NOT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `end_time` varchar(20) DEFAULT NULL,
  `remarks` varchar(20) DEFAULT '-DONE',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_task_templates`
--

INSERT INTO `daily_task_templates` (`id`, `username`, `activity`, `start_time`, `end_time`, `remarks`, `sort_order`, `created_at`) VALUES
(3, 'jmax40', 'Cleaned Hallway and Reading Area', '2 hrs', '', '-DONE', 0, '2026-11-03 13:13:16'),
(4, 'jmax40', 'Assisted Circulation Area and Faculty', '2 hrs', '', '-DONE', 1, '2026-11-03 13:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `employee_name`, `message`, `created_at`) VALUES
(1, 'jmax40', 'Jeffrey A. oderio', 'Hello sir', '2026-10-26 14:39:46'),
(2, 'jmax40', 'Jeffrey A. oderio', 'Ok na sir', '2026-10-26 14:44:38'),
(3, 'jmax40', 'Jeffrey A. oderio', 'HAHA', '2026-10-26 14:44:39'),
(4, 'MattWiz08', 'Matthio  Gel D. Basco', 'Jeffrey \"Torpedo Boy\" Oderio.Ahahahaha', '2026-10-27 11:29:25'),
(5, 'jmax40', 'Jeffrey A. oderio', 'HAHAHA', '2026-10-27 13:28:38'),
(6, 'jmax40', 'Jeffrey A. oderio', 'Tapos na petsa 30 mo daun sir ba .. Print nalang kulang haha', '2026-10-27 13:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `staff_position` varchar(100) DEFAULT NULL,
  `head_name` varchar(100) DEFAULT NULL,
  `head_title` varchar(100) DEFAULT NULL,
  `administrative_name` varchar(100) DEFAULT NULL,
  `administrative_title` varchar(100) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `employee_name`, `staff_name`, `staff_position`, `head_name`, `head_title`, `administrative_name`, `administrative_title`, `department`, `last_seen`, `last_login`) VALUES
(8, 'jmax40', '$2y$10$KMwTWNGku.xXcOPX8CdAZufX/De18uj8wcxbUlLodH3PjT59tdU3K', 'Jeffrey A. oderio', 'JEFFREY A. ODERIO', 'COS', 'ALGEAN T. DASAL, RL,MLIS', 'College Librarian III', 'ELEN G. AVILA, MAED, LPT', 'Administrative Officer V (HRMO III)', 'Knowledge Resource Center', '2026-11-03 15:26:19', '2026-11-03 15:25:01'),
(9, 'mnaguila', '$2y$10$NexKCisp6zGkGVBT33NMzODdNcQ6tVIiUYJfS6sTRbHuBFED65oRS', 'Melbin N. Aguila', 'Melbin N. Aguila', 'COS', 'Desiderio Jr S. Franco', 'Administrative Officer V (GSO)', 'ELEN G. AVILA, LPT', 'Administrative Officer V/HRMO III', 'General Services  Unit', '2026-11-03 15:14:25', '2026-11-03 15:14:25'),
(10, 'mar', '$2y$10$KMwTWNGku.xXcOPX8CdAZufX/De18uj8wcxbUlLodH3PjT59tdU3K', 'Joemar D. Viesca', 'Joemar D. Viesca', 'COS', 'Desiderio Jr S. Franco', 'Administrative Officer V (GSO)', 'ELEN G. AVILA, LPT', 'Administrative Officer V/HRMO III', 'General Services  Unit', '2026-11-03 14:21:08', '2026-11-03 13:36:08'),
(11, 'crisanto', '$2y$10$KMwTWNGku.xXcOPX8CdAZufX/De18uj8wcxbUlLodH3PjT59tdU3K', 'Crisanto A. Misiona', 'CRISANTO A. MISIONA', 'SUPPORT STAFF (GSO)                                                   ', 'DESIDERIO S. FRANCO JR.   ', 'Supervisor’s Name and Signature', 'ELEN G. AVILA, LPT', 'Administrative Officer V/HRMO III', 'General Services Unit', NULL, NULL),
(12, 'aavillanueva', '$2y$10$KMwTWNGku.xXcOPX8CdAZufX/De18uj8wcxbUlLodH3PjT59tdU3K', 'Albert A. Villanueva', 'Albert A. Villanueva', 'COS', 'DESIDERIO S. FRANCO, JR.', 'Supervisor’s Name and Signature', 'ELEN G. AVILA,LPT', 'Administrative Officer V/HRMO III', 'General Service Unit', '2026-11-03 11:18:08', '2026-11-03 10:56:11'),
(13, 'Darry', '$2y$10$xbda72XsICta2UM3PNQiieeQ7E4QbK1RUw.K8qa3h1.1Ibly.3b0K', 'Darry B. Villaflor', 'DARRY B. VILLAFLOR', 'COS', 'REYMART JADE B. GAVILEÑO', 'Director, Production Office', 'ELEN G. AVILA, LPT', 'Administrative Officer V/HRMO III', 'Production', NULL, NULL),
(14, 'MattWiz08', '$2y$10$VU18VkoLuNKr0KAC61KenOE3cacfitzvPlCDqvwaj/FBfp62WYtTW', 'Matthio  Gel D. Basco', 'Matthio Gel Basco', 'COS', 'ALGEAN T. DASAL,RL,MLIS', 'College Librarian III', 'ELEN G. AVILA, MAED, LPT', 'Administrative Officer V (HRMO III)', 'Knowledge Research Center', '2026-11-03 14:34:35', '2026-11-03 13:47:43'),
(18, 'eduardo', '$2y$10$3aJRoOkFVJKQ1iL6ghNple2KqQEwXOEnOQGXFbPGJ6Yok2BuBRDe6', 'Eduardo S. Cerveza', 'Eduardo S. Cerveza', 'COS', 'DESIDERIO JR S. FRANCO', 'Administrative Officer V (GSO)', 'ELEN G. AVILA, LPT', 'Administrative Officer V/HRMO III', 'GSO', '2026-11-03 15:26:25', '2026-11-03 15:26:25'),
(23, 'djlorana24', '$2y$10$rucgnk0YJazGqwrIdrfM8OJBZrQVm5T4i32kw5dsOd8rKUWan7bjq', 'Jennipe D. Lorana', 'Jennipe D. Lorana', 'COS', 'DESIDERIO JR S. FRANCO', 'Administrative Officer V (GSO)', 'ELEN G. AVILA, LPT', 'Administrative Officer V/HRMO 111', 'GSO', '2026-11-03 14:29:24', '2026-11-03 13:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_daily_settings`
--

CREATE TABLE `user_daily_settings` (
  `username` varchar(50) NOT NULL,
  `include_saturday` tinyint(1) NOT NULL DEFAULT 0,
  `include_sunday` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_daily_settings`
--

INSERT INTO `user_daily_settings` (`username`, `include_saturday`, `include_sunday`, `updated_at`) VALUES
('jmax40', 0, 0, '2026-11-03 13:13:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomplishments`
--
ALTER TABLE `accomplishments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_task_generation`
--
ALTER TABLE `daily_task_generation`
  ADD PRIMARY KEY (`username`,`report_date`);

--
-- Indexes for table `daily_task_templates`
--
ALTER TABLE `daily_task_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_daily_settings`
--
ALTER TABLE `user_daily_settings`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomplishments`
--
ALTER TABLE `accomplishments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50176;

--
-- AUTO_INCREMENT for table `daily_task_templates`
--
ALTER TABLE `daily_task_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
