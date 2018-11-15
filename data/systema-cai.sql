-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Nov 2018 um 11:32
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `class`
--

CREATE TABLE `class` (
  `classId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `timetable_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `day_teacher`
--

CREATE TABLE `day_teacher` (
  `day_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dispensation`
--

CREATE TABLE `dispensation` (
  `dispId` int(11) NOT NULL,
  `request` varchar(200) NOT NULL,
  `documenturl` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(4, '2018-11-02 00:00:00', 0, 'Test3');

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
  `isAccepted` tinyint(1) DEFAULT NULL,
  `disp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetable`
--

CREATE TABLE `timetable` (
  `timetableId` int(11) NOT NULL,
  `year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetable_day`
--

CREATE TABLE `timetable_day` (
  `timetable_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Sivakeerthan', 'Vamanarajasekaran', 'SVRNM', '$2y$10$Uc8v.aZ87anXGs37HmQjSuGvJBcMYQ3.5YfQq7mpUggVgBowRhZce', 1, 0, 0, 0, 1, NULL, NULL),
(2, 'Jerico Luis', 'Lua', 'jericoluislua', '$2y$10$Z0dCCOUu7UWC4g7SR2gHwuZP8u0G3gEwJqeXr6utYV102qPRoG1ju', 1, 0, 0, 0, 1, NULL, NULL);

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
  MODIFY `absId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `class`
--
ALTER TABLE `class`
  MODIFY `classId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `day`
--
ALTER TABLE `day`
  MODIFY `dayId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `dispensation`
--
ALTER TABLE `dispensation`
  MODIFY `dispId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
  MODIFY `evId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetableId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fk_class_timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`timetableid`);

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
  ADD CONSTRAINT `fk_timetable_day_timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`timetableid`);

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`classId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
