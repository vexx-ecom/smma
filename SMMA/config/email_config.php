<?php
// Email konfigurace
// Pro localhost nastavte 'local_mode' => true (emaily se ukládají do souboru)
// Pro produkci nastavte 'local_mode' => false (emaily se odesílají přes SMTP)

return [
    // Režim: true = localhost (ukládá do souboru), false = produkce (odesílá přes SMTP)
    'local_mode' => false,
    
    // SMTP nastavení (použije se pouze pokud local_mode = false)
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls', // 'tls' nebo 'ssl'
    'smtp_username' => 'j.sokol2007@gmail.com',
    'smtp_password' => 'aiwk kldg dmsv aqhe', // App Password z Gmail
    
    // Email adresy
    'from_email' => 'j.sokol2007@gmail.com',
    'from_name' => 'SMMA Kontaktní formulář',
    'to_email' => 'j.sokol2007@gmail.com',
    
    // Cesta pro ukládání emailů v localhost módu
    'local_email_dir' => 'emails'
];
?>

