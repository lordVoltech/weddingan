// JavaScript for interactive features on the landing page

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('button[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');
  
    if (menuButton && mobileMenu) {
      menuButton.addEventListener('click', () => {
        const expanded = menuButton.getAttribute('aria-expanded') === 'true' || false;
        menuButton.setAttribute('aria-expanded', !expanded);
        mobileMenu.classList.toggle('hidden');
      });
    }
  
    // Animate elements on scroll with slide-in from left or right
    const animatedElements = document.querySelectorAll('.animate-slide-left, .animate-slide-right');
  
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
    };
  
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('slide-in');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);
  
    animatedElements.forEach(el => {
      observer.observe(el);
    });
  });
  
  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
  
  // Floating action button animation handled by CSS, but add click event
  const floatingBtn = document.querySelector('.floating-btn');
  if (floatingBtn) {
    floatingBtn.addEventListener('click', () => {
      alert('Hubungi kami untuk bantuan lebih lanjut!');
    });
  }
  
  // Add active class to nav links on scroll
  const navLinks = document.querySelectorAll('.nav-link');
  const sections = Array.from(navLinks).map(link => {
    const href = link.getAttribute('href');
    if (href && href.startsWith('#')) {
      return document.querySelector(href);
    }
    return null;
  });
  
  window.addEventListener('scroll', () => {
    let currentIndex = -1;
    sections.forEach((section, index) => {
      if (section && window.scrollY >= section.offsetTop - 100) {
        currentIndex = index;
      }
    });
    navLinks.forEach((link, index) => {
      if (index === currentIndex) {
        link.classList.add('border-gold', 'text-gold');
      } else {
        link.classList.remove('border-gold', 'text-gold');
      }
    });
  });
  