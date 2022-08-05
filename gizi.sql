-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2022 at 02:35 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gizi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tb` varchar(255) NOT NULL,
  `bb` varchar(255) NOT NULL,
  `jenisKelamin` varchar(255) NOT NULL,
  `tanggalLahir` varchar(20) NOT NULL,
  `golDar` varchar(10) NOT NULL,
  `tempatLahir` varchar(255) NOT NULL,
  `jenisData` varchar(255) NOT NULL,
  `IMT_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `nik`, `nama`, `tb`, `bb`, `jenisKelamin`, `tanggalLahir`, `golDar`, `tempatLahir`, `jenisData`, `IMT_status`) VALUES
(1, '320301717325023', 'Singgih Falah', '65', '7', 'L', '3/18/2018', 'A', 'Cianjur', 'training', 'Underweight'),
(2, '320301654067027', 'Thomas Wiguna', '65', '7', 'L', '5/14/2017', 'B', 'Bandung', 'training', 'Underweight'),
(3, '320301131158031', 'Mario Arifah', '66', '7', 'L', '12/31/2018', 'O', 'Sumedang', 'training', 'Underweight'),
(4, '320301249856029', 'Dhanu Triashafira', '66', '7', 'L', '6/10/2019', 'A', 'Cianjur', 'training', 'Underweight'),
(5, '320301288720041', 'Bob Fathir', '67', '7', 'L', '5/23/2014', 'B', 'Cianjur', 'training', 'Underweight'),
(6, '320301187950042', 'Anas Aristy', '67', '7', 'L', '1/6/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(7, '320301477562010', 'Andrie Farizi Husnah', '68', '7', 'L', '5/17/2016', 'O', 'Cianjur', 'training', 'Underweight'),
(8, '320301774280025', 'Rio Naenggolan', '68', '8', 'L', '9/20/2019', 'B', 'Cianjur', 'training', 'Underweight'),
(9, '320301500498044', 'Hudzaifah Ihsanuddin', '69', '8', 'L', '10/26/2015', 'A', 'Cianjur', 'training', 'Underweight'),
(10, '320301423627048', 'Zulfi Willyanda', '69', '8', 'L', '9/16/2018', 'B', 'Cianjur', 'training', 'Underweight'),
(11, '320301170511012', 'Bimo Givan Oktavianty', '70', '8', 'L', '6/18/2014', 'AB', 'Cianjur', 'training', 'Underweight'),
(12, '320301202317035', 'Mustafid Paramadina', '70', '8', 'L', '9/17/2019', 'O', 'Cianjur', 'training', 'Underweight'),
(13, '320301178685038', 'Hilman Ariani', '71', '8', 'L', '6/1/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(14, '320301416135025', 'Bony Jordan', '71', '8', 'L', '5/31/2019', 'A', 'Cianjur', 'training', 'Underweight'),
(15, '320301327628015', 'Aldi Syaibatul Suandhini', '72', '8', 'L', '9/2/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(16, '320301585953029', 'Hizkia Fadhillah', '72', '8', 'P', '1/8/2013', 'AB', 'Cianjur', 'training', 'Underweight'),
(17, '320301280329017', 'Ressy Rachma', '73', '8', 'P', '9/17/2017', 'O', 'Cianjur', 'training', 'Underweight'),
(18, '320301531579051', 'Banni Febrianto', '73', '9', 'L', '4/14/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(19, '320301627580059', 'Wildan Giarini', '74', '9', 'L', '10/19/2018', 'A', 'Lebak', 'training', 'Underweight'),
(20, '320301440966060', 'Alrendy Listisni', '74', '9', 'P', '1/25/2016', 'B', 'Cianjur', 'training', 'Underweight'),
(21, '320301332488012', 'Aburachman Hosea', '75', '9', 'L', '1/22/2017', 'B', 'Cianjur', 'training', 'Underweight'),
(22, '320301221933056', 'Edwin Reksa Priyanto', '75', '9', 'L', '3/23/2016', 'AB', 'Cianjur', 'training', 'Underweight'),
(23, '320301694773013', 'Revi Hilman Septiani', '76', '9', 'L', '9/14/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(24, '320301402415060', 'Tubagus Yutama Diva', '76', '9', 'P', '7/24/2019', 'A', 'Aceh', 'training', 'Underweight'),
(25, '320301472995037', 'Geraldi Praditia Sinuka', '77', '9', 'P', '4/23/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(26, '320301495865040', 'Doni Anwar', '77', '9', 'L', '3/15/2019', 'A', 'Lampung', 'training', 'Underweight'),
(27, '320301654884044', 'Adisdi Irlan Siahainenia', '78', '9', 'L', '2/19/2017', 'A', 'Manado', 'training', 'Underweight'),
(28, '320301563913036', 'Aulia Tio', '78', '9', 'L', '4/27/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(29, '320301127531052', 'Gilang Wirawan', '79', '10', 'L', '7/18/2017', 'B', 'Bandung', 'training', 'Underweight'),
(30, '320301278564051', 'Firas Widyawati', '79', '10', 'L', '10/25/2016', 'A', 'Sumedang', 'training', 'Underweight'),
(31, '320301160064020', 'TaufikÂ DanialÂ Imam', '80', '10', 'L', '4/11/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(32, '320301792266022', 'IndahÂ NurulÂ Buana', '80', '10', 'P', '9/14/2015', 'AB', 'Cianjur', 'training', 'Underweight'),
(33, '320301480892015', 'RajaÂ AkhmadÂ Wangi', '81', '10', 'P', '4/13/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(34, '320301259164038', 'Dewi Astuti', '81', '10', 'P', '8/30/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(35, '320301548723014', 'Syaibatul Parhorasan', '82', '10', 'L', '6/16/2015', 'A', 'Cianjur', 'training', 'Underweight'),
(36, '320301372019025', 'Yosua Maulina', '82', '10', 'P', '2/28/2018', 'A', 'Cianjur', 'training', 'Underweight'),
(37, '320301255521041', 'Vito Rozi', '83', '10', 'P', '3/16/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(38, '320301289469033', 'Richard Arie Prihatiwi', '83', '11', 'L', '4/26/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(39, '320301455294053', 'Hudzaifah Loren', '84', '11', 'P', '10/9/2017', 'B', 'Cianjur', 'training', 'Underweight'),
(40, '320301723952022', 'Rio Ridanty', '84', '11', 'P', '12/8/2014', 'O', 'Cianjur', 'training', 'Underweight'),
(41, '320301181232015', 'Yudha Aswin Ciptasari', '85', '11', 'P', '10/13/2013', 'B', 'Cianjur', 'training', 'Underweight'),
(42, '320301289246051', 'Alditio Aulia', '85', '11', 'L', '2/9/2019', 'A', 'Cianjur', 'training', 'Underweight'),
(43, '320301553187013', 'Marza Haq', '86', '11', 'L', '7/25/2013', 'B', 'Cianjur', 'training', 'Underweight'),
(44, '320301613089010', 'Rahardianto Asyrafi Randhika', '86', '11', 'P', '8/26/2013', 'O', 'Cianjur', 'training', 'Underweight'),
(45, '320301162621047', 'Berian Amalina', '87', '11', 'P', '1/10/2017', 'B', 'Cianjur', 'training', 'Underweight'),
(46, '320301156125054', 'Mochammad Pratama Agustina', '87', '12', 'L', '1/24/2016', 'B', 'Lebak', 'training', 'Underweight'),
(47, '320301683260057', 'Rian Wiguna', '88', '12', 'L', '8/16/2017', 'O', 'Cianjur', 'training', 'Underweight'),
(48, '320301489941025', 'Revi Journalisanda', '88', '12', 'L', '3/28/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(49, '320301501646031', 'Fauzan Hidayati', '89', '12', 'P', '10/1/2016', 'AB', 'Cianjur', 'training', 'Underweight'),
(50, '320301703468060', 'Mark Amaliya', '89', '12', 'L', '5/15/2019', 'A', 'Cianjur', 'training', 'Underweight'),
(51, '320301798061059', 'Mustafid Alvianingrum', '90', '12', 'L', '6/1/2015', 'A', 'Cianjur', 'training', 'Underweight'),
(52, '320301725004034', 'Ilham Givan Nisa', '90', '12', 'L', '4/11/2013', 'AB', 'Bandung', 'training', 'Underweight'),
(53, '320301665672057', 'Yosafat Himawan', '91', '12', 'P', '7/23/2018', 'A', 'Sumedang', 'training', 'Underweight'),
(54, '320301424269054', 'Edwin Setyawati', '91', '13', 'P', '3/26/2018', 'A', 'Cianjur', 'training', 'Underweight'),
(55, '320301168927032', 'Aldi Setiawan', '92', '13', 'L', '10/18/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(56, '320301590411033', 'Adisdi Veronica', '92', '13', 'P', '10/2/2018', 'A', 'Cianjur', 'training', 'Underweight'),
(57, '320301526912039', 'Mirza Fikri', '93', '13', 'P', '11/16/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(58, '320301416875024', 'Yutama Usra', '93', '13', 'L', '2/19/2017', 'AB', 'Cianjur', 'training', 'Underweight'),
(59, '320301766953013', 'Bony Ulfania', '94', '13', 'L', '1/31/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(60, '320301308914026', 'Satrya Revi Rustam', '94', '13', 'P', '6/19/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(61, '320301688468040', 'Okky Nurkhasanah', '95', '13', 'P', '6/25/2018', 'AB', 'Cianjur', 'training', 'Underweight'),
(62, '320301358132056', 'Imam Alika', '95', '14', 'P', '12/18/2016', 'B', 'Cianjur', 'training', 'Underweight'),
(63, '320301146818010', 'Fadhlir Mawaldi', '96', '14', 'P', '6/12/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(64, '320301439904018', 'Rangga Maulinda', '96', '14', 'L', '7/24/2014', 'B', 'Cianjur', 'training', 'Underweight'),
(65, '320301565028060', 'Fajar Mairessi', '97', '14', 'P', '11/6/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(66, '320301126526012', 'Geraldi Nathania', '97', '14', 'L', '2/16/2018', 'O', 'Cianjur', 'training', 'Underweight'),
(67, '320301187180039', 'Akbar Machmud', '98', '14', 'L', '11/25/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(68, '320301471155010', 'Lukman Novitasari', '98', '14', 'L', '4/15/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(69, '320301435585010', 'Fahmi Sakinah', '99', '14', 'P', '4/14/2014', 'B', 'Lebak', 'training', 'Underweight'),
(70, '320301790305057', 'Surya Candraditya', '99', '15', 'L', '8/11/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(71, '320301185573054', 'Bintang Amelia', '100', '15', 'L', '9/29/2013', 'AB', 'Cianjur', 'training', 'Underweight'),
(72, '320301718155046', 'Hizkia Derilandry Wibisono', '100', '15', 'L', '7/20/2015', 'A', 'Cianjur', 'training', 'Underweight'),
(73, '320301195124054', 'Bryan Josh', '101', '15', 'L', '4/28/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(74, '320301651514018', 'Andhika Abidah', '101', '15', 'P', '6/19/2015', 'O', 'Cianjur', 'training', 'Underweight'),
(75, '320301303093037', 'Ridhwan Larashaty', '102', '15', 'L', '1/26/2014', 'O', 'Bandung', 'training', 'Underweight'),
(76, '320301295081047', 'Reynaldi Permatasari', '102', '16', 'P', '7/14/2019', 'A', 'Sumedang', 'training', 'Underweight'),
(77, '320301535873054', 'Beckley Anindya', '103', '16', 'P', '2/21/2018', 'A', 'Cianjur', 'training', 'Underweight'),
(78, '320301249051013', 'Roy Christine', '103', '16', 'L', '11/30/2016', 'A', 'Cianjur', 'training', 'Underweight'),
(79, '320301501468058', 'Yola Suputra', '104', '16', 'P', '4/2/2016', 'O', 'Cianjur', 'training', 'Underweight'),
(80, '320301377455027', 'Lintang Nuraini', '104', '16', 'P', '2/11/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(81, '320301589745015', 'Yoedhistiera Andriyanti', '105', '16', 'P', '1/11/2013', 'A', 'Cianjur', 'training', 'Underweight'),
(82, '320301136571049', 'Dikposa Indriastari', '105', '16', 'L', '11/8/2019', 'A', 'Cianjur', 'training', 'Underweight'),
(83, '320301706700059', 'Nauval Varensia', '106', '17', 'P', '7/28/2014', 'O', 'Cianjur', 'training', 'Underweight'),
(84, '320301217189050', 'Revo Julianne', '106', '17', 'L', '2/26/2015', 'A', 'Cianjur', 'training', 'Underweight'),
(85, '320301258178042', 'Jamal Bahri', '107', '17', 'P', '3/18/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(86, '320301619814013', 'Omar Herlin', '107', '17', 'P', '7/15/2017', 'AB', 'Cianjur', 'training', 'Underweight'),
(87, '320301347319058', 'Haris Agtrivia', '108', '17', 'P', '3/14/2019', 'B', 'Cianjur', 'training', 'Underweight'),
(88, '320301556826055', 'Bintang Pratiko', '108', '18', 'L', '4/27/2018', 'A', 'Cianjur', 'training', 'Underweight'),
(89, '320301667131030', 'Julian Adha', '109', '18', 'P', '12/24/2015', 'B', 'Cianjur', 'training', 'Underweight'),
(90, '320301743845038', 'Yola Kahfi', '109', '18', 'P', '6/13/2016', 'AB', 'Cianjur', 'training', 'Underweight'),
(91, '320301578906026', 'Farizi Sunanto', '110', '18', 'L', '7/7/2019', 'A', 'Cianjur', 'training', 'Underweight'),
(92, '320301221416018', 'Bimo Nathania', '110', '18', 'L', '2/19/2018', 'B', 'Lebak', 'training', 'Underweight'),
(93, '320301356976013', 'Muhamad Omar Mubarak', '111', '19', 'P', '3/15/2016', 'AB', 'Cianjur', 'training', 'Underweight'),
(94, '320301597668043', 'Miftachul Sigit Hasudungan', '111', '19', 'L', '11/13/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(95, '320301789533041', 'Rifqy Kusumawardhani', '112', '19', 'L', '7/25/2015', 'B', 'Cianjur', 'training', 'Underweight'),
(96, '320301264074051', 'Richard Reksa Larascaesara', '112', '19', 'L', '9/12/2016', 'O', 'Cianjur', 'training', 'Underweight'),
(97, '320301449630019', 'Hizrian Sihombing', '113', '19', 'P', '12/12/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(98, '320301174755031', 'Aufa Saniyati', '113', '20', 'P', '1/10/2018', 'O', 'Cianjur', 'training', 'Underweight'),
(99, '320301178777036', 'Fariz Aggil Nisrina', '114', '20', 'L', '3/25/2017', 'A', 'Lebak', 'training', 'Underweight'),
(100, '320301304640010', 'Dede Triutami', '114', '20', 'L', '10/23/2018', 'B', 'Cianjur', 'training', 'Underweight'),
(101, '320301218092057', 'Eka Primastiny', '115', '20', 'P', '3/21/2016', 'O', 'Cianjur', 'training', 'Underweight'),
(102, '320301382749044', 'Aggil Saputra', '115', '20', 'P', '5/11/2014', 'O', 'Cianjur', 'training', 'Underweight'),
(103, '320301137071036', 'Dwiki Suputra', '116', '21', 'L', '3/25/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(104, '320301350823037', 'Reynard Pertiwi', '116', '21', 'L', '2/4/2014', 'A', 'Cianjur', 'training', 'Underweight'),
(105, '320301155639035', 'Mustofa Isnandri', '117', '21', 'P', '5/8/2018', 'A', 'Bandung', 'training', 'Underweight'),
(106, '320301214573033', 'Teddo Elvira', '117', '21', 'P', '11/19/2014', 'O', 'Sumedang', 'training', 'Underweight'),
(107, '320301223336056', 'Rutwan Zain', '118', '22', 'L', '3/28/2013', 'A', 'Bandung', 'training', 'Underweight'),
(108, '320301469469033', 'Alditio Ariefandi', '118', '22', 'L', '10/10/2016', 'B', 'Cianjur', 'training', 'Underweight'),
(109, '320301185581027', 'Adam Alfin Oktavianty', '119', '22', 'P', '10/2/2017', 'A', 'Cianjur', 'training', 'Underweight'),
(110, '320301700007030', 'Banni Sapitri', '119', '22', 'P', '8/25/2016', 'A', 'Bandung', 'training', 'Underweight'),
(111, '320301687960019', 'Ogie Noverlia', '120', '22', 'P', '10/31/2018', 'A', 'Cianjur', 'testing', 'Underweight'),
(112, '320301284131052', 'Chandra Geryance', '124', '30', 'P', '4/3/2019', 'O', 'Cianjur', 'testing', 'Normal Weight'),
(113, '320301707005013', 'Praditia Farizi', '124', '32', 'L', '8/26/2017', 'A', 'Lebak', 'testing', 'Normal Weight'),
(114, '320301209811027', 'Aprian Haddad', '129', '86', 'L', '8/17/2019', 'AB', 'Cianjur', 'testing', 'Obese'),
(115, '320301513689050', 'Gilang Ertasari', '107', '67', 'P', '6/9/2013', 'A', 'Cianjur', 'testing', 'Obese'),
(116, '320301295130058', 'Syarief Tanuwijaya', '86', '41', 'P', '4/5/2018', 'B', 'Cianjur', 'testing', 'Obese'),
(117, '320301673276019', 'Ferdiansyah Rahmawati', '122', '82', 'P', '10/29/2013', 'A', 'Cianjur', 'testing', 'Obese'),
(118, '320301441119018', 'Bob Falah', '127', '80', 'L', '1/24/2017', 'A', 'Cianjur', 'testing', 'Obese'),
(119, '320301394315060', 'Azrul Wagey', '84', '35', 'L', '6/21/2017', 'B', 'Cianjur', 'testing', 'Obese'),
(120, '320301383620028', 'Pandu Maharani', '108', '67', 'P', '1/4/2014', 'A', 'Lebak', 'testing', 'Obese'),
(121, '320301736399022', 'Rinaldy Amami', '104', '55', 'P', '1/24/2013', 'AB', 'Cianjur', 'testing', 'Obese'),
(122, '320301572434042', 'Ario Azrul Hardianti', '80', '40', 'L', '9/28/2015', 'A', 'Cianjur', 'testing', 'Obese'),
(123, '320301366057046', 'Rezky Rais', '122', '35', 'P', '12/26/2015', 'A', 'Cianjur', 'testing', 'Overweight'),
(124, '320301489919026', 'Naufal Juliyanti', '112', '66', 'L', '6/7/2019', 'AB', 'Cianjur', 'testing', 'Obese'),
(125, '320301659721048', 'Rio Qodir', '130', '86', 'L', '10/21/2016', 'A', 'Cianjur', 'testing', 'Obese'),
(126, '320301774583045', 'Mario Keviati', '87', '40', 'L', '1/20/2014', 'A', 'Bandung', 'testing', 'Obese'),
(127, '320301268541038', 'Ariyadi Shabrina', '102', '58', 'P', '3/22/2015', 'A', 'Sumedang', 'testing', 'Obese'),
(128, '320301135583017', 'Ryan Setyawati', '89', '44', 'P', '5/10/2016', 'A', 'Bandung', 'testing', 'Obese'),
(129, '320301755595050', 'Arfan Jhon Wijaya', '95', '52', 'P', '1/26/2019', 'A', 'Cianjur', 'testing', 'Obese'),
(130, '320301448007010', 'Geraldi Sumlang', '103', '60', 'L', '6/28/2014', 'A', 'Cianjur', 'testing', 'Obese'),
(131, '320301652359057', 'Yosafat Febriani', '102', '53', 'P', '7/21/2015', 'A', 'Bandung', 'testing', 'Obese'),
(132, '320301199487035', 'Adityo Carolina', '126', '77', 'P', '3/25/2019', 'B', 'Bandung', 'testing', 'Obese'),
(133, '320301437567024', 'Dee Satrio', '83', '36', 'P', '1/26/2019', 'A', 'Cianjur', 'testing', 'Obese'),
(134, '320301462478025', 'Jhon Devi', '114', '65', 'L', '1/16/2017', 'A', 'Cianjur', 'testing', 'Obese'),
(135, '320301218671060', 'Pratama Hakim', '106', '63', 'L', '4/9/2013', 'O', 'Lebak', 'testing', 'Obese'),
(136, '320301691497052', 'Aldi Nurdiansyah', '113', '72', 'L', '9/3/2014', 'A', 'Manado', 'testing', 'Obese'),
(137, '320301116675047', 'Sutrisno Pringganti', '104', '58', 'P', '7/10/2019', 'B', 'Bandung', 'testing', 'Obese'),
(138, '320301454632039', 'Cakra Sakinah', '93', '50', 'L', '6/8/2016', 'A', 'Cianjur', 'testing', 'Obese'),
(139, '320301593468015', 'Rutwan Ihatrayudha', '126', '85', 'L', '3/9/2016', 'B', 'Cianjur', 'testing', 'Obese');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `is_first` int(1) NOT NULL DEFAULT '1',
  `level` varchar(50) NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT 'Y',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `no_telp`, `email`, `alamat`, `is_first`, `level`, `aktif`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '1234', 'admin@futsal.com', '', 0, 'admin', 'Y', '2022-04-12 14:43:44', '', '2022-05-29 11:29:16', ''),
(4228, '320301717325023', 'beeb6ec294f3429f2f50e3d73283745f', 'Singgih Falah', '0', '320301717325023@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4229, '320301654067027', '5b56bde6e1c0c3824f1891fe45192ffa', 'Thomas Wiguna', '0', '320301654067027@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4230, '320301131158031', 'c154d60c1b8fd509d23543f0043bcf26', 'Mario Arifah', '0', '320301131158031@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4231, '320301249856029', '5ef7029bf63477905c33e533bf187db7', 'Dhanu Triashafira', '0', '320301249856029@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4232, '320301288720041', '1a705c7a006bd6c4b631708b98126aa7', 'Bob Fathir', '0', '320301288720041@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4233, '320301187950042', '64456add02af63f0255faa833fe8ef40', 'Anas Aristy', '0', '320301187950042@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4234, '320301477562010', 'f4c44a80859e6890aedde9b2a2bfc89a', 'Andrie Farizi Husnah', '0', '320301477562010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4235, '320301774280025', '31581bb57777a4326f7bf16c6d5a7ea9', 'Rio Naenggolan', '0', '320301774280025@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4236, '320301500498044', 'f48f39d2bf3f11d0b5e2f9619074dca9', 'Hudzaifah Ihsanuddin', '0', '320301500498044@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4237, '320301423627048', '2c8c3078d2f3d727432259a12b7ec216', 'Zulfi Willyanda', '0', '320301423627048@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4238, '320301170511012', 'fd65c81e42a06db5f03a42b85c16e650', 'Bimo Givan Oktavianty', '0', '320301170511012@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4239, '320301202317035', 'c8d4fd828a3ef806127ca77a2cdf70fe', 'Mustafid Paramadina', '0', '320301202317035@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4240, '320301178685038', 'd0ca40e1df4858a2541bbbbe58c7ca28', 'Hilman Ariani', '0', '320301178685038@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4241, '320301416135025', '21b3bb5312dd9345509ff8c022aeab54', 'Bony Jordan', '0', '320301416135025@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4242, '320301327628015', '10d01b6f8f1e02d21115d6a2211b0b62', 'Aldi Syaibatul Suandhini', '0', '320301327628015@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4243, '320301585953029', '7ce1f216d8b672d810a4535458058bb2', 'Hizkia Fadhillah', '0', '320301585953029@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4244, '320301280329017', 'e13d5ffb97415040dc35608e16b021a9', 'Ressy Rachma', '0', '320301280329017@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4245, '320301531579051', '4dbf88de01d4f08e65da4a236e9ce69d', 'Banni Febrianto', '0', '320301531579051@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4246, '320301627580059', 'c77bc252963f2a33486d67a1f5906589', 'Wildan Giarini', '0', '320301627580059@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4247, '320301440966060', '616a8386d0cbba5c8652ef01c53ee702', 'Alrendy Listisni', '0', '320301440966060@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4248, '320301332488012', '344563d939716029793f175d54dc43bb', 'Aburachman Hosea', '0', '320301332488012@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4249, '320301221933056', '4be044eceb45f2e0e4decf51c5ca7d2b', 'Edwin Reksa Priyanto', '0', '320301221933056@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4250, '320301694773013', '75f15002302d2c01eeab596ce1da9d6d', 'Revi Hilman Septiani', '0', '320301694773013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4251, '320301402415060', '30334bf5fa6f0f8b1e97f2a6db0a2296', 'Tubagus Yutama Diva', '0', '320301402415060@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4252, '320301472995037', '547b7655728fb39bb066871264c9bfe4', 'Geraldi Praditia Sinuka', '0', '320301472995037@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4253, '320301495865040', 'e38b60b49b254300d14039f3a0da93ad', 'Doni Anwar', '0', '320301495865040@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4254, '320301654884044', '1970160a074dbb6b5368f83344cd4bca', 'Adisdi Irlan Siahainenia', '0', '320301654884044@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4255, '320301563913036', '6a2c32451c7c71645a1331237849f1ce', 'Aulia Tio', '0', '320301563913036@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4256, '320301127531052', '4aea8f2e7f0686395d18494d8c258131', 'Gilang Wirawan', '0', '320301127531052@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4257, '320301278564051', '15361fbc5d34361eb36472dfdd682ec6', 'Firas Widyawati', '0', '320301278564051@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4258, '320301160064020', 'e2ea0fd4622c4de1d4810639e47e55f4', 'TaufikÂ DanialÂ Imam', '0', '320301160064020@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4259, '320301792266022', 'cd08020719bfca6c0c01d2436d673ae4', 'IndahÂ NurulÂ Buana', '0', '320301792266022@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4260, '320301480892015', '2f8532ce1e5545f7227f4a038e449294', 'RajaÂ AkhmadÂ Wangi', '0', '320301480892015@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4261, '320301259164038', '3f20ee65ebc6f65e43eec54cefb9e25d', 'Dewi Astuti', '0', '320301259164038@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4262, '320301548723014', '328e3babe71a9f31b8705aaa07169cd6', 'Syaibatul Parhorasan', '0', '320301548723014@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4263, '320301372019025', 'bd0428c5ab35bca0385c437867dfdc72', 'Yosua Maulina', '0', '320301372019025@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4264, '320301255521041', '8f58ec5bc948cb0807506dc847682412', 'Vito Rozi', '0', '320301255521041@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4265, '320301289469033', '014cf093f6d3b0d998c1eedae6076ebb', 'Richard Arie Prihatiwi', '0', '320301289469033@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4266, '320301455294053', '77ec25f277f5aaf02336b2e2bdab7391', 'Hudzaifah Loren', '0', '320301455294053@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4267, '320301723952022', '9625b83ab699d4ae7b6df9c7ef6e7c13', 'Rio Ridanty', '0', '320301723952022@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4268, '320301181232015', 'f4aca696099b55168a550e2e779b0f59', 'Yudha Aswin Ciptasari', '0', '320301181232015@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4269, '320301289246051', '75ff43c64823983e224a41f95b56a667', 'Alditio Aulia', '0', '320301289246051@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4270, '320301553187013', 'cd44f3661c2b885c0c70ca8ea062e152', 'Marza Haq', '0', '320301553187013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4271, '320301613089010', 'e1bcb578f11fd743bb0535ecf73474aa', 'Rahardianto Asyrafi Randhika', '0', '320301613089010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4272, '320301162621047', '17d6e3c0c70f5ef717ba62065f740dcc', 'Berian Amalina', '0', '320301162621047@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4273, '320301156125054', 'd441e5330bf1f3ef2168b492eb0bba81', 'Mochammad Pratama Agustina', '0', '320301156125054@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4274, '320301683260057', 'cf7a132d90755a5ae881d65518726c7d', 'Rian Wiguna', '0', '320301683260057@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4275, '320301489941025', '996ae0bbadcf62630719f1e97d6a76f8', 'Revi Journalisanda', '0', '320301489941025@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4276, '320301501646031', '15e8651f4adec532c07cb38410e12d51', 'Fauzan Hidayati', '0', '320301501646031@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4277, '320301703468060', 'a85f07240ba6baf79677061dbadb82f3', 'Mark Amaliya', '0', '320301703468060@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4278, '320301798061059', 'fe3c66d94d368b9fc43c85cab8099fe0', 'Mustafid Alvianingrum', '0', '320301798061059@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4279, '320301725004034', 'd39963d570a15cf0a6af6aee4d524eec', 'Ilham Givan Nisa', '0', '320301725004034@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4280, '320301665672057', 'cf80d546fab7d929fcf6090622743262', 'Yosafat Himawan', '0', '320301665672057@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4281, '320301424269054', 'e64449bd92f3780d3fc67974ab6dbbd9', 'Edwin Setyawati', '0', '320301424269054@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4282, '320301168927032', '10633678a4fc4ea7d45219a7216d71da', 'Aldi Setiawan', '0', '320301168927032@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4283, '320301590411033', 'f033a78912a97ebbfd96a7671bca2538', 'Adisdi Veronica', '0', '320301590411033@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4284, '320301526912039', '1ca116b94397a72335240fd2fac28e9f', 'Mirza Fikri', '0', '320301526912039@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4285, '320301416875024', 'ba4245ac147f829a0e0a5ee4ee211f53', 'Yutama Usra', '0', '320301416875024@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4286, '320301766953013', '5a2330649fa8688377ebc352216a3cf9', 'Bony Ulfania', '0', '320301766953013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4287, '320301308914026', 'f40486358891ef03c8743d05827a534f', 'Satrya Revi Rustam', '0', '320301308914026@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4288, '320301688468040', 'dc47dea5333780cb03960ea74819ba94', 'Okky Nurkhasanah', '0', '320301688468040@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4289, '320301358132056', '320f6394ccd32a3ea8218c842d2ef428', 'Imam Alika', '0', '320301358132056@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4290, '320301146818010', '9b8cc620b5b56594e362cd17b63e8dd2', 'Fadhlir Mawaldi', '0', '320301146818010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4291, '320301439904018', 'e3f759c38271394baa95235244f610d8', 'Rangga Maulinda', '0', '320301439904018@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4292, '320301565028060', '52c5b14f1c0663376deddbe8908d558b', 'Fajar Mairessi', '0', '320301565028060@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4293, '320301126526012', 'ebb93e8ea2a3f734292d642da273cf33', 'Geraldi Nathania', '0', '320301126526012@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4294, '320301187180039', 'f6453ea8c03349afe45d24416834d28c', 'Akbar Machmud', '0', '320301187180039@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4295, '320301471155010', '1a9b73b1212fdc8ae0a6d4ce2ff853f1', 'Lukman Novitasari', '0', '320301471155010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4296, '320301435585010', 'b76238ae7ced600a0f9af14348bba656', 'Fahmi Sakinah', '0', '320301435585010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4297, '320301790305057', '172b8073b5363e69125e24385cfb3673', 'Surya Candraditya', '0', '320301790305057@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4298, '320301185573054', '942670bec35875205b1efb8e8b5fdf0a', 'Bintang Amelia', '0', '320301185573054@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4299, '320301718155046', '4fb29e87b946e40f29af184e8015cab6', 'Hizkia Derilandry Wibisono', '0', '320301718155046@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4300, '320301195124054', '4c410f44a0793ffa198a0b532fdeb8e2', 'Bryan Josh', '0', '320301195124054@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4301, '320301651514018', '067f9c43969b97885cb8ca58cdbfcbf7', 'Andhika Abidah', '0', '320301651514018@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4302, '320301303093037', '9ec18d0971c1211c6e9e42354a8fb90e', 'Ridhwan Larashaty', '0', '320301303093037@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4303, '320301295081047', '4a83d832a9b5b2843aa0693ea4c16497', 'Reynaldi Permatasari', '0', '320301295081047@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4304, '320301535873054', '0b592dcec3c28c6102df3079de1c6102', 'Beckley Anindya', '0', '320301535873054@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4305, '320301249051013', 'd4d3f2c70ce8d91e52ab8da84fd22496', 'Roy Christine', '0', '320301249051013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4306, '320301501468058', 'b19760088559c6a77a70695d7722158c', 'Yola Suputra', '0', '320301501468058@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4307, '320301377455027', '2c87bd264fe0a03aabf4732e0fa6c48b', 'Lintang Nuraini', '0', '320301377455027@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4308, '320301589745015', '00236eaf0feccef425eb8e92ea3badb4', 'Yoedhistiera Andriyanti', '0', '320301589745015@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4309, '320301136571049', 'ef028078ebac86905a466ae069a80a15', 'Dikposa Indriastari', '0', '320301136571049@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4310, '320301706700059', '92c15ef62edadb0ce9c9d242f7a923dc', 'Nauval Varensia', '0', '320301706700059@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4311, '320301217189050', '1757cda57156337738f3313debf5d8da', 'Revo Julianne', '0', '320301217189050@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4312, '320301258178042', '5357d411b46103fb8d0c35feccccd65c', 'Jamal Bahri', '0', '320301258178042@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4313, '320301619814013', 'de45037f1399402731c4dadfdcd2743e', 'Omar Herlin', '0', '320301619814013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4314, '320301347319058', '59dd55869eeac69455d7e7aa7f1042f7', 'Haris Agtrivia', '0', '320301347319058@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4315, '320301556826055', 'cab6b4e51ac30cabafc15d202dda17c5', 'Bintang Pratiko', '0', '320301556826055@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4316, '320301667131030', '9d95583c5302fea3c62df9da1a025aa1', 'Julian Adha', '0', '320301667131030@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4317, '320301743845038', 'd859ff4022d3c8543de347a0f0e8e290', 'Yola Kahfi', '0', '320301743845038@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4318, '320301578906026', '53a657064b729e6eaf21b57a29ca76b1', 'Farizi Sunanto', '0', '320301578906026@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4319, '320301221416018', 'a37d6628de457f1fe4ba94512651a65b', 'Bimo Nathania', '0', '320301221416018@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4320, '320301356976013', 'f01cf761ee283f4d43ff8aee0d79ad3e', 'Muhamad Omar Mubarak', '0', '320301356976013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4321, '320301597668043', 'f5aed3663d11943758a93c3f91092d92', 'Miftachul Sigit Hasudungan', '0', '320301597668043@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4322, '320301789533041', 'd1b12004e51a21903a345a41f532cd75', 'Rifqy Kusumawardhani', '0', '320301789533041@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4323, '320301264074051', 'b6d5711fffff91d0b106002d2b502595', 'Richard Reksa Larascaesara', '0', '320301264074051@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4324, '320301449630019', 'bb5d73fd9c05e6f837c388c6774aa6fc', 'Hizrian Sihombing', '0', '320301449630019@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4325, '320301174755031', '199f453b2b6ad2a8746477a7fff211f4', 'Aufa Saniyati', '0', '320301174755031@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4326, '320301178777036', 'ba1077d2617c3b826531bd820089f1ee', 'Fariz Aggil Nisrina', '0', '320301178777036@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4327, '320301304640010', '33066bc7f6c207ca79312077dab83cbf', 'Dede Triutami', '0', '320301304640010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4328, '320301218092057', '132cc5a46df245100c1cb9bb437d14a0', 'Eka Primastiny', '0', '320301218092057@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4329, '320301382749044', '276b734c4465e8de16fb2ced2ede85fa', 'Aggil Saputra', '0', '320301382749044@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4330, '320301137071036', '1fbbb2c1f246d3eb7335e33ceb6f0f01', 'Dwiki Suputra', '0', '320301137071036@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4331, '320301350823037', '2d589fbb811888526005bd6ceb665082', 'Reynard Pertiwi', '0', '320301350823037@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4332, '320301155639035', '515336af78e2f33cf9b3de3cdee8d51f', 'Mustofa Isnandri', '0', '320301155639035@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4333, '320301214573033', '6781178078a886ea328a26386c506818', 'Teddo Elvira', '0', '320301214573033@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4334, '320301223336056', 'e3849152126ff6b4244019b3a2bcf775', 'Rutwan Zain', '0', '320301223336056@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4335, '320301469469033', '2af96b5ca2a96af08f2dda335538252e', 'Alditio Ariefandi', '0', '320301469469033@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4336, '320301185581027', '5fac28a8cfebe839ededbebab363b8e8', 'Adam Alfin Oktavianty', '0', '320301185581027@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4337, '320301700007030', 'efd243b4888389ee81b76f48c13a0971', 'Banni Sapitri', '0', '320301700007030@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:41:51', '0', '2022-08-04 20:41:51', '0'),
(4338, '320301687960019', '3225cd588a8e72d909497ea658b846c7', 'Ogie Noverlia', '0', '320301687960019@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4339, '320301284131052', '678dcf16442c44791827b266afdfc191', 'Chandra Geryance', '0', '320301284131052@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4340, '320301707005013', '1b2e5515257e02dd05226d165b1c2830', 'Praditia Farizi', '0', '320301707005013@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4341, '320301209811027', 'b18781bc1bc9a909ac5c4cacf1e499ce', 'Aprian Haddad', '0', '320301209811027@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4342, '320301513689050', '9c028089bc2f96275e1f6e93476e83aa', 'Gilang Ertasari', '0', '320301513689050@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4343, '320301295130058', '309f277439b73f1ed812acbf00826644', 'Syarief Tanuwijaya', '0', '320301295130058@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4344, '320301673276019', '942a52c0038aae3b6e1d0c20be45af24', 'Ferdiansyah Rahmawati', '0', '320301673276019@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4345, '320301441119018', 'e6f37e493b3a1624ff497640461c2059', 'Bob Falah', '0', '320301441119018@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4346, '320301394315060', '371c3116bc85d2619e9c0645347e8f6b', 'Azrul Wagey', '0', '320301394315060@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4347, '320301383620028', '8d31db4afa1aba433aa704670d8222f0', 'Pandu Maharani', '0', '320301383620028@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4348, '320301736399022', '43240c0746eb09fb1f0c07c90ecaa119', 'Rinaldy Amami', '0', '320301736399022@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4349, '320301572434042', 'fd33c38855c7fa63cf35b097ae00196e', 'Ario Azrul Hardianti', '0', '320301572434042@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4350, '320301366057046', 'd7710e35924f7c54db0c10e775a86de9', 'Rezky Rais', '0', '320301366057046@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4351, '320301489919026', '110bcc9ebf4675d9133844a6fcce6ded', 'Naufal Juliyanti', '0', '320301489919026@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4352, '320301659721048', '30ad742153b48830427830900528d567', 'Rio Qodir', '0', '320301659721048@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4353, '320301774583045', '19752935442674bca499ef02a40724c7', 'Mario Keviati', '0', '320301774583045@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4354, '320301268541038', 'd5c601fbcc8fe6f7a8c1688967125e53', 'Ariyadi Shabrina', '0', '320301268541038@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4355, '320301135583017', 'ab74fa41b71767e351bb1acce6891830', 'Ryan Setyawati', '0', '320301135583017@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4356, '320301755595050', '7df11fe9743e956b6b20ea3f1dd326ee', 'Arfan Jhon Wijaya', '0', '320301755595050@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4357, '320301448007010', '937f54b9303fc4ecf76e673bb70fb01c', 'Geraldi Sumlang', '0', '320301448007010@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4358, '320301652359057', '88b0273965fb8b68ba434fcd1e13e62b', 'Yosafat Febriani', '0', '320301652359057@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4359, '320301199487035', '2a444fe0e0ffbcece70596866e9389ad', 'Adityo Carolina', '0', '320301199487035@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4360, '320301437567024', 'daaa54d5cc23b10767453c897fbd1acd', 'Dee Satrio', '0', '320301437567024@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4361, '320301462478025', '65cd21e2a5ac29d410fffd2403411715', 'Jhon Devi', '0', '320301462478025@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4362, '320301218671060', 'a9ad7e75940ae7dc455c2ebe0ce91745', 'Pratama Hakim', '0', '320301218671060@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4363, '320301691497052', '31588543301c05b5757894dccb8ca5e5', 'Aldi Nurdiansyah', '0', '320301691497052@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4364, '320301116675047', 'e386518d64267ee49678555a59e3382b', 'Sutrisno Pringganti', '0', '320301116675047@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4365, '320301454632039', '54b0e4984a6efe423faef3aed9e66603', 'Cakra Sakinah', '0', '320301454632039@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0'),
(4366, '320301593468015', 'de0bc6a041f3a5d893d9b9bbfb32d009', 'Rutwan Ihatrayudha', '0', '320301593468015@email.com', ' ', 1, 'user', 'Y', '2022-08-04 20:42:03', '0', '2022-08-04 20:42:03', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
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
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4367;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
