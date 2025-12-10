# Nastavení PHPMailer pro Gmail

## ✅ Co bylo nainstalováno:

1. **PHPMailer knihovna** - stažena a připravena v složce `PHPMailer-master/`
2. **contact.php** - upraven pro použití PHPMailer s Gmail SMTP
3. **config_email.php** - konfigurační soubor (volitelný)

## 🔧 KROKY K NASTAVENÍ:

### 1. Vytvořte App Password v Gmail

**DŮLEŽITÉ:** Gmail vyžaduje App Password, ne běžné heslo!

1. Přejděte na: https://myaccount.google.com/
2. Klikněte na **"Zabezpečení"** v levém menu
3. Zkontrolujte, že máte zapnuté **"Ověření ve dvou krocích"**
   - Pokud ne, zapněte ho nejdřív
4. V sekci **"Ověření ve dvou krocích"** klikněte na **"Hesla aplikací"**
5. Vyberte:
   - **Aplikace:** Poštovní klient
   - **Zařízení:** Windows počítač (nebo jiné)
6. Klikněte na **"Generovat"**
7. **Zkopírujte vygenerované 16místné heslo** (např: `abcd efgh ijkl mnop`)

### 2. Nastavte heslo v contact.php

Otevřete soubor `contact.php` a na řádku 48 změňte:

```php
$mail->Password   = 'YOUR_APP_PASSWORD'; // Zde vložte App Password z Gmail
```

Nahraďte `YOUR_APP_PASSWORD` vaším vygenerovaným App Password (bez mezer nebo s mezerami, obojí funguje).

### 3. Otestujte odesílání

1. Otevřete webovou stránku
2. Vyplňte kontaktní formulář
3. Odešlete zprávu
4. Zkontrolujte emailovou schránku `vexx.ecom@gmail.com`

## 📧 Konfigurace:

- **SMTP Server:** smtp.gmail.com
- **Port:** 587 (TLS)
- **Email odesílatele:** vexx.ecom@gmail.com
- **Email příjemce:** vexx.ecom@gmail.com

## ⚠️ Bezpečnostní poznámky:

- **NEUKLÁDEJTE** App Password do Gitu!
- Pokud používáte Git, přidejte `config_email.php` do `.gitignore`
- App Password je citlivá informace - chraňte ji

## 🐛 Řešení problémů:

### Email se neposílá:
1. Zkontrolujte, že máte zapnuté "Ověření ve dvou krocích"
2. Ověřte, že používáte App Password, ne běžné heslo
3. Zkontrolujte, že port 587 není blokovaný firewallem
4. Zkontrolujte PHP error log

### Chyba "SMTP connect() failed":
- Zkontrolujte připojení k internetu
- Ověřte, že port 587 není blokovaný
- Zkontrolujte, že používáte správné App Password

## 📚 Další informace:

- [PHPMailer dokumentace](https://github.com/PHPMailer/PHPMailer)
- [Gmail App Passwords](https://support.google.com/accounts/answer/185833)

---

**Status:** ✅ PHPMailer je nainstalován a připraven k použití
**Email:** vexx.ecom@gmail.com
**Potřebujete:** App Password z Gmail účtu

