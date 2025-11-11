
(function () {
  "use strict";
/**
   * FINAL & CORRECTED: Auto-Animation for Desktop, Click for Mobile - V9
   */
  document.addEventListener('DOMContentLoaded', () => {
    const logoContainer = document.getElementById('logo-menu-toggler');
    const body = document.body;
    if (!logoContainer) return;

    let animationInterval = null;

    const controlAnimation = () => {
      // --- Desktop Logic ---
      if (window.innerWidth < 991) {
        // Ensure menu-related classes are removed on desktop
        logoContainer.classList.remove('is-flipped');

        // Start animation only if it's not already running
        if (!animationInterval) {
          animationInterval = setInterval(() => {
            // Do not flip if the user is hovering over it
            if (!logoContainer.matches(':hover')) {
              logoContainer.classList.toggle('is-flipped');
            }
          }, 4000); // Flip every 4 seconds
        }
      } 
      // --- Mobile Logic ---
      else {
        // Stop any running animation if screen is resized to mobile
        if (animationInterval) {
          clearInterval(animationInterval);
          animationInterval = null;
        }
        // Sync the icon with the menu state on resize
        if (body.classList.contains('mobile-nav-active')) {
          logoContainer.classList.add('is-flipped');
        } else {
          logoContainer.classList.remove('is-flipped');
        }
      }
    };

    // Click handler ONLY for mobile
    logoContainer.addEventListener('click', (e) => {
      if (window.innerWidth <= 991) {
        e.preventDefault();
        body.classList.toggle('mobile-nav-active');

        // THIS IS THE FIX: The flip should now correctly follow the menu state
        if (body.classList.contains('mobile-nav-active')) {
          logoContainer.classList.add('is-flipped'); // Show 'X' when menu is active
        } else {
          logoContainer.classList.remove('is-flipped'); // Show Logo when menu is closed
        }
      }
    });

    // Run the logic when the page loads and when the window is resized
    window.addEventListener('resize', controlAnimation);
    controlAnimation(); // Initial run
  });
  /**
   * Helper Functions
   */
  const select = (el, all = false) => el.trim() ? (all ? [...document.querySelectorAll(el)] : document.querySelector(el)) : null;
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all);
    if (selectEl) {
      if (all) selectEl.forEach(e => e.addEventListener(type, listener));
      else selectEl.addEventListener(type, listener);
    }
  };
  const onscroll = (el, listener) => el.addEventListener('scroll', listener);
  const scrollto = (el) => {
    let header = select('#header');
    let offset = header.offsetHeight;
    if (!header.classList.contains('header-scrolled')) offset -= 20;
    let elementPos = select(el).offsetTop;
    window.scrollTo({ top: elementPos - offset, behavior: 'smooth' });
  };

  /**
   * Header scroll class
   */
  let selectHeader = select('#header');
  if (selectHeader) {
    const headerScrolled = () => window.scrollY > 100 ? selectHeader.classList.add('header-scrolled') : selectHeader.classList.remove('header-scrolled');
    window.addEventListener('load', headerScrolled);
    onscroll(document, headerScrolled);
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top');
  if (backtotop) {
    const toggleBacktotop = () => window.scrollY > 100 ? backtotop.classList.add('active') : backtotop.classList.remove('active');
    window.addEventListener('load', toggleBacktotop);
    onscroll(document, toggleBacktotop);
  }

  /**
   * BEYOND IMAGINATION: 3D Tilt Effect for Services and Team sections
   */
  function init3DTiltEffect() {
    const tiltElements = document.querySelectorAll('.services .icon-box, .team .celestial-profile');
    tiltElements.forEach(element => {
      element.addEventListener('mousemove', (e) => {
        const rect = element.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const width = element.offsetWidth;
        const height = element.offsetHeight;
        const rotateX = -((height / 2) - y) / 20;
        const rotateY = ((width / 2) - x) / 20;
        element.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
        if (element.classList.contains('icon-box')) {
          element.style.setProperty('--mouse-x', `${x}px`);
          element.style.setProperty('--mouse-y', `${y}px`);
        }
      });
      element.addEventListener('mouseleave', () => {
        element.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
      });
    });
  }

  /**
   * BEYOND IMAGINATION: Spotlight Effect for Features section
   */
  function initFeaturesSpotlight() {
    const featuresSection = document.querySelector('#features');
    if (featuresSection) {
      featuresSection.addEventListener('mousemove', e => {
        const rect = featuresSection.getBoundingClientRect();
        featuresSection.style.setProperty('--mouse-x', (e.clientX - rect.left) + 'px');
        featuresSection.style.setProperty('--mouse-y', (e.clientY - rect.top) + 'px');
      });
    }
  }

  /**
   * Main DOMContentLoaded listener for all page-specific scripts
   */
  document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('particle-canvas');
    if (canvas) {
      const ctx = canvas.getContext('2d');
      let particles = [];
      const particleCount = 70;
      const setCanvasSize = () => { canvas.width = window.innerWidth; canvas.height = window.innerHeight; };
      setCanvasSize();
      class Particle {
        constructor() { this.x = Math.random() * canvas.width; this.y = Math.random() * canvas.height; this.vx = (Math.random() - 0.5) * 0.3; this.vy = (Math.random() - 0.5) * 0.3; this.radius = Math.random() * 1.5 + 0.5; }
        draw() { ctx.beginPath(); ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2); ctx.fillStyle = 'rgba(138, 79, 255, 0.7)'; ctx.fill(); }
        update() { this.x += this.vx; this.y += this.vy; if (this.x < 0 || this.x > canvas.width) this.vx *= -1; if (this.y < 0 || this.y > canvas.height) this.vy *= -1; }
      }
      const init = () => { particles = []; for (let i = 0; i < particleCount; i++) particles.push(new Particle()); };
      const connectParticles = () => {
        for (let i = 0; i < particles.length; i++) {
          for (let j = i + 1; j < particles.length; j++) {
            const distance = Math.sqrt(Math.pow(particles[i].x - particles[j].x, 2) + Math.pow(particles[i].y - particles[j].y, 2));
            if (distance < 120) { ctx.beginPath(); ctx.moveTo(particles[i].x, particles[i].y); ctx.lineTo(particles[j].x, particles[j].y); ctx.strokeStyle = `rgba(138, 79, 255, ${1 - distance / 120})`; ctx.lineWidth = 0.5; ctx.stroke(); }
          }
        }
      };
      const animate = () => { ctx.clearRect(0, 0, canvas.width, canvas.height); particles.forEach(p => { p.update(); p.draw(); }); connectParticles(); requestAnimationFrame(animate); };
      window.addEventListener('resize', () => { setCanvasSize(); init(); });
      init(); animate();
    }
    init3DTiltEffect();
    initFeaturesSpotlight();

    // NEW: Interactive "About Us" Section Logic
    const aboutContainer = document.querySelector('.about-us-container');
    if (aboutContainer) {
      const nodes = aboutContainer.querySelectorAll('.neural-node');
      const resetNodes = (exceptNode = null) => {
        aboutContainer.classList.remove('node-active-mode');
        nodes.forEach(n => {
          if (n !== exceptNode) {
            n.classList.remove('active');
          }
        });
      };
      nodes.forEach(node => {
        const closeBtn = node.querySelector('.close-node-btn');
        node.addEventListener('click', (e) => {
          if ((closeBtn && closeBtn.contains(e.target)) || node.classList.contains('active')) {
            return;
          }
          resetNodes(node);
          aboutContainer.classList.add('node-active-mode');
          node.classList.add('active');
        });
        if (closeBtn) {
          closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            resetNodes();
          });
        }
      });
    }

    // MERGED: Project Showcase & Slideshow Logic
    const portalShowcase = document.querySelector('#portal-showcase');
    if (portalShowcase && portalShowcase.dataset.projects) {
      const allProjectsData = JSON.parse(portalShowcase.dataset.projects);
      const currentLang = portalShowcase.dataset.lang;
      const grid = portalShowcase.querySelector('.portal-grid');
      const slideshow = document.querySelector('.portal-slideshow');
      const slideshowTrack = slideshow.querySelector('.slideshow-track');
      const closeBtn = slideshow.querySelector('.slideshow-close-btn');
      const nextBtn = slideshow.querySelector('.slideshow-nav.next');
      const prevBtn = slideshow.querySelector('.slideshow-nav.prev');
      const htmlEl = document.documentElement;

      if (!grid || !slideshow || allProjectsData.length === 0) return;

      const slideElements = allProjectsData.map(product => {
        const slide = document.createElement('div');
        slide.className = 'slideshow-slide';
        slide.dataset.productId = product.id;
        const productName = (currentLang === 'ar' && product.name_ar) ? product.name_ar : product.name;
        const productDesc = (currentLang === 'ar' && product.description_ar) ? product.description_ar : (product.description || '');
        const categories = product.category_names || '';
        const visitText = currentLang === 'ar' ? 'زيارة الموقع' : 'Visit Website';
        slide.innerHTML = `
            <div class="slide-bg-container">
                <div class="slide-bg" style="background-image: url('assets/img/portfolio/${product.image}');"></div>
            </div>
            <div class="slide-details">
                <div class="container">
                    <span class="slide-category">${categories}</span>
                    <h2 class="slide-title">${productName}</h2>
                    ${(product.details_url && product.details_url !== '#') ? `<a href="${product.details_url}" class="slide-link" target="_blank">${visitText}</a>` : ''}
                    <div class="slide-thumbnails-container"></div>
                </div>
            </div>
        `;
        return slide;
      });
      slideshowTrack.append(...slideElements);

      let currentIndex = 0;
      let isAnimating = false;

      async function loadThumbnailsForSlide(slideElement) {
        if (slideElement.dataset.imagesLoaded === 'true') return;
        const productId = slideElement.dataset.productId;
        const mainImage = allProjectsData.find(p => p.id == productId).image;
        const thumbnailsContainer = slideElement.querySelector('.slide-thumbnails-container');
        thumbnailsContainer.innerHTML = '<span>Loading...</span>';
        try {
          const response = await fetch(`project/get_product_images.php?id=${productId}`);
          if (!response.ok) throw new Error('Network response was not ok');
          const additionalImages = await response.json();
          const allImages = [mainImage, ...additionalImages];
          thumbnailsContainer.innerHTML = '';
          if (allImages.length > 1) {
            thumbnailsContainer.innerHTML = allImages.map((img, index) => `
              <div class="thumbnail-item ${index === 0 ? 'is-active' : ''}" style="background-image: url('assets/img/portfolio/${img}');" data-src="assets/img/portfolio/${img}"></div>
            `).join('');
          }
          slideElement.dataset.imagesLoaded = 'true';
        } catch (error) {
          console.error('Failed to fetch additional images:', error);
          thumbnailsContainer.innerHTML = '<span>Failed to load images.</span>';
        }
      }

      function updateSlideshow(newIndex, direction) {
        if (isAnimating) return;
        isAnimating = true;
        const oldIndex = currentIndex;
        currentIndex = (newIndex + slideElements.length) % slideElements.length;
        const oldSlide = slideElements[oldIndex];
        const newSlide = slideElements[currentIndex];
        loadThumbnailsForSlide(newSlide);
        const inClass = direction === 'next' ? 'slide-in-next' : 'slide-in-prev';
        const outClass = direction === 'next' ? 'slide-out-next' : 'slide-out-prev';
        newSlide.classList.add('is-active', inClass);
        oldSlide.classList.add(outClass);
        setTimeout(() => {
          oldSlide.classList.remove('is-active', outClass);
          newSlide.classList.remove(inClass);
          isAnimating = false;
        }, 600);
      }

      function openSlideshow(startIndex) {
        currentIndex = startIndex;
        const firstSlide = slideElements[startIndex];
        slideElements.forEach((slide, index) => slide.classList.toggle('is-active', index === startIndex));
        loadThumbnailsForSlide(firstSlide);
        htmlEl.classList.add('slideshow-open');
      }

      function closeSlideshow() { htmlEl.classList.remove('slideshow-open'); }

      nextBtn.addEventListener('click', () => updateSlideshow(currentIndex + 1, 'next'));
      prevBtn.addEventListener('click', () => updateSlideshow(currentIndex - 1, 'prev'));
      grid.querySelectorAll('.portal-card').forEach(card => card.addEventListener('click', () => openSlideshow(parseInt(card.dataset.index, 10))));
      closeBtn.addEventListener('click', closeSlideshow);
      slideshowTrack.addEventListener('click', (e) => {
        if (e.target.classList.contains('thumbnail-item')) {
          const clickedThumbnail = e.target;
          const activeSlide = slideshowTrack.querySelector('.slideshow-slide.is-active');
          if (!activeSlide) return;
          const newImageSrc = clickedThumbnail.dataset.src;
          const slideBg = activeSlide.querySelector('.slide-bg');
          slideBg.style.backgroundImage = `url('${newImageSrc}')`;
          const parentContainer = clickedThumbnail.parentElement;
          parentContainer.querySelector('.thumbnail-item.is-active')?.classList.remove('is-active');
          clickedThumbnail.classList.add('is-active');
        }
      });
    }
  });

  /**
  * NEW & CORRECTED Mobile Navigation Logic
  */
  const mobileNavContainer = document.createElement('div');
  mobileNavContainer.classList.add('navbar-mobile');
  select('#header').appendChild(mobileNavContainer);

  if (mobileNavContainer) {
    const navClone = select('#navbar ul').cloneNode(true);

    const langDropdownClone = navClone.querySelector('.language-dropdown-desktop');

    if (langDropdownClone) {
      langDropdownClone.remove();
    }

    const navContent = navClone.innerHTML;

    mobileNavContainer.innerHTML = `<div class="navbar-mobile-content"><ul>${navContent}</ul></div>`;
  }

 /**
   * CORRECTED: Mobile Navigation Logic
   */
  

  on('click', '.language-toggle-mobile', function (e) {
    e.stopPropagation();
    this.classList.toggle('active');
  });

  on('click', 'body', function (e) {
    const langToggle = select('.language-toggle-mobile');
    if (langToggle && !langToggle.contains(e.target)) {
      langToggle.classList.remove('active');
    }
  });

  on('click', '.navbar-mobile a', function (e) {
    if (this.hash && select(this.hash)) {
      e.preventDefault();
      select('body').classList.remove('mobile-nav-active');
      scrollto(this.hash);
    }
  }, true);


  const closeMenuOnScroll = () => {
    const body = select('body');
    if (body.classList.contains('mobile-nav-active')) {
      body.classList.remove('mobile-nav-active');

      const langToggle = select('.language-toggle-mobile');
      if (langToggle && langToggle.classList.contains('active')) {
        langToggle.classList.remove('active');
      }
    }
  };
  
  onscroll(document, closeMenuOnScroll);

  /**
   * Logic to run after page has fully loaded
   */
  window.addEventListener('load', () => {
    let preloader = select('#preloader');
    if (preloader) {
      const animationDisplayTime = 1500;
      setTimeout(() => {
        preloader.classList.add('preloader-hidden');
        setTimeout(() => { preloader.remove(); }, 600);
      }, animationDisplayTime);
    }
    if (window.location.hash && select(window.location.hash)) { scrollto(window.location.hash); }
    AOS.init({ duration: 1000, easing: 'ease-in-out', once: true, mirror: false });

    /**
     * Team Swiper initialization
     */
    new Swiper('.team-slider', {
      speed: 600,
      loop: true,
      autoplay: { delay: 5000, disableOnInteraction: false },
      slidesPerView: 'auto',
      pagination: { el: '#team .swiper-pagination', clickable: true },
      spaceBetween: 30,
      breakpoints: {
        320: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 30 },
        1200: { slidesPerView: 4, spaceBetween: 40 }
      }
    });
  });

  /**
   * Contact Page Animated Swap logic
   */
  const show_info_btn = select("#show-info-btn");
  const show_form_btn = select("#show-form-btn");
  const contactContainer = select(".contact-page-container");
  if (contactContainer && show_info_btn && show_form_btn) {
    show_info_btn.addEventListener('click', () => contactContainer.classList.add("show-info-mode"));
    show_form_btn.addEventListener('click', () => contactContainer.classList.remove("show-info-mode"));
  }

  /**
   * AJAX handler for the Animated Contact Form
   */
  const animatedContactForm = select('#contact .animated-contact-form');
  if (animatedContactForm) {
    animatedContactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      let form = this;
      let loading = form.querySelector('.my-3 .loading');
      let errorMessage = form.querySelector('.my-3 .error-message');
      let sentMessage = form.querySelector('.my-3 .sent-message');
      loading.style.display = 'block';
      errorMessage.style.display = 'none';
      sentMessage.style.display = 'none';
      fetch(form.action, {
        method: form.method,
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
        .then(response => {
          if (response.ok) return response.text();
          else return response.text().then(text => { throw new Error(text || 'Server responded with an error.'); });
        })
        .then(data => {
          loading.style.display = 'none';
          sentMessage.style.display = 'block';
          form.reset();
        })
        .catch(error => {
          loading.style.display = 'none';
          errorMessage.textContent = error.message;
          errorMessage.style.display = 'block';
        })
        .finally(() => {
          setTimeout(() => {
            sentMessage.style.display = 'none';
            errorMessage.style.display = 'none';
          }, 3000);
        });
    });
  }
  /**
   * FINAL & PRECISE: Looping Projectile to the SVG Starting Point
   */
  document.addEventListener('DOMContentLoaded', () => {
    // 1. Get all necessary elements
    const headerLogo = document.querySelector('#logo-menu-toggler .header-logo-svg');
    const heroLogoContainer = document.querySelector('.hero-logo-container');
    const heroAnimatedSvg = document.querySelector('.hero-animated-svg');
    const heroLogoPath = document.querySelector('.hero-logo-path'); // The path itself
    
    // Check if all elements exist to prevent errors
    if (!headerLogo || !heroLogoContainer || !heroAnimatedSvg || !heroLogoPath) {
      console.error('Required elements for projectile animation not found.');
      if (heroLogoContainer) heroLogoContainer.classList.add('animate');
      return;
    }

    // 2. Create the projectile element
    const projectile = document.createElement('div');
    projectile.id = 'light-projectile';
    document.body.appendChild(projectile);

    // 3. The function to launch the projectile
    function launchProjectile() {
      // --- Calculate Start Point (Header Logo) ---
      const startRect = headerLogo.getBoundingClientRect();
      const startX = startRect.left + (startRect.width / 2);
      const startY = startRect.top + (startRect.height / 2);

      // --- Calculate End Point (SVG Path Start) ---
      // This is the core of the new logic
      const svgRect = heroAnimatedSvg.getBoundingClientRect(); // SVG position on screen
      const viewBox = heroAnimatedSvg.viewBox.baseVal;         // SVG internal coordinate system
      const pathStartPoint = heroLogoPath.getPointAtLength(0); // The very first point of the path {x, y}

      // Convert the path's internal coordinates to a screen position
      // a. Find the ratio of the start point within the viewBox
      const xRatio = (pathStartPoint.x - viewBox.x) / viewBox.width;
      const yRatio = (pathStartPoint.y - viewBox.y) / viewBox.height;
      // b. Apply that ratio to the SVG's actual size and position on the screen
      let targetX = svgRect.left + (xRatio * svgRect.width);
      let targetY = svgRect.top + (yRatio * svgRect.height);

      // c. Center the projectile on the target point
      const projectileSize = 25; // from CSS
      targetX -= (projectileSize / 2);
      targetY -= (projectileSize / 2);
      
      // --- The Animation Sequence ---
      
      // Instantly position the projectile at the start point (hidden)
      projectile.style.transition = 'none';
      projectile.style.opacity = '0';
      projectile.style.left = `${startX}px`;
      projectile.style.top = `${startY}px`;
      
      setTimeout(() => {
        // Now, add back the transition and launch towards the precise target
        projectile.style.transition = 'top 1.2s cubic-bezier(0.6, -0.28, 0.73, 0.04), left 1.2s cubic-bezier(0.3, 0.5, 0.8, 1), opacity 0.5s';
        projectile.style.opacity = '1';
        projectile.style.left = `${targetX}px`;
        projectile.style.top = `${targetY}px`;
      }, 50);

      setTimeout(() => {
        projectile.style.opacity = '0';
        if (!heroLogoContainer.classList.contains('animate')) {
          heroLogoContainer.classList.add('animate');
        }
      }, 1250);
    }

    // 4. Create the main loop
    function startAnimationLoop() {
        launchProjectile();
        setInterval(launchProjectile, 6000); // Re-launch every 6 seconds
    }

    // 5. Start after preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
      setTimeout(startAnimationLoop, 2000);
    } else {
      setTimeout(startAnimationLoop, 500);
    }
  });


  /**
   * Cosmic Data Stream Footer - Astonishing Level
   */
  (function() {
    const canvas = document.getElementById('cosmic-canvas');
    if (!canvas) return;
    

    const ctx = canvas.getContext('2d');
    let particles = [];
    const particleCount = 200;
    let mouse = { x: null, y: null, radius: 150 };

    function setCanvasSize() {
      canvas.width = canvas.offsetWidth;
      canvas.height = canvas.offsetHeight;
    }

    class Particle {
      constructor() {
        this.x = Math.random() * canvas.width;
        this.y = canvas.height + Math.random() * 100; // Start below the canvas
        this.baseY = this.y;
        this.radius = Math.random() * 1.5 + 1;
        this.speed = Math.random() * -1.5 - 0.5; // Move upwards
        this.density = (Math.random() * 30) + 1;
        this.color = `rgba(138, 79, 255, ${Math.random() * 0.5 + 0.2})`;
      }

      draw() {
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.closePath();
        ctx.fill();
      }

      update() {
        // Repel from mouse
        let dx = mouse.x - this.x;
        let dy = mouse.y - this.y;
        let distance = Math.sqrt(dx * dx + dy * dy);

        if (distance < mouse.radius) {
          let forceDirectionX = dx / distance;
          let forceDirectionY = dy / distance;
          let maxDistance = mouse.radius;
          let force = (maxDistance - distance) / maxDistance;
          let directionX = forceDirectionX * force * this.density;
          let directionY = forceDirectionY * force * this.density;
          
          this.x -= directionX;
          this.y -= directionY;
        }

        // Move upwards
        this.y += this.speed;

        // Reset particle if it goes above the screen
        if (this.y < -10) {
          this.y = canvas.height + 10;
          this.x = Math.random() * canvas.width;
        }
      }
    }

    function init() {
      particles = [];
      for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle());
      }
    }

    function animate() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      for (let i = 0; i < particles.length; i++) {
        particles[i].update();
        particles[i].draw();
      }
      requestAnimationFrame(animate);
    }

    // Event Listeners
    window.addEventListener('resize', () => {
      setCanvasSize();
      init();
    });

    const footer = document.querySelector('.cosmic-footer');
    footer.addEventListener('mousemove', (event) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = event.clientX - rect.left;
        mouse.y = event.clientY - rect.top;
    });

    footer.addEventListener('mouseleave', () => {
        mouse.x = null;
        mouse.y = null;
    });

    // Initial setup
    setCanvasSize();
    init();
    animate();
  })();


  /**
   * The Luminous Touch v3 - Constant Stardust & Parallax
   */
  (function() {
    const luminousCards = document.querySelectorAll('.luminous-card');
    if (!luminousCards.length) return;

    luminousCards.forEach(card => {
      const defaultContent = card.querySelector('.luminous-content.default');
      const glowingContent = card.querySelector('.luminous-content.glowing');

      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        
        // Mouse position relative to the card for clip-path and spotlight
        const x_rel = e.clientX - rect.left;
        const y_rel = e.clientY - rect.top;

        card.style.setProperty('--x-rel', `${x_rel}px`);
        card.style.setProperty('--y-rel', `${y_rel}px`);

        // Parallax effect calculation
        const x_from_center = x_rel - rect.width / 2;
        const y_from_center = y_rel - rect.height / 2;

        // Apply parallax to both content layers
        const moveFactor = 25; // Adjust for more/less intensity
        defaultContent.style.transform = `translateX(${x_from_center / moveFactor}px) translateY(${y_from_center / moveFactor}px)`;
        glowingContent.style.transform = `translateX(${x_from_center / moveFactor}px) translateY(${y_from_center / moveFactor}px)`;
      });
      
      card.addEventListener('mouseleave', () => {
        // Reset parallax effect
        defaultContent.style.transform = 'translateX(0px) translateY(0px)';
        glowingContent.style.transform = 'translateX(0px) translateY(0px)';
      });
    });
  })();
})();



