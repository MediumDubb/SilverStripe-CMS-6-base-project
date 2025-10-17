jQuery.noConflict();

(function ($) {
  $(document).ready(function () {

    let menuScrolledHeight;
    const scrollOffset = 40;

    AOS.init({
      once: true,
    });

    siteToast();
    initBSToolTips();
    scrollProgress();
    toggleSearchOverlay();
    minHeighMain();

    function toggleSearchOverlay() {
      const body = $('body');
      const searchInput = $('nav.navbar button.search-btn');
      const searchOverlay = $('#searchOverlay');
      const closeOverlay = $('#closeOverlay');

      searchInput.off('click').on('click', () => {
        if (!searchOverlay.is(':visible')) {
          body.addClass('overflow-hidden');
          searchOverlay.toggle();
        }
      });

      closeOverlay.off('click').on('click', () => {
        if (searchOverlay.is(':visible')) {
          body.removeClass('overflow-hidden');
          searchOverlay.toggle();
        }
      });
    }

    function scrollProgress() {
      const largeHero = $('.element .container-hero-content > div');
      const shortHero = $('.element .short-hero-panel p');
      if (largeHero.length > 0 ) {
        menuScrolledHeight = (largeHero.offset().top - $('#main-nav').outerHeight()) - scrollOffset;
      }
      if ( shortHero.length > 0 ) {
        menuScrolledHeight = (shortHero.offset().top - $('#main-nav').outerHeight()) - scrollOffset;
      }
      // Reads out the scroll position and stores it in the data attribute
      // so we can use it in our stylesheets
      const storeScroll = () => {
        document.getElementById('main-nav').dataset.scroll = window.scrollY.toString();
        // optimize this to only "turn on" when nav touches hero panel content element
        document.getElementById('main-nav').dataset.menuScrolled = (window.scrollY > menuScrolledHeight).toString();
      }
      // https://pqina.nl/blog/applying-styles-based-on-the-user-scroll-position-with-smart-css/
      // The debounce function receives our function as a parameter
      const debounce = (fn) => {
        // This holds the requestAnimationFrame reference, so we can cancel it if we wish
        let frame;
        // The debounce function returns a new function that can receive a variable number of arguments
        return (...params) => {
          // If the frame variable has been defined, clear it now, and queue for next frame
          if (frame) {
            cancelAnimationFrame(frame);
          }
          // Queue our function call for the next frame
          frame = requestAnimationFrame(() => {
            // Call our function and pass any params we received
            fn(...params);
          });
        }
      };
      // Listen for new scroll events, here we debounce our `storeScroll` function
      document.addEventListener('scroll', debounce(storeScroll), { passive: true });

      storeScroll();
    }

    function minHeighMain() {
      let main, contentHeightDiff;
      const footer = $('footer.footer');
      main = $('div.main[role="main"]');

      contentHeightDiff = Math.round( $(window).height() - ( main.outerHeight() + footer.outerHeight() ) );

      if (contentHeightDiff > 0) {
        main.css('min-height', Math.floor(main.outerHeight() + contentHeightDiff));
      }
    }

    function initBSToolTips() {
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    }

    function siteToast() {
      let $toast = $('#site-toast');

      if (sessionStorage.getItem('toast-exited') === '1') {
        $toast.addClass('d-none');
      }

      $('#site-toast svg.bi.bi-x').on('click', function () {
        $toast.addClass('hide');
        sessionStorage.setItem('toast-exited', '1');
      })
    }
  });
}(jQuery));
