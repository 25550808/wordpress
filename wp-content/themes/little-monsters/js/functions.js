(function () {

    "use strict";
    
    jQuery(document).ready(function ($) {
        // Search toggle.
        $('.search-toggle').on('click.littlemonsters', function (event) {
            var that = $(this),
                wrapper = $('#search-container'),
                container = that.find('a');

            that.toggleClass('active');
            wrapper.toggleClass('hide');

            if (that.hasClass('active')) {
                container.attr('aria-expanded', 'true');
            } else {
                container.attr('aria-expanded', 'false');
            }

            if (that.is('.active') || $('.search-toggle .screen-reader-text')[0] === event.target) {
                wrapper.find('.search-field').focus();
            }
        });

        /**********************************************************************
        * Login Ajax
        **********************************************************************/

        $('#opallostpasswordform').hide();
        $('#modalLoginForm form .btn-cancel').on('click', function () {
            $('#modalLoginForm').modal('hide');
            $('#modalLoginForm .alert').remove();
        });

        // sign in proccess
        $('form.login-form').on('submit', function () {
            var $this = $(this);
            $('.alert', this).remove();
            $.ajax({
                url: littlemonstersAjax.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize() + "&action=opalajaxlogin"
            }).done(function (data) {
                if (data.loggedin) {
                    $this.prepend('<div class="alert alert-info">' + data.message + '</div>');
                    location.reload();
                } else {
                    $this.prepend('<div class="alert alert-warning">' + data.message + '</div>');
                }
            });
            return false;
        });


        $('form#opalrgtRegisterForm').on('submit', function () {
            var $this = $(this);
            $('.alert', this).remove();
            $.ajax({
                url: littlemonstersAjax.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize() + "&action=opalajaxregister"
            }).done(function (data) {
                if (data.status == 1) {
                    $this.prepend('<div class="alert alert-info">' + data.msg + '</div>');
                    location.reload();
                } else {
                    $this.prepend('<div class="alert alert-warning">' + data.msg + '</div>');
                }
            });
            return false;
        });


        $('form .toggle-links').on('click', function () {
            $('.form-wrapper').hide();
            $($(this).attr('href')).show();
            return false;
        });

        // sign in proccess
        $('form.lostpassword-form').on('submit', function () {
            var $this = $(this);
            $('.alert', this).remove();
            $.ajax({
                url: littlemonstersAjax.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize() + "&action=opalajaxlostpass"
            }).done(function (data) {
                if (data.loggedin) {
                    $this.prepend('<div class="alert alert-info">' + data.message + '</div>');
                    location.reload();
                } else {
                    $this.prepend('<div class="alert alert-warning">' + data.message + '</div>');
                }
            });
            return false;
        });

        /**
         *
         */
        $(".dropdown-toggle-overlay").on('click', function () {
            $($(this).data('target')).addClass("active");
        });

        $(".dropdown-toggle-button").on('click', function () {
            $($(this).data('target')).removeClass("active");
            return false;
        });

        /**
         *
         * Automatic apply  OWL carousel
         */
        $(".owl-carousel-play .owl-carousel").each(function () {
            var config = {
                navigation: $(this).data('navigation'), // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                pagination: $(this).data('pagination'),
                autoHeight: false,
            };

            var owl = $(this);
            if ($(this).data('slide') == 1) {
                config.singleItem = true;
            } else {
                config.items = $(this).data('slide');
            }
            if ($(this).data('desktop')) {
                config.itemsDesktop = $(this).data('desktop');
            }
            if ($(this).data('desktopsmall')) {
                config.itemsDesktopSmall = $(this).data('desktopsmall');
            }
            if ($(this).data('tablet')) {
                config.itemsTablet = $(this).data('tablet');
            }
            if ($(this).data('tabletsmall')) {
                config.itemsTabletSmall = $(this).data('tabletsmall');
            }
            if ($(this).data('mobile')) {
                config.itemsMobile = $(this).data('mobile');
            }
            $(this).owlCarousel(config);
            $('.left', $(this).parent()).on('click', function () {
                owl.trigger('owl.prev');
                return false;
            });
            $('.right', $(this).parent()).on('click', function () {
                owl.trigger('owl.next');
                return false;
            });
        });

        /**
         *
         */
        if ($('.page-static-left')) {
            $('.page-static-left .button-action').on('click', function () {
                $('.page-static-left').toggleClass('active');
            });
        }

        // menu home 3
        $('.menu-button').on('click', function () {
            $(this).toggleClass('menu-close');
            $('.wrapper').toggleClass('active');
        });


        //fix map
        if ($('.kc-google-maps').length > 0) {

            $('.kc-google-maps').on('click', function () {
                $('.kc-google-maps iframe').css("pointer-events", "auto");
            });

            $(".kc-google-maps").mouseleave(function () {
                $('.kc-google-maps iframe').css("pointer-events", "none");
            });
        }

        /**
         * Scroll To Top
         */
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 200) {
                jQuery('.scrollup').fadeIn();
            } else {
                jQuery('.scrollup').fadeOut();
            }
        });

        jQuery('.scrollup').on('click', function () {
            jQuery("html, body").animate({scrollTop: 0}, 600);
            return false;
        });


        //Offcanvas Menu

        $('[data-toggle="offcanvas"], .btn-offcanvas').on('click', function () {
            $('.row-offcanvas').toggleClass('active')
            $('#opal-off-canvas').toggleClass('active');
        });
        
         //mobile click
        $('#main-menu-offcanvas .caret').on('click', function () {
            var $a = jQuery(this);
            $a.parent().find('> .dropdown-menu').slideToggle();
            if ($a.parent().hasClass('level-0')) {
                if($a.parent().hasClass('show')){
                    $a.parent().removeClass('show');
                }else{
                    $a.parents('li').siblings('li').find('ul:visible').slideUp().parent().removeClass('show');
                    $a.parent().addClass('show');
                }
            }
        });

        $('.showright').on('click', function () {
            $('.offcanvas-showright').toggleClass('active');
        });

        //Sticky menu header
        var nav = jQuery('.has-sticky');
        if (nav) {
            jQuery(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    nav.addClass("keeptop");
                } else {
                    nav.removeClass("keeptop");
                }
            });
        }


        //Gallery photo
        $("a[rel^='prettyPhoto[pp_gal]']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            social_tools: false,
        });

        //Video popup

        $("a[rel^='prettyPhoto[video]']").prettyPhoto({
            animation_speed:'normal',
            theme:'light_square',
            social_tools: false,
        });

        /*----------------------------------------------
         *    Apply Filter
         *----------------------------------------------*/
        jQuery('.isotope-filter li a').click(function () {

            var parentul = jQuery(this).parents('ul.isotope-filter').data('related-grid');
            jQuery(this).parents('ul.isotope-filter').find('li a').removeClass('active');
            jQuery(this).addClass('active');
            var selector = jQuery(this).attr('data-option-value');
            jQuery('#' + parentul).isotope({filter: selector}, function () {
            });

            return (false);
        });

    });
})(jQuery);