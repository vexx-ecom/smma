<?php
// Jednoduchý test odesílání emailu
header('Content-Type: application/json');

// Načtení PHPMailer
require_once 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require_once 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Načtení email konfigurace
$email_config = require_once 'config/email_config.php';

// Test - vytvoření složky a uložení testovacího emailu
$email_dir = isset($email_config['local_email_dir']) ? $email_config['local_email_dir'] : 'emails';

if (!is_dir($email_dir)) {
    if (mkdir($email_dir, 0755, true)) {
        $result = ['success' => true, 'message' => 'Složka ' . $email_dir . ' byla vytvořena'];
    } else {
        $result = ['success' => false, 'message' => 'Nepodařilo se vytvořit složku ' . $email_dir];
    }
} else {
    $result = ['success' => true, 'message' => 'Složka ' . $email_dir . ' již existuje'];
}

// Test - uložení testovacího emailu
$test_content = "<h1>Testovací email</h1><p>Čas: " . date('d.m.Y H:i:s') . "</p>";
$filename = $email_dir . '/test_' . date('Y-m-d_H-i-s') . '.html';

if (file_put_contents($filename, $test_content)) {
    $result['test_file'] = 'Testovací soubor vytvořen: ' . $filename;
} else {
    $result['test_file'] = 'Chyba při vytváření testovacího souboru';
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>

