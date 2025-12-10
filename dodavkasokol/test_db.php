<?php
/**
 * Testovací skript pro kontrolu databázového připojení
 * Otevřete v prohlížeči: http://localhost/dodavkasokol/test_db.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Test databázového připojení</h1>";
echo "<style>body { font-family: Arial, sans-serif; padding: 20px; } .success { color: green; } .error { color: red; } .info { color: blue; }</style>";

require_once 'config_db.php';

echo "<h2>1. Kontrola konfigurace</h2>";
echo "<p><strong>Host:</strong> " . DB_HOST . "</p>";
echo "<p><strong>Databáze:</strong> " . DB_NAME . "</p>";
echo "<p><strong>Uživatel:</strong> " . DB_USER . "</p>";
echo "<p><strong>Heslo:</strong> " . (DB_PASS ? '***' : '(prázdné)') . "</p>";

echo "<h2>2. Test připojení k MySQL serveru</h2>";
try {
    $dsn_test = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    $pdo_test = new PDO($dsn_test, DB_USER, DB_PASS);
    echo "<p class='success'>✓ Úspěšně připojeno k MySQL serveru</p>";
} catch (PDOException $e) {
    echo "<p class='error'>✗ Chyba připojení k MySQL: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p class='info'>Zkontrolujte, zda MySQL server běží (WAMP/XAMPP)</p>";
    exit;
}

echo "<h2>3. Kontrola existence databáze</h2>";
try {
    $stmt = $pdo_test->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
    $stmt->execute([DB_NAME]);
    if ($stmt->fetch()) {
        echo "<p class='success'>✓ Databáze '" . DB_NAME . "' existuje</p>";
    } else {
        echo "<p class='error'>✗ Databáze '" . DB_NAME . "' neexistuje</p>";
        echo "<p class='info'>Řešení: Spusťte SQL skript database.sql v phpMyAdmin</p>";
        exit;
    }
} catch (PDOException $e) {
    echo "<p class='error'>✗ Chyba při kontrole databáze: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}

echo "<h2>4. Test připojení k databázi</h2>";
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    echo "<p class='success'>✓ Úspěšně připojeno k databázi</p>";
} catch (PDOException $e) {
    echo "<p class='error'>✗ Chyba připojení k databázi: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}

echo "<h2>5. Kontrola tabulek</h2>";
try {
    // Kontrola tabulky dostupnost
    $stmt = $pdo->query("SHOW TABLES LIKE 'dostupnost'");
    if ($stmt->fetch()) {
        echo "<p class='success'>✓ Tabulka 'dostupnost' existuje</p>";
        
        // Kontrola struktury
        $stmt = $pdo->query("DESCRIBE dostupnost");
        $columns = $stmt->fetchAll();
        echo "<p><strong>Struktura tabulky:</strong></p><ul>";
        foreach ($columns as $col) {
            echo "<li>" . htmlspecialchars($col['Field']) . " (" . htmlspecialchars($col['Type']) . ")</li>";
        }
        echo "</ul>";
        
        // Kontrola, zda má pole datum_do
        $hasDatumDo = false;
        foreach ($columns as $col) {
            if ($col['Field'] === 'datum_do') {
                $hasDatumDo = true;
                break;
            }
        }
        
        if (!$hasDatumDo) {
            echo "<p class='error'>✗ Tabulka nemá pole 'datum_do'</p>";
            echo "<p class='info'>Řešení: Spusťte SQL skript database_update.sql v phpMyAdmin</p>";
        } else {
            echo "<p class='success'>✓ Pole 'datum_do' existuje</p>";
        }
    } else {
        echo "<p class='error'>✗ Tabulka 'dostupnost' neexistuje</p>";
        echo "<p class='info'>Řešení: Spusťte SQL skript database.sql v phpMyAdmin</p>";
    }
    
    // Kontrola tabulky admin_users
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    if ($stmt->fetch()) {
        echo "<p class='success'>✓ Tabulka 'admin_users' existuje</p>";
    } else {
        echo "<p class='error'>✗ Tabulka 'admin_users' neexistuje</p>";
        echo "<p class='info'>Řešení: Spusťte SQL skript database.sql v phpMyAdmin</p>";
    }
} catch (PDOException $e) {
    echo "<p class='error'>✗ Chyba při kontrole tabulek: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<h2>6. Test funkce getDbConnection()</h2>";
$test_pdo = getDbConnection();
if ($test_pdo) {
    echo "<p class='success'>✓ Funkce getDbConnection() funguje správně</p>";
    
    // Test dotazu
    try {
        $stmt = $test_pdo->query("SELECT COUNT(*) as count FROM dostupnost");
        $result = $stmt->fetch();
        echo "<p class='info'>Počet záznamů v tabulce dostupnost: " . $result['count'] . "</p>";
    } catch (PDOException $e) {
        echo "<p class='error'>✗ Chyba při testovacím dotazu: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<p class='error'>✗ Funkce getDbConnection() vrátila null</p>";
    echo "<p class='info'>Zkontrolujte error logy PHP</p>";
}

echo "<h2>7. Shrnutí</h2>";
if ($test_pdo) {
    echo "<p class='success'><strong>Všechny testy prošly! Databáze je správně nakonfigurována.</strong></p>";
    echo "<p><a href='admin.php'>Přejít na admin panel</a></p>";
} else {
    echo "<p class='error'><strong>Některé testy selhaly. Zkontrolujte výše uvedené chyby.</strong></p>";
    echo "<p class='info'><strong>Doporučené kroky:</strong></p>";
    echo "<ol>";
    echo "<li>Otevřete phpMyAdmin (http://localhost/phpmyadmin)</li>";
    echo "<li>Vytvořte databázi '" . DB_NAME . "' (pokud neexistuje)</li>";
    echo "<li>Spusťte SQL skript database.sql</li>";
    echo "<li>Pokud už máte databázi, spusťte database_update.sql pro přidání pole datum_do</li>";
    echo "</ol>";
}
?>

