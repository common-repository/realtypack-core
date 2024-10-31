(function ($) {
    'use strict';

    $(document).ready(function () {
        // Single builder template dom
        $('.post-type-single_builder .wrap .page-title-action').attr('data-featherlight', '.rtpc-single-builder-continer');
        // Close import modal button
        $(document).on('click', '.rtpc-close-import-modal', function (event) {
            event.preventDefault();
            $('.featherlight .featherlight-content .featherlight-close').trigger('click')
        });
    });


    function checkImportStatus() {

        let inputs = $('.rtpc-admin-form-checkbox-list li input');
        let condition = 'yes';

        $.each(inputs, function (index, val) {
            if ($(inputs[index]).prop('checked') === true) {
                if ($(inputs[index]).next('span').attr('data-action') == 'ready' || $(inputs[index]).next('span').attr('data-action') == 'downloaded') {
                    condition = 'no';
                }
            }
        });

        return condition;
    }

    function turnOnImportButtonStatus() {

        let inputs = $('.rtpc-admin-form-checkbox-list li input');
        let condition = false;

        $.each(inputs, function (index, val) {
            if ($(inputs[index]).prop('checked') === true) {
                condition = true;
            }
        });

        if (condition === true && $('.featherlight .featherlight-content .rtpc-admin-form-plugin-list .btn .blue').length < 1) {
            // Check import button status
            $('.rtpc-admin-import-button').addClass('blue');
            $('.rtpc-admin-import-button').addClass('vertical-gradiant');
            $('.rtpc-admin-import-button').removeClass('gray');
        } else {
            // Check import button status
            $('.rtpc-admin-import-button').addClass('gray');
            $('.rtpc-admin-import-button').removeClass('blue');
            $('.rtpc-admin-import-button').removeClass('vertical-gradiant');
        }
    }
    /**
     *  Builder Template
     */
    $.fn.RTPC_Template = function (options) {
        // Default Options
        var settings = $.extend({
            // These are the defaults.
            selector: '',
            nounce: '',
            action_hook: '',

        }, options);

        selectTemplate();

        function selectTemplate() {

            $(document).on('click', settings.selector, function (event) {
                event.preventDefault();

                var post_type = $('.featherlight #rtpc-template-type').val();
                var post_title = $('.featherlight #rtpc-title-text').val();

                $.ajax({
                    type: "POST",
                    url: rtpc.adminajax,
                    data: {
                        action: settings.action_hook,
                        security: settings.nounce,
                        post_type: post_type,
                        post_title: post_title,
                    },
                    success: function (data) {

                        if (data.error == true) {
                            $('.featherlight .rtpc-message').text(data.message);
                        } else {
                            window.location.replace(data.url);
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

    };

    /**
     *  Plugin installation
     */
    $.fn.RTPC_plugins = function (options) {
        // Default Options
        var settings = $.extend({
            // These are the defaults.
            selector: '',
            nounce: '',
            type: '',
            action_hook: '',

        }, options);

        installation();

        function installation() {

            $(document).on('click', settings.selector + '[href="#"]', function (event) {
                event.preventDefault();

                var $this = $(this);
                var type = $this.attr('data-action');
                var slug = $this.attr('data-slug');
                var source = $this.attr('data-source');

                // Check if its acticated return
                if ('activated' === type) {
                    return;
                }

                $this.prev().css('display', 'block');
                $this.addClass('rtp-button-deactive');
                $($this).removeAttr('href');

                var ajax_response = $.ajax({
                    type: "POST",
                    url: source,
                });

                ajax_response.promise().done(function () {
                    // Activate plugins
                    if ('activate' === type) {
                        $this.text(rtpc.activated);
                        $this.addClass('gray');
                        $this.removeClass('blue');
                        $this.prev().css('display', 'none');
                        $($this).attr('href', '#');
                    }
                    // Update plugins
                    if ('update' === type) {
                        var ajax_update = $.ajax({
                            type: "POST",
                            url: rtpc.adminajax,
                            data: {
                                action: settings.action_hook,
                                security: settings.nounce,
                                type: type,
                                slug: slug,
                                source: source,
                            },
                        });
                        ajax_update.promise().done(function (data) {
                            if (false === data.error) {
                                $this.attr('data-action', data.action);
                                $this.attr('data-source', data.source);
                            }
                            $this.text(rtpc.activate);
                            $this.prev().css('display', 'none');
                            $($this).attr('href', '#');

                        });
                    }
                    // Install plugins
                    if ('install' === type) {
                        var ajax_install = $.ajax({
                            type: "POST",
                            url: rtpc.adminajax,
                            data: {
                                action: settings.action_hook,
                                security: settings.nounce,
                                type: type,
                                slug: slug,
                                source: source,
                            },
                        });
                        ajax_install.promise().done(function (data) {
                            if (false === data.error) {
                                $this.attr('data-action', data.action);
                                $this.attr('data-source', data.source);
                            }
                            $this.text(rtpc.activate);
                            $this.prev().css('display', 'none');
                            $($this).attr('href', '#');

                        });

                    }

                    turnOnImportButtonStatus();
                });

            });
        }

    };

    /**
     *  Demo installation
     */
    $.fn.RTPC_demos = function (options) {
        // Default Options
        var settings = $.extend({
            // These are the defaults.
            selector: '',
            nounce: '',
            type: '',
            action_hook: '',

        }, options);

        var progressbar;
        var progressLabel;

        if ('activate_all' === settings.type) {
            activate_all();
        } else if ('all_options' === settings.type) {
            all_options();
        } else if ('check_boxes' === settings.type) {
            check_boxes();
        } else if ('import_demo' === settings.type) {
            import_demo();
        }


        function activate_all() {

            let activate_btn = $('.rtpc-admin-form-plugin-list .btn .blue');

            // Check is there any plugin to need activation or not
            if (activate_btn.length < 1) {
                $(settings.selector).addClass('gray');
                turnOnImportButtonStatus();
            }

            // Check on submit
            $(document).on('click', settings.selector + '[href="#"]', function (event) {
                event.preventDefault();
                // Check if its acticated return
                if ($(this).hasClass('gray')) {
                    return;
                }

                $(this).removeAttr('href');

                recur_loop(0);
            });

            var recur_loop = function (i) {
                var num = i || 0;

                let abtn = $('.featherlight .featherlight-content .rtpc-admin-form-plugin-list .btn .blue');

                if (num < abtn.length) {
                    var type = $(abtn[num]).attr('data-action');
                    var slug = $(abtn[num]).attr('data-slug');

                    $(abtn[num]).prev().css('display', 'block');
                    $(abtn[num]).addClass('rtp-button-deactive');
                    $(abtn[num]).removeAttr('href');

                    var main_ajax = $.ajax({
                        type: "POST",
                        url: rtpc.adminajax,
                        data: {
                            action: settings.action_hook,
                            action_type: settings.type,
                            security: settings.nounce,
                            type: type,
                            slug: slug,
                        },
                    });
                    main_ajax.promise().done(function (data) {
                        // Activate plugins
                        if (false === data.error) {
                            $(abtn[num]).attr('data-action', data.action);
                            $(abtn[num]).attr('data-source', data.source);

                            if ('activated' === data.action) {
                                $(abtn[num]).text(rtpc.activated);
                                $(abtn[num]).addClass('gray');
                                $(abtn[num]).removeClass('blue');
                                $(abtn[num]).prev().css('display', 'none');
                                $(abtn[num]).attr('href', '#');
                            }
                        }

                        if ($('.featherlight-content .rtpc-admin-form-plugin-list .btn .blue').length < 1) {
                            $('.rtpc-activate-all-plugins').addClass('gray');
                        }

                        // Check is there any plugin to need activation or not
                        if (num + 1 >= abtn.length) {
                            $(settings.selector).addClass('gray');
                            turnOnImportButtonStatus();
                        }

                        // Loop it again
                        recur_loop(0);
                    });
                }
            };
        }

        function all_options() {
            // Check on submit
            $(document).on('click', settings.selector, function (event) {
                let $this = $(this);
                // Check if all option checked or not
                if ($(this).prop('checked') === true) {
                    $('.rtpc-admin-form-checkbox-list li:not(:first-child) input').attr('checked', 'checked');
                } else {
                    $('.rtpc-admin-form-checkbox-list li:not(:first-child) input').attr('checked', false);
                }

                turnOnImportButtonStatus();

            });
        }

        function check_boxes() {
            // Check on submit
            $(document).on('click', settings.selector, function (event) {
                // Check if all option checked or not
                let $this = $(this);
                $(".rtpc-admin-check-all").removeAttr('checked', 'checked');
                if ($this.prop('checked') === true) {
                    $this.attr('checked', 'checked');
                } else {
                    $this.attr('checked', false);
                }

                turnOnImportButtonStatus();

            });
        }

        function import_demo() {

            $(document).on('click', settings.selector, function (event) {
                event.preventDefault();

                if ($(this).hasClass('gray')) {
                    return;
                }

                $('.rtpc-admin-form-section').addClass('rtpc-admin-hidden');
                $('.rtpc-admin-wizard-step-progress-bar').removeClass('rtpc-admin-hidden');

                progressbar = $(".featherlight .featherlight-content .rtpc-admin-popup-default_demo #progressbar");
                progressLabel = $(".featherlight .featherlight-content .rtpc-admin-popup-default_demo .progress-label");

                progressbar.progressbar({
                    value: 1,
                    change: function () {
                        progressLabel.text(progressbar.progressbar("value") + "%");
                    },
                    complete: function () {
                        progressLabel.text("Complete!");
                    }
                });

                submitImport();

            });

            var submitImport = function () {

                var inputs = $('.rtpc-admin-form-checkbox-list li input');
                var slug = $(settings.selector).attr('data-slug');;
                var fields = new Object();
                var lastStep = 'no';
                var counter = 0;

                $.each(inputs, function (index, val) {
                    if ($(inputs[index]).prop('checked') === true) {
                        if ('yes' == checkImportStatus()) {
                            lastStep = 'yes';
                        }
                        fields[index] = {
                            "type": $(inputs[index]).attr('name'),
                            "source": $(inputs[index]).next('span').attr('data-source'),
                            "action": $(inputs[index]).next('span').attr('data-action'),
                            "element": $(inputs[index]).next('span').attr('class'),
                            "laststep": lastStep
                        };
                        counter++;
                    }
                });

                $.ajax({
                    type: "POST",
                    url: rtpc.adminajax,
                    data: {
                        action: settings.action_hook,
                        action_type: settings.type,
                        security: settings.nounce,
                        fields: fields,
                        slug: slug,
                        progress: counter,
                    },
                    success: function (data) {
                        // Update progress bar
                        progress(parseInt(data.progress));

                        if (false === data.error) {
                            // Update message
                            $('.rtpc-admin-progress-bar .text').text(data.message);
                            // Progress label
                            let progress_count = progressbar.progressbar("value");
                            if (false == Number.isInteger(progress_count)) {
                                let progress_count = 0;
                            }

                            $('.rogress-label').text(progress_count + '%')
                            // Update action
                            $('.' + data.element).attr('data-action', data.action);

                            if ('no' === lastStep) {
                                // Start it again
                                submitImport();
                            }

                        } else if (true === data.error) {

                        } else if ('laststep' === data.error) {
                            // Finished steps
                            $('.rtpc-admin-wizard-step-progress-bar').addClass('rtpc-admin-hidden');
                            $('.rtpc-admin-wizard-step-finalize').removeClass('rtpc-admin-hidden');

                        }
                    }
                });
            };
        }

        function progress(i) {
            var val = progressbar.progressbar("value");

            progressbar.progressbar("value", val + i);
        }


    };

    /**
     *  Demo installation
     */
    $.fn.RTPC_dashboard = function (options) {
        // Default Options
        var settings = $.extend({
            // These are the defaults.
            selector: '',
            nounce: '',
            type: '',
            action_hook: '',

        }, options);

        if ('submit_data' === settings.type) {
            activate();
        }

        function activate() {

            // Check on submit
            $(document).on('click', settings.selector, function (event) {
                event.preventDefault();

                var email = $('.rtpc-admin-activate-email').val();
                var purchase = $('.rtpc-admin-activate-purchase').val();
                $('.rtpc-admin-error-msg').text('');
                $('.rtpc-admin-success-msg').text('');

                $.ajax({
                    type: "POST",
                    url: rtpc.adminajax,
                    data: {
                        action: settings.action_hook,
                        security: settings.nounce,
                        action_type: settings.type,
                        email: email,
                        purchase: purchase,
                    },
                    success: function (data) {
                        if (true === data.error) {
                            $('.rtpc-admin-error-msg').text(data.message);
                        } else if (false === data.error) {
                            $('.rtpc-admin-success-msg').text(data.message);
                        }
                    }

                });
            });

        }

    };

})(jQuery);