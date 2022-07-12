-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2022 at 12:51 PM
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
  `bb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `nik`, `nama`, `tb`, `bb`) VALUES
(1, '320301717325023', 'Singgih Falah', '65', '7'),
(2, '320301654067027', 'Thomas Wiguna', '65', '7'),
(3, '320301131158031', 'Mario Arifah', '66', '7'),
(4, '320301249856029', 'Dhanu Triashafira', '66', '7'),
(5, '320301288720041', 'Bob Fathir', '67', '7'),
(6, '320301187950042', 'Anas Aristy', '67', '7'),
(7, '320301477562010', 'Andrie Farizi Husnah', '68', '7'),
(8, '320301774280025', 'Rio Naenggolan', '68', '8'),
(9, '320301500498044', 'Hudzaifah Ihsanuddin', '69', '8'),
(10, '320301423627048', 'Zulfi Willyanda', '69', '8'),
(11, '320301170511012', 'Bimo Givan Oktavianty', '70', '8'),
(12, '320301202317035', 'Mustafid Paramadina', '70', '8'),
(13, '320301178685038', 'Hilman Ariani', '71', '8'),
(14, '320301416135025', 'Bony Jordan', '71', '8'),
(15, '320301327628015', 'Aldi Syaibatul Suandhini', '72', '8'),
(16, '320301585953029', 'Hizkia Fadhillah', '72', '8'),
(17, '320301280329017', 'Ressy Rachma', '73', '8'),
(18, '320301531579051', 'Banni Febrianto', '73', '9'),
(19, '320301627580059', 'Wildan Giarini', '74', '9'),
(20, '320301440966060', 'Alrendy Listisni', '74', '9'),
(21, '320301332488012', 'Aburachman Hosea', '75', '9'),
(22, '320301221933056', 'Edwin Reksa Priyanto', '75', '9'),
(23, '320301694773013', 'Revi Hilman Septiani', '76', '9'),
(24, '320301402415060', 'Tubagus Yutama Diva', '76', '9'),
(25, '320301472995037', 'Geraldi Praditia Sinuka', '77', '9'),
(26, '320301495865040', 'Doni Anwar', '77', '9'),
(27, '320301654884044', 'Adisdi Irlan Siahainenia', '78', '9'),
(28, '320301563913036', 'Aulia Tio', '78', '9'),
(29, '320301127531052', 'Gilang Wirawan', '79', '10'),
(30, '320301278564051', 'Firas Widyawati', '79', '10'),
(31, '320301160064020', 'TaufikÂ DanialÂ Imam', '80', '10'),
(32, '320301792266022', 'IndahÂ NurulÂ Buana', '80', '10'),
(33, '320301480892015', 'RajaÂ AkhmadÂ Wangi', '81', '10'),
(34, '320301259164038', 'Dewi Astuti', '81', '10'),
(35, '320301548723014', 'Syaibatul Parhorasan', '82', '10'),
(36, '320301372019025', 'Yosua Maulina', '82', '10'),
(37, '320301255521041', 'Vito Rozi', '83', '10'),
(38, '320301289469033', 'Richard Arie Prihatiwi', '83', '11'),
(39, '320301455294053', 'Hudzaifah Loren', '84', '11'),
(40, '320301723952022', 'Rio Ridanty', '84', '11'),
(41, '320301181232015', 'Yudha Aswin Ciptasari', '85', '11'),
(42, '320301289246051', 'Alditio Aulia', '85', '11'),
(43, '320301553187013', 'Marza Haq', '86', '11'),
(44, '320301613089010', 'Rahardianto Asyrafi Randhika', '86', '11'),
(45, '320301162621047', 'Berian Amalina', '87', '11'),
(46, '320301156125054', 'Mochammad Pratama Agustina', '87', '12'),
(47, '320301683260057', 'Rian Wiguna', '88', '12'),
(48, '320301489941025', 'Revi Journalisanda', '88', '12'),
(49, '320301501646031', 'Fauzan Hidayati', '89', '12'),
(50, '320301703468060', 'Mark Amaliya', '89', '12'),
(51, '320301798061059', 'Mustafid Alvianingrum', '90', '12'),
(52, '320301725004034', 'Ilham Givan Nisa', '90', '12'),
(53, '320301665672057', 'Yosafat Himawan', '91', '12'),
(54, '320301424269054', 'Edwin Setyawati', '91', '13'),
(55, '320301168927032', 'Aldi Setiawan', '92', '13'),
(56, '320301590411033', 'Adisdi Veronica', '92', '13'),
(57, '320301526912039', 'Mirza Fikri', '93', '13'),
(58, '320301416875024', 'Yutama Usra', '93', '13'),
(59, '320301766953013', 'Bony Ulfania', '94', '13'),
(60, '320301308914026', 'Satrya Revi Rustam', '94', '13'),
(61, '320301688468040', 'Okky Nurkhasanah', '95', '13'),
(62, '320301358132056', 'Imam Alika', '95', '14'),
(63, '320301146818010', 'Fadhlir Mawaldi', '96', '14'),
(64, '320301439904018', 'Rangga Maulinda', '96', '14'),
(65, '320301565028060', 'Fajar Mairessi', '97', '14'),
(66, '320301126526012', 'Geraldi Nathania', '97', '14'),
(67, '320301187180039', 'Akbar Machmud', '98', '14'),
(68, '320301471155010', 'Lukman Novitasari', '98', '14'),
(69, '320301435585010', 'Fahmi Sakinah', '99', '14'),
(70, '320301790305057', 'Surya Candraditya', '99', '15'),
(71, '320301185573054', 'Bintang Amelia', '100', '15'),
(72, '320301718155046', 'Hizkia Derilandry Wibisono', '100', '15'),
(73, '320301195124054', 'Bryan Josh', '101', '15'),
(74, '320301651514018', 'Andhika Abidah', '101', '15'),
(75, '320301303093037', 'Ridhwan Larashaty', '102', '15'),
(76, '320301295081047', 'Reynaldi Permatasari', '102', '16'),
(77, '320301535873054', 'Beckley Anindya', '103', '16'),
(78, '320301249051013', 'Roy Christine', '103', '16'),
(79, '320301501468058', 'Yola Suputra', '104', '16'),
(80, '320301377455027', 'Lintang Nuraini', '104', '16'),
(81, '320301589745015', 'Yoedhistiera Andriyanti', '105', '16'),
(82, '320301136571049', 'Dikposa Indriastari', '105', '16'),
(83, '320301706700059', 'Nauval Varensia', '106', '17'),
(84, '320301217189050', 'Revo Julianne', '106', '17'),
(85, '320301258178042', 'Jamal Bahri', '107', '17'),
(86, '320301619814013', 'Omar Herlin', '107', '17'),
(87, '320301347319058', 'Haris Agtrivia', '108', '17'),
(88, '320301556826055', 'Bintang Pratiko', '108', '18'),
(89, '320301667131030', 'Julian Adha', '109', '18'),
(90, '320301743845038', 'Yola Kahfi', '109', '18'),
(91, '320301578906026', 'Farizi Sunanto', '110', '18'),
(92, '320301221416018', 'Bimo Nathania', '110', '18'),
(93, '320301356976013', 'Muhamad Omar Mubarak', '111', '19'),
(94, '320301597668043', 'Miftachul Sigit Hasudungan', '111', '19'),
(95, '320301789533041', 'Rifqy Kusumawardhani', '112', '19'),
(96, '320301264074051', 'Richard Reksa Larascaesara', '112', '19'),
(97, '320301449630019', 'Hizrian Sihombing', '113', '19'),
(98, '320301174755031', 'Aufa Saniyati', '113', '20'),
(99, '320301178777036', 'Fariz Aggil Nisrina', '114', '20'),
(100, '320301304640010', 'Dede Triutami', '114', '20'),
(101, '320301218092057', 'Eka Primastiny', '115', '20'),
(102, '320301382749044', 'Aggil Saputra', '115', '20'),
(103, '320301137071036', 'Dwiki Suputra', '116', '21'),
(104, '320301350823037', 'Reynard Pertiwi', '116', '21'),
(105, '320301155639035', 'Mustofa Isnandri', '117', '21'),
(106, '320301214573033', 'Teddo Elvira', '117', '21'),
(107, '320301223336056', 'Rutwan Zain', '118', '22'),
(108, '320301469469033', 'Alditio Ariefandi', '118', '22'),
(109, '320301185581027', 'Adam Alfin Oktavianty', '119', '22'),
(110, '320301700007030', 'Banni Sapitri', '119', '22'),
(111, '320301687960019', 'Ogie Noverlia', '120', '22'),
(112, '320301284131052', 'Chandra Geryance', '124', '84'),
(113, '320301707005013', 'Praditia Farizi', '124', '78'),
(114, '320301209811027', 'Aprian Haddad', '129', '86'),
(115, '320301513689050', 'Gilang Ertasari', '107', '67'),
(116, '320301295130058', 'Syarief Tanuwijaya', '86', '41'),
(117, '320301673276019', 'Ferdiansyah Rahmawati', '122', '82'),
(118, '320301441119018', 'Bob Falah', '127', '80'),
(119, '320301394315060', 'Azrul Wagey', '84', '35'),
(120, '320301383620028', 'Pandu Maharani', '108', '67'),
(121, '320301736399022', 'Rinaldy Amami', '104', '55'),
(122, '320301572434042', 'Ario Azrul Hardianti', '80', '40'),
(123, '320301366057046', 'Rezky Rais', '122', '80'),
(124, '320301489919026', 'Naufal Juliyanti', '112', '66'),
(125, '320301659721048', 'Rio Qodir', '130', '86'),
(126, '320301774583045', 'Mario Keviati', '87', '40'),
(127, '320301268541038', 'Ariyadi Shabrina', '102', '58'),
(128, '320301135583017', 'Ryan Setyawati', '89', '44'),
(129, '320301755595050', 'Arfan Jhon Wijaya', '95', '52'),
(130, '320301448007010', 'Geraldi Sumlang', '103', '60'),
(131, '320301652359057', 'Yosafat Febriani', '102', '53'),
(132, '320301199487035', 'Adityo Carolina', '126', '77'),
(133, '320301437567024', 'Dee Satrio', '83', '36'),
(134, '320301462478025', 'Jhon Devi', '114', '65'),
(135, '320301218671060', 'Pratama Hakim', '106', '63'),
(136, '320301691497052', 'Aldi Nurdiansyah', '113', '72'),
(137, '320301116675047', 'Sutrisno Pringganti', '104', '58'),
(138, '320301454632039', 'Cakra Sakinah', '93', '50'),
(139, '320301593468015', 'Rutwan Ihatrayudha', '126', '85');

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
  `info` text NOT NULL,
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

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `no_telp`, `email`, `alamat`, `info`, `is_first`, `level`, `aktif`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '1234', 'admin@futsal.com', '', '', 0, 'admin', 'Y', '2022-04-12 14:43:44', '', '2022-05-29 11:29:16', ''),
(2, 'jamal', '74f56399c89f4bd03ff5e85b6bf4e85f', 'Jamal Bahri', '082991829811', 'jamal@mailinator.com', 'Bojong Gede', '', 0, 'user', 'Y', '2022-04-12 22:38:05', '', '2022-05-29 12:49:18', ''),
(15, 'Siti Maspupah', '0e8682ef8b049f63e2f16845bdd4f7a9', 'Siti Maspupah', '087824529024', 'Sitimaspupah112@gmail.com', 'Jl Nusa Indah VI Gg 3 No 113', '', 0, 'user', 'Y', '2022-06-17 15:24:45', '0', '2022-06-20 12:29:17', '15'),
(16, 'pupah', '4d85cb59b864e12bee7b4b05f1722e57', 'Siti Maspupah', '12342', 'siti.maspupah@gmail.com', 'Cibaregbeg', '{\"bb\":\"42\",\"tb\":\"159\"}', 0, 'user', 'Y', '2022-06-17 18:02:03', '0', '2022-06-18 20:09:01', '0'),
(17, 'Aal', '152513003826867c2ea1fb014d6a956f', 'Allailatul Magfiroh', '081285191686', 'magfirohlailatul146@gmail.com', 'Jl. H. Nuar Rt 008/06', '{\"bb\":\"62\",\"tb\":\"164\"}', 0, 'user', 'Y', '2022-06-20 12:51:18', '0', '2022-06-20 12:52:58', '0'),
(18, 'singgihfalah', '19ec9a45d485c7c2913691e4cfed0660', 'Singgih Falah', '087785662512', 'singgih@gmail.com', 'Cianjur', '{\"bb\":\"113\",\"tb\":\"156\"}', 0, 'user', 'Y', '2022-06-28 20:38:12', '0', '2022-06-28 20:38:56', '0'),
(19, 'thomaswiguna', 'afdba18496f0aa3a344c9dac4ff6b06a', 'Thomas Wiguna', '081235126523', 'Thomas@gmail.com', 'Bandung', '{\"bb\":\"131\",\"tb\":\"176\"}', 0, 'user', 'Y', '2022-06-28 20:41:05', '0', '2022-06-28 20:42:50', '0'),
(20, 'marioarifah', '25d55ad283aa400af464c76d713c07ad', 'Mario Arifah', '087714253625', 'mario@gmail.com', 'Sumedang', '{\"bb\":\"92\",\"tb\":\"140\"}', 0, 'user', 'Y', '2022-06-28 20:44:35', '0', '2022-06-28 20:57:15', '0'),
(21, 'dhanutriashafira', '25d55ad283aa400af464c76d713c07ad', 'Dhanu Triashafira', '087714693256', 'dhanu@gmail.com', 'Cianjur', '{\"bb\":\"100\",\"tb\":\"146\"}', 0, 'user', 'Y', '2022-06-28 20:49:35', '0', '2022-06-28 20:54:23', '0'),
(23, 'ariqalkadri', 'b2419a6a09c9139b9afb3fbd31d2f732', 'Ariqalqodri', '089528526545', 'alqodrariq@gmail.com', 'Pesona Anggrek Blok A 17 no 18', '{\"bb\":\"94\",\"tb\":\"170\"}', 0, 'user', 'Y', '2022-06-28 21:01:30', '0', '2022-06-28 21:02:18', '0'),
(24, 'Angga0704', 'f45691a6642d0dde63c0de17090b4334', 'Angga', '089610226817', 'muhammadangga0704@gmail.com', 'Kp. Poncol Jaya RT.04 / RW.019 ', '{\"bb\":\"53\",\"tb\":\"170\"}', 1, 'user', 'Y', '2022-06-29 21:01:58', '0', '2022-06-29 21:01:58', '0'),
(25, 'wmutiara', '810247419084c82d03809fc886fedaad', 'Mutiara Wulandari', '081315920855', 'wmutiara549@gmail.com', 'Jl. Wijaya Kusuma 2', '{\"bb\":\"80\",\"tb\":\"170\"}', 0, 'user', 'Y', '2022-06-29 21:04:16', '0', '2022-06-29 21:05:11', '0'),
(26, 'Angga70', 'fe5d836232b344116307c703909cfeb0', 'Angga', '089467548466', 'anggasyamsul710@gmail.com', 'Kp. Poncol Jaya RT.04 / RW.019 ', '{\"bb\":\"53\",\"tb\":\"170\"}', 0, 'user', 'Y', '2022-07-04 14:28:54', '0', '2022-07-04 14:29:41', '0'),
(27, '320301717325023', 'beeb6ec294f3429f2f50e3d73283745f', '320301717325023', 'wodowiejrjworwo', '320301717325023@email.com', 'KP.poncasdasoijdaiodjadjjiji', '{\"bb\":\"50\",\"tb\":\"170\"}', 0, 'user', 'Y', '2022-07-11 20:09:13', '0', '2022-07-11 20:10:52', '0'),
(28, '320301131158031', 'c154d60c1b8fd509d23543f0043bcf26', '320301131158031', '980348204090', '320301131158031@email.com', 'akldjkasjkdajj', '{\"bb\":\"50\",\"tb\":\"100\"}', 1, 'user', 'Y', '2022-07-11 20:20:18', '0', '2022-07-11 20:20:18', '0');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
