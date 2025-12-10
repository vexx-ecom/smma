-- Databáze pro správu dostupnosti dodávky
-- Spusťte tento SQL skript v phpMyAdmin

-- Vytvoření databáze (pokud ještě neexistuje)
CREATE DATABASE IF NOT EXISTS `dodavkasokol` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci;
USE `dodavkasokol`;

-- Tabulka pro správu dostupnosti
CREATE TABLE IF NOT EXISTS `dostupnost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `datum_do` date DEFAULT NULL,
  `status` enum('dostupne','rezervovano','blokovano') NOT NULL DEFAULT 'dostupne',
  `poznamka` text DEFAULT NULL,
  `vytvoreno` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upraveno` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_datum` (`datum`),
  KEY `idx_datum_do` (`datum_do`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- Tabulka pro admin uživatele
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `vytvoreno` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- Vložení výchozího admin uživatele
-- Uživatelské jméno: admin
-- Heslo: password (ZMĚŇTE SI HO PO PRVNÍM PŘIHLÁŠENÍ!)
-- Heslo je hashováno pomocí password_hash() - pro změnu použijte: password_hash('nové_heslo', PASSWORD_DEFAULT)
-- Pro vytvoření nového hashe spusťte v PHP: echo password_hash('vaše_heslo', PASSWORD_DEFAULT);
INSERT INTO `admin_users` (`username`, `password_hash`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Vložení ukázkových dat (volitelné)
-- INSERT INTO `dostupnost` (`datum`, `datum_do`, `status`, `poznamka`) VALUES
-- ('2025-01-15', '2025-01-17', 'rezervovano', 'Rezervace od pana Nováka'),
-- ('2025-01-20', '2025-01-20', 'blokovano', 'Servis vozidla'),
-- ('2025-02-05', '2025-02-07', 'rezervovano', 'Rezervace od paní Svobodové');

