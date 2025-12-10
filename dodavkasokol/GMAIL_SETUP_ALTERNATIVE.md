# Alternativní nastavení Gmail (bez App Password)

## ⚠️ Problém s App Passwords

Pokud vidíte chybu "Nastavení, které hledáte, pro váš účet není k dispozici", znamená to, že App Passwords nejsou dostupné pro váš účet.

## ✅ Řešení 1: Použít běžné Gmail heslo

### Krok 1: Povolte méně zabezpečené aplikace (pokud je to možné)

1. Přejděte na: https://myaccount.google.com/security
2. Najděte sekci "Méně zabezpečený přístup k aplikaci" (Less secure app access)
   - **POZNÁMKA:** Google tuto možnost již většinou nepodporuje pro nové účty
   - Pokud tuto možnost nevidíte, použijte Řešení 2

### Krok 2: Nastavte heslo v contact.php

Otevřete `contact.php` a na řádku 61 změňte:

```php
$mail->Password   = 'VAŠE_GMAIL_HESLO'; // Vložte vaše běžné Gmail heslo
```

**⚠️ BEZPEČNOSTNÍ UPOZORNĚNÍ:** 
- Toto je méně bezpečné než App Password
- Nikdy neukládejte heslo do Gitu!
- Zvažte použití jiného email provideru

---

## ✅ Řešení 2: Použít jiný email provider (DOPORUČENO)

### Možnost A: Použít jiný Gmail účet
- Pokud máte jiný Gmail účet s App Passwords, použijte ho

### Možnost B: Použít jiný email provider

#### Seznam.cz / Email.cz
```php
$mail->Host       = 'smtp.seznam.cz';
$mail->Port       = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Username   = 'vas-email@seznam.cz';
$mail->Password   = 'vase-heslo';
```

#### Outlook.com / Hotmail
```php
$mail->Host       = 'smtp-mail.outlook.com';
$mail->Port       = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Username   = 'vas-email@outlook.com';
$mail->Password   = 'vase-heslo';
```

#### SendGrid / Mailgun (profesionální řešení)
- Vyžaduje registraci, ale je bezpečnější a spolehlivější
- Vhodné pro produkční weby

---

## ✅ Řešení 3: Zkontrolovat typ účtu

1. Zkontrolujte, zda máte **osobní Gmail** nebo **Google Workspace** účet
2. Pro Google Workspace účty:
   - App Passwords může spravovat administrátor
   - Kontaktujte správce vaší domény

---

## 🧪 Testování

Po nastavení otestujte:

1. Otevřete webovou stránku
2. Vyplňte kontaktní formulář
3. Odešlete zprávu
4. Zkontrolujte PHP error log, pokud to nefunguje

## 📝 Aktuální nastavení v contact.php

- **SMTP Server:** smtp.gmail.com
- **Port:** 587
- **Zabezpečení:** TLS
- **Email:** vexx.ecom@gmail.com
- **Heslo:** Vložte na řádek 61 v contact.php

---

**Doporučení:** Pokud App Passwords nefungují, zvažte použití jiného email provideru nebo profesionální služby jako SendGrid.

