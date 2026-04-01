function pixel_ebook_store_mobile_menu_open() {
  jQuery(".side_nav").addClass('show');
}
function pixel_ebook_store_mobile_menu_close() {
  jQuery(".side_nav").removeClass('show');
}

jQuery(function($){
  $('.toggle').click(function () {
    pixel_ebook_store_Keyboard_loop($('.side_nav'));
  });
});

var pixel_ebook_store_Keyboard_loop = function (elem) {
  var pixel_ebook_store_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var pixel_ebook_store_firstTabbable = pixel_ebook_store_tabbable.first();
  var pixel_ebook_store_lastTabbable = pixel_ebook_store_tabbable.last();
  pixel_ebook_store_firstTabbable.focus();

  pixel_ebook_store_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      pixel_ebook_store_firstTabbable.focus();
    }
  });

  pixel_ebook_store_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      pixel_ebook_store_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};

jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() >= 200) {
        jQuery("#return-to-top").fadeIn();
    } else {
        jQuery("#return-to-top").fadeOut();
    }
});

jQuery("#return-to-top").click(function () {
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
});

jQuery('#main-banner-wrap .owl-carousel').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  navText: [
    '<span>PREV</span>', // Left arrow
    '<span>NEXT</span>' // Right arrow
  ],
  responsive: {
    0: {
      items: 1,
      dots: false,
    },
    600: {
      items: 1,
    },
    1000: {
      items: 1,
    }
  }
});

jQuery('#main-category-wrap .owl-carousel').owlCarousel({
  loop: true,
  margin: 30,
  nav: false,
  dots: false,
  navText: [
    '<span>PREV</span>', // Left arrow
    '<span>NEXT</span>' // Right arrow
  ],
  responsive: {
    0: {
      items: 1,
      dots: false,
    },
    600: {
      items: 2,
    },
    1000: {
      items: 4,
    }
  }
});

jQuery('.subscriber-box .owl-carousel').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  navText: [
    '<span>PREV</span>', // Left arrow
    '<span>NEXT</span>' // Right arrow
  ],
  responsive: {
    0: {
      items: 1,
      dots: false,
    },
    600: {
      items: 1,
    },
    1000: {
      items: 1,
    }
  }
});

jQuery('.variety-box .owl-carousel').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  navText: [
    '<i class="fas fa-chevron-left mr-2"></i>', // Left arrow
    '<i class="fas fa-chevron-right"></i>' // Right arrow
  ],
  responsive: {
    0: {
      items: 1,
      dots: false,
    },
    600: {
      items: 1,
    },
    1000: {
      items: 1,
    }
  }
});