(function ($) {
    'use strict';
    /**
     *  Singin Register Template
     */
    $.fn.RTPC_signin_register = function (options) {
        // Default Options
        var settings = $.extend({
            // These are the defaults.
            selector: '',
            type: null,
            nounce: '',
            action_hook: '',

        }, options);

        if ('signin' === settings.type) {
            signin();
        } else if ('register' === settings.type) {
            register();
        } else if ('reOpenRegister' === settings.type) {
            reOpenRegister();
        }

        function signin() {

            $(document).on('click', settings.selector, function (event) {
                event.preventDefault();

                var username = $('.featherlight #rtpc-username').val();
                var password = $('.featherlight #rtpc-password').val();
                var remeber_me = $('.featherlight #remeber_me').prop('checked');

                $.ajax({
                    type: "POST",
                    url: rtpc.adminajax,
                    data: {
                        action: settings.action_hook,
                        security: settings.nounce,
                        username: username,
                        password: password,
                        remeber_me: remeber_me,
                    },
                    success: function (data) {

                        if (data.error == true) {
                            $('.featherlight .signin-message').html(data.message);
                        } else {
                            $('.featherlight .signin-message').html(data.message);
                            // Remove the loading Class
                            setTimeout(function () {
                                location.reload(true);
                            }, 100);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('.featherlight .signin-message').html('');
                        // Remove the loading Class
                        setTimeout(function () {

                        }, 100);
                    }
                });
            });
        }

        function register() {

            $(document).on('click', settings.selector, function (event) {
                event.preventDefault();

                var email = $('.featherlight #RTPC_register_email').val();
                var username = $('.featherlight #RTPC_register_username').val();
                var fname = $('.featherlight #RTPC_register_fname').val();
                var lname = $('.featherlight #RTPC_register_lname').val();
                var role = $('.featherlight #RTPC__registerrole').val();
                var password = $('.featherlight #RTPC_register_password').val();
                var rpassword = $('.featherlight #RTPC_register_rpassword').val();
                var term_services = $('.featherlight #term_register_services').prop('checked');

                // Remove last html
                $('.featherlight .register-message').empty();

                $.ajax({
                    type: "POST",
                    url: rtpc.adminajax,
                    data: {
                        action: settings.action_hook,
                        security: settings.nounce,
                        email: email,
                        username: username,
                        fname: fname,
                        lname: lname,
                        role: role,
                        password: password,
                        rpassword: rpassword,
                        term_services: term_services,
                    },
                    success: function (data) {
                        $.each(data.message, function (index, message) {
                            $('.featherlight .register-message').append('<span>' + message + '</span>');
                        });

                        // Remove the loading Class
                        if (data.error == false) {
                            setTimeout(function () {
                                location.reload(true);
                            }, 100);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // Remove the loading Class
                        setTimeout(function () {

                        }, 100);
                    }
                });
            });
        }

        function reOpenRegister() {

            $(document).on('click', settings.selector, function (event) {
                event.preventDefault();

                // Close current light box
                var current = $.featherlight.current();
                current.close();

                // Open Register 
                $('.rtp-register-button').trigger('click');

            });
        }

    };

    $('.rtp-lazy').Lazy({
        // your configuration goes here
        scrollDirection: 'vertical',
        effect: 'fadeIn',
        visibleOnly: true,
        onError: function (element) {
            console.log('error loading ' + element.data('src'));
        }
    });


})(jQuery);