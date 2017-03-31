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

         Parallax
         ______________________________________________________________
         */
        var Parallax = new function () {
            var _this;
            this.skr;
            this.container;
            this.section;
            this.active = true;
            this.init = function () {
                _this = this;
                _this.section = $('.coll-page-section')

                // show sections
                if (_this.section.length < 9) {
                    _this.section.each(function () {
                        $(this).find('.coll-section-background').css('display', 'block')
                    })
                }

                // init skrollr
                _this.skr = skrollr.init({
                    smoothScrolling: false,
                    mobileDeceleration: 0.01,
                    forceHeight: false,
                    mobileCheck: function () {
                        return true
                    }
                });
                if (isMobile && _this.section.length > 8) {
                    _this.skr.on('beforerender', _this.mobile)
                } else {
                    _this.skr.on('beforerender', function (data) {
                        return _this.active
                    })
                }


                // events
                $wndw.on('coll.lightbox.on', _this.manage)
                $wndw.on('coll.lightbox.off', _this.manage)
                $wndw.load(_this.onWLoad);
                $wndw.smartresize(_this.resize);
                $wndw.on('coll.container.update', _this.resize);
            }
            this.onWLoad = function () {
                // force resize on load
                _this.resize();
            }
            this.resize = function () {
                _this.skr.refresh();
            }
            this.manage = function () {
                _this.active = !_this.active;
            }
            this.mobile = function (data) {

                _this.section.each(function () {
                    var _this = $(this),
                        viewport = {},
                        section = {};


                    viewport.top = 0;
                    viewport.bottom = $wndw.height();
                    section.top = _this.offset().top;
                    section.bottom = section.top + _this.outerHeight();

                    if ((viewport.bottom < section.top || viewport.top > section.bottom)) {
                        _this.find('.coll-section-background').css('display', 'none')
                    } else {
                        _this.find('.coll-section-background').css('display', 'block')
                    }

                })
                return   _this.active;
            }
        }


        /*

         SCROLL
         ______________________________________________________________
         */
        var Scroll = new function () {
            this.pos = 0;
            this.max = 0;
            this.min = 0;
            var _container = $('#skrollr-body'),
                _sb = $('.js-coll-scrollbar'),
                _sbc = $('.js-coll-scrollbar-content'),
                _this = this;

            this.init = function () {


                //scrollbar
                _sbc.height(_container.height())

                _sb.perfectScrollbar({
                    wheelSpeed: 0,
                    minScrollbarLength: 20,
                    suppressScrollX: true
                });


                //events
                $wndw.load(_this.onWLoad);
                $wndw.smartresize(_this.resize);
                $wndw.on('coll.container.update', _this.resize);
                $wndw.on('coll.lightbox.on', _this.disableEvents)
                $wndw.on('coll.lightbox.off', _this.enableEvents)
                // enable
                _this.enableEvents();


            }
            this.enableEvents = function () {
                $('.js-coll-local-link').on('click', _this.links);
                if (!isMobile) {
                    $wndw.on('coll-scroll', _this.scroll);
                    $(document).on('mousewheel', _this.wheel);
                    $(document).on('keydown', _this.keyboard);
                } else {
                    // enable scrollr
                    Parallax.skr = skrollr.init({
                        smoothScrolling: false,
                        mobileDeceleration: 0.01,
                        forceHeight: false,
                        mobileCheck: function () {
                            return true
                        }
                    });

                    if (Parallax.section.length > 8) {
                        Parallax.skr.on('beforerender', Parallax.mobile)
                    } else {
                        Parallax.skr.on('beforerender', function (data) {
                            return Parallax.active
                        })
                    }

                    Parallax.skr.setScrollTop(-_this.pos)
                }


            }
            this.disableEvents = function () {
                $('.js-coll-local-link').off('click', _this.links)
                if (!isMobile) {
                    $wndw.off('coll-scroll', _this.scroll);
                    $(document).off('mousewheel', _this.wheel);
                    $(document).off('keydown', _this.keyboard);
                } else {
                    // skrollr
                    // needs to be disabled because it is not passing touch events.
                    _this.pos = -Parallax.skr.getScrollTop();
                    Parallax.skr.destroy()
                }


            }
            this.wheel = function (event) {
                //console.log(event.deltaX, event.deltaY, event.deltaFactor);
                _this.pos += event.deltaFactor * event.deltaY * 2;
                _this.pos = Math.min(_this.max, Math.max(_this.min, _this.pos))

                Parallax.skr.animateTo(-_this.pos, {
                    duration: 400,
                    easing: 'outCubic'
                })
                //move scrollbar
                _sb.scrollTop(-_this.pos);
            }
            this.scroll = function (e, top) {
                _this.pos = -top;
                _this.pos = Math.min(_this.max, Math.max(_this.min, _this.pos))
                Parallax.skr.setScrollTop(-_this.pos)
            }
            this.keyboard = function (e) {
                switch (e.which) {
                    case 38: // up
                        _this.pos += 100;
                        break;
                    case 40: // down
                        _this.pos -= 100;
                        break;
                    case 33: // page up
                        _this.pos += $wndw.height();
                        break;
                    case 32: // space bar
                        if (e.shiftKey) {
                            _this.pos += $wndw.height() * 0.8;
                        } else if (!$('input:focus, textarea:focus').length) {
                            _this.pos -= $wndw.height() * 0.8;
                        }
                        break;
                    case 34: // page down
                        _this.pos -= $wndw.height();
                        break;
                    case 35: // end
                        _this.pos = _this.min;
                        break;
                    case 36: // home
                        _this.pos = _this.max;
                        break;
                    default:
                        return;
                }

                // check bounds
                _this.pos = Math.min(_this.max, Math.max(_this.min, _this.pos))

                Parallax.skr.animateTo(-_this.pos, {
                    duration: 400,
                    easing: 'outCubic'
                })
                //move scrollbar
                _sb.scrollTop(-_this.pos);
            }
            this.links = function (ev) {
                ev.preventDefault();

                _this.pos = -($($(this).attr('href')).offset().top + Parallax.skr.getScrollTop());
                _this.pos = Math.min(_this.max, Math.max(_this.min, _this.pos))


                Parallax.skr.animateTo(-_this.pos, {
                    duration: 1000,
                    easing: 'outCubic'
                })

                //move scrollbar
                _sb.scrollTop(-_this.pos);
            }
            this.onWLoad = function () {

                // more jump fix
                var _hHeader = (isMobile) ? $('.site-header.mobile').height() : $('.site-header').height();
                var _morePos = ($(location.hash).is("span[id^='more']")) ? _hHeader : 0;

                _this.resize();

                // start
                if (location.hash) {
                    _this.pos = -$(location.hash).offset().top + _morePos;
                    _this.pos = Math.min(_this.max, Math.max(_this.min, _this.pos))

                    Parallax.skr.animateTo(-_this.pos, {
                        duration: 1000,
                        easing: 'outCubic'
                    })

                    //move scrollbar
                    _sb.scrollTop(-_this.pos);
                }


            }
            this.resize = function () {
                _this.min = $wndw.height() - _container.height();
                _sbc.height(_container.height())
                _sb.perfectScrollbar('update');
            }
        }


        Parallax.init();
        Scroll.init();


    });
}(jQuery));
