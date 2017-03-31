(function ($) {
    "use strict";
    $(function () {


        var Portfolio = new function () {
            var frame;
            var assetContainer = $('.js-coll-assets');
            var data = [];
            var input = $('#coll_portfolio_assets_content');
            var raw = $('#coll_portfolio_assets_content').val();

            this.init = function () {

                /*
                 * Upload button click event, which builds the choose-from-library frame.
                 *
                 */
                $('.js-coll-add-image').on('click', function (event) {
                    var $el = $(this);
                    event.preventDefault();

                    // Create the media frame.
                    frame = wp.media.frames.customHeader = wp.media({
                        title: $el.data('choose one or more images'),
                        multiple: true,
                        library: { // remove these to show all
//                            type: 'image', // specific mime
//                            author: userSettings.uid // specific user-posted attachment
                        },
                        button: {
                            text: $el.data('update'), // button text
                            close: true // whether click closes
                        }
                    });

                    // When an image is selected, run a callback.
                    frame.on('select', function () {

                        var selection = frame.state().get('selection');
                        selection.map(function (attachment) {
                            attachment = attachment.toJSON();
                            // Do something with attachment.id and/or attachment.url here
                            // prepare data to send to the database


                            var data = {
                                action: 'get_thumbs',
                                id: attachment.id
                            };


                            // send
                            $.post(ajaxurl, data, function (response) {
                                createImageAsset(response, attachment.id);
                            });


                        });
                    });


                    frame.open();
                });


                // video
                var _embd = $('<textarea class="embed-code"></textarea>');
                var _vadd = $('<a class="button js-coll-add-video close-portBox">oki</a>');
                var _vedit = $('<a class="button hide js-coll-edit-video close-portBox">oki</a>');
                var _pbx = $('<div id="video-code" class="portBox"><span class="title">Insert Embed Code</span></div>');
                var _nEditIndex = 0;
                _pbx.append(_embd)
                _pbx.append(_vadd)
                _pbx.append(_vedit)
                $('body').append(_pbx)

                _vadd.on('click', function (event) {
                    var $el = $(this);
                    var _embedcode = _embd.val();

                    event.preventDefault();

                    if (_embedcode != '') {
                        createVideoAsset(_embedcode);
                    }

                })
                _vedit.on('click', function (event) {
                    var $el = $(this);
                    var _embedcode = _embd.val()

                    if (_embedcode != '') {
                        editVideoAsset(_embedcode, _nEditIndex);
                    }

                    _vadd.removeClass('hide')
                    _vedit.addClass('hide')
                    _pbx.find('.title').text('Insert Embed Code')
                    _embd.val('');

                    event.preventDefault();
                })


                // remove item
                assetContainer.on('click', '.js-coll-asset-item .remove', function (el) {

                    // remove item from the data object
                    data.splice($(this).parent().index(), 1);
                    // update the input with the new value
                    updateData();
                    // remove the item from the asset container
                    $(this).parent().remove();

                });
                // edit item   (video embed code)
                assetContainer.on('click', '.js-coll-asset-item .edit', function (el) {
                    _vadd.addClass('hide')
                    _vedit.removeClass('hide')
                    _pbx.find('.title').text('Edit Embed Code')

                    _nEditIndex = $(this).parent().index();

                    _embd.val(function () {
                        return data[_nEditIndex].ecode
                    });
                });


                //make assets sortable
                assetContainer.sortable({
                    start: function (e, ui) {
                        // creates a temporary attribute on the element with the old index
                        $(this).attr('data-previndex', ui.item.index());
                    },
                    update: function (e, ui) {
                        // gets the new and old index then removes the temporary attribute
                        var newIndex = ui.item.index();
                        var oldIndex = $(this).attr('data-previndex');
                        $(this).removeAttr('data-previndex');

                        // save data
                        data.splice(newIndex, 0, data.splice(oldIndex, 1)[0]);
                        updateData()
                    }
                });


                loadItems();


                //thumbnail
                $('.js-coll-add-thumb').on('click', function (event) {
                    var $el = $(this);
                    event.preventDefault();

                    // Create the media frame.
                    frame = wp.media.frames.customHeader = wp.media({
                        title: $el.data('choose a thumbnail'),
                        multiple: false,
                        library: { // remove these to show all
                            // type: 'image', // specific mime
                            // author: userSettings.uid // specific user-posted attachment
                        },
                        button: {
                            text: $el.data('update'), // button text
                            close: true // whether click closes
                        }
                    });

                    // When an image is selected, run a callback.
                    frame.on('select', function () {

                        var selection = frame.state().get('selection');
                        selection.map(function (attachment) {
                            attachment = attachment.toJSON();
                            addThumb(attachment.url, attachment.id);
                        });
                    });


                    frame.open();
                });
            }
            // functions
            var loadItems = function () {
                data = $.parseJSON(raw);
                if (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].type == 'image') {
                            addImageAsset(data[i].thumb)
                        }
                        if (data[i].type == 'video') {
                            addVideoAsset(data[i].thumb)
                        }
                    }
                } else {
                    data = [];
                }
                updateData();
            }
            var createImageAsset = function (url, id) {
                addImageAsset(url);
                // save info
                var _info = {'type': 'image', 'thumb': url, 'id': id};
                data.push(_info)
                updateData();
            }
            var addImageAsset = function (url) {
                var _item = $('<li class="item image js-coll-asset-item ui-state-default"><a class="remove"><i class="fa fa-times-circle"></a></li>')
                var _img = $('<img />')
                _img.attr('src', url);
                _item.prepend(_img)

                // add the item
                assetContainer.append(_item)
            }
            var createVideoAsset = function (code) {
                var _tmb;
                var _vID;
                // get thumb
                if (code.indexOf('youtube') !== -1) {
                    var reg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
                    _vID = reg.exec(code)[1];


                    _tmb = "//i3.ytimg.com/vi/" + _vID + "/hqdefault.jpg";
                    //add item
                    addVideoAsset(_tmb);
                    // save info
                    var _info = {'type': 'video', 'ecode': code, 'thumb': _tmb};
                    data.push(_info)
                    updateData();


                }
                if (code.indexOf('vimeo') !== -1) {
                    _vID = code.match(/player\.vimeo\.com\/video\/([0-9]*)/)[1];

                    $.ajax({
                        url: 'http://www.vimeo.com/api/v2/video/' + _vID + '.json',
                        dataType: 'jsonp',
                        success: function (dota) {
                            _tmb = dota[0].thumbnail_medium;
                            //add item
                            addVideoAsset(_tmb);


                            // save info
                            var _info = {'type': 'video', 'ecode': code, 'thumb': _tmb};
                            data.push(_info)


                            updateData();
                        }
                    });
                }

            }
            var addVideoAsset = function (url) {
                var _item = $('<li class="item video js-coll-asset-item ui-state-default"><a class="remove"><i class="fa fa-times-circle"></i></a><a class="edit"  data-display="video-code" data-animationspeed="0"><i class="fa fa-pencil-square"></i></a></li>')
                var _img = $('<img />')
                _img.attr('src', url);
                _item.prepend(_img)

                // add the item
                assetContainer.append(_item)
            }
            var editVideoAsset = function (code, i) {
                data[i].ecode = code;
                updateData();
            }
            var updateData = function () {
                input.val(function () {
                    var _str = JSON.stringify(data);
                    _str = String(_str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                    return _str;
                })
            }
            var addThumb = function (url, id) {
                var _url = url;    // in cazul in care ma joc cu urlu
                $('#coll_portfolio_thumb').val(id)
                $('.js-coll-thumb-img').attr('src', url)
            }
        }


        Portfolio.init();

    });
}(jQuery));