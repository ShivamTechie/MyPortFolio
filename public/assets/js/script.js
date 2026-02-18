// Jessica Portfolio Theme - JavaScript
(function($) {
    "use strict";

    $(document).ready(function() {
        
        // Hide loading screen
        setTimeout(() => {
            $('#loading').addClass('hidden');
        }, 1000);

        // Lightbox configuration
        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'fitImagesInViewport': true,
                'albumLabel': "Image %1 of %2"
            });
        }

        // Testimonial Swiper
        if (document.querySelector('.testimonial-swiper')) {
            var testimonialSwiper = new Swiper(".testimonial-swiper", {
                spaceBetween: 20,
                pagination: {
                    el: ".testimonial-swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    800: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });
        }

        // Smooth scrolling for navigation links
        $('a[href^="#"]').on('click', function(e) {
            var href = $(this).attr('href');
            if (href === '#') return;
            
            e.preventDefault();
            var target = $(href);
            
            if (target.length) {
                var offsetTop = target.offset().top - 80;
                $('html, body').animate({
                    scrollTop: offsetTop
                }, 800);

                // Close mobile menu
                $('.offcanvas').offcanvas('hide');
            }
        });

        // Active navigation on scroll
        $(window).on('scroll', function() {
            var scrollPos = $(window).scrollTop() + 100;
            
            $('section[id]').each(function() {
                var sectionTop = $(this).offset().top;
                var sectionHeight = $(this).outerHeight();
                var sectionId = $(this).attr('id');
                
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    $('.nav-link').removeClass('active');
                    $('.nav-link[href="#' + sectionId + '"]').addClass('active');
                }
            });

            // Navbar background on scroll
            if (scrollPos > 100) {
                $('.navbar').css('box-shadow', '0 4px 20px rgba(0, 0, 0, 0.1)');
            } else {
                $('.navbar').css('box-shadow', '0 2px 10px rgba(0, 0, 0, 0.05)');
            }
        });

        // Contact Form Handler
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var formData = new FormData(this);
            var submitBtn = form.find('button[type="submit"]');
            var btnText = submitBtn.html();
            var formMessage = $('#formMessage');
            
            // Disable button
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Sending...');
            formMessage.removeClass('alert-success alert-danger').hide();
            
            $.ajax({
                url: '/contact',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        formMessage.addClass('alert alert-success')
                            .html('<i class="fas fa-check-circle"></i> ' + (response.message || 'Message sent successfully!'))
                            .fadeIn();
                        form[0].reset();
                    } else {
                        formMessage.addClass('alert alert-danger')
                            .html('<i class="fas fa-exclamation-circle"></i> ' + (response.message || 'Failed to send message. Please try again.'))
                            .fadeIn();
                    }
                },
                error: function() {
                    formMessage.addClass('alert alert-danger')
                        .html('<i class="fas fa-exclamation-circle"></i> An error occurred. Please try again later.')
                        .fadeIn();
                },
                complete: function() {
                    submitBtn.prop('disabled', false);
                    submitBtn.html(btnText);
                    
                    // Hide message after 5 seconds
                    setTimeout(function() {
                        formMessage.fadeOut();
                    }, 5000);
                }
            });
        });

        // Animate elements on scroll
        var animateOnScroll = function() {
            $('.portfolio-item, .service-icon, .testimonial-card').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                
                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animate-in');
                }
            });
        };

        $(window).on('scroll', animateOnScroll);
        animateOnScroll(); // Initial check

        // Add animation classes
        $('<style>')
            .text(`
                .portfolio-item, .service-icon, .testimonial-card {
                    opacity: 0;
                    transform: translateY(30px);
                    transition: all 0.6s ease;
                }
                .animate-in {
                    opacity: 1 !important;
                    transform: translateY(0) !important;
                }
            `)
            .appendTo('head');

        // Stats counter animation
        var hasAnimated = false;
        $(window).on('scroll', function() {
            if (!hasAnimated && $('.stats-row').length) {
                var statsTop = $('.stats-row').offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();
                
                if (windowBottom > statsTop) {
                    hasAnimated = true;
                    $('.display-2').each(function() {
                        var $this = $(this);
                        var target = parseInt($this.text());
                        var duration = 2000;
                        var steps = 50;
                        var increment = target / steps;
                        var current = 0;
                        var stepDuration = duration / steps;
                        
                        var interval = setInterval(function() {
                            current += increment;
                            if (current >= target) {
                                $this.text(target);
                                clearInterval(interval);
                            } else {
                                $this.text(Math.floor(current));
                            }
                        }, stepDuration);
                    });
                }
            }
        });

        // Console message
        console.log('%c👋 Hello Developer!', 'font-size: 20px; font-weight: bold; color: #F0756C;');
        console.log('%cLooking for something? Let\'s connect!', 'font-size: 14px; color: #4BA1A7;');
        console.log('%cBuilt with ❤️ using PHP, MySQL, Bootstrap & Swiper.js', 'font-size: 12px; color: #777;');

    }); // End of document ready

})(jQuery);
