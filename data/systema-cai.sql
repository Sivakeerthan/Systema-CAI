-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Dez 2018 um 09:31
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 7.2.11

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

--
-- Daten für Tabelle `absent`
--

INSERT INTO `absent` (`absId`, `student_id`, `date_start`, `date_end`) VALUES
(1, 1, '2018-12-13', '2018-12-13'),
(2, 1, '2018-12-11', '2018-12-11'),
(7, 1, '2018-12-04', '2018-12-04'),
(8, 1, '2018-12-07', '2018-12-07'),
(9, 1, '2018-12-13', '2018-12-13'),
(10, 1, '2018-12-14', '2018-12-14'),
(11, 1, '2018-12-14', '2018-12-14'),
(12, 1, '2018-12-14', '2018-12-14'),
(13, 1, '2018-12-14', '2018-12-14'),
(14, 1, '2018-12-14', '2018-12-14'),
(15, 1, '2018-12-14', '2018-12-14'),
(16, 1, '2018-12-14', '2018-12-14'),
(17, 1, '2018-12-17', '2018-12-17');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `class`
--

CREATE TABLE `class` (
  `classId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `timetable_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `class`
--

INSERT INTO `class` (`classId`, `name`, `timetable_id`) VALUES
(1, 'IM16a', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `day`
--

CREATE TABLE `day` (
  `dayId` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `lessons_1ht` int(11) NOT NULL,
  `lessons_2ht` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `day`
--

INSERT INTO `day` (`dayId`, `name`, `lessons_1ht`, `lessons_2ht`) VALUES
(1, 'Montag', 4, 2),
(2, 'Dienstag', 5, 4),
(3, 'Mittwoch', 4, 0),
(4, 'Donnerstag', 0, 0),
(5, 'Freitag', 5, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `day_teacher`
--

CREATE TABLE `day_teacher` (
  `day_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `day_teacher`
--

INSERT INTO `day_teacher` (`day_id`, `teacher_id`) VALUES
(1, 7),
(1, 9),
(1, 10),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 9),
(2, 11),
(3, 4),
(3, 5),
(5, 4),
(5, 5),
(5, 6),
(5, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dispensation`
--

CREATE TABLE `dispensation` (
  `dispId` int(11) NOT NULL,
  `request` varchar(200) NOT NULL,
  `documenturl` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `dispensation`
--

INSERT INTO `dispensation` (`dispId`, `request`, `documenturl`) VALUES
(1, 'Sehr geehrter Herr Nufer, Ich werde an diesem Tag einen Bewerbungsgespräch haben. Deswegen, kann ich nicht am Unterricht teilnehmen.', './uploads/files/disp/lorem-ipsum.pdf'),
(2, 'Bewerbungsgespräch', '/uploads/files/disp/1/lorem-ipsum.pdf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE `event` (
  `evId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `isKK` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `event`
--

INSERT INTO `event` (`evId`, `date`, `isKK`, `name`) VALUES
(1, '2018-10-25 00:00:00', 1, 'TestKK'),
(2, '2018-10-30 00:00:00', 0, 'Spooky'),
(3, '2018-11-02 00:00:00', 0, 'Test2'),
(4, '2018-11-02 00:00:00', 0, 'Test3'),
(5, '2018-12-12 00:00:00', 1, 'Test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lesson`
--

CREATE TABLE `lesson` (
  `lesId` int(11) NOT NULL,
  `abs_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `isKontingent` tinyint(1) NOT NULL DEFAULT '0',
  `isDispensation` tinyint(1) NOT NULL DEFAULT '0',
  `isExcused` tinyint(1) DEFAULT '0',
  `isUnexcused` tinyint(1) DEFAULT '0',
  `isAccepted` tinyint(1) DEFAULT '0',
  `disp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lesson`
--

INSERT INTO `lesson` (`lesId`, `abs_id`, `teacher_id`, `isKontingent`, `isDispensation`, `isExcused`, `isUnexcused`, `isAccepted`, `disp_id`) VALUES
(1, 2, NULL, 1, 0, 1, 0, 1, NULL),
(2, 2, NULL, 1, 0, 1, 0, 1, NULL),
(3, 2, NULL, 1, 0, 1, 0, 1, NULL),
(4, 2, NULL, 1, 0, 1, 0, 1, NULL),
(5, 2, NULL, 1, 0, 1, 0, 1, NULL),
(6, 2, NULL, 1, 0, 1, 0, 1, NULL),
(7, 2, NULL, 1, 0, 1, 0, 1, NULL),
(8, 2, NULL, 1, 0, 1, 0, 1, NULL),
(9, 2, NULL, 1, 0, 1, 0, 1, NULL),
(10, 2, NULL, 1, 0, 1, 0, 1, NULL),
(11, 7, NULL, 0, 0, 0, 1, 0, NULL),
(12, 7, NULL, 0, 0, 0, 1, 0, NULL),
(13, 8, NULL, 0, 1, 1, 0, 1, 2),
(14, 8, NULL, 0, 1, 1, 0, 1, 2),
(15, 8, NULL, 0, 1, 1, 0, 1, 2),
(16, 8, NULL, 0, 1, 1, 0, 1, 2),
(17, 8, NULL, 0, 1, 1, 0, 1, 2),
(18, 9, NULL, 0, 0, 0, 1, 0, NULL),
(19, 9, NULL, 0, 0, 0, 1, 0, NULL),
(20, 10, NULL, 0, 0, 0, 0, 0, NULL),
(21, 10, NULL, 0, 0, 0, 0, 0, NULL),
(22, 11, NULL, 1, 0, 0, 0, 0, NULL),
(23, 11, NULL, 1, 0, 0, 0, 0, NULL),
(24, 12, NULL, 1, 0, 0, 0, 0, NULL),
(25, 12, NULL, 1, 0, 0, 0, 0, NULL),
(26, 13, NULL, 1, 0, 0, 0, 0, NULL),
(27, 13, NULL, 1, 0, 0, 0, 0, NULL),
(28, 14, NULL, 1, 0, 0, 0, 0, NULL),
(29, 14, NULL, 1, 0, 0, 0, 0, NULL),
(30, 15, NULL, 0, 0, 0, 0, 0, NULL),
(31, 15, NULL, 0, 0, 0, 0, 0, NULL),
(32, 16, NULL, 1, 0, 0, 0, 0, NULL),
(33, 16, NULL, 1, 0, 0, 0, 0, NULL),
(34, 17, NULL, 1, 0, 0, 0, 0, NULL),
(35, 17, NULL, 1, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetable`
--

CREATE TABLE `timetable` (
  `timetableId` int(11) NOT NULL,
  `year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `timetable`
--

INSERT INTO `timetable` (`timetableId`, `year`) VALUES
(1, '2018/2019');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetable_day`
--

CREATE TABLE `timetable_day` (
  `timetable_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `timetable_day`
--

INSERT INTO `timetable_day` (`timetable_id`, `day_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

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
  `kontingent` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uId`, `firstname`, `lastname`, `username`, `password`, `isStudent`, `isTeacher`, `isPrincipal`, `isSecretary`, `isAdmin`, `kontingent`, `class_id`) VALUES
(1, 'Sivakeerthan', 'Vamanarajasekaran', 'SVRNM', '$2y$10$Uc8v.aZ87anXGs37HmQjSuGvJBcMYQ3.5YfQq7mpUggVgBowRhZce', 1, 0, 0, 0, 1, 14, 1),
(2, 'Jerico Luis', 'Lua', 'jericoluislua', '$2y$10$Z0dCCOUu7UWC4g7SR2gHwuZP8u0G3gEwJqeXr6utYV102qPRoG1ju', 1, 0, 0, 0, 1, NULL, NULL),
(3, 'Teacher', 'Test', 'teacher1', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(4, 'Véronique', 'Fahrni', 'vfahrni', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(5, 'Doris', 'Graber', 'dgraber', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(6, 'Hermann', 'Michel', 'hmichel', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(7, 'Lena', 'Niklaus', 'lniklaus', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(8, 'Tim', 'Overmann', 'tovermann', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(9, 'Pia', 'Schaffner', 'pschaffner', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(10, 'Ingrid', 'Schwab', 'ischwab', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(11, 'Irene', 'Staub', 'istaub', '$2y$10$EXIzCtoZnNeEY0I.0NedsO0v/uto5xP109LPcJkLW80dxxRXmbbIC', 0, 1, 0, 0, 0, NULL, NULL),
(12, 'Raymond', 'Anliker', 'ranliker', '$2y$10$6iwril/Ckl9ovdONU9i4Ve9dot2UvIFSO.ee5YZ6I0xeyQ1vo4U/O', 0, 0, 1, 0, 0, NULL, NULL),
(13, 'Roland', 'Dardel', 'rdardel', '$2y$10$f2DNJTSHx2XF3lYCtDhF4.NORFM0qm//5Z8ciamIEbaIUOsAy5W2a', 0, 0, 1, 0, 0, NULL, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `absent`
--
ALTER TABLE `absent`
  ADD PRIMARY KEY (`absId`),
  ADD KEY `fk_absent_student` (`student_id`);

--
-- Indizes für die Tabelle `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classId`),
  ADD KEY `fk_class_timetable` (`timetable_id`);

--
-- Indizes für die Tabelle `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`dayId`);

--
-- Indizes für die Tabelle `day_teacher`
--
ALTER TABLE `day_teacher`
  ADD PRIMARY KEY (`day_id`,`teacher_id`),
  ADD KEY `fk_day_teacher_teacher` (`teacher_id`);

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
  ADD PRIMARY KEY (`lesId`),
  ADD KEY `fk_lesson_absent` (`abs_id`),
  ADD KEY `fk_lesson_teacher` (`teacher_id`),
  ADD KEY `fk_lesson_dispensation` (`disp_id`);

--
-- Indizes für die Tabelle `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetableId`);

--
-- Indizes für die Tabelle `timetable_day`
--
ALTER TABLE `timetable_day`
  ADD PRIMARY KEY (`timetable_id`,`day_id`),
  ADD KEY `fk_timetable_day_day` (`day_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uId`),
  ADD KEY `fk_user_class` (`class_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `absent`
--
ALTER TABLE `absent`
  MODIFY `absId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `class`
--
ALTER TABLE `class`
  MODIFY `classId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `day`
--
ALTER TABLE `day`
  MODIFY `dayId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `dispensation`
--
ALTER TABLE `dispensation`
  MODIFY `dispId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
  MODIFY `evId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetableId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `absent`
--
ALTER TABLE `absent`
  ADD CONSTRAINT `fk_absent_student` FOREIGN KEY (`student_id`) REFERENCES `user` (`uId`);

--
-- Constraints der Tabelle `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `fk_class_timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`timetableId`);

--
-- Constraints der Tabelle `day_teacher`
--
ALTER TABLE `day_teacher`
  ADD CONSTRAINT `fk_day_teacher_day` FOREIGN KEY (`day_id`) REFERENCES `day` (`dayId`),
  ADD CONSTRAINT `fk_day_teacher_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`uId`);

--
-- Constraints der Tabelle `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `fk_lesson_absent` FOREIGN KEY (`abs_id`) REFERENCES `absent` (`absId`),
  ADD CONSTRAINT `fk_lesson_dispensation` FOREIGN KEY (`disp_id`) REFERENCES `dispensation` (`dispId`),
  ADD CONSTRAINT `fk_lesson_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`uId`);

--
-- Constraints der Tabelle `timetable_day`
--
ALTER TABLE `timetable_day`
  ADD CONSTRAINT `fk_timetable_day_day` FOREIGN KEY (`day_id`) REFERENCES `day` (`dayId`),
  ADD CONSTRAINT `fk_timetable_day_timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`timetableId`);

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`classId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
