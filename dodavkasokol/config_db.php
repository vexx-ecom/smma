<?php
/**
 * Konfigurační soubor pro databázové připojení
 * 
 * DŮLEŽITÉ: Upravte tyto údaje podle vašeho nastavení WAMP/XAMPP
 */

// Databázové údaje
define('DB_HOST', 'localhost');
define('DB_NAME', 'dodavkasokol');
define('DB_USER', 'root');  // Výchozí uživatel pro WAMP/XAMPP
define('DB_PASS', '');      // Výchozí heslo pro WAMP/XAMPP je prázdné
define('DB_CHARSET', 'utf8mb4');

/**
 * Vytvoření databázového připojení
 * @return PDO|null
 */
function getDbConnection() {
    static $pdo = null;
    
    if ($pdo !== null) {
        return $pdo;
    }
    
    try {
        // Nejdřív zkusíme připojit bez databáze, abychom zjistili, zda MySQL běží
        $dsn_test = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
        $pdo_test = new PDO($dsn_test, DB_USER, DB_PASS);
        
        // Zkontrolujeme, zda databáze existuje
        $stmt = $pdo_test->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
        $stmt->execute([DB_NAME]);
        if (!$stmt->fetch()) {
            error_log("Databáze '" . DB_NAME . "' neexistuje. Spusťte prosím SQL skript database.sql v phpMyAdmin.");
            return null;
        }
        
        // Nyní se připojíme k databázi
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        // Zkontrolujeme, zda tabulka existuje
        $stmt = $pdo->query("SHOW TABLES LIKE 'dostupnost'");
        if (!$stmt->fetch()) {
            error_log("Tabulka 'dostupnost' neexistuje. Spusťte prosím SQL skript database.sql v phpMyAdmin.");
            return null;
        }
        
        return $pdo;
    } catch (PDOException $e) {
        // Logování chyby místo zobrazení
        error_log("Databázové připojení selhalo: " . $e->getMessage());
        error_log("Kontrola: Host=" . DB_HOST . ", DB=" . DB_NAME . ", User=" . DB_USER);
        return null;
    }
}

/**
 * Kontrola, zda je uživatel přihlášen jako admin
 * @return bool
 */
function isAdminLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Přesměrování na login stránku, pokud není uživatel přihlášen
 */
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: admin_login.php');
        exit;
    }
}

