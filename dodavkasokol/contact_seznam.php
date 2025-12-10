<?php
// ALTERNATIVNÍ VERZE - Použití Seznam.cz místo Gmail
// Tato verze je jednodušší na nastavení a obvykle funguje bez problémů

header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metoda není povolena']);
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

$errors = [];

if (empty($name)) {
    $errors[] = 'Jméno je povinné';
}

if (empty($email)) {
    $errors[] = 'Email je povinný';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Neplatná emailová adresa';
}

if (empty($subject)) {
    $errors[] = 'Předmět je povinný';
}

if (empty($message)) {
    $errors[] = 'Zpráva je povinná';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

$mail = new PHPMailer(true);

try {
    // Nastavení pro Seznam.cz (jednodušší než Gmail)
    $mail->isSMTP();
    $mail->Host       = 'smtp.seznam.cz';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vas-email@seznam.cz'; // ZMĚŇTE na váš Seznam email
    $mail->Password   = 'vase-heslo'; // ZMĚŇTE na vaše Seznam heslo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom('vas-email@seznam.cz', 'Dodávka Sokol - Web');
    $mail->addAddress('vexx.ecom@gmail.com', 'Dodávka Sokol');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Kontaktní formulář - ' . $subject;
    
    $email_body = '<html><body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">';
    $email_body .= '<h2 style="color: #1a73e8;">Nový kontakt z webu Dodávka Sokol</h2>';
    $email_body .= '<div style="background: #f5f5f5; padding: 20px; border-radius: 5px; margin: 20px 0;">';
    $email_body .= '<p><strong>Jméno:</strong> ' . htmlspecialchars($name) . '</p>';
    $email_body .= '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
    $email_body .= '<p><strong>Předmět:</strong> ' . htmlspecialchars($subject) . '</p>';
    $email_body .= '</div>';
    $email_body .= '<div style="margin: 20px 0;">';
    $email_body .= '<h3 style="color: #1a73e8;">Zpráva:</h3>';
    $email_body .= '<p style="white-space: pre-wrap;">' . nl2br(htmlspecialchars($message)) . '</p>';
    $email_body .= '</div>';
    $email_body .= '</body></html>';
    
    $mail->Body = $email_body;
    $mail->AltBody = "Nový kontakt z webu Dodávka Sokol\n\nJméno: $name\nEmail: $email\nPředmět: $subject\n\nZpráva:\n$message";

    $mail->send();
    
    echo json_encode([
        'success' => true, 
        'message' => 'Zpráva byla úspěšně odeslána. Děkujeme za váš zájem!'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Chyba při odesílání zprávy: ' . $mail->ErrorInfo
    ]);
}
?>

