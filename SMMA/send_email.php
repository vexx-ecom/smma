<?php
// Nastavení hlaviček pro JSON odpověď
header('Content-Type: application/json');

// Zapnutí error reporting pro debugging (odstranit v produkci)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Nezobrazovat chyby uživateli, ale logovat

// Načtení PHPMailer
require_once 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require_once 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

// Use statements musí být po require
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Načtení email konfigurace
try {
    $email_config = require_once 'config/email_config.php';
    
    if (!is_array($email_config)) {
        throw new Exception('Konfigurace není pole');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Chyba při načítání konfigurace: ' . $e->getMessage()
    ]);
    exit;
}

// Kontrola, zda byl formulář odeslán metodou POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    
    // Pokud nejsou chyby, odešli email
    if (empty($errors)) {
        // Příprava emailu
        $email_subject = 'Kontaktní formulář: ' . $subject;
        
        // HTML tělo emailu
        $email_body_html = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background-color: #6366f1; color: white; padding: 20px; text-align: center; }
                    .content { background-color: #f9f9f9; padding: 20px; }
                    .field { margin-bottom: 15px; }
                    .label { font-weight: bold; color: #6366f1; }
                    .message-box { background-color: white; padding: 15px; border-left: 4px solid #6366f1; margin-top: 15px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Nový kontakt z webového formuláře</h2>
                    </div>
                    <div class='content'>
                        <div class='field'>
                            <span class='label'>Jméno:</span> " . htmlspecialchars($name) . "
                        </div>
                        <div class='field'>
                            <span class='label'>Email:</span> " . htmlspecialchars($email) . "
                        </div>
                        <div class='field'>
                            <span class='label'>Předmět:</span> " . htmlspecialchars($subject) . "
                        </div>
                        <div class='message-box'>
                            <div class='label'>Zpráva:</div>
                            <div>" . nl2br(htmlspecialchars($message)) . "</div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        ";
        
        // Plain text verze
        $email_body_text = "Nový kontakt z webového formuláře\n\n" .
                        "Jméno: " . $name . "\n" .
                        "Email: " . $email . "\n" .
                        "Předmět: " . $subject . "\n\n" .
                        "Zpráva:\n" . $message . "\n";
        
        // Lokální režim - ukládání do souboru
        if (isset($email_config['local_mode']) && $email_config['local_mode'] === true) {
            try {
                // Vytvořit složku pro emaily, pokud neexistuje
                $email_dir = isset($email_config['local_email_dir']) ? $email_config['local_email_dir'] : 'emails';
                if (!is_dir($email_dir)) {
                    mkdir($email_dir, 0755, true);
                }
                
                // Vytvořit název souboru s časovou značkou
                $filename = $email_dir . '/email_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.html';
                
                // Uložit email do souboru
                $file_content = "<!DOCTYPE html>\n<html>\n<head>\n<meta charset='UTF-8'>\n";
                $file_content .= "<title>" . htmlspecialchars($email_subject) . "</title>\n";
                $file_content .= "<style>body { font-family: Arial, sans-serif; margin: 20px; }</style>\n";
                $file_content .= "</head>\n<body>\n";
                $file_content .= "<h2>Email uložený z localhost formuláře</h2>\n";
                $file_content .= "<p><strong>Čas:</strong> " . date('d.m.Y H:i:s') . "</p>\n";
                $file_content .= "<p><strong>Pro:</strong> " . htmlspecialchars($email_config['to_email']) . "</p>\n<hr>\n";
                $file_content .= $email_body_html;
                $file_content .= "\n</body>\n</html>";
                
                if (file_put_contents($filename, $file_content)) {
                    // Úspěch
                    echo json_encode([
                        'success' => true,
                        'message' => 'Děkuji za zprávu! Email byl uložen do souboru: ' . $filename
                    ]);
                } else {
                    throw new Exception('Nepodařilo se uložit soubor');
                }
                
            } catch (Exception $e) {
                error_log("Error saving email: " . $e->getMessage());
                echo json_encode([
                    'success' => false,
                    'message' => 'Chyba při ukládání emailu. Zkuste to prosím znovu.'
                ]);
            }
        } else {
            // Produkční režim - odesílání přes SMTP
            try {
                // Vytvoření instance PHPMailer
                $mail = new PHPMailer(true);
                
                // SMTP nastavení
                $mail->isSMTP();
                $mail->Host = $email_config['smtp_host'];
                $mail->SMTPAuth = true;
                $mail->Username = $email_config['smtp_username'];
                $mail->Password = $email_config['smtp_password'];
                $mail->SMTPSecure = $email_config['smtp_secure'];
                $mail->Port = $email_config['smtp_port'];
                $mail->CharSet = 'UTF-8';
                
                // Odesílatel
                $mail->setFrom($email_config['from_email'], $email_config['from_name']);
                
                // Příjemce
                $mail->addAddress($email_config['to_email']);
                
                // Reply-To na email odesílatele
                $mail->addReplyTo($email, $name);
                
                // Obsah emailu
                $mail->isHTML(true);
                $mail->Subject = $email_subject;
                $mail->Body = $email_body_html;
                $mail->AltBody = $email_body_text;
                
                // Odeslání emailu
                $mail->send();
                
                // Úspěch
                echo json_encode([
                    'success' => true,
                    'message' => 'Děkuji za zprávu! Brzy se vám ozvu.'
                ]);
                
            } catch (Exception $e) {
                // Chyba při odesílání
                error_log("PHPMailer Error: " . $mail->ErrorInfo);
                echo json_encode([
                    'success' => false,
                    'message' => 'Omlouvám se, došlo k chybě při odesílání zprávy. Zkuste to prosím znovu později.'
                ]);
            }
        }
    } else {
        // Vrátit chyby
        echo json_encode([
            'success' => false,
            'message' => implode('<br>', $errors)
        ]);
    }
} else {
    // Pokud není POST, přesměrovat
    header('Location: index.php');
    exit;
}
?>
