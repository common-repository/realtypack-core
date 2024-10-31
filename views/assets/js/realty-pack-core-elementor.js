;
(function ($) {
    'use strict';

    var rtpcFrontendFunctions = {
        // gets elemnts settings by data-setting attribute
        getElementSetting: function (element) {},
        getElementData: function (element) {
            return $(element).data();
        },
        // runs everytime an specific widget gets ready ( by changes)
        runOnWidgetReady: function (widgetName, fn) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, function ($scope, h) {
                fn();
            });
        },
        runSwiper: function (className, options, widgetName) {
            if (window.elementorFrontend && elementorFrontend.hooks) {
                //if () {
                this.runOnWidgetReady(widgetName, function () {
                    new Swiper(className, options || {
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        //grabCursor: true,
                        //slideClass:'.rtpc-testimonial-swiper-slide',
                    });
                })
                //}
            } else {
                setTimeout(function () {
                    new Swiper(className, options || {
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        //slideClass:'.rtpc-testimonial-swiper-slide',
                    });
                }, 5000);
            }
        }
    }

    $(document).ready(function ($) {
        /**
         * run counters
         * 
         * @since 1.0
         */
        // runs functions on elementor editor ( everytime it get changes)
        if (window.elementorFrontend) {
            if (elementorFrontend.hooks) {
                // runs counter in widget editor
                rtpcFrontendFunctions.runSwiper('.rtp-recent-viewed-container', {
                    slidesPerView: 1,
                    autoplay: true,
                    loop: true,
                    pagination: {
                        el: '.rtp-recent-viewed-swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.slider-control-left',
                        prevEl: '.slider-control-right',
                    },
                });
            }
        }

        /**
         * Testimonial Widget
         * 
         * Run Swipper
         * 
         */
        rtpcFrontendFunctions.runSwiper('.rtpc-testimonial-swiper-container', {
            slidesPerView: 1,
            loop: true,
            navigation: {
                nextEl: '.rtpc-testimonial-arrowbutton-next',
                prevEl: '.rtpc-testimonial-arrowbutton-prev',
            },
            //grabCursor: true,
        }, 'RTPC_testimonial.default');


        /**
         * Recent Posts Grid Slider Widget
         * 
         * Run Swipper
         * 
         */
        rtpcFrontendFunctions.runSwiper('.rtpc-rpgs-property-slider', {
            slidesPerView: 1,
            autoHeight: true,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            //grabCursor: true,
        });
        /**
         * Our Agents Widget
         * 
         * Run Swipper
         * 
         */
        rtpcFrontendFunctions.runSwiper('.our-agents-container', {
            slidesPerView: 4,
            slidesPerGroup: 4,
            loop: true,
            loopFillGroupWithBlank: false,
            centerInsufficientSlides: true,
            // grabCursor: true,
            pagination: {
                el: '.our-agents-pagination',
                clickable: true,
                bulletClass: 'our-agents-swiper-pagination-bullet',
                bulletActiveClass: 'our-agents-swiper-pagination-bullet-active'
            },
            breakpoints: {
                // when window width is <= 480
                480: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 0
                },
                // when window width is <= 1133
                1133: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 0
                },
                1400: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    spaceBetween: 0
                },
            }
        }, 'our-agents.default');

        /**
         * Property Listing Carousal
         * 
         * @since 1.0
         * 
         */
        rtpcFrontendFunctions.runSwiper('.rtp-carousel', {
            slidesPerView: 1,
            initialSlide: 1,
            loop: true,
            autoplay: {
                delay: 5000,
            },
            breakpoints: {
                // when window width is <= 480
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            },
            centeredSlides: true,
            spaceBetween: -40,
            pagination: {
                el: '.slide-counter',
                type: 'progressbar',
            },
            navigation: {
                nextEl: '.slider-control-left',
                prevEl: '.slider-control-right',
            },

        }, 'RTPC_property_listing_carousal.default');

        /**
         * Property Listing Carousal Type 2
         * 
         * @since 1.0
         * 
         */
        rtpcFrontendFunctions.runSwiper('.rtp-carousel-type2', {
            slidesPerView: 1,
            autoplay: {
                "stopOnLastSlide": true,
                "disableOnInteraction": false,
            },
            breakpoints: {
                // when window width is <= 480
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },

            },
            centeredSlides: true,
            //spaceBetween: -40,
            pagination: {
                el: '.slide-counter',
                type: 'progressbar',
            },
            navigation: {
                nextEl: '.slider-control-left',
                prevEl: '.slider-control-right',
            },
        }, 'RTPC_property_listing_carousal.default');

        /**
         * iconbox carousel Widget
         * 
         * Run Swipper
         * 
         */
        rtpcFrontendFunctions.runSwiper('.rtpc-iconbox-carousel', {
            slidesPerView: 3,
            slidesOffsetBefore: '123',
            //grabCursor: true,
            //freeMode: true,
            breakpoints: {
                // when window width is <= 480
                480: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
                // when window width is <= 1133
                1133: {
                    slidesPerView: 2,
                    spaceBetween: 0
                },
                // when window width is <= 1366
                1366: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
            }
        }, 'rtpc-iconbox-carousel.default');

        $('.more_search_option').click(function () {
            $(this).parent().parent().find('.wpl_search_from_box_bot').slideToggle('fast');
            $(this).find('.rtpc-search-more-option').toggle();
            $(this).find('.rtpc-search-less-option').toggle();
        });

        $(".rtpc-search-tab").click(function () {
            if ($(this).hasClass("rtpc-search-tab-active")) {
                return;
            }
            $(this).parent().find(".rtpc-search-tab").each(function () {
                $(this).removeClass("rtpc-search-tab-active");
            })
            $(this).addClass("rtpc-search-tab-active");
        })

        /**
         * property listing Change Filter Tabs
         * 
         * @since 1.0
         *  
         */

        $(".rtpc-change-checked input:radio").click(function () {
            console.log($(this).parent());
            var that = this;

            $(this).parent().find("input:radio").next().removeClass("checked");
            setTimeout(function () {
                $(that).next().addClass("checked");
            }, 100);
        });


        $("#rtpcPropertyGrid").click(function () {
            $(this).addClass('checked');
            $('#rtpcPropertyColumn').removeClass('checked');
            $('.rtpc-rpgs-properties-container').addClass("rtpc-rpgs-properties-grid");
            $('.rtpc-rpgs-properties-container').removeClass("rtpc-rpgs-properties-column");
        });

        /**
         * property listing Toggle Grid & Column View
         * 
         * @since 1.0
         *  
         */

        $("#rtpcPropertyColumn").click(function () {
            $(this).addClass('checked');
            $('#rtpcPropertyGrid').removeClass('checked');
            $('.rtpc-rpgs-properties-container').addClass("rtpc-rpgs-properties-column");
            $('.rtpc-rpgs-properties-container').removeClass("rtpc-rpgs-properties-grid");
        });

        $("#rtpcPropertyGrid").click(function () {
            $(this).addClass('checked');
            $('#rtpcPropertyColumn').removeClass('checked');
            $('.rtpc-rpgs-properties-container').addClass("rtpc-rpgs-properties-grid");
            $('.rtpc-rpgs-properties-container').removeClass("rtpc-rpgs-properties-column");
        });

        /**
         * property Recent Viewed
         * 
         * @since 1.0
         *  
         */
        rtpcFrontendFunctions.runSwiper('.rtp-recent-viewed-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: true,
            loop: true,
            pagination: {
                el: '.rtp-recent-viewed-swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.slider-control-left',
                prevEl: '.slider-control-right',
            },
        }, 'rtp_recent_viewed.default');

        $("#rtpcAgentGrid").click(function () {
            $(this).addClass('checked');
            $('#rtpcAgentColumn').removeClass('checked');
            $('.rtpc-agent-list-column').addClass('rtpc-agent-list-grid');
            $('.rtpc-agent-list-column').removeClass('rtpc-agent-list-column');
        });
        $("#rtpcAgentColumn").click(function () {
            $(this).addClass('checked');
            $('#rtpcAgentGrid').removeClass('checked');
            $('.rtpc-agent-list-grid').addClass('rtpc-agent-list-column');
            $('.rtpc-agent-list-grid').removeClass('rtpc-agent-list-grid');
        });

        /**
         * Single Property Slider
         * 
         * @since 1.0
         *  
         */
        window.onload = function () {
            var singlePropertyGalleryTop = new Swiper('.rtpc-single-property-gallery', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
                loopedSlides: $(".rtpc-single-property-gallery").data("slide-count")
            });
            var singlePropertyGalleryThumbs = new Swiper('.rtpc-single-property-gallery-thumbs', {
                spaceBetween: 20,
                //centeredSlides: true,
                touchRatio: 0.2,
                slidesPerView: $(".rtpc-single-property-gallery").data("slide-count") < 6 ? $(".rtpc-single-property-gallery").data("slide-count") : 6,
                slideToClickedSlide: true,
                loop: true,
                freeMode: true,
                loopedSlides: $(".rtpc-single-property-gallery").data("slide-count"),
                // watchSlidesVisibility: true,
                // watchSlidesProgress: true,
                loopFillGroupWithBlank: false,
            });
            if (singlePropertyGalleryTop.controller) {
                singlePropertyGalleryTop.controller.control = singlePropertyGalleryThumbs;
                singlePropertyGalleryThumbs.controller.control = singlePropertyGalleryTop;
            }
        }
        //}, 5000);

        /**
         * Contact form in single agency and agent
         * 
         * @since 1.0
         *  
         */
        $(document).on('click', '.rtpc-single-agency-contact-container .rtp-main-button-blue a[href="#"]', function (event) {
            event.preventDefault();

            let user = $(this).attr('data-user');
            let nounce = $(this).attr('data-nounce');
            let name = $('#rtpc-agency-contact-name').val();
            let phone = $('#rtpc-agency-contact-phone').val();
            let email = $('#rtpc-agency-contact-email').val();
            let contact = $('#rtpc-agency-contact-contact').val();
            $(this).removeAttr('href');
            // Remove notice message
            $('.rtpc-message').text('');

            $.ajax({
                type: "POST",
                url: rtpc.adminajax,
                data: {
                    action: 'rtpc_agency_contact',
                    security: nounce,
                    user: user,
                    name: name,
                    phone: phone,
                    email: email,
                    contact: contact,
                },
                success: function (data) {
                    // check error
                    if (true == data.error) {
                        $('.rtpc-message').addClass('rtpc-failure-msg');
                        $('.rtpc-message').removeClass('rtpc-success-msg');
                        $('.rtpc-message').text(data.message);
                    } else {
                        $('.rtpc-message').addClass('rtpc-success-msg');
                        $('.rtpc-message').removeClass('rtpc-failure-msg');
                        $('.rtpc-message').text(data.message);
                    }
                    $(this).attr('href', '#');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Remove the loading Class
                    $(this).attr('href', '#');
                }
            });
        });

        /**
         * Newsletter widget
         * 
         * @since 1.0
         */
        $(document).on('click', '.rtpc-newsletter-submit', function (event) {
            event.preventDefault();

            let $this = $(this);
            let nounce = $this.attr('data-nounce');
            let email = $this.prev('input[type="text"]').val();

            // Remove notice message
            $('.rtpc-message').text('');

            $.ajax({
                type: "POST",
                url: rtpc.adminajax,
                data: {
                    action: 'rtpc_newsletter',
                    security: nounce,
                    email: email,
                },
                success: function (data) {
                    // check error
                    if (true == data.error) {
                        $this.parent().children('.rtpc-message').addClass('rtpc-success-msg');
                        $this.parent().children('.rtpc-message').removeClass('rtpc-failure-msg');
                        $this.parent().children('.rtpc-message').text(data.message);
                    } else {
                        $this.parent().children('.rtpc-message').addClass('rtpc-failure-msg');
                        $this.parent().children('.rtpc-message').removeClass('rtpc-success-msg');
                        $this.parent().children('.rtpc-message').text(data.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {}
            });
        });

        /**
         * Favorite Single widget
         * 
         * @since 1.0
         */
        $(document).on('click', '.rtpc-sp-favorite[href="#"]', function (event) {
            event.preventDefault();

            let $this = $(this);
            let nounce = $this.attr('data-nounce');
            let pid = $this.attr('data-pid');
            let mode = $this.attr('data-mode');
            $($this).removeAttr('href');

            $.ajax({
                type: "POST",
                url: rtpc.adminajax,
                data: {
                    action: 'rtpc_single_favorite',
                    security: nounce,
                    pid: pid,
                    mode: mode,
                },
                success: function (data) {
                    // check error
                    if ('remove' == data.action) {
                        $this.attr('data-mode', '1');
                        $this.attr('title', 'Add to favorite');
                    }
                    if ('add' == data.action) {
                        $this.attr('data-mode', '0');
                        $this.attr('title', 'Remove from favorite');
                    }
                    $($this).attr('href', '#');
                },
                error: function (jqXHR, textStatus, errorThrown) {}
            });
        });

        /**
         * Property widget changing sort options
         * 
         * @since 1.0
         */
        $(document).on('change', '.rtpc-agent-sort .wpl_plist_sort', function (event) {
            event.preventDefault();

            $(this).removeAttr('onchange');

            let order_string = $(this).val();

            let order_obj = order_string.split('&');
            let order_v1 = order_obj[0].split('=');
            let order_v2 = order_obj[1].split('=');

            let url = window.location.href;

            url = wpl_update_qs(order_v1[0], order_v1[1], url);
            url = wpl_update_qs(order_v2[0], order_v2[1], url);

            /** Move to First Page **/
            url = wpl_update_qs('wplpage', '1', url);

            window.location = url;
        });

        /**
         * Property widget filter option
         * 
         * @since 1.0
         */
        $(document).on('click', '.rtpc-rpgs-filter-tabs .tab', function (event) {
            event.preventDefault();
            //myself
            var $this = $(this);
            // Get listing id clicked
            var listing = $this.attr('data-listing');

            // remove active class from sibiling
            $('.rtpc-rpgs-filter-tabs .tab').removeAttr('checked');
            // Add active class to myself
            $this.attr('checked', true);

            $('.rtpc-rpgs-properties-container .rtpc-rpgs-property-box').each(function (index, el) {
                if ( listing == 'all') {
                    $(el).show();
                } else if( $(el).attr('data-listing') != listing ) {
                    $(el).hide();
                } else {
                    $(el).show();
                }
            });
        });


        $('#rtpc-reset-password').click(function () {
            $('.rtpc-signin-show').fadeOut('fast', function () {
                $('.rtpc-resetpass-show').fadeIn('slow');
            });
        })

        $("#rtpc-back-to-signin, .featherlight-close").click(function () {
            $('.rtpc-resetpass-show').fadeOut('fast', function () {
                $('.rtpc-signin-show').fadeIn('slow');
            });
        })

        // Close Featherlights
        $(document).on('click', '#signin-open-register', function (event) {
            setTimeout(function () {
                $.featherlight($('.rtpc-register-box'));
            }, 350);
        });

        // var signinFeather = new $.featherlight($('.rtpc-signin-box'), {
        //     afterOpen: function () {

        //         var count = 1;
        //         $('.rtpc-signin-box').find('input, select, textarea, button').each(function () {
        //             $(this).attr('tabindex', count++);
        //         });

        //     },
        // });

        // var registerFeather = new $.featherlight($('.rtpc-register-box'), {
        //     afterOpen: function () {

        //         var count = 1;
        //         $('.rtpc-register-box').find('input, select, textarea, button').each(function () {
        //             $(this).attr('tabindex', count++);
        //         });

        //     },
        // });

    });

})(jQuery);