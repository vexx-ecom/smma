<?php
/**
 * Testovací skript pro kontrolu odesílání emailů
 * Otevřete v prohlížeči: http://localhost/dodavkasokol/test_email.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Test odesílání emailu</h1>";
echo "<style>body { font-family: Arial, sans-serif; padding: 20px; } .success { color: green; } .error { color: red; }</style>";

require_once __DIR__ . '/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    echo "<h2>1. Konfigurace PHPMailer</h2>";
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vexx.ecom@gmail.com';
    $mail->Password   = 'qddb opzb fcqb gsqn';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->SMTPDebug  = 2; // Zapnout debugování
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    echo "<p class='success'>✓ Konfigurace nastavena</p>";
    
    echo "<h2>2. Nastavení odesílatele a příjemce</h2>";
    $mail->setFrom('vexx.ecom@gmail.com', 'Dodávka Sokol - Web');
    $mail->addAddress('mike.sokol@seznam.cz', 'Dodávka Sokol');
    echo "<p class='success'>✓ Odesílatel: vexx.ecom@gmail.com</p>";
    echo "<p class='success'>✓ Příjemce: mike.sokol@seznam.cz</p>";
    
    echo "<h2>3. Obsah emailu</h2>";
    $mail->isHTML(true);
    $mail->Subject = 'Test emailu - Dodávka Sokol';
    $mail->Body = '<h2>Testovací email</h2><p>Toto je testovací email z webu Dodávka Sokol.</p>';
    $mail->AltBody = "Testovací email\n\nToto je testovací email z webu Dodávka Sokol.";
    echo "<p class='success'>✓ Obsah nastaven</p>";
    
    echo "<h2>4. Odesílání emailu</h2>";
    $mail->send();
    echo "<p class='success'><strong>✓ Email byl úspěšně odeslán!</strong></p>";
    echo "<p>Zkontrolujte prosím schránku mike.sokol@seznam.cz</p>";
    
} catch (Exception $e) {
    echo "<p class='error'><strong>✗ Chyba při odesílání emailu:</strong></p>";
    echo "<p class='error'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p class='error'>ErrorInfo: " . htmlspecialchars($mail->ErrorInfo) . "</p>";
    echo "<h3>Možné příčiny:</h3>";
    echo "<ul>";
    echo "<li>Špatné App Password pro Gmail</li>";
    echo "<li>Problém s připojením k SMTP serveru</li>";
    echo "<li>Firewall blokuje připojení</li>";
    echo "<li>Gmail blokuje přístup z tohoto serveru</li>";
    echo "</ul>";
}
?>

