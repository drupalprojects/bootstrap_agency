/**
 * @file
 * Javascript functions used by the bootstrap_agency theme.
 */

(function ($) {
  Drupal.behaviors.agencyTheme = {
    attach: function (context) {
      // Replace cbpAnimatedHeader.js.
      $(window).scroll(function () {
          if ($(this).scrollTop() > 200) {
              $('.navbar-default').addClass('navbar-shrink');
          }
          else {
              $('.navbar-default').removeClass('navbar-shrink');
          }
      });

      // Hide the responsive menu when clicking in a menu item.
      $('#navbar').find('.navbar-collapse ul li:not(.dropdown) a').click(function () {
          $('#navbar button.navbar-toggle:visible').click();
      });
    }
  };
})(jQuery);
