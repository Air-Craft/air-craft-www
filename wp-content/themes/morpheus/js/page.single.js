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
            var _section,
                _item,
                _content,
                _slideH,
                _this;
            this.container;
            this.init = function () {
                _this = this;
                _section = $('.js-coll-page-section')
                _this.container = $('#skrollr-body');

                // mobile phone bug
                if (isMobile)   $('.coll-section-background').addClass('js-coll-parallax');


                // resize the bg container
                _section.first().height($wndw.height() * 0.67);
                // insert the title inside the bg container
                _section.first().append($('.js-coll-page-section.title-container'))
                // select all the backgrounds
                _content = {};
                _content.image = $('.js-coll-parallax .coll-bg-image');
                _content.image.w = _content.image.attr('width');
                _content.image.h = _content.image.attr('height');

                // select all the parallax bgs
                _item = $('.js-coll-parallax');

                // select sliding header
                _slideH = $('.js-coll-header-slide')


                _this.onWResize();
                // events
                $wndw.load(_this.onWResize);
                $wndw.smartresize(_this.onWResize);
            }
            this.onWResize = function () {
                // resize thumb container
                _section.first().height($wndw.height() * 0.8);

                // resize image
                var _rw = _section.first().width() / _content.image.w,
                    _rh = _section.first().height() / _content.image.h,
                    _r = (_rw > _rh) ? _rw : _rh,
                    _nw = Math.round(_content.image.w * _r),
                    _nh = Math.round(_content.image.h * _r);

                _content.image.css({
                    width: _nw,
                    height: _nh,
                    top: (_section.first().height() - _nh) / 2,
                    left: (_section.first().width() - _nw) / 2
                });



                _this.addData();
            }
            this.addData = function () {

                // remove all data attributes
                _item.removeAttrs('^(data-)');

                _item.each(function () {
                    var _ths = $(this);

                    var _ot = _ths.parent().offset().top - _this.container.offset().top;

                    addAttr(_ths, 0, 0);
                    addAttr(_ths, _ot + _ths.parent().height(), $wndw.height() / 3);

                })

                if (_slideH) {
                    _slideH.removeAttrs('^(data-)');
                    addAttr(_slideH, $wndw.height() - _slideH.height() - 10, -200);
                    addAttr(_slideH, $wndw.height() - _slideH.height(), 0);
                }
            }
            var addAttr = function (item, nData, nValue) {
                var _data = 'data-' + Math.round(nData);
                var _value = 'transform: translate(0px, ' + nValue + 'px);';
                item.attr(_data, _value);
            }
        }

        Parallax.init();


    });
    $.fn.removeAttrs = function (regex) {
        var regex = new RegExp(regex, "g");
        return this.each(function () {
            var _this = $(this);
            for (var i = this.attributes.length - 1; i >= 0; i--) {
                var attrib = this.attributes[i];
                if (attrib && attrib.name.search(regex) >= 0) {
                    _this.removeAttr(attrib.name);
                }
            }
            ; // end for
        });
    };
}(jQuery));
