-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Okt 2018 um 08:19
-- Server-Version: 10.1.34-MariaDB
-- PHP-Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `systema-cai`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `absent`
--

CREATE TABLE `absent` (
  `absId` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dispensation`
--

CREATE TABLE `dispensation` (
  `dispId` int(11) NOT NULL,
  `request` varchar(100) NOT NULL,
  `documenturl` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE `event` (
  `evId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `isKK` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lesson`
--

CREATE TABLE `lesson` (
  `lesId` int(11) NOT NULL,
  `abs_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `isKontingent` tinyint(1) NOT NULL,
  `isDispensation` tinyint(1) NOT NULL,
  `isExcused` tinyint(1) NOT NULL,
  `isUnexcused` tinyint(1) NOT NULL,
  `accepted_by` int(11) DEFAULT NULL,
  `subj_id` int(11) NOT NULL,
  `disp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subject`
--

CREATE TABLE `subject` (
  `subjId` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `subject`
--

INSERT INTO `subject` (`subjId`, `name`) VALUES
(1, 'Englisch'),
(2, 'Französisch'),
(3, 'Deutsch'),
(4, 'Spanisch'),
(5, 'Italienisch'),
(6, 'Mathematik'),
(7, 'Finanz- und Rechnungswesen'),
(8, 'Wirtschaft und Recht'),
(9, 'Technik und Umwelt'),
(10, 'Geschichte'),
(11, 'Sport'),
(12, 'IKA'),
(13, 'Bildnerisches Gestalten'),
(14, 'Bewerbung'),
(15, 'IDPA'),
(16, 'Sonstige');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `uId` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isStudent` tinyint(1) NOT NULL,
  `isTeacher` tinyint(1) NOT NULL,
  `isPrincipal` tinyint(1) NOT NULL,
  `isSecretary` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `kontingent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uId`, `firstname`, `lastname`, `username`, `password`, `isStudent`, `isTeacher`, `isPrincipal`, `isSecretary`, `isAdmin`, `kontingent`) VALUES
(1, 'Sivakeerthan', 'Vamanarajasekaran', 'SVRNM', '$2y$10$Uc8v.aZ87anXGs37HmQjSuGvJBcMYQ3.5YfQq7mpUggVgBowRhZce', 1, 0, 0, 0, 1, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `absent`
--
ALTER TABLE `absent`
  ADD PRIMARY KEY (`absId`);

--
-- Indizes für die Tabelle `dispensation`
--
ALTER TABLE `dispensation`
  ADD PRIMARY KEY (`dispId`);

--
-- Indizes für die Tabelle `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`evId`);

--
-- Indizes für die Tabelle `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesId`);

--
-- Indizes für die Tabelle `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `absent`
--
ALTER TABLE `absent`
  MODIFY `absId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `dispensation`
--
ALTER TABLE `dispensation`
  MODIFY `dispId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
  MODIFY `evId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `subject`
--
ALTER TABLE `subject`
  MODIFY `subjId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
