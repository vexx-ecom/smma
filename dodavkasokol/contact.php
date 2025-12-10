<?php
// Zpracování kontaktního formuláře s PHPMailer
header('Content-Type: application/json');

// Načtení PHPMailer
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

// Získání dat z formuláře
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validace
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

// Konfigurace PHPMailer pro Gmail
$mail = new PHPMailer(true);

try {
    // Nastavení serveru - použití App Password pro Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vexx.ecom@gmail.com'; // Gmail adresa
    $mail->Password   = 'qddb opzb fcqb gsqn'; // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS pro port 587
    $mail->Port       = 587; // Port 587 pro TLS
    $mail->CharSet    = 'UTF-8';
    $mail->SMTPDebug  = 0; // Nastavte na 2 pro debugování
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Nastavení odesílatele a příjemce
    $mail->setFrom('vexx.ecom@gmail.com', 'Dodávka Sokol - Web');
    $mail->addAddress('vexx.ecom@gmail.com', 'Dodávka Sokol');
    $mail->addReplyTo($email, $name);

    // Obsah emailu
    $mail->isHTML(true);
    $mail->Subject = 'Kontaktní formulář - ' . $subject;
    
    $email_body = '<html><body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">';
    $email_body .= '<h2 style="color: #1a73e8;">Nový kontakt z webu Dodávka Sokol</h2>';
    $email_body .= '<div style="background: #f5f5f5; padding: 20px; border-radius: 5px; margin: 20px 0;">';
    $email_body .= '<p><strong>Jméno:</strong> ' . htmlspecialchars($name) . '</p>';
    $email_body .= '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
    if (!empty($phone)) {
        $email_body .= '<p><strong>Telefon:</strong> ' . htmlspecialchars($phone) . '</p>';
    }
    $email_body .= '<p><strong>Předmět:</strong> ' . htmlspecialchars($subject) . '</p>';
    $email_body .= '</div>';
    $email_body .= '<div style="margin: 20px 0;">';
    $email_body .= '<h3 style="color: #1a73e8;">Zpráva:</h3>';
    $email_body .= '<p style="white-space: pre-wrap;">' . nl2br(htmlspecialchars($message)) . '</p>';
    $email_body .= '</div>';
    $email_body .= '</body></html>';
    
    $mail->Body = $email_body;
    
    // Textová verze pro klienty bez HTML podpory
    $mail->AltBody = "Nový kontakt z webu Dodávka Sokol\n\n";
    $mail->AltBody .= "Jméno: " . $name . "\n";
    $mail->AltBody .= "Email: " . $email . "\n";
    if (!empty($phone)) {
        $mail->AltBody .= "Telefon: " . $phone . "\n";
    }
    $mail->AltBody .= "Předmět: " . $subject . "\n\n";
    $mail->AltBody .= "Zpráva:\n" . $message . "\n";

    // Odeslání emailu
    $mail->send();
    
    echo json_encode([
        'success' => true, 
        'message' => 'Zpráva byla úspěšně odeslána. Děkujeme za váš zájem!'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("PHPMailer Error: " . $e->getMessage());
    error_log("PHPMailer ErrorInfo: " . $mail->ErrorInfo);
    echo json_encode([
        'success' => false, 
        'message' => 'Chyba při odesílání zprávy. Zkuste to prosím později nebo nás kontaktujte telefonicky.'
    ]);
}
?>
