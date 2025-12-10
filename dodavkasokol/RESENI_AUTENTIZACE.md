# Řešení chyby "Could not authenticate" s Gmail

## 🔴 Problém
Chyba: **"SMTP Error: Could not authenticate"**

Gmail odmítá autentizaci, protože:
1. **Vyžaduje App Password** (ne běžné heslo)
2. **"Méně zabezpečené aplikace" jsou vypnuté** (Google to už většinou nepodporuje)
3. **Port nebo šifrování není správně nastaveno**

## ✅ ŘEŠENÍ 1: Zkusit port 465 s SSL

Upravil jsem `contact.php` - zkusil jsem změnit:
- Port: **587 → 465**
- Šifrování: **TLS → SSL**

**Zkuste to znovu!** Pokud to stále nefunguje, použijte Řešení 2.

---

## ✅ ŘEŠENÍ 2: Použít Seznam.cz (NEJJEDNODUŠŠÍ)

Vytvořil jsem alternativní soubor `contact_seznam.php`:

### Výhody Seznam.cz:
- ✅ **Funguje s běžným heslem** (ne App Password)
- ✅ **Jednodušší nastavení**
- ✅ **Spolehlivější pro české weby**

### Jak použít:

1. **Zaregistrujte se na Seznam.cz** (pokud nemáte účet):
   - https://email.seznam.cz/

2. **Upravte `contact_seznam.php`**:
   ```php
   $mail->Username   = 'vas-email@seznam.cz'; // Váš Seznam email
   $mail->Password   = 'vase-heslo'; // Vaše Seznam heslo
   ```

3. **Přejmenujte soubory**:
   - `contact.php` → `contact_gmail.php` (záloha)
   - `contact_seznam.php` → `contact.php` (aktivní)

4. **Otestujte formulář**

---

## ✅ ŘEŠENÍ 3: Vytvořit App Password (pokud je to možné)

### Krok 1: Zkontrolujte typ účtu
- Otevřete: https://myaccount.google.com/security
- Zkontrolujte, zda máte **osobní Gmail** nebo **Google Workspace**

### Krok 2: Pro osobní Gmail
1. Zapněte **"Ověření ve dvou krocích"**
2. Počkejte 7 dní (Google vyžaduje čekací dobu)
3. Poté by se měla objevit možnost "Hesla aplikací"

### Krok 3: Pro Google Workspace
- Kontaktujte správce vaší domény
- App Passwords může spravovat pouze administrátor

---

## ✅ ŘEŠENÍ 4: Použít jiný email provider

### Outlook.com / Hotmail
```php
$mail->Host       = 'smtp-mail.outlook.com';
$mail->Port       = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
```

### Email.cz
```php
$mail->Host       = 'smtp.email.cz';
$mail->Port       = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
```

---

## 🧪 Testování

Po změně nastavení:

1. Otevřete webovou stránku
2. Vyplňte kontaktní formulář
3. Odešlete zprávu
4. Zkontrolujte, zda email dorazil

## 📝 Aktuální nastavení v contact.php

- **Port:** 465 (SSL)
- **Šifrování:** SSL
- **Email:** vexx.ecom@gmail.com

**Doporučení:** Pokud Gmail stále nefunguje, použijte **Seznam.cz** - je to nejjednodušší řešení pro české weby.

