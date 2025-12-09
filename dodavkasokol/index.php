    <!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodavka Sokol - Pronájem Citroen Jumper</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="logo">Dodavka Sokol</h1>
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

    <!-- Hero Section - Výhody -->
    <section id="home" class="hero vyhody-hero">
        <div class="container">
            <div class="vyhody-grid">
                <div class="vyhody-card vyhody-card-blue">
                    <div class="vyhody-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="6" width="16" height="10" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                            <rect x="6" y="8" width="4" height="3" rx="0.5" stroke="currentColor" stroke-width="1.5" fill="none"/>
                            <rect x="5" y="4" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2" fill="none" opacity="0.7" transform="translate(2 2)"/>
                            <rect x="7" y="6" width="4" height="3" rx="0.5" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.7" transform="translate(2 2)"/>
                        </svg>
                    </div>
                    <h3 class="vyhody-title">Rychlé vyzvednutí</h3>
                    <p class="vyhody-text">Smlouvu máme pro Vás již připravenou</p>
                </div>
                <div class="vyhody-card vyhody-card-green">
                    <div class="vyhody-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4C11.4 4 11 4.4 11 5V7C11 7.6 11.4 8 12 8C12.6 8 13 7.6 13 7V5C13 4.4 12.6 4 12 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M10 7L12 9L14 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="6" y="10" width="12" height="8" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M8 14H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="9" cy="18" r="1.5" fill="currentColor"/>
                            <circle cx="15" cy="18" r="1.5" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3 class="vyhody-title">Cesta k pronájmu</h3>
                    <p class="vyhody-text">Cesta k pronájmu je u nás velmi jednoduchá</p>
                </div>
                <div class="vyhody-card vyhody-card-brown">
                    <div class="vyhody-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 17H19L17 19H7L5 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 17V9C19 7.9 18.1 7 17 7H7C5.9 7 5 7.9 5 9V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7 7V5C7 3.9 7.9 3 9 3H15C16.1 3 17 3.9 17 5V7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="3" y="17" width="18" height="2" fill="currentColor"/>
                            <circle cx="8" cy="17" r="1.5" fill="currentColor"/>
                            <circle cx="16" cy="17" r="1.5" fill="currentColor"/>
                            <rect x="6" y="5" width="12" height="2" rx="1" fill="currentColor" opacity="0.8"/>
                        </svg>
                    </div>
                    <h3 class="vyhody-title">Jednoduchost</h3>
                    <p class="vyhody-text">S námi je rezervace jednoduchá</p>
                </div>
            </div>
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

    <!-- Specifikace -->
    <section id="specifikace" class="specifikace">
        <div class="container">
            <h2 class="section-title">Specifikace vozidla</h2>
            <div class="spec-grid">
                <div class="spec-card">
                    <div class="spec-icon">👥</div>
                    <h3>Kapacita</h3>
                    <p class="spec-value">9 osob</p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">📦</div>
                    <h3>Nákladový prostor</h3>
                    <p class="spec-value">13 m³</p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">⛽</div>
                    <h3>Spotřeba</h3>
                    <p class="spec-value">8 l/100 km</p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">🛢️</div>
                    <h3>Palivo</h3>
                    <p class="spec-value">Diesel</p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">⚙️</div>
                    <h3>Převodovka</h3>
                    <p class="spec-value">Manuální</p>
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

    <!-- Ceník -->
    <section id="cenik" class="cenik">
        <div class="container">
            <h2 class="section-title">Ceník pronájmu</h2>
            <div class="pricing-wrapper">
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
                <div class="pricing-card pricing-card-featured">
                    <h3 class="pricing-title">Dlouhodobý pronájem</h3>
                    <div class="pricing-table">
                        <div class="pricing-row">
                            <span class="pricing-period">15-30 dnů</span>
                            <span class="pricing-price">1 200 Kč / den</span>
                        </div>
                        <div class="pricing-row pricing-row-featured">
                            <span class="pricing-period">31 a více dnů</span>
                            <span class="pricing-price">1 000 Kč / den</span>
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
                <?php if (file_exists('logo.png')): ?>
                    <img src="logo.png" alt="Dodavka Sokol" class="footer-logo">
                <?php endif; ?>
                <p>&copy; <?php echo date('Y'); ?> Dodavka Sokol. Všechna práva vyhrazena.</p>
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

