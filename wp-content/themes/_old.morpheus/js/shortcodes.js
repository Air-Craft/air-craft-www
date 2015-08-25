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
             *
             *
             *  LAZY LOAD
             *************************************************************************************************/
            $wndw.load(function () {
                // load images

                // set the placeholder dimentions
                var _imgs = $("img.js-coll-lazy");
                _imgs.height(function () {
                    var _h = $(this).width() / $(this).attr('width') * $(this).attr('height')
                    return _h;
                })

                $("img.js-coll-lazy").lazyload({
                    data_attribute: 'coll-src',
                    effect: "fadeIn",
                    event: "coll.start.lazy",
                    load: function (elements_left) {
                        $(this).css({
                            'height': 'auto'
                        })
                        if (elements_left == 0) {
                            $wndw.trigger('resize');
                        }
                    }
                });


                $("img.js-coll-lazy").trigger('coll.start.lazy')
            });


            /*

             Page Sections
             ______________________________________________________________
             */
            var Section = new function () {
                var _this,
                    _minW,
                    _w;
                this.init = function () {
                    _this = this;
                    _minW = $('.js-coll-window-min');
                    _w = $('.js-coll-window');

                    // force resize
                    _this.resize()
                    //events
                    $wndw.resize(_this.resize)
                }
                this.resize = function () {
                    // window min
                    _minW.css('min-height', $wndw.height())
                    _minW.find('.section-content').css('min-height', $wndw.height())

                    // window exact
                    _w.css('height', $wndw.height())
                    _w.find('.section-content').css('height', $wndw.height())
                    // chrome....
                    //_item.find('.section-content').css('height', $wndw.height() + 1)
                }

            }
            Section.init();

            /*

             Typography
             ______________________________________________________________
             */
            var Typo = new function () {
                this.items;
                var _this;
                var $smtpad = $('.js-coll-smart-padding');

                this.init = function () {
                    _this = this;

                    _this.update();

                    // events
                    $wndw.resize(_this.resize)
                    $wndw.load(_this.resize)
                    $wndw.on('coll.shortcodes.update', _this.update)
                }
                this.resize = function () {
                    // resize text and smart padding
                    if ($wndw.width() < 1024) {
                        _this.items.css('font-size', function () {
                            var _size = ($wndw.width() - 320) * ($(this).data('coll-font-size').max - $(this).data('coll-font-size').min) / (1024 - 320)
                                + $(this).data('coll-font-size').min;
                            _size = Math.round(_size)
                            return _size + 'px';
                        })
                        $smtpad.css('padding-bottom', function (index, value) {
                            var _sp = ($wndw.width() - 320) * ($(this).data('coll-padding').max - $(this).data('coll-padding').min) / (1024 - 320)
                                + $(this).data('coll-padding').min;
                            _sp = Math.round(_sp)
                            return _sp + '%';
                        })
                    }
                    else {
                        _this.items.css('font-size', function () {
                            return $(this).data('coll-font-size').max + 'px';
                        })
                        $smtpad.css('padding-bottom', function (index, value) {
                            return $(this).data('coll-padding').max + '%';
                        })
                    }


                }
                this.update = function () {
                    _this.items = $('.js-coll-texttype-resize');
                    _this.resize();
                }


            }
            Typo.init()

            /*

             Portfolio
             ______________________________________________________________
             */
            var Portfolio = new function () {
                var _this,
                    _portfolio;
                this.init = function () {
                    _this = this;
                    _portfolio = $('.coll-shortcode-portfolio');


                    if (_portfolio.length > 0) {
                        // start isotope instances
                        _portfolio.each(function () {
                            initIsotope($(this))
                        })

                        // hover opacity
                        _portfolio.find('.hentry').hover(
                            function () {
                                $(this).find('.thumb>img').css('opacity', $(this).data('coll-hover-opacity'))
                            },
                            function () {
                                $(this).find('.thumb>img').css('opacity', 1)
                            }
                        )
                    }


                    // lightbox
                    $('.js-coll-port-lightbox').magnificPopup({
                        type: 'ajax',
                        closeBtnInside: !isMobile,
                        fixedContentPos: true,
                        callbacks: {
                            parseAjax: function (resp) {
                                // mfpResponse.data is a "data" object from ajax "success" callback
                                // for simple HTML file, it will be just String
                                // You may modify it to change contents of the popup
                                // For example, to show just #some-element:
                                // mfpResponse.data = $(mfpResponse.data).find('#some-element');


                                // mfpResponse.data must be a String or a DOM (jQuery) element
                                var _title = $('<div class="large-10 large-offset-2 medium-offset-2 medium-10"></div>')
                                    .append($(resp.data).find('.title-wrapper'))
                                var _content = $('<div class="large-10 large-offset-2 medium-offset-2 medium-10"></div>')
                                    .append($(resp.data).find('.content-wrapper'))
                                    .append($(resp.data).find('.asset-wrapper'))

                                var _data = $('<div class="coll-single lightbox  row"></div>')
                                    .append('<div class="wrapper large-11 large-centered columns"></div>')
                                _data.find('.wrapper')
                                    .append($(resp.data).find('.title-divider'))
                                    .append(_title)
                                    .append($(resp.data).find('.content-divider'))
                                    .append(_content)


                                // add img src attr
                                var imgs = _data.find('img.js-coll-lazy');
                                imgs.attr('src', function () {
                                    return $(this).data('coll-src')
                                })

                                resp.data = _data;

                            },
                            open: function () {
                                // Will fire when this exact popup is opened
                                // this - is Magnific Popup object
                                $wndw.trigger('coll.lightbox.on')
                            },
                            close: function () {
                                // Will fire when popup is closed
                                $wndw.trigger('coll.lightbox.off')
                            },
                            ajaxContentAdded: function () {
                                // Ajax content is loaded and appended to DOM


                                $wndw.trigger('coll.shortcodes.update')
                            }
                            // e.t.c.
                        },
                        mainClass: ''
                    });

                    // events
                    $wndw.smartresize(_this.resize);
                }
                this.resize = function () {

                }
                var initIsotope = function (instance) {
                    var _isOn = false,
                        _filter = instance.find('.js-coll-portfolio-filter'),
                        _selector = _filter.first().attr('data-filter'),
                        _container = instance.find('.js-coll-portfolio');

                    _filter.on('click', function (e) {
                        e.preventDefault();

                        if ($(this).hasClass('current')) {
                            return false
                        }
                        //deselect the other filter item
                        var _previous = _filter.filter('.current');
                        _previous.removeClass('current');
                        colorChange(_previous, 'coll-color');

                        // select current category
                        _selector = $(this).attr('data-filter');
                        colorChange($(this), 'coll-color-hover')
                        $(this).addClass('current');


                        // filter items
                        _container.isotope({filter: _selector})


                        $wndw.trigger('resize');


                    })

                    // add filter hover color
                    _filter.hover(
                        function () {
                            colorChange($(this), 'coll-color-hover')
                        }, function () {
                            colorChange($(this), 'coll-color')
                        });


                    // select first filter item
                    $wndw.load(function () {

                        // select the first filter item
                        _container.isotope();
                        _filter.first().trigger('click');
                        _isOn = true;
                    });
                    $wndw.resize(function () {
                        if (_isOn) {
                            _container.isotope('layout', true)
                        }

                    })
                }
                var colorChange = function (elem, str) {
                    if (!elem.hasClass('current')) {
                        elem.css({
                            'color': elem.data(str),
                            'border-color': elem.data(str)
                        })
                    }

                }
            }
            Portfolio.init();

            /*

             Latest Blog
             ______________________________________________________________
             */
            var Blog = new function () {
                var _this,
                    _item,
                    _title;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-shortcode-blog .hentry');
                    _title = $('.coll-shortcode-blog .link-color');


                    // add hover color
                    _title.hover(
                        function () {
                            $(this).css('color', $(this).data('coll-color-hover'))
                        },
                        function () {
                            $(this).css('color', $(this).data('coll-color'))
                        }
                    )

                    // lightbox
                    $('.js-coll-blog-lightbox').magnificPopup({
                        type: 'ajax',
                        closeBtnInside: !isMobile,
                        fixedContentPos: true,
                        callbacks: {
                            parseAjax: function (resp) {
                                // mfpResponse.data is a "data" object from ajax "success" callback
                                // for simple HTML file, it will be just String
                                // You may modify it to change contents of the popup
                                // For example, to show just #some-element:
                                // mfpResponse.data = $(mfpResponse.data).find('#some-element');

                                // mfpResponse.data must be a String or a DOM (jQuery) element
                                var _title = $('<div class="large-10 large-offset-2 medium-offset-2 medium-10"></div>')
                                    .append($(resp.data).find('.title-wrapper'))
                                var _content = $('<div class="large-10 large-offset-2 medium-offset-2 medium-10"></div>')
                                    .append($(resp.data).find('.content-wrapper'))

                                var _data = $('<div class="coll-single lightbox coll-post row"></div>')
                                    .append('<div class="wrapper large-11 large-centered columns"></div>')
                                _data.find('.wrapper')
                                    .append($(resp.data).find('.title-divider'))
                                    .append(_title)
                                    .append($(resp.data).find('.content-divider'))
                                    .append(_content)


                                // add img src attr
                                var imgs = _data.find('img.js-coll-lazy');
                                imgs.attr('src', function () {
                                    return $(this).data('coll-src')
                                })

                                resp.data = _data;

                            },
                            open: function () {
                                // Will fire when this exact popup is opened
                                // this - is Magnific Popup object
                                $wndw.trigger('coll.lightbox.on')
                            },
                            close: function () {
                                // Will fire when popup is closed
                                $wndw.trigger('coll.lightbox.off')
                            },
                            ajaxContentAdded: function () {
                                // Ajax content is loaded and appended to DOM
                                $('.coll-single.lightbox .js-fit-video').fitVids();

                                $wndw.trigger('coll.shortcodes.update')
                            }
                            // e.t.c.
                        },
                        mainClass: ''
                    });


                    //force resize
                    //_this.resize();


                    // events
                    $wndw.resize(_this.resize);
                }
                this.resize = function () {
                    // add min height
                    var maxHeight = Math.max.apply(null, _item.map(function () {
                        return $(this).find('.js-coll-inner').outerHeight();
                    }).get());
                    _item.css('height', maxHeight)
                }
            }
            Blog.init();

            /*

             Video
             ______________________________________________________________
             */
            var Video = new function () {
                var _this,
                    _vcontainer,
                    _pType;
                this.init = function () {
                    _this = this;
                    _vcontainer = $('.js-coll-video');
                    _pType = $('body').hasClass('single');


                    // make vids responsive
                    //_vcontainer.fitVids();

                    _vcontainer.each(function () {
                        var _iframe = $(this).find('iframe');
                        $(this).data('coll-iframe', _iframe)

                        _iframe.remove();
                    })


                    //events
                    $wndw.load(_this.load)
                    $wndw.on('coll.shortcodes.update', _this.asinc);
                }
                this.createCover = function (container, psel) {
                    var _iframe = container.find('iframe'),
                        _parent = container.closest(psel),
                        _cover = $('<div class="coll-iframe-overlay"></div>'),
                        _under = $('<div class="coll-iframe-color hide"></div>'),
                        _close = $('<a class="coll-iframe-close"><i class="fa fa-times-circle"></i></a>'),
                        _enabled = false;

                    _cover.on('click', function () {
                        _iframe.parent().addClass('coll-iframe-enabled')
                        _iframe.closest('.section-content').addClass('no-3d')
                        _under.removeClass('hide')

                        _iframe[0].src += "&autoplay=1";

                        _enabled = !_enabled;
                    })
                    _close.add(_under).on('click', function () {
                        _iframe.parent().removeClass('coll-iframe-enabled')
                        _iframe.closest('.section-content').removeClass('no-3d')
                        _under.addClass('hide');

                        // reset video
                        _iframe.attr('src', '')
                        _iframe.attr('src', container.data('coll-src'))

                        _enabled = !_enabled;
                    })

                    // add it to the dom
                    container.find('iframe').parent().append(_cover);
                    container.find('iframe').parent().append(_close);
                    _parent.append(_under);
                }

                this.load = function () {
//                    _vcontainer.each(function () {
//                        $(this).find('iframe').attr('src', $(this).data('coll-src'))
//                    });


                    // make vids responsive


                    // fix scroll probllem
                    // cacamash pe pings.conviva.com
                    _vcontainer.each(function () {
                        var _iframe = $(this).data('coll-iframe')
                        _iframe.appendTo($(this));

                        $(this).fitVids();

                        if ($(this).hasClass('coll-lightbox-on') || isMobile) {

                            // save src
                            $(this).data('coll-src', _iframe.attr('src'));
                            //remove src
                            //_iframe.attr('src', '')
                            // scroll
                            if (_pType) {
                                _this.createCover($(this), '.coll-single')
                            } else {
                                _this.createCover($(this), '.coll-page-section')
                            }

                        }
                    });

                    //_vcontainer.fitVids();
                }
                this.asinc = function () {
                    var _nVideo = $('.coll-single.lightbox .js-coll-video')

                    _nVideo.fitVids();


                    // fix scroll probllem
                    _nVideo.each(function () {
                        if ($(this).hasClass('coll-lightbox-on')) {
                            var _iframe = $(this).find('iframe')
                            // save src
                            $(this).data('coll-src', _iframe.attr('src'));
                            // scroll
                            _this.createCover($(this), '.coll-single.lightbox')
                        }
                    });

                }
            }
            Video.init();

            /*

             Iframe
             ______________________________________________________________
             */
            var IFrame = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.js-coll-iframe');


                    // fix scroll probllem
                    _item.each(function () {
                        var _iframe = $(this).find('iframe')
                        // scroll
                        _this.createCover($(this), '.coll-page-section')
                    });


                    //events
                    $wndw.load(_this.load)
                    $wndw.on('coll.shortcodes.update', _this.asinc);
                }
                this.createCover = function (container, psel) {
                    var _iframe = container.find('iframe'),
                        _parent = container.closest(psel),
                        _cover = $('<div class="coll-iframe-overlay"></div>'),
                        _under = $('<div class="coll-iframe-color hide"></div>'),
                        _close = $('<a class="coll-iframe-close"><i class="fa fa-times-circle"></i></a>'),
                        _enabled = false;

                    _cover.on('click', function () {
                        _iframe.parent().addClass('coll-iframe-enabled')
                        _iframe.closest('.section-content').addClass('no-3d')
                        _under.removeClass('hide')

                        _enabled = !_enabled;
                    })
                    _close.add(_under).on('click', function () {
                        _iframe.parent().removeClass('coll-iframe-enabled')
                        _iframe.closest('.section-content').removeClass('no-3d')
                        _under.addClass('hide');

                        _enabled = !_enabled;
                    })

                    // add it to the dom
                    container.find('iframe').parent().append(_cover);
                    container.find('iframe').parent().append(_close);
                    _parent.append(_under);
                }

                this.load = function () {

                }
                this.asinc = function () {
                    var _nIframe = $('.coll-single.lightbox .js-coll-iframe')

                    _nIframe.fitVids();


                    // fix scroll probllem
                    _nIframe.each(function () {
                        var _iframe = $(this).find('iframe')

                        // scroll
                        _this.createCover($(this), '.coll-single.lightbox')
                    });
                }
            }
            IFrame.init();

            /*

             SOLCIAL ICON
             ______________________________________________________________
             */
            var SocialIcon = new function () {
                var _this,
                    _icon;
                this.init = function () {
                    _this = this;
                    _icon = $('.js-coll-social-icon');


                    _icon
                        .each(function () {
                            out($(this))
                        })
                        .hover(function () {
                            over($(this))
                        }, function () {
                            out($(this))
                        });


                }
                var over = function (e) {

                    e.css({
                        'color': e.data('coll-color-hover'),
                        'border-color': e.data('coll-background-color-hover'),
                        'background-color': e.data('coll-background-color-hover')
                    })
                }
                var out = function (e) {

                    e.css({
                        'color': e.data('coll-color'),
                        'border-color': e.data('coll-border-color'),
                        'background': 'none'
                    })
                }

            }
            SocialIcon.init();

            /*

             Team
             ______________________________________________________________
             */
            var Team = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-shortcode-team > .hentry');

                    //force resize


                    // events
                    $wndw.resize(_this.resize);
                    $wndw.load(_this.resize);
                }
                this.resize = function () {
                    // add min height
                    var maxHeight = Math.max.apply(null, _item.map(function () {
                        return $(this).find('.js-coll-inner').outerHeight();
                    }).get());
                    _item.css('height', maxHeight)
                }
            }
            Team.init();

            /*

             Services
             ______________________________________________________________
             */
            var Service = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-shortcode-services > .hentry');

                    //force resize


                    // events
                    $wndw.smartresize(_this.resize);
                    $wndw.load(_this.resize);
                }
                this.resize = function () {
                    // add min height

                    if ($wndw.width() > 767) {
                        var maxHeight = Math.max.apply(null, _item.map(function () {
                            return $(this).find('.js-coll-inner').outerHeight();
                        }).get());

                        _item.css('height', maxHeight)
                    }
                }
            }
            Service.init();

            /*

             Pricing Tables
             ______________________________________________________________
             */
            var Price = new function () {
                var _this,
                    _item,
                    _link;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-shortcode-pricing-table > .hentry > .wrapper');
                    _link = $('.js-coll-pt-purchase');

                    // link color
                    _link
                        .each(function () {
                            out($(this))
                        })
                        .hover(
                        function () {
                            over($(this))
                        }, function () {
                            out($(this))
                        });


                    //force resize


                    // events
                    $wndw.resize(_this.resize);
                }
                this.resize = function () {
                    // add min height
                    var maxHeight = Math.max.apply(null, _item.map(function () {
                        return $(this).find('.js-coll-inner').outerHeight();
                    }).get());
                    _item.css('height', maxHeight)
                }
                var over = function (e) {
                    e.css({
                        'color': e.data('coll-color-hover'),
                        'border-color': e.data('coll-background-color-hover'),
                        'background': e.data('coll-background-color-hover')
                    })

                }
                var out = function (e) {
                    e.css({
                        'color': 'inherit',
                        'border-color': 'inherit',
                        'background': 'none'
                    })
                }
            }
            Price.init();

            /*

             BUTTON
             ______________________________________________________________
             */
            var Button = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;

                    _this.create('.js-coll-button');

                    // events
                    $wndw.on('coll.shortcodes.update', function () {
                        _this.create('.coll-single.lightbox .js-coll-button')
                    });
                }
                this.create = function (sel) {
                    _item = $(sel);
                    _item
                        .each(function () {
                            out($(this))
                        })
                        .hover(
                        function () {
                            over($(this))
                        }, function () {
                            out($(this))
                        });
                }
                var over = function (e) {
                    e.css({
                        'color': e.data('coll-color-hover'),
                        'border': e.data('coll-border-hover'),
                        'background-color': e.data('coll-background-color-hover')
                    })
                }
                var out = function (e) {
                    e.css({
                        'color': e.data('coll-color'),
                        'border': e.data('coll-border'),
                        'background': e.data('coll-background-color')
                    })
                }

            }
            Button.init();

            /*

             CONTACT
             ______________________________________________________________
             */
            var Contact = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.js-coll-contact');


                    _item.each(function () {
                        var _th = $(this);
                        var _field = $(this).find('.field');
                        var _send = $(this).find('.coll-button');

                        //default
                        out(_field, _th)

                        // hover
                        _field
                            .css('color', _th.data('coll-color'))
                            .focus(function () {
                                over($(this), _th)
                            })
                            .blur(function () {
                                out($(this), _th)
                            })
                    });


                }
                var over = function (e, s) {
                    e.css('border-color', s.data('coll-border-color-selected'))
                }
                var out = function (e, s) {
                    e.css('border-color', s.data('coll-border-color'))
                }

            }
            Contact.init();

            /*

             SKILL
             ______________________________________________________________
             */
            var Skill = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;

                    $(".knob").knob({
                        'draw': function () {
                            $(this.i).val(this.cv + '%')
                        }
                    });
                }
            }
            Skill.init();

            /*

             Tabs
             ______________________________________________________________
             */
            var Tabs = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;

                    _item = $('.coll-tabs .tabs');

                    // activate content
                    $(_item.find('.active a')).each(function () {
                        $($(this).attr('href')).addClass('active')
                    })

                    _item.on('toggled', function (event, tab) {
                        $wndw.trigger('resize')
                    });


                    $wndw.on('coll.shortcodes.update', _this.asinc);

                }
                this.asinc = function () {
                    _item = $('.coll-single.lightbox .coll-tabs .tabs');

                    // activate content
                    $(_item.find('.active a')).each(function () {
                        $($(this).attr('href')).addClass('active')
                    })

                    $(document).foundation();
                }
            }
            Tabs.init();
            /*

             Tabs
             ______________________________________________________________
             */
            var Accordion = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-accordion .accordion > dd');

                    _item.on('click', function () {
                        $wndw.trigger('resize')
                    });
                }
            }
            Accordion.init();


            /*

             Twitter
             ______________________________________________________________
             */
            var Twitter = new function () {
                var _this,
                    _item;

                this.init = function () {
                    _this = this;
                    _item = $('.coll-twitter');


                    _item.each(function () {
                        var _this = $(this);

                        // logo
                        $(this).find('.logo').css('color', _this.data('coll-color').m)
                        //text
                        $(this).find('.text').css('color', _this.data('coll-color').t)
                        // links
                        $(this).find('.text > a')
                            .css('color', _this.data('coll-color').l)
                            .on('mouseover', function () {
                                $(this).css('color', _this.data('coll-color').lh)
                            })
                            .on('mouseout', function () {
                                $(this).css('color', _this.data('coll-color').l)
                            })
                        // time
                        $(this).find('small.time')
                            .css('color', _this.data('coll-color').m)
                            .on('mouseover', function () {
                                $(this).css('color', _this.data('coll-color').lh)
                            })
                            .on('mouseout', function () {
                                $(this).css('color', _this.data('coll-color').m)
                            })

                    })


                }
            }
            Twitter.init();


            /*

             Middle
             ______________________________________________________________
             */
            var Middle = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-middle');


                    // hide title if is enabled
                    _item.each(function () {
                        $(this)
                            .parent()
                            .removeClass('columns')

                    })


                    // events
                    // $wndw.smartresize(_this.resize);
                }
                this.resize = function () {
                    _item.css('height', function () {
                        var _h = $(this).closest('.section-content').height();
                        //return _h;
                        return $wndw.height();
                    })
                }

            }
            Middle.init();

            var LayerSlider = new function () {
                var _this,
                    _item;
                this.init = function () {
                    _this = this;
                    _item = $('.coll-layerslider');


                    _item.on('coll.layerslider.init', function () {
                        $wndw.trigger('coll.shortcodes.update')
                    })
                }

            }
            LayerSlider.init();


        }
    );
}(jQuery));
