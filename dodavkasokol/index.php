    <!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodávka Sokol - Pronájem Citroen Jumper</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Poppins:wght@700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo-wrapper">
                    <?php if (file_exists('logo_nav.png')): ?>
                        <img src="logo_nav.png" alt="Dodávka Sokol" class="logo-img">
                    <?php endif; ?>
                    <h1 class="logo">Dodávka Sokol</h1>
                </div>
                <nav class="nav">
                    <a href="#home" class="nav-link">Domů</a>
                    <a href="#galerie" class="nav-link">Galerie</a>
                    <a href="#specifikace" class="nav-link">Specifikace</a>
                    <a href="#dostupnost" class="nav-link">Dostupnost</a>
                    <a href="#cenik" class="nav-link">Ceník</a>
                    <a href="#kontakt" class="nav-link">Kontakt</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero vyhody-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Pronájem <span class="gradient-text">Citroen Jumper</span>
                </h1>
                <p class="hero-description">
                    Profesionální dodávka pro vaše potřeby. Kapacita 9 osob nebo 13 m³ nákladového prostoru. 
                    Ideální pro stěhování, přepravu zboží nebo skupinové cesty.
                </p>
                <div class="hero-buttons">
                    <a href="#kontakt" class="btn btn-primary">Kontaktujte nás</a>
                    <a href="#specifikace" class="btn btn-secondary">Více informací</a>
                </div>
                <div class="hero-features">
                    <div class="hero-feature">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                        </svg>
                        <span>Rychlé vyzvednutí</span>
                    </div>
                    <div class="hero-feature">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                        </svg>
                        <span>Flexibilní podmínky</span>
                    </div>
                    <div class="hero-feature">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                        </svg>
                        <span>Výhodné ceny</span>
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

    <!-- Galerie -->
    <section id="galerie" class="galerie">
        <div class="container">
            <h2 class="section-title">Galerie</h2>
            <div class="gallery-grid">
                <?php
                $images = ['01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg'];
                foreach ($images as $image) {
                    if (file_exists($image)) {
                        echo '<div class="gallery-item">';
                        echo '<img src="' . htmlspecialchars($image) . '" alt="Citroen Jumper - ' . htmlspecialchars($image) . '" class="gallery-image">';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Specifikace a Ceník -->
    <section id="specifikace" class="specifikace">
        <div class="container">
            <div class="spec-cenik-wrapper">
                <div class="spec-section">
                    <h2 class="section-title">Specifikace vozidla</h2>
                    <div class="spec-list">
                        <div class="spec-item">
                            <span class="spec-label">Kapacita:</span>
                            <span class="spec-value">9 osob</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Nákladový prostor:</span>
                            <span class="spec-value">13 m³</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Spotřeba:</span>
                            <span class="spec-value">8 l/100 km</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Palivo:</span>
                            <span class="spec-value">Diesel</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Převodovka:</span>
                            <span class="spec-value">Manuální</span>
                        </div>
                    </div>
                </div>
                <div class="cenik-section">
                    <h2 class="section-title">Ceník pronájmu</h2>
                    <div class="pricing-card">
                        <h3 class="pricing-title">Krátkodobý pronájem</h3>
                        <div class="pricing-table">
                            <div class="pricing-row">
                                <span class="pricing-period">1-3 dny</span>
                                <span class="pricing-price">1 500 Kč / den</span>
                            </div>
                            <div class="pricing-row">
                                <span class="pricing-period">4-7 dnů</span>
                                <span class="pricing-price">1 400 Kč / den</span>
                            </div>
                            <div class="pricing-row">
                                <span class="pricing-period">8-14 dnů</span>
                                <span class="pricing-price">1 300 Kč / den</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dostupnost -->
    <section id="dostupnost" class="dostupnost">
        <div class="container">
            <h2 class="section-title">Dostupnost</h2>
            <div class="availability-wrapper">
                <div class="availability-calendar">
                    <div class="calendar-header">
                        <button class="calendar-nav" id="prevMonth">‹</button>
                        <h3 class="calendar-month-year" id="currentMonthYear"></h3>
                        <button class="calendar-nav" id="nextMonth">›</button>
                    </div>
                    <div class="calendar-grid" id="calendarGrid"></div>
                    <div class="calendar-legend">
                        <div class="legend-item">
                            <span class="legend-color legend-available"></span>
                            <span>Dostupné</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color legend-reserved"></span>
                            <span>Rezervováno</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color legend-today"></span>
                            <span>Dnes</span>
                        </div>
                    </div>
                </div>
                <div class="availability-info">
                    <h3>Informace o dostupnosti</h3>
                    <p>Kontrolujte dostupnost vozidla v kalendáři. Pro rezervaci nás prosím kontaktujte telefonicky nebo prostřednictvím kontaktního formuláře.</p>
                    <div class="availability-features">
                        <div class="feature-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                            </svg>
                            <span>Rychlá rezervace</span>
                        </div>
                        <div class="feature-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                            </svg>
                            <span>Aktuální stav</span>
                        </div>
                        <div class="feature-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                            </svg>
                            <span>Flexibilní podmínky</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Kontakt -->
    <section id="kontakt" class="kontakt">
        <div class="container">
            <h2 class="section-title">Kontakt</h2>
            <div class="contact-wrapper">
                <div class="contact-content">
                    <div class="contact-map-section">
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2558.5!2d15.123456!3d50.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470d8b1234567890%3A0x1234567890abcdef!2sN%C4%9Bm%C4%8Dice%2023%2C%20533%2052%20N%C4%9Bm%C4%8Dice!5e0!3m2!1scs!2scz!4v1234567890123!5m2!1scs!2scz" 
                                width="100%" 
                                height="100%" 
                                style="border:0; border-radius: 12px;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Mapa - Autodílna Sokol, Němčice 23">
                            </iframe>
                        </div>
                    </div>
                    <div class="contact-form-section">
                        <form id="contactForm" class="contact-form">
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
                            <button type="submit" class="btn-submit">Odeslat zprávu</button>
                            <div id="formMessage" class="form-message"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-main">
                    <div class="footer-section">
                        <?php if (file_exists('logo_footer.png')): ?>
                            <img src="logo_footer.png" alt="Dodávka Sokol" class="footer-logo">
                        <?php endif; ?>
                    </div>
                    <div class="footer-section">
                        <h4 class="footer-heading">Kontakt</h4>
                        <div class="footer-contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a href="mailto:info@dodavkasokol.cz" class="footer-contact-link">info@dodavkasokol.cz</a>
                        </div>
                        <div class="footer-contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 5C3 3.89543 3.89543 3 5 3H8.27924C8.70967 3 9.09181 3.27543 9.22792 3.68377L10.7257 8.17721C10.8831 8.64932 10.6694 9.16531 10.2243 9.38787L7.96701 10.5165C9.06925 12.9612 11.0388 14.9308 13.4835 16.033L14.6121 13.7757C14.8347 13.3306 15.3507 13.1169 15.8228 13.2743L20.3162 14.7721C20.7246 14.9082 21 15.2903 21 15.7208V19C21 20.1046 20.1046 21 19 21H18C9.71573 21 3 14.2843 3 6V5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a href="tel:+420123456789" class="footer-contact-link">+420 123 456 789</a>
                        </div>
                        <p class="footer-text">Němčice 23, 533 52 Němčice</p>
                    </div>
                    <div class="footer-section">
                        <h4 class="footer-heading">Navigace</h4>
                        <nav class="footer-nav">
                            <a href="#home" class="footer-link">Domů</a>
                            <a href="#galerie" class="footer-link">Galerie</a>
                            <a href="#specifikace" class="footer-link">Specifikace</a>
                            <a href="#dostupnost" class="footer-link">Dostupnost</a>
                            <a href="#cenik" class="footer-link">Ceník</a>
                            <a href="#kontakt" class="footer-link">Kontakt</a>
                        </nav>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; <?php echo date('Y'); ?> Dodávka Sokol. Všechna práva vyhrazena.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Gallery lightbox
        document.querySelectorAll('.gallery-image').forEach(img => {
            img.addEventListener('click', function() {
                const lightbox = document.createElement('div');
                lightbox.className = 'lightbox';
                lightbox.innerHTML = `
                    <span class="lightbox-close">&times;</span>
                    <img src="${this.src}" alt="${this.alt}">
                `;
                document.body.appendChild(lightbox);
                
                lightbox.querySelector('.lightbox-close').addEventListener('click', () => {
                    lightbox.remove();
                });
                lightbox.addEventListener('click', (e) => {
                    if (e.target === lightbox) {
                        lightbox.remove();
                    }
                });
            });
        });

        // Contact form handling
        const contactForm = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');
        
        if (contactForm) {
            contactForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('.btn-submit');
                const originalText = submitButton.textContent;
                
                // Disable button and show loading
                submitButton.disabled = true;
                submitButton.textContent = 'Odesílám...';
                formMessage.textContent = '';
                formMessage.className = 'form-message';
                
                try {
                    const response = await fetch('contact.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        formMessage.textContent = data.message;
                        formMessage.className = 'form-message form-message-success';
                        contactForm.reset();
                    } else {
                        formMessage.textContent = data.message;
                        formMessage.className = 'form-message form-message-error';
                    }
                } catch (error) {
                    formMessage.textContent = 'Chyba při odesílání zprávy. Zkuste to prosím později.';
                    formMessage.className = 'form-message form-message-error';
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                    
                    // Scroll to message
                    formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            });
        }

        // Calendar functionality
        let currentDate = new Date();
        const monthNames = ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'];
        const dayNames = ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So'];
        
        // Example reserved dates (in production, this would come from a database)
        const reservedDates = [
            '2025-01-15',
            '2025-01-16',
            '2025-01-20',
            '2025-02-05',
            '2025-02-06',
            '2025-02-07'
        ];
        
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            document.getElementById('currentMonthYear').textContent = `${monthNames[month]} ${year}`;
            
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const daysInMonth = lastDay.getDate();
            const startingDayOfWeek = firstDay.getDay();
            
            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = '';
            
            // Day headers
            dayNames.forEach(day => {
                const dayHeader = document.createElement('div');
                dayHeader.className = 'calendar-day-header';
                dayHeader.textContent = day;
                calendarGrid.appendChild(dayHeader);
            });
            
            // Empty cells for days before month starts
            for (let i = 0; i < startingDayOfWeek; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day empty';
                calendarGrid.appendChild(emptyCell);
            }
            
            // Days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'calendar-day';
                
                const date = new Date(year, month, day);
                const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                
                if (date < today) {
                    dayCell.classList.add('past');
                } else if (reservedDates.includes(dateString)) {
                    dayCell.classList.add('reserved');
                } else {
                    dayCell.classList.add('available');
                }
                
                if (date.toDateString() === today.toDateString()) {
                    dayCell.classList.add('today');
                }
                
                dayCell.textContent = day;
                calendarGrid.appendChild(dayCell);
            }
        }
        
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });
        
        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });
        
        renderCalendar();
    </script>
</body>
</html>

