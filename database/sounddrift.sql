-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Gen 03, 2024 alle 15:41
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sounddrift`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

CREATE TABLE `album` (
  `Email` char(50) NOT NULL,
  `Data` date NOT NULL,
  `Immagine` char(50) DEFAULT NULL,
  `Titolo` char(50) NOT NULL,
  `Genere` char(50) NOT NULL,
  `Durata` decimal(50,0) NOT NULL,
  `NumCanzoni` decimal(50,0) NOT NULL,
  `Con_Email` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `canzone`
--

CREATE TABLE `canzone` (
  `Email` char(50) NOT NULL,
  `Data` date NOT NULL,
  `Immagine` char(50) DEFAULT NULL,
  `Titolo` char(50) NOT NULL,
  `Genere` char(50) NOT NULL,
  `Durata` decimal(50,0) NOT NULL,
  `Int_Email` char(50) NOT NULL,
  `Int_Titolo` char(50) NOT NULL,
  `Ins_Email` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `coda`
--

CREATE TABLE `coda` (
  `Email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `EmailScrittore` char(50) NOT NULL,
  `Descrizione` char(200) NOT NULL,
  `Ha__Email_Testuale` char(50) NOT NULL,
  `Ha__Email_Canzone` char(50) NOT NULL,
  `Ha__Titolo_Canzone` char(50) NOT NULL,
  `Ha__Email_Album` char(50) NOT NULL,
  `Ha__Titolo_Album` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `compone`
--

CREATE TABLE `compone` (
  `C_C_Email` char(50) NOT NULL,
  `C_C_Titolo` char(50) NOT NULL,
  `Email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
  `Segue_Email` char(50) NOT NULL,
  `Seguito_Email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `libreria`
--

CREATE TABLE `libreria` (
  `Email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `Email` char(50) NOT NULL,
  `Descrizione` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `playlist`
--

CREATE TABLE `playlist` (
  `Email` char(50) NOT NULL,
  `Immagine` char(50) NOT NULL,
  `Titolo` char(50) NOT NULL,
  `Tie_Email` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `testuale`
--

CREATE TABLE `testuale` (
  `Email` char(50) NOT NULL,
  `Data` date NOT NULL,
  `Immagine` char(50) DEFAULT NULL,
  `Testo` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Email` char(50) NOT NULL,
  `Password` char(100) NOT NULL,
  `Username` char(50) NOT NULL;
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`Email`,`Titolo`),
  ADD KEY `REF_ALBUM_LIBRE_FK` (`Con_Email`);

--
-- Indici per le tabelle `canzone`
--
ALTER TABLE `canzone`
  ADD PRIMARY KEY (`Email`,`Titolo`),
  ADD KEY `EQU_CANZO_ALBUM_FK` (`Int_Email`,`Int_Titolo`),
  ADD KEY `REF_CANZO_CODA_FK` (`Ins_Email`);

--
-- Indici per le tabelle `coda`
--
ALTER TABLE `coda`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`EmailScrittore`),
  ADD KEY `REF_COMME_TESTU_FK` (`Ha__Email_Testuale`),
  ADD KEY `REF_COMME_CANZO_FK` (`Ha__Email_Canzone`,`Ha__Titolo_Canzone`),
  ADD KEY `REF_COMME_ALBUM_FK` (`Ha__Email_Album`,`Ha__Titolo_Album`);

--
-- Indici per le tabelle `compone`
--
ALTER TABLE `compone`
  ADD PRIMARY KEY (`Email`,`C_C_Email`,`C_C_Titolo`),
  ADD KEY `REF_compo_CANZO_FK` (`C_C_Email`,`C_C_Titolo`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`Segue_Email`,`Seguito_Email`),
  ADD KEY `REF_follo_UTENT_1` (`Seguito_Email`);

--
-- Indici per le tabelle `libreria`
--
ALTER TABLE `libreria`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `REF_PLAYL_LIBRE_FK` (`Tie_Email`);

--
-- Indici per le tabelle `testuale`
--
ALTER TABLE `testuale`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Email`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `REF_ALBUM_LIBRE_FK` FOREIGN KEY (`Con_Email`) REFERENCES `libreria` (`Email`),
  ADD CONSTRAINT `REF_ALBUM_UTENT` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `canzone`
--
ALTER TABLE `canzone`
  ADD CONSTRAINT `EQU_CANZO_ALBUM_FK` FOREIGN KEY (`Int_Email`,`Int_Titolo`) REFERENCES `album` (`Email`, `Titolo`),
  ADD CONSTRAINT `REF_CANZO_CODA_FK` FOREIGN KEY (`Ins_Email`) REFERENCES `coda` (`Email`),
  ADD CONSTRAINT `REF_CANZO_UTENT` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `coda`
--
ALTER TABLE `coda`
  ADD CONSTRAINT `ID_CODA_UTENT_FK` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `ID_COMME_UTENT_FK` FOREIGN KEY (`EmailScrittore`) REFERENCES `utente` (`Email`),
  ADD CONSTRAINT `REF_COMME_ALBUM_FK` FOREIGN KEY (`Ha__Email_Album`,`Ha__Titolo_Album`) REFERENCES `album` (`Email`, `Titolo`),
  ADD CONSTRAINT `REF_COMME_CANZO_FK` FOREIGN KEY (`Ha__Email_Canzone`,`Ha__Titolo_Canzone`) REFERENCES `canzone` (`Email`, `Titolo`),
  ADD CONSTRAINT `REF_COMME_TESTU_FK` FOREIGN KEY (`Ha__Email_Testuale`) REFERENCES `testuale` (`Email`);

--
-- Limiti per la tabella `compone`
--
ALTER TABLE `compone`
  ADD CONSTRAINT `EQU_compo_PLAYL` FOREIGN KEY (`Email`) REFERENCES `playlist` (`Email`),
  ADD CONSTRAINT `REF_compo_CANZO_FK` FOREIGN KEY (`C_C_Email`,`C_C_Titolo`) REFERENCES `canzone` (`Email`, `Titolo`);

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `REF_follo_UTENT_1` FOREIGN KEY (`Seguito_Email`) REFERENCES `utente` (`Email`),
  ADD CONSTRAINT `REF_follo_UTENT_FK` FOREIGN KEY (`Segue_Email`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `libreria`
--
ALTER TABLE `libreria`
  ADD CONSTRAINT `ID_LIBRE_UTENT_FK` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `ID_NOTIF_UTENT_FK` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `ID_PLAYL_UTENT_FK` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`),
  ADD CONSTRAINT `REF_PLAYL_LIBRE_FK` FOREIGN KEY (`Tie_Email`) REFERENCES `libreria` (`Email`);

--
-- Limiti per la tabella `testuale`
--
ALTER TABLE `testuale`
  ADD CONSTRAINT `ID_TESTU_UTENT_FK` FOREIGN KEY (`Email`) REFERENCES `utente` (`Email`);

ALTER TABLE `utente` 
  ADD UNIQUE(`Username`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
