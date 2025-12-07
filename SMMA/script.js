// Mobile Menu Toggle
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('.nav-menu');

if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
    });

    // Close menu when clicking on a link
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            menuToggle.classList.remove('active');
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
            navMenu.classList.remove('active');
            menuToggle.classList.remove('active');
        }
    });
}

// Navbar scroll effect and active link highlighting
const navbar = document.querySelector('.navbar');
const navLinks = document.querySelectorAll('.nav-menu a');
const sections = document.querySelectorAll('section[id]');

if (navbar) {
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Highlight active section in navigation
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (currentScroll >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href && href.includes('#' + current)) {
                link.classList.add('active');
            }
        });
    });
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        
        if (target) {
            const offsetTop = target.offsetTop - 80; // Account for fixed navbar
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// Form submission - počkat na načtení DOM
console.log('Script.js se načítá...');

document.addEventListener('DOMContentLoaded', function() {
    console.log('=== DOM NAČTEN, HLEDÁM FORMULÁŘ ===');
    
    const contactForm = document.querySelector('.contact-form');
    const formMessage = document.getElementById('form-message');
    const submitBtn = document.getElementById('submit-btn');

    console.log('Formulář:', contactForm);
    console.log('Form message:', formMessage);
    console.log('Submit btn:', submitBtn);

    if (!contactForm) {
        console.error('Kontaktní formulář nenalezen!');
        return;
    }

    if (!formMessage) {
        console.error('Element form-message nenalezen!');
        return;
    }

    if (!submitBtn) {
        console.error('Tlačítko submit-btn nenalezeno!');
        return;
    }
    
    console.log('Všechny elementy nalezeny, přidávám event listener...');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        console.log('=== FORMULÁŘ SE ODESÍLÁ ===');
        
        // Skrýt předchozí zprávu
        formMessage.style.display = 'none';
        
        // Deaktivovat tlačítko
        submitBtn.disabled = true;
        submitBtn.textContent = 'Odesílám...';
        
        // Získat data z formuláře
        const formData = new FormData(contactForm);
        
        console.log('Odesílám data na send_email.php...');
        
        // Odeslat data na server
        fetch('send_email.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Odpověď přijata, status:', response.status);
            if (!response.ok) {
                throw new Error('HTTP error! status: ' + response.status);
            }
            return response.text(); // Nejdřív jako text, pak zkusíme JSON
        })
        .then(text => {
            console.log('Odpověď:', text);
            try {
                const data = JSON.parse(text);
                // Zobrazit zprávu
                formMessage.style.display = 'block';
                formMessage.innerHTML = data.message;
                
                if (data.success) {
                    // Přesměrovat na stránku s potvrzením
                    window.location.href = 'success.php';
                    return;
                } else {
                    formMessage.style.backgroundColor = '#f8d7da';
                    formMessage.style.color = '#721c24';
                    formMessage.style.border = '1px solid #f5c6cb';
                }
            } catch (e) {
                console.error('Chyba při parsování JSON:', e);
                console.error('Odpověď serveru:', text);
                formMessage.style.display = 'block';
                formMessage.style.backgroundColor = '#f8d7da';
                formMessage.style.color = '#721c24';
                formMessage.style.border = '1px solid #f5c6cb';
                formMessage.innerHTML = 'Chyba při zpracování odpovědi serveru. Zkontrolujte konzoli prohlížeče.';
            }
            
            // Aktivovat tlačítko zpět
            submitBtn.disabled = false;
            submitBtn.textContent = 'Odeslat zprávu';
        })
        .catch(error => {
            console.error('Chyba:', error);
            // Zobrazit chybovou zprávu
            formMessage.style.display = 'block';
            formMessage.style.backgroundColor = '#f8d7da';
            formMessage.style.color = '#721c24';
            formMessage.style.border = '1px solid #f5c6cb';
            formMessage.innerHTML = 'Omlouvám se, došlo k chybě při odesílání zprávy. Zkuste to prosím znovu. (Chyba: ' + error.message + ')';
            
            // Aktivovat tlačítko zpět
            submitBtn.disabled = false;
            submitBtn.textContent = 'Odeslat zprávu';
        });
    });
});

// Intersection Observer for fade-in animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const animateElements = document.querySelectorAll('.service-card, .portfolio-item, .testimonial-card');
    
    animateElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(el);
    });
});

// Add active state to navigation links based on scroll position
const sections = document.querySelectorAll('section[id]');

window.addEventListener('scroll', () => {
    const scrollY = window.pageYOffset;
    
    sections.forEach(section => {
        const sectionHeight = section.offsetHeight;
        const sectionTop = section.offsetTop - 100;
        const sectionId = section.getAttribute('id');
        
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            document.querySelectorAll('.nav-menu a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }
    });
});

// Add parallax effect to hero shapes
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const shapes = document.querySelectorAll('.shape');
    
    shapes.forEach((shape, index) => {
        const speed = 0.5 + (index * 0.1);
        shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
    });
});

