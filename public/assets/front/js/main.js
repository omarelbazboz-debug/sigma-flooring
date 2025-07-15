$(".hero-slider .owl-carousel").owlCarousel({
  items: 1,
  loop: true,
  nav: false,
  dots: false,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 5000,
  animateOut: "slideOutLeft", // الخروج إلى اليسار
  animateIn: "slideInRight", // الدخول من اليمين
  smartSpeed: 1000,
});

// navbar scroll
let nav = document.querySelector(".navbar");
let navHeight = nav.offsetHeight;
window.addEventListener("scroll", function () {
  let scrollTop = window.scrollY;
  if (scrollTop > navHeight) {
    nav.classList.add("fixed-top");
  } else {
    nav.classList.remove("fixed-top");
  }
});

// menu mobile
document.addEventListener("DOMContentLoaded", function () {
  // دالة للتحقق من حجم الشاشة
  function isMobileView() {
    return window.innerWidth <= 992;
  }

  // العناصر الرئيسية
  const dropdowns = document.querySelectorAll(".nav-item.dropdown");

  // العناصر الفرعية (Submenu)
  const submenus = document.querySelectorAll(".dropdown-submenu");

  // إضافة event listeners للعناصر الرئيسية
  dropdowns.forEach((dropdown) => {
    const toggle = dropdown.querySelector(".products-toggle");

    toggle.addEventListener("click", function (e) {
      if (isMobileView()) {
        e.stopPropagation();
        dropdown.classList.toggle("show");

        // إغلاق القوائم الأخرى عند فتح واحدة جديدة
        dropdowns.forEach((otherDropdown) => {
          if (otherDropdown !== dropdown) {
            otherDropdown.classList.remove("show");
          }
        });
      }
    });
  });

  // إضافة event listeners للعناصر الفرعية
  submenus.forEach((submenu) => {
    const toggle = submenu.querySelector(".submenu-toggle");

    toggle.addEventListener("click", function (e) {
      if (isMobileView()) {
        e.stopPropagation();
        submenu.classList.toggle("show");
      }
    });
  });

  // إغلاق القوائم عند النقر خارجها (للشاشات الصغيرة فقط)
  document.addEventListener("click", function () {
    if (isMobileView()) {
      dropdowns.forEach((dropdown) => {
        dropdown.classList.remove("show");
      });

      submenus.forEach((submenu) => {
        submenu.classList.remove("show");
      });
    }
  });

  // تحديث السلوك عند تغيير حجم النافذة
  window.addEventListener("resize", function () {
    if (!isMobileView()) {
      // إغلاق جميع القوائم عند التبديل إلى عرض كبير
      dropdowns.forEach((dropdown) => {
        dropdown.classList.remove("show");
      });

      submenus.forEach((submenu) => {
        submenu.classList.remove("show");
      });
    }
  });
});

// Back To Top Slider
document.addEventListener("DOMContentLoaded", function() {
  const backTopButton = document.getElementById("back-top");
  
  // Show/hide button on scroll
  window.addEventListener("scroll", function() {
    if (window.scrollY > 20) {
      backTopButton.classList.add("show");
    } else {
      backTopButton.classList.remove("show");
    }
  });

  // Scroll to top when clicked
  backTopButton.addEventListener("click", function(e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
});