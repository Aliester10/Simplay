document.addEventListener("DOMContentLoaded", function () {
  // Initialize AOS with custom settings (REDUCED duration for faster loading)
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 600,
      easing: "ease-out-cubic",
      once: true,
      offset: 30,
      delay: 0,
    });
  }

  // Create Advanced Particle System
  function createParticleSystem() {
    const particleContainer = document.getElementById("particleSystem");
    const particleCount = 10; // REDUCED from 15 to 10 for better performance

    for (let i = 0; i < particleCount; i++) {
      const particle = document.createElement("div");
      particle.className = "particle";

      // Random size and position
      const size = Math.random() * 4 + 2;
      particle.style.width = size + "px";
      particle.style.height = size + "px";
      particle.style.left = Math.random() * 100 + "%";
      particle.style.top = Math.random() * 100 + "%";

      // Random animation delay and duration
      particle.style.animationDelay = Math.random() * 8 + "s";
      particle.style.animationDuration = Math.random() * 4 + 6 + "s";

      particleContainer.appendChild(particle);
    }
  }

  // Ultra-Enhanced Filter and Query System
  const activityQuery = document.getElementById("activityQuery");
  const sortSelect = document.getElementById("sortSelect");
  const statusFilter = document.getElementById("statusFilter");
  const premiumGrid = document.getElementById("premiumGrid");
  const activityItems = document.querySelectorAll(".activity-item");

  let currentFilters = {
    query: "",
    sort: "latest",
    status: "all",
    category: "all",
  };

  // Query functionality
  activityQuery.addEventListener("input", function () {
    currentFilters.query = this.value.toLowerCase();
    applyFilters();
  });

  // Sort functionality (REMOVED loading animation)
  sortSelect.addEventListener("change", function () {
    currentFilters.sort = this.value;
    applyFilters();
  });

  // Status filter
  statusFilter.addEventListener("change", function () {
    currentFilters.status = this.value;
    applyFilters();
  });

  function applyFilters() {
    let visibleCount = 0;

    activityItems.forEach((item, index) => {
      let shouldShow = true;

      // Query filter
      if (
        currentFilters.query &&
        !item.dataset.title.includes(currentFilters.query)
      ) {
        shouldShow = false;
      }

      // Status filter
      if (
        currentFilters.status !== "all" &&
        item.dataset.status !== currentFilters.status
      ) {
        shouldShow = false;
      }

      // Category filter
      if (
        currentFilters.category !== "all" &&
        item.dataset.category !== currentFilters.category
      ) {
        shouldShow = false;
      }

      if (shouldShow) {
        item.style.display = "block";
        visibleCount++;
      } else {
        item.style.display = "none";
      }
    });

    // Update showing info
    const showingInfo = document.querySelector(".showing-info");
    if (showingInfo) {
      showingInfo.innerHTML = `Menampilkan <span class="highlight">${visibleCount}</span> dari <span class="highlight">${activityItems.length}</span> aktivitas`;
    }

    // Show empty state if no results
    const emptyState = document.querySelector(".empty-state");
    if (visibleCount === 0 && !emptyState) {
      showEmptyState();
    } else if (visibleCount > 0 && emptyState) {
      emptyState.remove();
    }
  }

  function showEmptyState() {
    const emptyHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="empty-title">Tidak Ada Hasil</h3>
                <p class="empty-description">
                    Tidak ditemukan aktivitas yang sesuai dengan kriteria pencarian Anda. Coba ubah filter atau kata kunci pencarian.
                </p>
                <button class="empty-action" onclick="clearFilters()">
                    <i class="fas fa-refresh"></i>
                    <span>Reset Filter</span>
                </button>
            </div>
        `;
    premiumGrid.insertAdjacentHTML("beforeend", emptyHTML);
  }

  window.clearFilters = function () {
    activityQuery.value = "";
    sortSelect.value = "latest";
    statusFilter.value = "all";

    currentFilters = {
      query: "",
      sort: "latest",
      status: "all",
      category: "all",
    };

    applyFilters();
  };

  // Premium Bookmark System
  const bookmarkButtons = document.querySelectorAll(".bookmark-btn");
  bookmarkButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const icon = this.querySelector("i");
      const isBookmarked = icon.classList.contains("fas");

      if (isBookmarked) {
        icon.classList.remove("fas");
        icon.classList.add("far");
        this.style.color = "var(--text-light)";
        this.style.borderColor = "var(--neutral-200)";

        // Show notification
        showNotification("Bookmark dihapus", "info");
      } else {
        icon.classList.remove("far");
        icon.classList.add("fas");
        this.style.color = "var(--secondary)";
        this.style.borderColor = "var(--secondary)";

        // Success animation
        this.style.background = "var(--secondary)";
        this.style.color = "white";
        setTimeout(() => {
          this.style.background = "white";
          this.style.color = "var(--secondary)";
        }, 200);

        // Show notification
        showNotification("Ditambahkan ke bookmark", "success");
      }

      // Bounce animation
      this.style.transform = "scale(1.3)";
      setTimeout(() => {
        this.style.transform = "scale(1)";
      }, 200);
    });
  });

  // Premium Share System
  const shareButtons = document.querySelectorAll(".share-btn");
  shareButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Copy current URL to clipboard
      navigator.clipboard
        .writeText(window.location.href)
        .then(() => {
          // Success feedback
          const originalHTML = this.innerHTML;
          this.innerHTML = '<i class="fas fa-check"></i>';
          this.style.background = "var(--success)";
          this.style.color = "white";
          this.style.borderColor = "var(--success)";

          setTimeout(() => {
            this.innerHTML = originalHTML;
            this.style.background = "white";
            this.style.color = "var(--text-light)";
            this.style.borderColor = "var(--neutral-200)";
          }, 1500);

          // Show notification
          showNotification("Link disalin ke clipboard", "success");
        })
        .catch(() => {
          showNotification("Gagal menyalin link", "error");
        });
    });
  });

  // NEW: Notification System
  function showNotification(message, type = "info") {
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${getNotificationIcon(type)}"></i>
                <span>${message}</span>
            </div>
        `;

    // Add notification styles
    Object.assign(notification.style, {
      position: "fixed",
      top: "20px",
      right: "20px",
      background: getNotificationColor(type),
      color: "white",
      padding: "16px 24px",
      borderRadius: "12px",
      boxShadow: "0 8px 25px rgba(0, 0, 0, 0.15)",
      zIndex: "10000",
      transform: "translateX(100%)",
      transition: "all 0.3s cubic-bezier(0.25, 1, 0.5, 1)",
      minWidth: "300px",
      backdropFilter: "blur(10px)",
    });

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
      notification.style.transform = "translateX(0)";
    }, 100);

    // Animate out and remove
    setTimeout(() => {
      notification.style.transform = "translateX(100%)";
      setTimeout(() => {
        notification.remove();
      }, 300);
    }, 3000);
  }

  function getNotificationIcon(type) {
    const icons = {
      success: "check-circle",
      error: "exclamation-circle",
      warning: "exclamation-triangle",
      info: "info-circle",
    };
    return icons[type] || "info-circle";
  }

  function getNotificationColor(type) {
    const colors = {
      success: "var(--gradient-success)",
      error: "linear-gradient(135deg, #ef4444, #dc2626)",
      warning: "var(--gradient-secondary)",
      info: "var(--gradient-primary)",
    };
    return colors[type] || "var(--gradient-primary)";
  }

  // Advanced Card Interactions
  const premiumCards = document.querySelectorAll(".premium-card");
  premiumCards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      // Enhance neighboring cards effect
      const allCards = document.querySelectorAll(".premium-card");
      allCards.forEach((otherCard) => {
        if (otherCard !== this && otherCard.style.display !== "none") {
          otherCard.style.opacity = "0.7";
          otherCard.style.transform = "scale(0.98)";
        }
      });
    });

    card.addEventListener("mouseleave", function () {
      // Reset all cards
      const allCards = document.querySelectorAll(".premium-card");
      allCards.forEach((otherCard) => {
        otherCard.style.opacity = "1";
        otherCard.style.transform = "scale(1)";
      });
    });

    // Add click ripple effect
    card.addEventListener("click", function (e) {
      if (e.target.closest(".card-actions") || e.target.closest(".action-btn"))
        return;

      const ripple = document.createElement("div");
      const rect = card.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;

      Object.assign(ripple.style, {
        position: "absolute",
        width: size + "px",
        height: size + "px",
        left: x + "px",
        top: y + "px",
        borderRadius: "50%",
        background: "rgba(26, 115, 232, 0.3)",
        transform: "scale(0)",
        animation: "ripple 0.6s linear",
        pointerEvents: "none",
        zIndex: "100",
      });

      card.style.position = "relative";
      card.appendChild(ripple);

      setTimeout(() => {
        ripple.remove();
      }, 600);
    });
  });

  // NEW: Quick Actions
  function addQuickActions() {
    const quickActionsHTML = `
            <div class="quick-actions" id="quickActions">
                <button class="quick-action-btn" id="scrollToTop" title="Scroll to Top">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <button class="quick-action-btn" id="gridToggle" title="Toggle View">
                    <i class="fas fa-th"></i>
                </button>
            </div>
        `;

    document.body.insertAdjacentHTML("beforeend", quickActionsHTML);

    // Add quick actions styles
    const quickActionsStyle = document.createElement("style");
    quickActionsStyle.textContent = `
            .quick-actions {
                position: fixed;
                bottom: 30px;
                right: 30px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                z-index: 1000;
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.3s ease;
            }

            .quick-action-btn {
                width: 56px;
                height: 56px;
                background: var(--gradient-primary);
                border: none;
                border-radius: 50%;
                color: white;
                font-size: 20px;
                cursor: pointer;
                box-shadow: 0 8px 25px rgba(var(--primary-rgb), 0.4);
                transition: var(--transition-bounce);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .quick-action-btn:hover {
                transform: translateY(-3px) scale(1.1);
                box-shadow: 0 12px 30px rgba(var(--primary-rgb), 0.5);
            }

            .quick-action-btn:active {
                transform: translateY(-1px) scale(1.05);
            }

            .quick-action-btn i {
                transition: transform 0.3s ease;
            }

            .quick-action-btn:hover i {
                transform: rotate(360deg);
            }

            @media (max-width: 768px) {
                .quick-actions {
                    bottom: 20px;
                    right: 20px;
                }
                
                .quick-action-btn {
                    width: 48px;
                    height: 48px;
                    font-size: 18px;
                }
            }
        `;
    document.head.appendChild(quickActionsStyle);

    // Quick actions functionality
    document
      .getElementById("scrollToTop")
      .addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
        showNotification("Kembali ke atas", "info");
      });

    let isGridView = true;
    document
      .getElementById("gridToggle")
      .addEventListener("click", function () {
        const icon = this.querySelector("i");
        const grid = document.getElementById("premiumGrid");

        if (isGridView) {
          grid.style.gridTemplateColumns = "1fr";
          icon.className = "fas fa-th-large";
          showNotification("Beralih ke tampilan list", "info");
          isGridView = false;
        } else {
          grid.style.gridTemplateColumns =
            "repeat(auto-fit, minmax(420px, 1fr))";
          icon.className = "fas fa-th";
          showNotification("Beralih ke tampilan grid", "info");
          isGridView = true;
        }
      });
  }

  // Smooth Hero CTA Scroll
  const heroCTA = document.querySelector(".hero-cta");
  if (heroCTA) {
    heroCTA.addEventListener("click", function (e) {
      e.preventDefault();
      document.querySelector("#activities").scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    });
  }

  // Advanced Parallax Effects
  let ticking = false;

  function updateParallax() {
    const scrolled = window.pageYOffset;
    const heroImage = document.querySelector(".hero-image");
    const geometricShapes = document.querySelectorAll(".geometric-shape");
    const quickActions = document.getElementById("quickActions");

    if (heroImage) {
      const rate = scrolled * -0.3;
      heroImage.style.transform = `translateY(${rate}px) scale(1.1)`;
    }

    geometricShapes.forEach((shape, index) => {
      const rate = scrolled * (0.1 + index * 0.05);
      shape.style.transform = `translateY(${rate}px) rotate(${
        scrolled * 0.1
      }deg)`;
    });

    // Show/hide quick actions based on scroll
    if (quickActions) {
      if (scrolled > 300) {
        quickActions.style.opacity = "1";
        quickActions.style.transform = "translateY(0)";
      } else {
        quickActions.style.opacity = "0";
        quickActions.style.transform = "translateY(20px)";
      }
    }

    ticking = false;
  }

  window.addEventListener("scroll", function () {
    if (!ticking) {
      requestAnimationFrame(updateParallax);
      ticking = true;
    }
  });

  // NEW: Keyboard shortcuts
  document.addEventListener("keydown", function (e) {
    if (e.ctrlKey || e.metaKey) {
      switch (e.key) {
        case "f":
          e.preventDefault();
          activityQuery.focus();
          showNotification("Fokus pada pencarian", "info");
          break;
      }
    }

    if (e.key === "Escape") {
      if (activityQuery.value) {
        activityQuery.value = "";
        activityQuery.dispatchEvent(new Event("input"));
        showNotification("Pencarian dibersihkan", "info");
      }
    }
  });

  // REMOVED: Loading states for navigation to improve performance

  // REMOVED: Progressive image loading that causes delays

  // REMOVED: Performance monitoring that can slow down initial load

  // Initialize essential features only
  createParticleSystem();
  addQuickActions();

  // Add custom ripple animation styles
  const style = document.createElement("style");
  style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }

        .notification-content i {
            font-size: 18px;
        }

        .showing-info {
            color: var(--text-light);
            font-size: 14px;
            font-weight: 600;
        }

        .showing-info .highlight {
            color: var(--primary);
            font-weight: 700;
        }

        .control-label {
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-label i {
            color: var(--primary);
            font-size: 16px;
        }

        /* Enhanced Notification System */
        .notification {
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .notification-success {
            background: var(--gradient-success) !important;
        }

        .notification-error {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        }

        .notification-warning {
            background: var(--gradient-secondary) !important;
        }

        .notification-info {
            background: var(--gradient-primary) !important;
        }

        /* Enhanced Empty State Animations */
        .empty-state {
            opacity: 1;
            transform: translateY(0);
        }

        .empty-icon {
            animation: emptyIconFloat 3s ease-in-out infinite;
        }

        @keyframes emptyIconFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Enhanced Filter Animation */
        .filter-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gradient-primary);
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        /* Enhanced Card Hover Effects */
        .premium-card {
            will-change: transform;
            backface-visibility: hidden;
        }

        .premium-card:hover {
            will-change: auto;
        }

        /* Enhanced Pagination */
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 48px;
            height: 48px;
            margin: 0 4px;
            background: white;
            border: 2px solid var(--neutral-200);
            border-radius: var(--radius-md);
            color: var(--text);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-base);
        }

        .pagination a:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
        }

        .pagination .active span {
            background: var(--gradient-primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
        }

        .pagination .disabled span {
            background: var(--neutral-100);
            border-color: var(--neutral-200);
            color: var(--text-light);
            cursor: not-allowed;
        }

        /* Enhanced Mobile Responsiveness */
        @media (max-width: 480px) {
            .filter-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .filter-select {
                min-width: 100%;
            }

            .showing-info {
                text-align: center;
                margin-top: 16px;
            }

            .premium-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card-actions {
                flex-direction: column;
                gap: 12px;
            }

            .secondary-actions {
                justify-content: center;
            }
        }

        /* Dark Mode Support (Optional) */
        @media (prefers-color-scheme: dark) {
            :root {
                --surface: #1e293b;
                --text: #e2e8f0;
                --text-light: #94a3b8;
                --neutral-50: #334155;
                --neutral-100: #475569;
                --neutral-200: #64748b;
            }

            .activity-showcase {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            }

            .premium-card {
                background: rgba(30, 41, 59, 0.8);
                backdrop-filter: blur(20px);
                border-color: rgba(100, 116, 139, 0.3);
            }

            .filter-section {
                background: rgba(30, 41, 59, 0.9);
                backdrop-filter: blur(30px);
                border-color: rgba(100, 116, 139, 0.3);
            }

            .query-input {
                background: rgba(51, 65, 85, 0.8);
                border-color: rgba(100, 116, 139, 0.4);
                color: var(--text);
            }

            .filter-select {
                background: rgba(51, 65, 85, 0.8);
                border-color: rgba(100, 116, 139, 0.4);
                color: var(--text);
            }
        }

        /* Print Styles */
        @media print {
            .geometric-bg,
            .particle-system,
            .quick-actions,
            .hero-cta,
            .filter-section,
            .secondary-actions {
                display: none !important;
            }

            .cinematic-hero {
                height: 200px;
                page-break-inside: avoid;
            }

            .premium-card {
                page-break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ccc;
            }

            .premium-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* Accessibility Enhancements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .particle-system {
                display: none;
            }

            .geometric-bg {
                display: none;
            }
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            .premium-card {
                border: 3px solid #000;
            }

            .action-btn {
                border: 3px solid #000;
            }

            .primary-action {
                background: #000;
                border: 3px solid #000;
            }
        }

        /* Focus Visible for Better Accessibility */
        .query-input:focus-visible,
        .filter-select:focus-visible,
        .action-btn:focus-visible,
        .primary-action:focus-visible,
        .quick-action-btn:focus-visible {
            outline: 3px solid var(--primary);
            outline-offset: 2px;
        }

        /* OPTIMIZED: Faster image rendering */
        .card-image {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: optimize-contrast;
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        /* OPTIMIZED: Hardware acceleration for cards */
        .premium-card {
            transform: translateZ(0);
            backface-visibility: hidden;
        }
    `;
  document.head.appendChild(style);

  // Smooth scroll for better UX
  document.documentElement.style.scrollBehavior = "smooth";

  // REMOVED: Welcome message section has been deleted

  // OPTIMIZED: Simple Error Handling for Images
  document.querySelectorAll(".card-image").forEach((img) => {
    img.addEventListener("error", function () {
      // Simple fallback without heavy SVG processing
      this.style.background = "linear-gradient(135deg, #f0f0f0, #e0e0e0)";
      this.style.display = "flex";
      this.style.alignItems = "center";
      this.style.justifyContent = "center";
      this.innerHTML =
        '<div style="color: #999; font-size: 14px; text-align: center;"><i class="fas fa-image" style="font-size: 48px; margin-bottom: 8px; display: block;"></i>Gambar tidak tersedia</div>';
      this.style.filter = "none";
      this.style.opacity = "1";
    });

    // OPTIMIZED: Preload critical images only
    if (img.loading !== "lazy") {
      img.loading = "eager";
      img.decoding = "sync";
    }
  });

  // REMOVED: Battery Status API (not essential for core functionality)
  // REMOVED: Complex performance monitoring
  // REMOVED: Service Worker registration (optional feature)
  // REMOVED: Connection monitoring (not critical)
  // REMOVED: Memory monitoring (can impact performance)

  console.log(
    "🚀 Activity Showcase initialized successfully with optimized performance!"
  );
});

// SIMPLIFIED: Page visibility API for performance
document.addEventListener("visibilitychange", function () {
  const particles = document.querySelectorAll(".particle");
  const geometricShapes = document.querySelectorAll(".geometric-shape");

  if (document.hidden) {
    particles.forEach((p) => (p.style.animationPlayState = "paused"));
    geometricShapes.forEach((s) => (s.style.animationPlayState = "paused"));
  } else {
    particles.forEach((p) => (p.style.animationPlayState = "running"));
    geometricShapes.forEach((s) => (s.style.animationPlayState = "running"));
  }
});

// OPTIMIZED: Preload critical resources
window.addEventListener("load", () => {
  // Preload next page images if pagination exists
  const nextPageLink = document.querySelector(".pagination .next");
  if (nextPageLink && "requestIdleCallback" in window) {
    requestIdleCallback(() => {
      const link = document.createElement("link");
      link.rel = "prefetch";
      link.href = nextPageLink.href;
      document.head.appendChild(link);
    });
  }
});
