(function ($) {
    "use strict";
    $(function () {


        var Background = new function () {
            var _this;
            this.init = function () {
                _this = this;
                _this.manage('coll_bg_type', 'background-type-') ;
                _this.manage('coll_bg_slider_type', 'slider-type-') ;
            }
            this.manage = function (radio, box) {
                var _type = $('input[id^="' + radio + '"]') ,
                    _fields = $('[class*="' + box + '"]').closest('.format-settings');

                // hide all bg metaboxes
                _fields.hide();
                // show the selected metabox
                var _sel = $('input[id^="' + radio + '"]:checked').val();
                $('.' + box + _sel).closest('.format-settings').show();
                // show bg metabox on demand
                _type.change(function (e) {
                    _fields.hide();
                    _sel = $(this).val();
                    $('.' + box + _sel).closest('.format-settings').show();
                })
            }
        }


        Background.init();

    });
}(jQuery));