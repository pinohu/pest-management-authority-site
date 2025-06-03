document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('openai-content-form');
  if (!form) return;
  const resultDiv = document.getElementById('openai-content-result');
  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    const prompt = form.openai_prompt.value.trim();
    if (!prompt) return;
    resultDiv.textContent = 'Generating...';
    try {
      const response = await fetch('/wp-json/ab-mcp/v1/openai-generate', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ prompt }),
      });
      const data = await response.json();
      if (data && data.content) {
        resultDiv.textContent = data.content;
      } else {
        resultDiv.textContent = 'No content generated.';
      }
    } catch (err) {
      resultDiv.textContent = 'Error generating content.';
    }
  });

  // Accessible accordion for FAQ
  const accordions = document.querySelectorAll('.accordion');
  accordions.forEach(acc => {
    const buttons = acc.querySelectorAll('.accordion-button');
    buttons.forEach((btn, idx) => {
      btn.addEventListener('click', function() {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
        const panel = document.getElementById(btn.getAttribute('aria-controls'));
        panel.setAttribute('aria-hidden', expanded);
        if (!expanded) {
          panel.style.display = 'block';
        } else {
          panel.style.display = 'none';
        }
      });
      btn.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          if (idx < buttons.length - 1) buttons[idx + 1].focus();
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          if (idx > 0) buttons[idx - 1].focus();
        } else if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          btn.click();
        }
      });
    });
  });

  // AJAX for Reoon email validator
  const reoonForm = document.querySelector('.reoon-email-form');
  if (reoonForm) {
    reoonForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      const email = reoonForm.reoon_email.value.trim();
      const resultDiv = reoonForm.parentElement.querySelector('.reoon-email-result');
      if (!email) {
        showErrorSummary(reoonForm, [{ fieldId: 'reoon_email', message: 'Email is required.' }]);
        focusFirstInvalid(reoonForm);
        return;
      }
      resultDiv.textContent = 'Validating...';
      try {
        const res = await fetch('/wp-json/ab-mcp/v1/reoon-validate', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email }),
        });
        const data = await res.json();
        if (data.valid) {
          resultDiv.textContent = 'Email is valid.';
        } else {
          resultDiv.textContent = 'Email is invalid.';
        }
      } catch (err) {
        resultDiv.textContent = 'Validation error.';
      }
    });
  }

  // AJAX for Acumbamail newsletter
  const acumbaForm = document.querySelector('.acumbamail-newsletter-form');
  if (acumbaForm) {
    acumbaForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      const email = acumbaForm.acumbamail_email.value.trim();
      const resultDiv = acumbaForm.parentElement.querySelector('.acumbamail-newsletter-result');
      if (!email) {
        showErrorSummary(acumbaForm, [{ fieldId: 'acumbamail_email', message: 'Email is required.' }]);
        focusFirstInvalid(acumbaForm);
        return;
      }
      resultDiv.textContent = 'Subscribing...';
      try {
        const res = await fetch('/wp-json/ab-mcp/v1/acumbamail-subscribe', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email }),
        });
        const data = await res.json();
        if (data.success) {
          resultDiv.textContent = 'Subscribed! Check your inbox.';
        } else {
          resultDiv.textContent = 'Subscription failed.';
        }
      } catch (err) {
        resultDiv.textContent = 'Subscription error.';
      }
    });
  }

  // AJAX for Certopus certificate request
  const certopusForm = document.querySelector('.certopus-certificate-form');
  if (certopusForm) {
    certopusForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      const name = certopusForm.certopus_name.value.trim();
      const email = certopusForm.certopus_email.value.trim();
      const resultDiv = certopusForm.parentElement.querySelector('.certopus-certificate-result');
      const errors = [];
      if (!name) errors.push({ fieldId: 'certopus_name', message: 'Name is required.' });
      if (!email) errors.push({ fieldId: 'certopus_email', message: 'Email is required.' });
      if (errors.length) {
        showErrorSummary(certopusForm, errors);
        focusFirstInvalid(certopusForm);
        return;
      }
      resultDiv.textContent = 'Requesting certificate...';
      try {
        const res = await fetch('/wp-json/ab-mcp/v1/certopus-request', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, email }),
        });
        const data = await res.json();
        if (data.success) {
          resultDiv.textContent = 'Certificate requested! Check your email.';
        } else {
          resultDiv.textContent = 'Certificate request failed.';
        }
      } catch (err) {
        resultDiv.textContent = 'Certificate request error.';
      }
    });
  }
});

function showErrorSummary(form, errors) {
  let summary = form.querySelector('.error-summary');
  if (!summary) {
    summary = document.createElement('div');
    summary.className = 'error-summary';
    summary.setAttribute('role', 'alert');
    summary.setAttribute('aria-live', 'assertive');
    form.prepend(summary);
  }
  summary.innerHTML = '<strong>There were errors with your submission:</strong><ul>' +
    errors.map(e => `<li><a href="#${e.fieldId}">${e.message}</a></li>`).join('') + '</ul>';
  summary.querySelector('a').focus();
}

function focusFirstInvalid(form) {
  const invalid = form.querySelector(':invalid');
  if (invalid) invalid.focus();
} 