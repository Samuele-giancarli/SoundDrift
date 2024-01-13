-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Gen 07, 2024 alle 20:08
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
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `ID` int NOT NULL,
  `ID_Utente` int NOT NULL,
  `Data` date NOT NULL,
  `Testo` text NOT NULL,
  `ID_Immagine` int DEFAULT NULL,
  `ID_Album` int,
  `ID_Canzone` int
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Struttura della tabella `album`
--

CREATE TABLE `album` (
  `ID` int NOT NULL,
  `ID_Utente` int NOT NULL,
  `Data` date NOT NULL,
  `Titolo` tinytext NOT NULL,
  `Genere` tinytext NOT NULL,
  `Finalizzato` boolean NOT NULL DEFAULT 0,
  `ID_Immagine` int
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `canzone`
--

CREATE TABLE `canzone` (
  `ID` int NOT NULL,
  `ID_Utente` int NOT NULL,
  `Data` date NOT NULL,
  `ID_Album` int,
  `ID_Immagine` int,
  `ID_Audio` int NOT NULL,
  `Titolo` tinytext NOT NULL,
  `Genere` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
`ID` int NOT NULL,
`ID_Utente` int NOT NULL, 
`ID_Post` int NOT NULL, 
`Testo` text NOT NULL,
`DateTime` DateTime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `associativa_playlist`
--

CREATE TABLE `associativa_playlist` (
  `ID_Playlist` int NOT NULL, 
  `ID_Canzone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
  `ID_Seguito` int NOT NULL, 
  `ID_Seguace` int NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `libreria`
--

CREATE TABLE `mipiace_canzone` (
`ID_Utente` int NOT NULL, 
`ID_Canzone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `mipiace_album` (
`ID_Utente` int NOT NULL, 
`ID_Album` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `mipiace_playlist` (
`ID_Utente` int NOT NULL, 
`ID_Playlist` int NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `mipiace_post` (
`ID_Utente` int NOT NULL, 
`ID_Post` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `ID` int NOT NULL,
  `Testo` text NOT NULL,
  `ID_Utente` int NOT NULL, 
  `ID_Mandante` int, 
  `ID_Post` int,
  `DateTime` DateTime NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `playlist`
--

CREATE TABLE `playlist` (
  `ID` int NOT NULL,
  `ID_Utente` int NOT NULL, 
  `ID_Immagine` int,
  `Titolo` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Struttura della tabella `risorsa`
--

CREATE TABLE `risorsa` (
  `ID` int NOT NULL,
  `FileName` tinytext NOT NULL, 
  `MimeType` tinytext NOT NULL,
  `Contenuto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int NOT NULL,
  `Email` tinytext NOT NULL,
  `Password` tinytext NOT NULL,
  `Username` tinytext NOT NULL,
  `ID_Immagine` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Autore/RicercaPerAutore` (`ID_Utente`),
  ADD KEY `RicercaPerTitolo` (`Titolo`),
  ADD KEY `ImmagineAlbum` (`ID_Immagine`),
  ADD KEY `FinalizzaAlbum` (`Finalizzato`);

--
-- Indici per le tabelle `canzone`
--
ALTER TABLE `canzone`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Autore/RicercaPerAutore` (`ID_Utente`),
  ADD KEY `RicercaPerTitolo` (`Titolo`),
  ADD KEY `InAlbum` (`ID_Album`),
  ADD KEY `ImmagineCanzone` (`ID_Immagine`),
  ADD KEY `AudioCanzone` (`ID_Audio`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKscrive_FK` (`ID_Utente`,`ID_Post`);

--
-- Indici per le tabelle `associativa_playlist`
--
ALTER TABLE `associativa_playlist`
  ADD PRIMARY KEY (`ID_Canzone`,`ID_Playlist`),
  ADD KEY `ID_Canzone` (`ID_Canzone`),
  ADD KEY `ID_Playlist` (`ID_Playlist`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
ADD PRIMARY KEY (`ID_Seguace`,`ID_Seguito`),
  ADD KEY `ID_Seguace` (`ID_Seguace`),
  ADD KEY `ID_Seguito` (`ID_Seguito`);

--
-- Indici per le tabelle `mipiace_canzone`
--
ALTER TABLE `mipiace_canzone`
ADD PRIMARY KEY (`ID_Utente`,`ID_Canzone`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ID_Canzone` (`ID_Canzone`);

--
-- Indici per le tabelle `mipiace_album`
--
ALTER TABLE `mipiace_album`
ADD PRIMARY KEY (`ID_Utente`,`ID_Album`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ID_Album` (`ID_Album`);
--
-- Indici per le tabelle `mipiace_playlist`
--
ALTER TABLE `mipiace_playlist`
ADD PRIMARY KEY (`ID_Utente`,`ID_Playlist`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ID_Playlist` (`ID_Playlist`);
--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY(`ID_Post`),
  ADD KEY(`ID_Mandante`),
  ADD KEY(`ID_Utente`),
  ADD `tripla` TEXT AS (CONCAT(`ID_Utente`, "|", `ID_Mandante`, "|", IFNULL(`ID_Post`, 0), "|", `Testo`)) UNIQUE;

--
-- Indici per le tabelle `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ImmaginePlaylist` (`ID_Immagine`),
  ADD KEY `RicercaPerTitolo` (`Titolo`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ID_Canzone` (`ID_Canzone`),
  ADD KEY `ID_Album` (`ID_Album`),
  ADD KEY `ImmaginePost` (`ID_Immagine`);

--
-- Indici per le tabelle `risorsa`
--
ALTER TABLE `risorsa`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ImmagineProfilo` (`ID_Immagine`),
  ADD UNIQUE INDEX `UsernameUtente` (`Username`),
  ADD UNIQUE INDEX `MailUtente` (`Email`);

--
-- Indici per le tabelle `risorsa`
--
ALTER TABLE `mipiace_post`
  ADD PRIMARY KEY (`ID_Utente`, `ID_Post`),
  ADD KEY (`ID_Utente`),
  ADD KEY (`ID_Post`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `canzone`
--
ALTER TABLE `canzone`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `playlist`
--
ALTER TABLE `playlist`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `testuale`
--
ALTER TABLE `post`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT,  
  ADD CONSTRAINT `ImgPost` FOREIGN KEY (`ID_immagine`) REFERENCES `risorsa` (`ID`);

--
-- AUTO_INCREMENT per la tabella `album`
--
ALTER TABLE `album`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `risorsa`
--
ALTER TABLE `risorsa`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `AutoreAlbum` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `ImgAlbum` FOREIGN KEY (`ID_Immagine`) REFERENCES `risorsa` (`ID`);
--
-- Limiti per la tabella `canzone`
--
ALTER TABLE `canzone`
  ADD CONSTRAINT `CanzoneInAlbum` FOREIGN KEY (`ID_Album`) REFERENCES `album` (`ID`),
  ADD CONSTRAINT `AutoreCanzone` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `ImgSong` FOREIGN KEY (`ID_Immagine`) REFERENCES `risorsa` (`ID`),
  ADD CONSTRAINT `AudioSong` FOREIGN KEY (`ID_Audio`) REFERENCES `risorsa` (`ID`);
--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `AutoreCommento` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
   ADD CONSTRAINT `PostRiferimento` FOREIGN KEY (`ID_Post`) REFERENCES `post` (`ID`);
--
-- Limiti per la tabella `associativa_playlist`
--
ALTER TABLE `associativa_playlist`
 ADD CONSTRAINT `PlaylistContiene` FOREIGN KEY (`ID_Playlist`) REFERENCES `playlist` (`ID`),
   ADD CONSTRAINT `CanzoneFaParte` FOREIGN KEY (`ID_Canzone`) REFERENCES `canzone` (`ID`);

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
 ADD CONSTRAINT `Seguace` FOREIGN KEY (`ID_Seguace`) REFERENCES `utente` (`ID`),
 ADD CONSTRAINT `Seguito` FOREIGN KEY (`ID_Seguito`) REFERENCES `utente` (`ID`);

--
-- Limiti per la tabella `mipiace_canzone`
--
ALTER TABLE `mipiace_canzone`
 ADD CONSTRAINT `UtentePiaceCanzone` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
 ADD CONSTRAINT `CanzonePiaceUtente` FOREIGN KEY (`ID_Canzone`) REFERENCES `canzone` (`ID`);

--
-- Limiti per la tabella `mipiace_album`
--
ALTER TABLE `mipiace_album`
 ADD CONSTRAINT `UtentePiaceAlbum` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
 ADD CONSTRAINT `AlbumPiaceUtente` FOREIGN KEY (`ID_Album`) REFERENCES `album` (`ID`);

--
-- Limiti per la tabella `mipiace_playlist`
--
ALTER TABLE `mipiace_playlist`
 ADD CONSTRAINT `UtentePiacePlaylist` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
 ADD CONSTRAINT `PlaylistPiaceUtente` FOREIGN KEY (`ID_Playlist`) REFERENCES `playlist` (`ID`);

ALTER TABLE `mipiace_post`
 ADD CONSTRAINT `UtentePiacePost` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
 ADD CONSTRAINT `PostPiaceUtente` FOREIGN KEY (`ID_Post`) REFERENCES `post` (`ID`);
--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `Utente` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `Mandante` FOREIGN KEY (`ID_Mandante`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `Post` FOREIGN KEY (`ID_Post`) REFERENCES `post` (`ID`);

--
-- Limiti per la tabella `playlist`
--
ALTER TABLE `playlist`
 ADD CONSTRAINT `CreatorePlaylist` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID`),
 ADD CONSTRAINT `ImgPlaylist` FOREIGN KEY (`ID_Immagine`) REFERENCES `risorsa` (`ID`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
