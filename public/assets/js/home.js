document.addEventListener("DOMContentLoaded", function () {
  // Preloader
  window.addEventListener("load", function () {
    setTimeout(function () {
      const preloader = document.getElementById("preloader");
      if (preloader) {
        preloader.style.opacity = "0";
        setTimeout(() => preloader.remove(), 300);
      }
    }, 500);
  });

  // Initialize all components
  initSliderContent();
  initProductCarousel();
  initElegantSectionHeaders();
  initFloatingCategories();
  initFilterTabs();
  initScrollAnimations();
  initWishlistHandlers();
  initPerformanceOptimizations();

  // Modern Floating Categories Initialization
  function initFloatingCategories() {
    const categoryItems = document.querySelectorAll(".category-floating-item");
    const floatingPanel = document.querySelector(".categories-floating-panel");

    // Add magical entrance animation
    if (floatingPanel) {
      floatingPanel.style.opacity = "0";
      floatingPanel.style.transform = "translateY(30px) scale(0.9)";

      setTimeout(() => {
        floatingPanel.style.transition = "all 1s cubic-bezier(0.4, 0, 0.2, 1)";
        floatingPanel.style.opacity = "1";
        floatingPanel.style.transform = "translateY(0) scale(1)";
      }, 300);
    }

    // Enhanced category interactions with floating effects
    categoryItems.forEach((item, index) => {
      // Add staggered floating entrance animation
      item.style.opacity = "0";
      item.style.transform = "translateX(-20px)";

      setTimeout(() => {
        item.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        item.style.opacity = "1";
        item.style.transform = "translateX(0)";
      }, 500 + index * 80);

      // Get the category link
      const categoryLink = item.querySelector(".category-floating-link");

      // Enhanced click handling with floating animation
      item.addEventListener("click", function (e) {
        // If the click is directly on the link, let the default behavior work
        if (e.target.closest(".category-floating-link")) {
          return;
        }

        // Otherwise, handle the click ourselves
        e.preventDefault();

        // Remove active class from all items
        categoryItems.forEach((cat) => cat.classList.remove("active"));

        // Add active class to clicked item
        this.classList.add("active");

        // Create floating ripple effect
        createFloatingRipple(this);

        // Add floating loading state
        addFloatingLoadingState(this);

        // Store selected category
        sessionStorage.setItem("selectedCategory", this.dataset.category);

        // Analytics tracking
        trackCategorySelection(this);

        // Navigate to the category page with floating transition
        if (categoryLink && categoryLink.href) {
          setTimeout(() => {
            window.location.href = categoryLink.href;
          }, 400);
        }
      });

      // Enhanced floating hover effects
      item.addEventListener("mouseenter", function () {
        if (!this.classList.contains("active")) {
          this.style.background = "rgba(255, 255, 255, 0.1)";
          this.style.backdropFilter = "blur(10px)";
        }

        // Animate icon with floating effect
        const icon = this.querySelector(".category-floating-icon");
        if (icon) {
          icon.style.color = "white";
          icon.style.background = "var(--pink-accent)";
          icon.style.borderColor = "var(--pink-accent)";
          icon.style.transform = "scale(1.1) rotate(5deg)";
          icon.style.boxShadow = "0 4px 15px rgba(233, 30, 99, 0.4)";
        }

        // Animate arrow with floating motion
        const arrow = this.querySelector(".category-floating-arrow");
        if (arrow) {
          arrow.style.transform = "translateX(3px) scale(1.1)";
          arrow.style.color = "white";
          arrow.style.background = "rgba(255, 255, 255, 0.15)";
        }

        // Animate text with floating glow
        const name = this.querySelector(".category-floating-name");
        if (name) {
          name.style.color = "white";
          name.style.textShadow = "0 2px 10px rgba(233, 30, 99, 0.3)";
        }

        // Add floating animation to the entire item
        this.style.transform = "translateY(-2px)";
      });

      item.addEventListener("mouseleave", function () {
        if (!this.classList.contains("active")) {
          this.style.background = "transparent";
          this.style.backdropFilter = "";
        }

        const icon = this.querySelector(".category-floating-icon");
        if (icon && !this.classList.contains("active")) {
          icon.style.color = "rgba(255, 255, 255, 0.8)";
          icon.style.background = "rgba(255, 255, 255, 0.1)";
          icon.style.borderColor = "rgba(255, 255, 255, 0.15)";
          icon.style.transform = "scale(1) rotate(0deg)";
          icon.style.boxShadow = "none";
        }

        const arrow = this.querySelector(".category-floating-arrow");
        if (arrow) {
          arrow.style.transform = "translateX(0) scale(1)";
          arrow.style.color = "rgba(255, 255, 255, 0.5)";
          arrow.style.background = "rgba(255, 255, 255, 0.05)";
        }

        const name = this.querySelector(".category-floating-name");
        if (name && !this.classList.contains("active")) {
          name.style.color = "rgba(255, 255, 255, 0.9)";
          name.style.textShadow = "none";
        }

        this.style.transform = "translateY(0)";
      });

      // Keyboard navigation with floating effects
      item.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();

          // Add floating click effect
          this.style.transform = "scale(0.98) translateY(1px)";
          setTimeout(() => {
            this.style.transform = "";

            // Navigate to category page
            if (categoryLink && categoryLink.href) {
              window.location.href = categoryLink.href;
            }
          }, 200);
        } else if (e.key === "ArrowDown") {
          e.preventDefault();
          const nextItem = this.nextElementSibling;
          if (nextItem) {
            nextItem.focus();
            nextItem.scrollIntoView({ behavior: "smooth", block: "nearest" });
          }
        } else if (e.key === "ArrowUp") {
          e.preventDefault();
          const prevItem = this.previousElementSibling;
          if (prevItem) {
            prevItem.focus();
            prevItem.scrollIntoView({ behavior: "smooth", block: "nearest" });
          }
        }
      });

      // Make items focusable for accessibility
      item.setAttribute("tabindex", "0");
      item.setAttribute("role", "button");
      item.setAttribute(
        "aria-label",
        `Select ${
          item.querySelector(".category-floating-name").textContent
        } category`
      );
    });

    // Restore selected category with floating styling
    restoreSelectedCategory();

    // Initialize floating view all button
    initViewAllButtonFloating();

    // Add floating scroll animations
    initFloatingScrollAnimations();

    // Initialize dot animations
    initDotAnimations();
  }

  // Create floating ripple effect
  function createFloatingRipple(element) {
    const ripple = document.createElement("div");

    ripple.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(233, 30, 99, 0.3) 30%,
                rgba(255, 255, 255, 0.2) 50%,
                rgba(233, 30, 99, 0.3) 70%,
                transparent 100%);
            transform: translateX(-100%);
            animation: floatingRipple 0.8s ease;
            pointer-events: none;
            z-index: 1;
            border-radius: 8px;
        `;

    // Add floating ripple animation keyframes
    if (!document.querySelector("#floating-ripple-styles")) {
      const style = document.createElement("style");
      style.id = "floating-ripple-styles";
      style.textContent = `
                @keyframes floatingRipple {
                    0% {
                        transform: translateX(-100%);
                        opacity: 0;
                    }
                    30% {
                        opacity: 1;
                    }
                    70% {
                        opacity: 1;
                    }
                    100% {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
      document.head.appendChild(style);
    }

    element.style.position = "relative";
    element.appendChild(ripple);

    setTimeout(() => ripple.remove(), 800);
  }

  // Add floating loading state
  function addFloatingLoadingState(element) {
    const arrow = element.querySelector(".category-floating-arrow i");
    const icon = element.querySelector(".category-floating-icon");

    if (arrow) {
      const originalClass = arrow.className;
      arrow.className = "fas fa-circle-notch fa-spin";
      arrow.style.color = "var(--pink-accent)";

      setTimeout(() => {
        arrow.className = originalClass;
        arrow.style.color = "";
      }, 1000);
    }

    if (icon) {
      icon.style.animation = "pulse 0.8s ease infinite";
      setTimeout(() => {
        icon.style.animation = "";
      }, 1000);
    }

    // Add floating loading class
    element.classList.add("category-floating-loading");
    setTimeout(() => {
      element.classList.remove("category-floating-loading");
    }, 1000);
  }

  // Restore selected category with floating styling
  function restoreSelectedCategory() {
    const selectedCategory = sessionStorage.getItem("selectedCategory");
    if (selectedCategory) {
      const categoryItem = document.querySelector(
        `[data-category="${selectedCategory}"]`
      );
      if (categoryItem) {
        categoryItem.classList.add("active");

        // Add floating visual feedback
        categoryItem.style.background = "rgba(255, 255, 255, 0.15)";
        categoryItem.style.backdropFilter = "blur(15px)";

        const icon = categoryItem.querySelector(".category-floating-icon");
        if (icon) {
          icon.style.color = "white";
          icon.style.background = "var(--pink-accent)";
          icon.style.borderColor = "var(--pink-accent)";
        }

        const name = categoryItem.querySelector(".category-floating-name");
        if (name) {
          name.style.color = "white";
        }
      }
    }
  }

  // Initialize floating view all button
  function initViewAllButtonFloating() {
    const viewAllBtn = document.querySelector(".view-all-floating");
    if (viewAllBtn) {
      viewAllBtn.addEventListener("click", function (e) {
        // Add floating click animation
        this.style.transform = "scale(0.95) translateY(2px)";

        // Add enhanced floating loading state
        const originalHTML = this.innerHTML;
        const loadingHTML = `
                    <div class="view-all-floating-icon">
                        <div class="mini-grid-dots">
                            <span class="mini-dot"></span>
                            <span class="mini-dot"></span>
                            <span class="mini-dot"></span>
                            <span class="mini-dot"></span>
                        </div>
                    </div>
                    <span class="view-all-floating-text">Loading...</span>
                    <div class="view-all-floating-arrow">
                        <i class="fas fa-circle-notch fa-spin"></i>
                    </div>
                `;

        this.innerHTML = loadingHTML;
        this.style.color = "var(--pink-accent)";

        setTimeout(() => {
          this.style.transform = "";
          this.innerHTML = originalHTML;
          this.style.color = "";
        }, 1200);
      });

      // Add enhanced floating hover animation
      viewAllBtn.addEventListener("mouseenter", function () {
        this.style.transform = "translateY(-2px)";

        const arrow = this.querySelector(".view-all-floating-arrow");
        if (arrow) {
          arrow.style.transform = "translateX(3px)";
        }

        const dots = this.querySelectorAll(".mini-dot");
        dots.forEach((dot, index) => {
          setTimeout(() => {
            dot.style.transform = "scale(1.2)";
            dot.style.background = "white";
          }, index * 100);
        });
      });

      viewAllBtn.addEventListener("mouseleave", function () {
        this.style.transform = "";

        const arrow = this.querySelector(".view-all-floating-arrow");
        if (arrow) {
          arrow.style.transform = "translateX(0)";
        }

        const dots = this.querySelectorAll(".mini-dot");
        dots.forEach((dot) => {
          dot.style.transform = "scale(1)";
          dot.style.background = "rgba(255, 255, 255, 0.7)";
        });
      });
    }
  }

  // Initialize floating scroll animations
  function initFloatingScrollAnimations() {
    const floatingPanel = document.querySelector(".categories-floating-panel");
    if (!floatingPanel) return;

    let lastScrollY = window.scrollY;

    window.addEventListener(
      "scroll",
      () => {
        const currentScrollY = window.scrollY;
        const scrollDiff = currentScrollY - lastScrollY;

        if (currentScrollY > 100) {
          floatingPanel.style.transform = `translateY(-${Math.min(
            scrollDiff * 0.05,
            2
          )}px) scale(1.02)`;
          floatingPanel.style.boxShadow = `
                    0 30px 60px rgba(0, 0, 0, 0.15),
                    0 15px 30px rgba(255, 255, 255, 0.15) inset,
                    0 0 30px rgba(233, 30, 99, 0.1)
                `;
        } else {
          floatingPanel.style.transform = "translateY(0) scale(1)";
          floatingPanel.style.boxShadow = `
                    0 20px 40px rgba(0, 0, 0, 0.1),
                    0 10px 20px rgba(255, 255, 255, 0.1) inset
                `;
        }

        lastScrollY = currentScrollY;
      },
      { passive: true }
    );
  }

  // Initialize dot animations
  function initDotAnimations() {
    const dots = document.querySelectorAll(".dot");
    const floatingPanel = document.querySelector(".categories-floating-panel");

    if (floatingPanel) {
      floatingPanel.addEventListener("mouseenter", () => {
        dots.forEach((dot, index) => {
          setTimeout(() => {
            dot.style.background = "white";
            dot.style.transform = "scale(1.2)";
            dot.style.boxShadow = "0 2px 8px rgba(233, 30, 99, 0.3)";
          }, index * 50);
        });
      });

      floatingPanel.addEventListener("mouseleave", () => {
        dots.forEach((dot) => {
          dot.style.background = "rgba(255, 255, 255, 0.9)";
          dot.style.transform = "scale(1)";
          dot.style.boxShadow = "none";
        });
      });
    }
  }

  // Track category selection for analytics
  function trackCategorySelection(categoryItem) {
    const categoryName = categoryItem.querySelector(
      ".category-floating-name"
    ).textContent;
    const categoryId = categoryItem.dataset.category;

    // Google Analytics tracking
    if (typeof gtag !== "undefined") {
      gtag("event", "category_selected", {
        event_category: "navigation",
        event_label: categoryName,
        value: categoryId,
      });
    }

    // Custom analytics
    if (typeof analytics !== "undefined") {
      analytics.track("Category Selected", {
        categoryName: categoryName,
        categoryId: categoryId,
        timestamp: new Date().toISOString(),
      });
    }

    // Console log for development
    console.log(`Category selected: ${categoryName} (ID: ${categoryId})`);
  }

  // Filter Tab Functionality
  function initFilterTabs() {
    const filterTabs = document.querySelectorAll(".tab-btn");
    const productCards = document.querySelectorAll(".product-card");

    filterTabs.forEach((tab) => {
      tab.addEventListener("click", function () {
        filterTabs.forEach((t) => t.classList.remove("active"));
        this.classList.add("active");

        const filter = this.dataset.filter;

        productCards.forEach((card, index) => {
          if (filter === "all" || card.dataset.category.includes(filter)) {
            card.style.display = "block";
            setTimeout(() => {
              card.style.animation = "fadeInUp 0.5s ease forwards";
            }, index * 50);
          } else {
            card.style.display = "none";
          }
        });
      });
    });
  }

  // Elegant Section Headers Animation
  function initElegantSectionHeaders() {
    const sectionHeaders = document.querySelectorAll(".section-header-elegant");

    const observerOptions = {
      threshold: 0.3,
      rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const header = entry.target;

          const tag = header.querySelector(".section-tag");
          if (tag) {
            setTimeout(() => {
              tag.style.animation = "fadeInUp 0.6s ease forwards";
            }, 200);
          }

          const title = header.querySelector(".section-title-elegant");
          if (title) {
            setTimeout(() => {
              title.style.animation = "fadeInUp 0.8s ease forwards";
            }, 400);
          }

          const divider = header.querySelector(".section-divider");
          if (divider) {
            setTimeout(() => {
              divider.style.animation = "fadeInUp 0.6s ease forwards";
            }, 600);
          }

          const description = header.querySelector(
            ".section-description-elegant"
          );
          if (description) {
            setTimeout(() => {
              description.style.animation = "fadeInUp 0.8s ease forwards";
            }, 800);
          }

          const actions = header.querySelector(".header-actions-elegant");
          if (actions) {
            setTimeout(() => {
              actions.style.animation = "fadeInUp 0.8s ease forwards";
            }, 1000);
          }

          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    sectionHeaders.forEach((header) => {
      observer.observe(header);
    });
  }

  // Scroll Animations
  function initScrollAnimations() {
    const animateElements = document.querySelectorAll(".product-card");

    animateElements.forEach((element) => {
      element.classList.add("animate-on-scroll");
    });

    const observerOptions = {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animated");
        }
      });
    }, observerOptions);

    animateElements.forEach((element) => {
      observer.observe(element);
    });
  }

  // Wishlist Handlers
  function initWishlistHandlers() {
    const wishlistButtons = document.querySelectorAll(".wishlist-btn");

    wishlistButtons.forEach((button) => {
      button.addEventListener("click", function (e) {
        e.preventDefault();

        const icon = this.querySelector("i");
        const isActive = this.classList.contains("active");

        if (isActive) {
          this.classList.remove("active");
          icon.classList.remove("fas");
          icon.classList.add("far");
          this.setAttribute("title", "Add to Wishlist");

          showToast("Removed from wishlist", "info");
        } else {
          this.classList.add("active");
          icon.classList.remove("far");
          icon.classList.add("fas");
          this.setAttribute("title", "Remove from Wishlist");

          showToast("Added to wishlist", "success");
        }

        // Add heart animation
        icon.style.animation = "pulse 0.3s ease";
        setTimeout(() => {
          icon.style.animation = "";
        }, 300);
      });
    });
  }

  // Performance Optimizations
  function initPerformanceOptimizations() {
    // Lazy load images
    const images = document.querySelectorAll("img[data-src]");
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.classList.remove("lazy");
          imageObserver.unobserve(img);
        }
      });
    });

    images.forEach((img) => imageObserver.observe(img));

    // Debounce scroll events
    let scrollTimeout;
    window.addEventListener("scroll", () => {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(() => {
        handleScrollAnimations();
      }, 16); // ~60fps
    });

    // Throttle resize events
    let resizeTimeout;
    window.addEventListener("resize", () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
      }, 250);
    });
  }

  // Handle scroll-based animations
  function handleScrollAnimations() {
    // Additional scroll-based effects can be added here
  }

  // Handle responsive changes
  function handleResponsiveChanges() {
    const floatingPanel = document.querySelector(".categories-floating-panel");
    const sidebar = document.querySelector(".category-sidebar-modern");

    if (window.innerWidth <= 768) {
      if (sidebar) sidebar.style.padding = "15px";
      if (floatingPanel) floatingPanel.style.borderRadius = "15px";
    } else if (window.innerWidth <= 991) {
      if (sidebar) sidebar.style.padding = "20px";
      if (floatingPanel) floatingPanel.style.borderRadius = "20px";
    } else {
      if (sidebar) sidebar.style.padding = "0 10px";
      if (floatingPanel) floatingPanel.style.borderRadius = "20px";
    }
  }

  // Enhanced toast notifications
  function showToast(message, type = "info") {
    const toast = document.createElement("div");
    const colors = {
      success: "#10b981",
      error: "#ef4444",
      warning: "#f59e0b",
      info: "#3b82f6",
    };

    toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${colors[type]};
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.875rem;
            font-weight: 500;
            max-width: 300px;
        `;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
      toast.style.transform = "translateX(0)";
    }, 100);

    setTimeout(() => {
      toast.style.transform = "translateX(100%)";
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  }

  // Product card interactions
  document.querySelectorAll(".product-card").forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px) scale(1.02)";
      this.style.transition = "all 0.3s cubic-bezier(0.4, 0, 0.2, 1)";
    });

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)";
    });
  });

  // Visibility change handling
  document.addEventListener("visibilitychange", function () {
    if (document.hidden) {
      // Pause animations when page is hidden
      const animatedElements = document.querySelectorAll(
        '[style*="animation"]'
      );
      animatedElements.forEach((el) => {
        if (el.style.animationPlayState !== undefined) {
          el.style.animationPlayState = "paused";
        }
      });
    } else {
      // Resume animations when page is visible
      const animatedElements = document.querySelectorAll(
        '[style*="animation"]'
      );
      animatedElements.forEach((el) => {
        if (el.style.animationPlayState !== undefined) {
          el.style.animationPlayState = "running";
        }
      });
    }
  });

  // Error handling
  window.addEventListener("error", function (e) {
    if (
      window.location.hostname === "localhost" ||
      window.location.hostname.includes("dev")
    ) {
      console.error("Development Error:", e.message);
    }
  });
});

// Global functions
// Add to Cart Function
function addToCart(button) {
  const originalText = button.innerHTML;
  button.classList.add("btn-loading");
  button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
  button.disabled = true;

  button.style.transform = "scale(0.98)";

  setTimeout(() => {
    button.classList.remove("btn-loading");
    button.innerHTML = '<i class="fas fa-check"></i> Added!';
    button.style.background = "#10b981";
    button.style.transform = "scale(1.05)";

    setTimeout(() => {
      button.innerHTML = originalText;
      button.disabled = false;
      button.style.background = "";
      button.style.transform = "";
    }, 2000);
  }, 1000);
}

// Slider Content Function
function initSliderContent() {
  // Get sliders data from data attribute
  const slidersElement = document.getElementById("sliderContent");
  const slidersData = slidersElement
    ? JSON.parse(slidersElement.dataset.sliders || "[]")
    : [];
  const assetPath = document.body.dataset.assetPath || "";

  if (!slidersData || slidersData.length === 0) {
    updateSliderContent(
      {
        title: "COMPUTER AND LAPTOPS",
        subtitle: "PRESENTING SMART SOLUTIONS",
        description:
          "Welcome our latest innovation! We are proud to introduce the latest products designed to meet your needs better.",
        button_text: "MORE",
        button_url: "#",
        image_url: "assets/img/default-bg.jpg",
      },
      true,
      assetPath
    );
    return;
  }

  updateSliderContent(slidersData[0], true, assetPath);

  if (slidersData.length > 1) {
    let currentIndex = 0;
    setInterval(() => {
      currentIndex = (currentIndex + 1) % slidersData.length;
      updateSliderContent(slidersData[currentIndex], false, assetPath);
    }, 5000);
  }
}

function updateSliderContent(slider, isInitial, assetPath) {
  const contentWrapper = document.getElementById("sliderContent");
  const bgElement = document.getElementById("backgroundSlider");

  if (!contentWrapper || !bgElement) return;

  const newImageUrl = `${assetPath}${slider.image_url}`;

  const newContent = document.createElement("div");
  newContent.className = "content-wrapper slide-transition";
  newContent.style.opacity = "0";
  newContent.style.transition = "opacity 0.8s ease";
  newContent.innerHTML = `
        <div class="design-tagline" style="animation: slideInLeft 1s ease 0.2s both;">${
          slider.subtitle || ""
        }</div>
        <div class="design-title" style="animation: slideInLeft 1s ease 0.4s both;">
            <h1>${slider.title || "TITLE HERE"}</h1>
        </div>
        <div class="design-description" style="animation: slideInLeft 1s ease 0.6s both;">
            <p>${slider.description || ""}</p>
        </div>
        <div class="explore-btn" style="animation: slideInLeft 1s ease 0.8s both;">
            <a href="${slider.button_url || "#"}" class="btn-explore">
                ${slider.button_text || "MORE"}
            </a>
        </div>
    `;

  if (isInitial) {
    if (bgElement) {
      bgElement.style.backgroundImage = `url('${newImageUrl}')`;
    }
    contentWrapper.innerHTML = "";
    contentWrapper.appendChild(newContent);
    setTimeout(() => (newContent.style.opacity = "1"), 100);
  } else {
    contentWrapper.style.opacity = "0.7";
    setTimeout(() => {
      if (bgElement) {
        bgElement.style.backgroundImage = `url('${newImageUrl}')`;
      }
      contentWrapper.innerHTML = "";
      contentWrapper.appendChild(newContent);
      newContent.style.opacity = "1";
      contentWrapper.style.opacity = "1";
    }, 300);
  }
}

// Product Carousel Function
function initProductCarousel() {
  const carousel = document.getElementById("productCarousel");
  if (!carousel) return;

  const items = carousel.querySelectorAll(".carousel-item");
  if (!items.length) return;

  const prevBtn = document.querySelector(".nav-prev");
  const nextBtn = document.querySelector(".nav-next");
  const indicators = document.querySelectorAll(
    ".carousel-indicators .indicator"
  );

  let currentIndex = 0;
  let timer;
  let touchStartX, touchEndX;

  function showSlide(index) {
    if (index < 0) index = items.length - 1;
    if (index >= items.length) index = 0;

    items.forEach((item, i) => {
      item.classList.remove("active");
      if (i === index) {
        setTimeout(() => {
          item.classList.add("active");
          item.style.animation = "slideInRight 0.6s ease forwards";
        }, 100);
      }
    });

    if (indicators && indicators.length) {
      indicators.forEach((ind) => ind.classList.remove("active"));
      if (indicators[index]) {
        indicators[index].classList.add("active");
      }
    }

    currentIndex = index;

    clearInterval(timer);
    timer = setInterval(autoAdvance, 6000);
  }

  function autoAdvance() {
    showSlide(currentIndex + 1);
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", () => {
      showSlide(currentIndex - 1);
      prevBtn.style.transform = "scale(0.9)";
      setTimeout(() => (prevBtn.style.transform = ""), 150);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      showSlide(currentIndex + 1);
      nextBtn.style.transform = "scale(0.9)";
      setTimeout(() => (nextBtn.style.transform = ""), 150);
    });
  }

  if (indicators && indicators.length) {
    indicators.forEach((indicator, index) => {
      indicator.addEventListener("click", () => {
        showSlide(index);
      });
    });
  }

  // Touch/Swipe Support
  carousel.addEventListener(
    "touchstart",
    function (e) {
      touchStartX = e.changedTouches[0].screenX;
    },
    { passive: true }
  );

  carousel.addEventListener(
    "touchend",
    function (e) {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
    },
    { passive: true }
  );

  function handleSwipe() {
    const swipeThreshold = 50;
    if (touchStartX - touchEndX > swipeThreshold) {
      showSlide(currentIndex + 1);
    } else if (touchEndX - touchStartX > swipeThreshold) {
      showSlide(currentIndex - 1);
    }
  }

  timer = setInterval(autoAdvance, 6000);
  showSlide(0);

  carousel.addEventListener("mouseenter", function () {
    clearInterval(timer);
  });

  carousel.addEventListener("mouseleave", function () {
    timer = setInterval(autoAdvance, 6000);
  });

  document.addEventListener("visibilitychange", function () {
    if (document.hidden) {
      clearInterval(timer);
    } else {
      timer = setInterval(autoAdvance, 6000);
    }
  });
}
