<?php
/**
 * Konfigurační soubor pro PHPMailer
 * 
 * DŮLEŽITÉ: Pro Gmail potřebujete App Password, ne běžné heslo!
 * 
 * Jak získat App Password:
 * 1. Přejděte na https://myaccount.google.com/
 * 2. Zvolte "Zabezpečení"
 * 3. Zapněte "Ověření ve dvou krocích" (pokud ještě není zapnuté)
 * 4. V sekci "Ověření ve dvou krocích" klikněte na "Hesla aplikací"
 * 5. Vyberte "Aplikace" a "Poštovní klient"
 * 6. Zkopírujte vygenerované heslo a vložte ho níže
 */

return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls', // 'tls' nebo 'ssl'
    'smtp_username' => 'vexx.ecom@gmail.com',
    'smtp_password' => 'YOUR_APP_PASSWORD_HERE', // ZDE VLOŽTE APP PASSWORD!
    'from_email' => 'vexx.ecom@gmail.com',
    'from_name' => 'Dodávka Sokol - Web',
    'to_email' => 'vexx.ecom@gmail.com',
    'to_name' => 'Dodávka Sokol'
];

