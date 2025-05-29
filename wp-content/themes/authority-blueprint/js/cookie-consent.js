document.addEventListener('DOMContentLoaded', function() {
  if (!localStorage.getItem('cookieConsent')) {
    var banner = document.createElement('div');
    banner.id = 'cookie-consent-banner';
    banner.style.position = 'fixed';
    banner.style.bottom = '0';
    banner.style.left = '0';
    banner.style.right = '0';
    banner.style.background = '#222';
    banner.style.color = '#fff';
    banner.style.padding = '1em';
    banner.style.zIndex = '9999';
    banner.innerHTML = '<span>This site uses cookies to enhance your experience. <a href="/privacy-policy" style="color:#fff;text-decoration:underline;">Learn more</a>.</span> <button id="cookie-consent-accept" style="margin-left:1em;">Accept</button>';
    document.body.appendChild(banner);
    document.getElementById('cookie-consent-accept').onclick = function() {
      localStorage.setItem('cookieConsent', '1');
      banner.remove();
    };
  }
}); 