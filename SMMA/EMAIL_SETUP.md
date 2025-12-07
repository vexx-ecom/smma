# Nastavení odesílání emailů

## Režimy odesílání

### Localhost režim (pro testování na WAMP)
V souboru `config/email_config.php` je nastaveno `'local_mode' => true`.
- Emaily se **neodesílají**, ale ukládají se do složky `emails/`
- Každý email je uložen jako HTML soubor s časovou značkou
- Ideální pro testování na localhostu bez nutnosti SMTP konfigurace

### Produkční režim (pro živý server)
V souboru `config/email_config.php` nastavte `'local_mode' => false`.
- Emaily se odesílají přes SMTP (Gmail)
- Vyžaduje App Password z Gmail

---

## Gmail App Password (pouze pro produkční režim)

Pro odesílání emailů přes Gmail je potřeba použít **App Password** (ne běžné heslo).

### Jak získat App Password - KROK ZA KROKEM:

**KROK 1:** Otevřete přímo tento odkaz: https://myaccount.google.com/apppasswords

**KROK 2:** Pokud máte zapnutou 2-Step Verification:
   - Uvidíte stránku pro vytvoření App Password
   - Vyberte "Mail" z dropdown menu
   - Vyberte "Other (Custom name)"
   - Zadejte název (např. "SMMA Website")
   - Klikněte na "Generate"
   - Zkopírujte vygenerované 16místné heslo (např. "abcd efgh ijkl mnop")

**KROK 3:** Pokud NEMÁTE zapnutou 2-Step Verification:
   - Nejdříve musíte zapnout 2-Step Verification: https://myaccount.google.com/security
   - Po zapnutí se vraťte na: https://myaccount.google.com/apppasswords
   - Pokračujte podle KROKU 2

**KROK 4:** Vložte heslo do souboru `config/email_config.php`:
   - Otevřete soubor: `config/email_config.php`
   - Najděte řádek: `'smtp_password' => '',`
   - Vložte heslo mezi uvozovky: `'smtp_password' => 'abcd efgh ijkl mnop',`
   - ULOŽTE soubor

### Konfigurace

Upravte soubor `config/email_config.php`:

```php
'smtp_password' => 'VAŠE_APP_PASSWORD_ZDE', // 16místné heslo z Google
```

### Testování

Po nastavení App Password můžete otestovat formulář na webu. Email bude odeslán na **j.sokol2007@gmail.com**.

