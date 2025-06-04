/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  "use strict";

  // Mobile menu functionality
  const mobileMenuButton = document.querySelector(".mobile-menu-button");
  const primaryMenu = document.querySelector("#primary-menu");
  const searchToggle = document.querySelector(".search-toggle");
  const searchForm = document.querySelector("#search-form");

  // Mobile menu toggle
  if (mobileMenuButton && primaryMenu) {
    mobileMenuButton.addEventListener("click", function () {
      const isExpanded =
        mobileMenuButton.getAttribute("aria-expanded") === "true";

      mobileMenuButton.setAttribute("aria-expanded", !isExpanded);
      mobileMenuButton.classList.toggle("active");
      primaryMenu.classList.toggle("active");

      // Prevent body scroll when menu is open
      document.body.classList.toggle("menu-open", !isExpanded);
    });
  }

  // Search toggle functionality
  if (searchToggle && searchForm) {
    searchToggle.addEventListener("click", function () {
      const isExpanded = searchToggle.getAttribute("aria-expanded") === "true";

      searchToggle.setAttribute("aria-expanded", !isExpanded);
      searchForm.hidden = isExpanded;

      if (!isExpanded) {
        const searchField = searchForm.querySelector(".search-field");
        if (searchField) {
          searchField.focus();
        }
      }
    });
  }

  // Close mobile menu when clicking outside
  document.addEventListener("click", function (event) {
    if (mobileMenuButton && primaryMenu) {
      const isClickInsideMenu = primaryMenu.contains(event.target);
      const isClickOnButton = mobileMenuButton.contains(event.target);

      if (
        !isClickInsideMenu &&
        !isClickOnButton &&
        primaryMenu.classList.contains("active")
      ) {
        mobileMenuButton.setAttribute("aria-expanded", "false");
        mobileMenuButton.classList.remove("active");
        primaryMenu.classList.remove("active");
        document.body.classList.remove("menu-open");
      }
    }
  });

  // Keyboard navigation for menu
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      // Close mobile menu on Escape
      if (
        mobileMenuButton &&
        primaryMenu &&
        primaryMenu.classList.contains("active")
      ) {
        mobileMenuButton.setAttribute("aria-expanded", "false");
        mobileMenuButton.classList.remove("active");
        primaryMenu.classList.remove("active");
        document.body.classList.remove("menu-open");
        mobileMenuButton.focus();
      }

      // Close search form on Escape
      if (searchToggle && searchForm && !searchForm.hidden) {
        searchToggle.setAttribute("aria-expanded", "false");
        searchForm.hidden = true;
        searchToggle.focus();
      }
    }
  });

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");

      // Skip if it's just a hash
      if (href === "#") return;

      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });

        // Update focus for accessibility
        target.focus();
      }
    });
  });

  // Add loading class to body when page loads
  window.addEventListener("load", function () {
    document.body.classList.add("loaded");
  });

  // Intersection Observer for animations
  if ("IntersectionObserver" in window) {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate-in");
        }
      });
    }, observerOptions);

    // Observe elements that should animate in
    document
      .querySelectorAll(".card, .section-header, .hero-content")
      .forEach((el) => {
        observer.observe(el);
      });
  }
})();
