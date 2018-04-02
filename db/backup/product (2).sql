-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2018 at 08:52 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_distribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `scm_product_code` bigint(40) NOT NULL,
  `tp_product` int(100) NOT NULL,
  `pack_carton` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `description`, `product_code`, `team`, `scm_product_code`, `tp_product`, `pack_carton`, `user_id`) VALUES
(1499, 'Avsar Plus Tablet 160/5/12.5mg CP', '', 'PV09403', 'X-Treme', 1010401002000100362, 141, 32, 2),
(1500, 'Avsar Plus Tablet 160/5/25mg CP', '', 'PV09404', 'X-Treme', 1010401002000100363, 145, 32, 2),
(1501, 'Avsar Plus Tablet 160/10/12.5mg CP', '', 'PV09401', 'X-Treme', 1010401002000100353, 153, 32, 2),
(1502, 'Avsar Plus Tablet 160/10/25mg CP', '', 'PV09402', 'X-Treme', 1010401002000100360, 155, 32, 2),
(1503, 'Avsar Plus Tablet 320/10/25mg CP', '', 'PV09405', 'X-Treme', 1010401002000100364, 238, 32, 2),
(1504, 'Tansin Tablet 50mg CP', '', '6118610', 'X-Treme', 1010401002000100055, 130, 50, 2),
(1505, 'Tansin DS Tablet 100mg CP', '', '6118615', 'X-Treme', 1010401002000100067, 173, 50, 2),
(1506, 'Diu-Tansin Tablet CP', '', '6926310', 'X-Treme', 1010401002000100071, 138, 50, 2),
(1507, 'Securin Tablet 5mg CP', '', 'PV08101', 'X-Treme', 1010401002000100319, 108, 50, 2),
(1508, 'Securin Tablet 10mg CP', '', 'PV08102', 'X-Treme', 1010401002000100320, 216, 50, 2),
(1509, 'X-Plended Tablet 5mg CP', '', '7013910', 'X-Treme', 1010401002000100063, 117, 50, 2),
(1510, 'X-Plended Tablet 10mg CP', '', '7013912', 'X-Treme', 1010401002000100065, 196, 50, 2),
(1511, 'Lowplat Tablet 75mg CP', '', '3678310', 'Champions', 1010401002000100036, 121, 100, 2),
(1512, 'Xcept Tablet 10mg CP', '', 'PV07801', 'Champions', 1010401002000100274, 255, 50, 2),
(1513, 'Xcept Tablet 15mg CP', '', 'PV07802', 'Champions', 1010401002000100279, 476, 50, 2),
(1514, 'Xcept Tablet 20mg CP', '', 'PV07803', 'Champions', 1010401002000100280, 595, 60, 2),
(1515, 'X-Plended Tablet 20mg CP', '', '7013915', 'Champions', 1010401002000100064, 340, 50, 2),
(1516, 'Inosita Tablet 25mg CP', '', 'PV04803', 'Metabolizer', 1010401002000100170, 106, 50, 2),
(1517, 'Inosita Tablet 50mg CP (14s)', '', 'PV04804', 'Metabolizer', 1010401002000100286, 262, 50, 2),
(1518, 'Inosita Tablet 100mg CP (14s)', '', 'PV04805', 'Metabolizer', 1010401002000100287, 428, 50, 2),
(1519, 'Inosita Plus Tablet 50/500mg CP (14s)', '', 'PV04903', 'Metabolizer', 1010401002000100288, 274, 50, 2),
(1520, 'Inosita Plus Tablet 50/850mg CP', '', 'PV04905', 'Metabolizer', 1010401002000100361, 200, 50, 2),
(1521, 'Inosita Plus Tablet 50/1000mg CP (14s)', '', 'PV04904', 'Metabolizer', 1010401002000100289, 286, 50, 2),
(1522, 'INNOGEN R INJECTION, 10ml Vial\r\n\r\n', '', 'PV02401', 'Metabolizer', 1010403001000200005, 394, 24, 2),
(1523, 'INNOGEN N INJECTION, 10ml Vial', '', 'PV02501', 'Metabolizer', 1010403001000200006, 394, 24, 2),
(1524, 'INNOGEN M30 INJECTION, 10ml Vial', '', 'PV02601', 'Metabolizer', 1010403001000200007, 373, 24, 2),
(1525, 'Treatan Tablet 4mg CP', '', '6449610', 'Metabolizer', 1010401002000100059, 132, 50, 2),
(1526, 'Treatan Tablet 8mg CP', '', '6449613', 'Metabolizer', 1010401002000100058, 170, 50, 2),
(1527, 'Treatan Tablet 16mg CP', '', '6449615', 'Metabolizer', 1010401002000100057, 455, 50, 2),
(1528, 'Treatan-D Tablet CP', '', '6449710', 'Metabolizer', 1010401002000100060, 510, 50, 2),
(1529, 'Xilica Capsule 50mg CP', '', 'PV08901', 'Metabolizer', 1010401002000200021, 173, 50, 2),
(1530, 'Xilica Capsule 75mg CP', '', 'PV08902', 'Metabolizer', 1010401002000200022, 194, 50, 2),
(1531, 'Xilica Capsule 100mg CP', '', 'PV08903', 'Metabolizer', 1010401002000200023, 244, 50, 2),
(1532, 'Xilica Capsule 150mg CP', '', 'PV08904', 'Metabolizer', 1010401002000200024, 347, 50, 2),
(1533, 'Lowplat Plus Tablet 75/75mg CP', '', '3672210', 'Legends', 1010401002000100075, 126, 50, 2),
(1534, 'Lowplat Plus Tablet 75/150mg CP', '', '3672215', 'Legends', 1010401002000100037, 130, 50, 2),
(1535, 'Telsarta Tablet 20mg CP', '', 'PV03701', 'Legends', 1010401002000100154, 109, 50, 2),
(1536, 'Telsarta Tablet 40mg CP', '', 'PV03702', 'Legends', 1010401002000100155, 182, 50, 2),
(1537, 'Telsarta Tablet 80mg CP', '', 'PV03703', 'Legends', 1010401002000100156, 264, 24, 2),
(1538, 'Telsarta-A Tablet 5/40mg CP', '', 'PV07701', 'Legends', 1010401002000100269, 213, 50, 2),
(1539, 'Telsarta-A Tablet 5/80mg CP', '', 'PV07702', 'Legends', 1010401002000100270, 323, 28, 2),
(1540, 'Telsarta-A Tablet 10/40mg CP', '', 'PV07703', 'Legends', 1010401002000100271, 162, 50, 2),
(1541, 'Telsarta-A Tablet 10/80mg CP', '', 'PV07704', 'Legends', 1010401002000100272, 230, 50, 2),
(1542, 'Telsarta-D Tablet 40/12.5mg CP', '', 'PV03801', 'Legends', 1010401002000100158, 264, 50, 2),
(1543, 'Telsarta-D Tablet 80/12.5mg CP', '', 'PV03802', 'Legends', 1010401002000100159, 381, 50, 2),
(1544, 'Avsar Tablet 80/5mg CP', '', 'PV03601', 'Challengers', 1010401002000100149, 214, 100, 2),
(1545, 'Avsar Tablet 160/5mg CP', '', 'PV03602', 'Challengers', 1010401002000100150, 309, 50, 2),
(1546, 'Avsar Tablet 160/10mg CP', '', 'PV03603', 'Challengers', 1010401002000100151, 357, 50, 2),
(1547, 'Galvecta Tablet 50mg CP', '', 'PV09001', 'Challengers', 1010401002000100357, 208, 50, 2),
(1548, 'Galvecta Plus Tablet 50/850mg CP', '', 'PV09101', 'Challengers', 1010401002000100358, 306, 50, 2),
(1549, 'Galvecta Plus Tablet 50/1000mg CP', '', 'PV09102', 'Challengers', 1010401002000100359, 306, 50, 2),
(1550, 'Nuval Tablet 80mg CP', '', 'PV05001', 'Challengers', 1010401002000100164, 179, 50, 2),
(1551, 'Nuval Tablet 160mg CP', '', 'PV05002', 'Challengers', 1010401002000100165, 250, 24, 2),
(1552, 'Nuval-D Tablet 80/12.5mg CP', '', 'PV05101', 'Challengers', 1010401002000100162, 190, 50, 2),
(1553, 'Nuval-D Tablet 160/25mg CP', '', 'PV05102', 'Challengers', 1010401002000100163, 274, 24, 2),
(1554, 'Arbi Tablet 150mg CP', '', 'PV06001', 'Winners', 1010401002000100217, 196, 50, 2),
(1555, 'Arbi Tablet 300mg CP', '', 'PV06002', 'Winners', 1010401002000100220, 293, 38, 2),
(1556, 'Arbi-D Tablet 150/12.5mg CP', '', 'PV06101', 'Winners', 1010401002000100219, 205, 50, 2),
(1557, 'Arbi-D Tablet 300/12.5mg CP', '', 'PV06102', 'Winners', 1010401002000100218, 303, 38, 2),
(1558, 'Arbi-D Tablet 300/25mg CP', '', 'PV06103', 'Winners', 1010401002000100351, 417, 38, 2),
(1559, 'Evopride Tablet 1mg CP (30s)', '', '2687718', 'Winners', 1010401002000100324, 129, 40, 2),
(1560, 'Evopride Tablet 2mg CP (30s)', '', '2687713', 'Winners', 1010401002000100325, 215, 40, 2),
(1561, 'Evopride Tablet 3mg CP (30s)', '', '2687716', 'Winners', 1010401002000100326, 291, 40, 2),
(1562, 'Evopride Tablet 4mg CP (30s)', '', '2687717', 'Winners', 1010401002000100327, 434, 40, 2),
(1563, 'Myopro Tablet 10mg CP', '', 'PV09601', 'Winners', 1010401002000100387, 140, 50, 2),
(1564, 'Myopro Tablet 20mg CP', '', 'PV09602', 'Winners', 1010401002000100388, 254, 56, 2),
(1565, 'Myopro Tablet 40mg CP', '', 'PV09603', 'Winners', 1010401002000100389, 339, 56, 2),
(1566, 'Orslim Capsule 120mg CP', '', '4442620', 'Winners', 1010401002000200001, 1275, 40, 2),
(1567, 'Duzalta Capsule 20mg CP', '', 'PV08701', 'Mavericks', 1010401002000200018, 214, 50, 2),
(1568, 'Duzalta Capsule 30mg CP', '', 'PV08702', 'Mavericks', 1010401002000200019, 292, 50, 2),
(1569, 'Duzalta Capsule 60mg CP', '', 'PV08703', 'Mavericks', 1010401002000200020, 315, 50, 2),
(1570, 'Evopride Plus Tablet 1/500mg CP', '', 'PV01701', 'Mavericks', 1010401002000100079, 128, 50, 2),
(1571, 'Evopride Plus Tablet 2/500mg CP', '', 'PV01702', 'Mavericks', 1010401002000100086, 217, 50, 2),
(1572, 'Ramipace Tablet 1.25mg CP (28s)', '', '5451410', 'Mavericks', 1010401002000100246, 172, 50, 2),
(1573, 'Ramipace Tablet 2.5mg CP (28s)', '', '5451415', 'Mavericks', 1010401002000100247, 290, 50, 2),
(1574, 'Ramipace Tablet 5mg CP', '', '5451417', 'Mavericks', 1010401002000100044, 378, 50, 2),
(1575, 'Ramipace Tablet 10mg CP', '', '5451418', 'Mavericks', 1010401002000100013, 510, 50, 2),
(1576, 'Setspin Tablet 8mg CP', '', 'PV08801', 'Mavericks', 1010401002000100321, 182, 25, 2),
(1577, 'Setspin Tablet 16mg CP', '', 'PV08802', 'Mavericks', 1010401002000100322, 251, 25, 2),
(1578, 'Setspin Tablet 24mg CP', '', 'PV08803', 'Mavericks', 1010401002000100323, 402, 25, 2),
(1579, 'Estar Tablet 5mg CP', '', '2693012', 'Titans', 1010401002000100016, 149, 50, 2),
(1580, 'Estar Tablet 10mg CP (14s)', '', '2693013', 'Titans', 1010401002000100328, 221, 50, 2),
(1581, 'Estar Tablet 20mg CP', '', '2693011', 'Titans', 1010401002000100015, 327, 50, 2),
(1582, 'Evokalm Tablet 25mg CP', '', '2501810', 'Titans', 1010401002000100103, 98, 50, 2),
(1583, 'Evokalm Tablet 100mg CP', '', '2501815', 'Titans', 1010401002000100104, 185, 50, 2),
(1584, 'Evokalm Tablet 200mg CP', '', '2501820', 'Titans', 1010401002000100096, 281, 50, 2),
(1585, 'Evokalm XR Tablet 200mg CP', '', 'PV03901', 'Titans', 1010401002000100160, 281, 24, 2),
(1586, 'Evokalm XR Tablet 300mg CP', '', 'PV03902', 'Titans', 1010401002000100161, 383, 24, 2),
(1587, 'Klevra Tablet 250mg CP', '', 'PV04101', 'Titans', 1010401002000100167, 561, 30, 2),
(1588, 'Klevra Tablet 500mg CP', '', 'PV04102', 'Titans', 1010401002000100168, 1007, 20, 2),
(1589, 'Klevra XR Tablet 500mg CP', '', 'PV06701', 'Titans', 1010401002000100189, 336, 24, 2),
(1590, 'Klevra Oral Solution 500mg/5ml CP (60ml)', '', 'PV04103', 'Titans', 1010401002000500006, 306, 50, 2),
(1591, 'Voxamine Tablet 50mg CP', '', '6927310', 'Titans', 1010401002000100061, 156, 50, 2),
(1592, 'Voxamine Tablet 100mg CP', '', '6927315', 'Titans', 1010401002000100062, 313, 50, 2),
(1593, 'Dakvir Tablet 30mg CP', '', 'PV09901', 'Re-Born Virology', 1010401002000100407, 2365, 25, 2),
(1594, 'Dakvir Tablet 60mg CP', '', 'PV09902', 'Re-Born Virology', 1010401002000100408, 3869, 25, 2),
(1595, 'Tenova Tablet 300mg CP', '', 'PV04301', 'Re-Born Virology', 1010401002000100166, 2974, 20, 2),
(1596, 'Rixabac Tablet 200mg CP', '', 'PV07501', 'Re-Born Virology', 1010401002000100257, 142, 50, 2),
(1597, 'Rixabac Tablet 550mg CP', '', 'PV07502', 'Re-Born Virology', 1010401002000100258, 422, 76, 2),
(1598, 'Zoltar Capsule 20mg CP', '', '7004910', 'Re-Born Virology', 1010401002000200007, 145, 50, 2),
(1599, 'ZOLTAR INJECTION (CP)', '', '7004940', 'Re-Born Virology', 1010403003000200001, 204, 124, 2),
(1600, 'Zoval Tablet 400mg CP', '', 'PV07901', 'Re-Born Virology', 1010401002000100318, 5059, 32, 2),
(1601, 'Evorin Tablet 400mg CP', '', 'PV04501', 'Re-Born Virology', 1010401002000100073, 0, 1, 2),
(1602, 'Evorin Tablet 600mg CP', '', 'PV04502', 'Re-Born Virology', 1010401002000100331, 0, 1, 2),
(1603, 'Esmart Tablet 50mg CP', '', 'PV02301', 'Elite', 1010401002000100137, 198, 50, 2),
(1604, 'Esmart Tablet 75mg CP', '', 'PV02302', 'Elite', 1010401002000100146, 206, 50, 2),
(1605, 'Onita Sachet 2g CP', '', 'PV01901', 'Elite', 1010401002000600002, 655, 40, 2),
(1606, 'Gouric Tablet 80mg CP', '', 'PV04002', 'Elite', 1010401002000100177, 523, 50, 2),
(1607, 'Nise Tablet 100mg CP', '', '4390410', 'Bone Saviour', 1010401002000100039, 98, 100, 2),
(1608, 'Ibandro Tablet 150mg CP', '', 'PV02801', 'Bone Saviour', 1010401002000100145, 376, 27, 2),
(1609, 'Gouric Tablet 40mg CP', '', 'PV04001', 'Bone Saviour', 1010401002000100176, 306, 100, 2),
(1610, 'Spedicam Tablet 8mg CP', '', 'PV04201', 'Warrior', 1010401002000100175, 111, 100, 2),
(1611, 'Evofix Capsule 400mg CP', '', '2692720', 'Gladiators', 1010401001000200001, 510, 50, 2),
(1612, 'Fasteso Tablet 20mg CP', '', '2692310', 'Gladiators', 1010401002000100021, 147, 100, 2),
(1613, 'Fasteso Tablet 40mg CP', '', '2692315', 'Gladiators', 1010401002000100022, 214, 100, 2),
(1614, 'Actiflor Sachet 250mg CP', '', '184850', 'Sprinters', 1010401002000600001, 244, 72, 2),
(1615, 'Aireez Sachet 4mg CP', '', '185050', 'Sprinters', 1010401002000100072, 143, 40, 2),
(1616, 'Aireez Tablet 4mg CP', '', '185012', 'Sprinters', 1010401002000100074, 143, 50, 2),
(1617, 'Aireez Tablet 5mg CP', '', '185010', 'Sprinters', 1010401002000100003, 383, 50, 2),
(1618, 'Aireez Tablet 10mg CP', '', '185015', 'Sprinters', 1010401002000100004, 510, 50, 2),
(1619, 'Evofix Suspension 100mg/5ml CP (30ml)', '', '2692749', 'Sprinters', 1010401001000300008, 111, 50, 2),
(1620, 'Evofix Suspension 100mg/5ml CP (60ml)', '', '2692745', 'Sprinters', 1010401001000300003, 147, 50, 2),
(1621, 'Evofix DS Suspension CP (30ml)', '', '2692747', 'Sprinters', 1010401001000300005, 155, 50, 2),
(1622, 'Celia Develop 1 (CP)', '', 'PV02201', 'Hifliers', 1010403007000100001, 620, 24, 2),
(1623, 'Celia Develop 2 (CP)', '', 'PV02202', 'Hifliers', 1010403007000100002, 648, 24, 2),
(1624, 'Celia Develop 3 (CP)', '', 'PV02203', 'Hifliers', 1010403007000100003, 657, 24, 2),
(1625, 'CELIA DIGEST', '', 'PV02901', 'Hifliers', 1010403007000100004, 800, 12, 2),
(1626, 'CELIA ANTI REGURGITATION', '', 'PV03101', 'Hifliers', 1010403007000100006, 823, 12, 2),
(1627, 'CELIA DIARRHOEAS ACTION', '', 'PV03201', 'Hifliers', 1010403007000100007, 724, 12, 2),
(1628, 'CELIA PEPTIDE EHF', '', 'PV06201', 'Hifliers', 1010403007000100010, 2081, 12, 2),
(1629, 'CELIA LF INFANT', '', 'PV03301', 'Hifliers', 1010403007000100008, 763, 12, 2),
(1630, 'Celia Premature', '', 'PV06401', 'Hifliers', 1010403007000100012, 851, 12, 2),
(1631, 'CELIA MAMA', '', 'PV03401', 'Hifliers', 1010403007000100009, 833, 12, 2),
(1632, 'Lacteus 1 (CP)', '', 'PV08201', 'Conqueror', 1010403007000100013, 675, 24, 2),
(1633, 'Lacteus 2 (CP)', '', 'PV08301', 'Conqueror', 1010403007000100014, 675, 24, 2),
(1634, 'Lacteus 3 (CP)', '', 'PV08401', 'Conqueror', 1010403007000100015, 675, 24, 2),
(1635, 'Lacteus AR (CP)', '', 'PV08501', 'Conqueror', 1010403007000100016, 823, 24, 2),
(1636, 'Bonedol Tablet 0.25mcg CP', '', '879710', 'Non Promotional', 1010401002000100007, 51, 50, 2),
(1637, 'Bonedol Tablet 0.5mcg CP', '', '879713', 'Non Promotional', 1010401002000100008, 128, 50, 2),
(1638, 'Evorox Tablet 250mg CP', '', '2691815', 'Non Promotional', 1010401001000100004, 289, 50, 2),
(1639, 'Evorox Suspension 125mg/5ml CP (50ml)', '', '2691840', 'Non Promotional', 1010401001000300004, 145, 50, 2),
(1640, 'Gouric Tablet 120mg CP', '', 'PV04003', 'Non Promotional', 1010401002000100352, 680, 50, 2),
(1641, 'Lowplat Tablet 300mg CP', '', '3678315', 'Non Promotional', 1010401002000100299, 59, 100, 2),
(1642, 'Zoltar Insta Capsule 20mg CP', '', 'PV02703', 'Non Promotional', 1010401002000200013, 124, 40, 2),
(1643, 'Zoltar Insta Capsule 40mg CP', '', 'PV02704', 'Non Promotional', 1010401002000200014, 214, 40, 2),
(1644, 'Phytus Syrup 120ml CP', '', 'PV09201', 'Sprinters', 1010404001000100003, 166, 50, 2),
(1645, 'NeoQ 10 Capsule 50mg CP', '', 'PV06901', 'Legends', 1030301001000200001, 407, 30, 2),
(1646, 'Ad Folic Tablet CP', '', 'PV07001', 'Warrior', 1030301001000100001, 203, 50, 2),
(1647, 'Ad Folic OD Tablet 600mcg CP', '', 'PV08601', 'Warrior', 1030301001000100006, 327, 50, 2),
(1648, 'NeoQ 10 Capsule 100mg CP', '', 'PV06902', 'Warrior', 1030301001000200002, 727, 0, 2),
(1649, 'Nozea Tablet CP', '', 'PV09701', 'Warrior', 1030301001000100008, 240, 0, 2),
(1650, 'Ferfer Sachet CP', '', 'PV09501', 'Gladiators', 1030301001000300004, 392, 0, 2),
(1651, 'Supercran Sachet CP', '', 'PV07201', 'Gladiators', 1030301001000300002, 203, 0, 2),
(1652, 'Kalsob Tablet CP', '', 'PV08001', 'Bone Saviour', 1030301001000100007, 392, 0, 2),
(1653, 'Opt-D Drops 400IU CP', '', 'PV09304', 'Hifliers', 1030301001000400001, 218, 0, 2),
(1654, 'Opt-D Capsule 25,000IU CP', '', 'PV09301', 'Elite', 1030301001000200003, 109, 0, 2),
(1655, 'Opt-D Capsule 100,000IU CP', '', 'PV09302', 'Elite', 1030301001000200004, 160, 0, 2),
(1656, 'Opt-D Capsule 200,000IU CP', '', 'PV09303', 'Elite', 1030301001000200005, 145, 0, 2),
(1657, 'NE-C300-E - A3 COMPLETE COMPRESSOR NEBULIZER', '', 'PV05706', 'OMRON', 1010403008000100042, 7265, 0, 2),
(1658, 'NE-C28P-E - COMP A.I.R. NE-C28P', '', 'PV05707', 'OMRON', 1010403008000100041, 7692, 0, 2),
(1659, 'NE-C803-E Comp Air Basic Compressor Nebulizer', '', 'PV05705', 'OMRON', 1010403008000100039, 3350, 0, 2),
(1660, 'MC-246-E-Omron Eco Temp Basic', '', 'PV05401', 'OMRON', 1010403008000100006, 444, 0, 2),
(1661, 'MC-341-E-Eco Temp Smart', '', 'PV05402', 'OMRON', 1010403008000100004, 556, 0, 2),
(1662, 'MC-720-E GENTLE TEMP 720 - THERMOMETER', '', 'PV05404', 'OMRON', 1010403008000100037, 5470, 0, 2),
(1663, 'HEM-7120-AF BPM - M2 ECO', '', 'PV05206', 'OMRON', 1010403008000100043, 3248, 0, 2),
(1664, 'HEM-7120-E BPM-UA M2 Basic', '', 'PV05201', 'OMRON', 1010403008000100033, 3846, 0, 2),
(1665, 'HEM-7131-E BPM-UA M3', '', 'PV05204', 'OMRON', 1010403008000100034, 7265, 0, 2),
(1666, 'HEM-7321-E UA M6 Comfort', '', 'PV05202', 'OMRON', 1010403008000100035, 9402, 0, 2),
(1667, 'HEM-7080IT-E UA-BPM M10-IT', '', 'PV05205', 'OMRON', 1010403008000100040, 14017, 0, 2),
(1668, 'HEM-6120-E WR-BPM RS1', '', 'PV05302', 'OMRON', 1010403008000100023, 3658, 0, 2),
(1669, 'HBF-508-E-Body Comp Monitor BF-508', '', 'PV05601', 'OMRON', 1010403008000100001, 8120, 0, 2),
(1670, 'HN-289-ESL SCALE HN289 SILKY GREY', '', 'PV05602', 'OMRON', 1010403008000100031, 2979, 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD UNIQUE KEY `scm_product_code` (`scm_product_code`),
  ADD KEY `product_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1671;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
