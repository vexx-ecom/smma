-- Migrace: Přidání pole datum_do pro rezervace od-do
-- Spusťte tento SQL skript v phpMyAdmin, pokud už máte vytvořenou databázi

USE `dodavkasokol`;

-- Přidání pole datum_do
ALTER TABLE `dostupnost` 
ADD COLUMN `datum_do` date DEFAULT NULL AFTER `datum`;

-- Odstranění UNIQUE constraint z pole datum, protože teď můžeme mít více záznamů pro stejný datum (různé rozsahy)
ALTER TABLE `dostupnost` 
DROP INDEX `datum`;

-- Přidání indexu pro rychlejší vyhledávání
ALTER TABLE `dostupnost` 
ADD INDEX `idx_datum_do` (`datum_do`);

-- Pokud máte existující záznamy, můžete nastavit datum_do = datum pro jednodenní rezervace
UPDATE `dostupnost` SET `datum_do` = `datum` WHERE `datum_do` IS NULL;

