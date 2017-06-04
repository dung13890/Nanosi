(function($) {
    "use strict";

    function element_exits(el) {
        return el.length;
    }

    /**
     * General.
     */
    function general() {
        /* On Parallax for .parallax class. */
    	$('.parallax').parallax("50%", 0.2);
    }

    /**
     * Owl Carousel.
     */
    function owlSlide() {
        var $owlSlide = $('.owl-slide');
        if( element_exits($owlSlide) ) {
            $owlSlide.each(function() {
                $(this).owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 10,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true
                });
            });
        }
    }

    /**
     * Product Gallery.
     */
    function productGallery() {
        var sync1 = '#owl-sync1';
        var sync2 = '#owl-sync2';

        // Initialize plugin
        var owlCarousel1 = $(sync1).owlCarousel({
            items: 1,
            nav: true,
        });
        var owlCarousel2 = $(sync2).owlCarousel({
            items: 4,
            margin: 10,
        });

        // Sync carousel & add current class
        carouselSyncCurrentClass();

        // On carousel change: Sync carousel & add current class
        owlCarousel1.on('changed.owl.carousel', function() {
          carouselSyncCurrentClass();
        });
        owlCarousel2.on('changed.owl.carousel', function(event) {
          carouselSyncCurrentClass();
        });

        // Thumbs switch click event.
        owlCarousel2.find('.item').click(function() {
            var itemIndex = $(this).parent().index();
            owlCarousel1.trigger('to.owl.carousel', itemIndex);
            carouselSyncCurrentClass();
        });

        function carouselSyncCurrentClass() {
            setTimeout(function() {
                var carousel1ActiveIndex = $('#owl-sync1 .owl-item.active').index();
                $('#owl-sync1 .owl-item img').removeClass('elevate-zoom');
                $('#owl-sync1 .owl-item.active img').addClass('elevate-zoom');
                productZoomDestroy();
                productZoom();

                $('#owl-sync2 .owl-item').removeClass('current');
                var currentItem = $('#owl-sync2 .owl-item:nth-child(' + (carousel1ActiveIndex + 1) + ')');
                currentItem.addClass('current');

                if (!currentItem.hasClass('active')) {
                    if (currentItem.prevAll('.active').length > 0) {
                        owlCarousel2.trigger('next.owl.carousel');
                    }
                    if (currentItem.nextAll('.active').length) {
                        owlCarousel2.trigger('prev.owl.carousel');
                    }
                }
            }, 100);
        }
    }

    /**
     * Product popup with Fancybox.
     */
    function productFancybox() {
        var $fancyboxElement = $('#owl-sync1 img[data-fancybox="gallery"]');
        if (element_exits($fancyboxElement)) {
            $fancyboxElement.fancybox({
                thumbs : {
                    showOnStart : true
                }
            });
        }
    }

    /**
     * Product zoom.
     */
    function productZoom() {
        var $zoomElement = $('.elevate-zoom');
        if (element_exits($zoomElement)) {
            $zoomElement.each(function() {
                $(this).elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair"
                });
            });
        }
    }

    function productZoomDestroy() {
        var $zoomElement = $('.elevate-zoom');
        if (element_exits($zoomElement)) {
            $zoomElement.each(function() {
                $.removeData($(this), 'elevateZoom');//remove zoom instance from image

                $('.zoomContainer').remove();// remove zoom container from DOM
            });
        }
    }

    $(document).ready(function() {
        general();
        owlSlide();
        productGallery();
        productZoom();
        productFancybox();
    });

    $(window).load(function () {

    });

})(jQuery);
