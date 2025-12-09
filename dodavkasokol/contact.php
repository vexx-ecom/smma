<?php
// Zpracování kontaktního formuláře
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metoda není povolena']);
    exit;
}

// Získání dat z formuláře
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
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

// Příprava emailu
$to = 'mike.sokol@seznam.cz';
$email_subject = 'Kontaktní formulář - ' . $subject;
$email_body = "Nový kontakt z webu Dodavka Sokol\n\n";
$email_body .= "Jméno: " . $name . "\n";
$email_body .= "Email: " . $email . "\n";
$email_body .= "Předmět: " . $subject . "\n\n";
$email_body .= "Zpráva:\n" . $message . "\n";

$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Odeslání emailu
if (mail($to, $email_subject, $email_body, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Zpráva byla úspěšně odeslána. Děkujeme za váš zájem!']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Chyba při odesílání zprávy. Zkuste to prosím později.']);
}
?>

