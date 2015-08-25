/**
 * Created with JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/25/13
 * Time: 1:39 PM
 * To change this template use File | Settings | File Templates.
 */

(function ($) {
    "use strict";
    $(function () {

        var $wndw = $(window);
        var isMobile = ($('body').hasClass('coll-mobile')) ? true : false;
        /*

         Header
         ______________________________________________________________
         */
        var Header = new function () {

            // mobile
            var _mVisible = false;

            this.init = function () {
                //if sliding header, move static header in position
                if ($('.js-coll-header-slide').length) {
                    $('.coll-page-section').first().append($('.site-header.static'));
                }


                // menu
                var $header = $('.site-header:not(.mobile)');
                $header.find('.sf-menu').superfish({
                    delay: 100,
                    animation: {opacity: 'show'},
                    speed: 'fast',
                    autoArrows: false
                });
                // show submenu
                var _nMenuTop = parseInt($header.find('.mainmenu').css('top'));
                var _nMenuHeight = $header.find('.sf-menu').height();

                $header.oHeight = $header.height();


                $header.find('.sf-menu > li').hover(
                    function () {
                        var _sub = $(this).find('ul'),
                            _h = $(this).closest('.site-header')
                        if (_sub.length) {
                            _h.css('height', _sub.outerHeight() + _nMenuTop + _nMenuHeight);
                        }
                    },
                    function () {
                        var _sub = $(this).find('ul'),
                            _h = $(this).closest('.site-header')
                        if (_sub.length) {
                            _sub.hide();
                            _h.css('height', $header.oHeight);
                        }
                    }
                )


                    var _mHeader = $('.site-header.mobile');

                    _mHeader.find('.sf-menu').css('margin-top', function () {
                        return -$(this).outerHeight();
                    })
                    _mHeader.find('.mainmenu').find('li').each(function () {
                        if ($(this).children('ul').length > 0) {
                            $(this).append('<a class="mobnav-subarrow"><i class="fa fa-angle-down"></i></a>')
                        }
                    })

                    _mHeader.find('#coll-menu-icon').on('click', function (e) {
                        if (_mVisible) {
                            mobileClose()
                        }
                        else {
                            mobileOpen();
                        }
                        e.preventDefault();
                    })


                    // close
                    _mHeader.find('.mobnav-subarrow').on('click',
                        function () {
                            $(this).parent().toggleClass("xpopdrop");
                        });
                    _mHeader.find('.mainmenu').find('a:not(.mobnav-subarrow)').on('click', mobileClose)

                // mobile
                if (isMobile) {
                    // swipe handlers
                    var _mHeaderPos;
                    $(".wrapper.common").swipe({
                        tap: function (event, target) {
                            if (_mVisible) mobileClose()
                        },
                        swipeStatus: function (event, phase, direction, distance, duration, fingerCount) {
                            //If we are moving before swipe, and we are going L or R, then manually drag the images
                            if (phase == 'start') _mHeaderPos = _mHeader.offset().top;
                            if (phase == "move" && (direction == "up" || direction == "down")) {
                                if (direction == "up") {
                                    _mHeader.css('-webkit-transform', function () {
                                        var _y = _mHeaderPos - distance;
                                        _y = Math.max(_y, -$(this).height());
                                        return "translate(0px, " + _y + "px) translateZ(0px)";
                                    })
                                }
                                else if (direction == "down") {
                                    _mHeader.css('-webkit-transform', function () {
                                        var _y = _mHeaderPos + distance;
                                        _y = Math.min(_y, 0);
                                        return "translate(0px," + _y + "px) translateZ(0px)";
                                    })
                                }
                            }

                        },
                        allowPageScroll: "vertical",
                        //Default is 75px, set to 0 for demo so any distance triggers swipe
                        threshold: 10
                    });

                }


            }
            var mobileOpen = function (n) {
                $('.site-header.mobile .sf-menu').toggleClass("xactive");
                _mVisible = !_mVisible;
            }
            var mobileClose = function () {
                $('.site-header.mobile .sf-menu')
                    .toggleClass("xactive")
                    .css('margin-top', function () {
                        return -$(this).outerHeight();
                    })
                _mVisible = !_mVisible;
            }
        }


        /*

         Preloader
         ______________________________________________________________
         */
        var Preloader = new function () {
            var _this,
                _pContainer,
                _preloader;
            this.init = function () {
                _this = this;
                _preloader = $('.coll-site-preloader');

                // prepare remove
                $wndw.load(_this.load)

            }
            this.load = function () {

                $('.wrapper.common').css('visibility', 'visible')

                _preloader.animate({
                    opacity: 0
                }, 500, "linear", function () {
                    $(this).remove();
                });

            }
        }
        Preloader.init();
        /*
         *
         *
         *  ALL CONTENT HAS BEEN LOADED
         *************************************************************************************************/
        $wndw.load(function () {
            Header.init();
        });



        $(document).foundation();

    });
}(jQuery));
