<?php
require_once 'config/services.php';
$page_title = '';
$base_path = '';

include 'includes/header.php';
?>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Zvyšte svou <span class="gradient-text">online přítomnost</span> s profesionálním SMMA
                </h1>
                <p class="hero-description">
                    Pomáhám firmám růst pomocí strategického marketingu na sociálních sítích. 
                    Vytvářím obsah, které vaše publikum miluje a které přináší výsledky.
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary">Začneme spolu</a>
                </div>
                <div class="hero-stats">
                    <div class="stat">
                        <div class="stat-number">17+</div>
                        <div class="stat-label">Spokojených klientů</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">150%</div>
                        <div class="stat-label">Průměrný růst</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">3+</div>
                        <div class="stat-label">Let zkušeností</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Moje služby</h2>
                <p class="section-subtitle">Komplexní řešení pro váš online marketing</p>
            </div>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                <a href="service.php?id=<?php echo $service['id']; ?>" class="service-card-link">
                    <div class="service-card">
                        <div class="service-icon">
                            <?php if (isset($service['icon_image']) || (isset($service['icon']) && (strpos($service['icon'], '.png') !== false || strpos($service['icon'], '.jpg') !== false || strpos($service['icon'], '.svg') !== false))): ?>
                                <img src="<?php echo isset($service['icon_image']) ? $service['icon_image'] : $service['icon']; ?>" alt="<?php echo $service['title']; ?>" class="ads-icon-img">
                            <?php else: ?>
                                <?php echo $service['icon']; ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="service-title"><?php echo $service['title']; ?></h3>
                        <p class="service-description">
                            <?php echo $service['short_description']; ?>
                        </p>
                        <ul class="service-features">
                            <?php foreach (array_slice($service['features'], 0, 3) as $feature): ?>
                                <li><?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="service-link-text">Zjistit více →</div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Co říkají klienti</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Profesionální přístup a skvělé výsledky. Naše online přítomnost se 
                        výrazně zlepšila a vidíme reálný růst v prodejích."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">JD</div>
                        <div class="author-info">
                            <div class="author-name">Jan Dvořák</div>
                            <div class="author-role">CEO, TechStart</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Kreativní obsah a strategické myšlení. Spolupráce byla skvělá 
                        a výsledky předčily naše očekávání."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">MN</div>
                        <div class="author-info">
                            <div class="author-name">Marie Nováková</div>
                            <div class="author-role">Marketing Manager</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Výborná komunikace, vždy včasné dodání a výsledky, které mluví samy za sebe. 
                        Určitě doporučuji!"
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">PS</div>
                        <div class="author-info">
                            <div class="author-name">Petr Svoboda</div>
                            <div class="author-role">Majitel, LocalShop</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Common Mistakes Section -->
    <section id="mistakes" class="mistakes">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">5 nejčastějších chyb v reklamě na sociálních sítích</h2>
                <p class="section-subtitle">Tyhle chyby dělají i zkušení marketéři – zjistěte, jestli je neděláte taky a vyhněte se jim, než Vám začnou pálit rozpočet.</p>
            </div>
            <div class="mistakes-content">
                <div class="mistake-item">
                    <div class="mistake-number">1</div>
                    <div class="mistake-text">
                        <h3 class="mistake-title">Slabá kreativa (video/grafika + text)</h3>
                        <p class="mistake-description">Někdy se stane, že reklama může být technicky nastavená správně, ale pokud nemáte kvalitní kreativu, nedokážete uživatele zaujmout. V rušném feedu je důležitý "hook" přes který nalákate potenciální zákazníky.</p>
                    </div>
                </div>
                <div class="mistake-item">
                    <div class="mistake-number">2</div>
                    <div class="mistake-text">
                        <h3 class="mistake-title">Zapomenutý remarketing</h3>
                        <p class="mistake-description">Mnoho lidí dělá reklamy jen na úplně nové publikum. Ale přitom největší šanci na konverzi mají ti, kteří už dříve projevili zájem – navštívili web, dali like, uložili příspěvek.</p>
                    </div>
                </div>
                <div class="mistake-item">
                    <div class="mistake-number">3</div>
                    <div class="mistake-text">
                        <h3 class="mistake-title">Příliš časté zásadní změny v kampaních</h3>
                        <p class="mistake-description">Častá chyba začátečníků – po dvou dnech mění rozpočet, text, publikum i vizuál. Jenže každý větší zásah restartuje fázi učení algoritmu, což brzdí výsledky. Někdy je potřeba nechat kampaň chvíli běžet, aby se stabilizovala.</p>
                    </div>
                </div>
                <div class="mistake-item">
                    <div class="mistake-number">4</div>
                    <div class="mistake-text">
                        <h3 class="mistake-title">Ignorování analýzy a dat</h3>
                        <p class="mistake-description">Reklama se spustí a dál se nic nesleduje. Bez pravidelné kontroly výkonu (např. CTR, CPC, ROAS...) nevíte, co funguje a co ne. Analýza není jen pro experty – i základní čísla pomohou dělat lepší rozhodnutí.</p>
                    </div>
                </div>
                <div class="mistake-item">
                    <div class="mistake-number">5</div>
                    <div class="mistake-text">
                        <h3 class="mistake-title">Reklama bez silné výzvy k akci (CTA)</h3>
                        <p class="mistake-description">Lidé v mnoha případech neudělají nic, pokud jim neřeknete, co mají udělat. „Kup teď", „Zjisti víc", „Stáhni zdarma" – jednoduché výzvy k akci často zásadně ovlivní výsledky. Pokud chybí, může to mít fatální dopad na reklamu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Pojďme spolupracovat</h2>
                <p class="section-subtitle">Máte projekt? Napište mi a domluvíme se na spolupráci</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Kontaktní informace</h3>
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <div class="contact-label">Email</div>
                            <div class="contact-value">j.sokol2007@gmail.com</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div>
                            <div class="contact-label">Telefon</div>
                            <div class="contact-value">604 256 988</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">💼</div>
                        <div>
                            <div class="contact-label">Sociální sítě</div>
                            <div class="social-links">
                                <a href="#" class="social-link">Instagram</a>
                                <a href="#" class="social-link">Facebook</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="contact-form" id="contactForm" method="POST" action="send_email.php">
                    <div id="form-message" style="display: none; margin-bottom: 1rem; padding: 1rem; border-radius: 8px;"></div>
                    <div class="form-group">
                        <label for="name">Jméno</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Předmět</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Zpráva</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit-btn">Odeslat zprávu</button>
                </form>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>

