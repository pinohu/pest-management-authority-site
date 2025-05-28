document.addEventListener('DOMContentLoaded', function() {
  var menuToggle = document.querySelector('.menu-toggle');
  var nav = document.getElementById('primary-menu');

  if (!menuToggle || !nav) return;

  menuToggle.addEventListener('click', function() {
    var expanded = menuToggle.getAttribute('aria-expanded') === 'true';
    menuToggle.setAttribute('aria-expanded', !expanded);
    nav.hidden = expanded;
  });

  // Close menu on outside click (mobile UX)
  document.addEventListener('click', function(e) {
    if (!nav.contains(e.target) && !menuToggle.contains(e.target)) {
      nav.hidden = true;
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });

  // Lazy loading for images (IntersectionObserver)
  var lazyImages = document.querySelectorAll('img.lazy-image');
  if ('IntersectionObserver' in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          if (lazyImage.dataset.srcset) {
            lazyImage.srcset = lazyImage.dataset.srcset;
          }
          if (lazyImage.dataset.sizes) {
            lazyImage.sizes = lazyImage.dataset.sizes;
          }
          lazyImage.classList.add('loaded');
          lazyImageObserver.unobserve(lazyImage);
        }
      });
    });
    lazyImages.forEach(function(lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });
  }
}); 