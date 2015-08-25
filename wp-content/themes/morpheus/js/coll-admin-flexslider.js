(function ($) {
    "use strict";
    $(function () {


        var FlexSlider = new function () {
            var frame;
            var assetContainer = $('.js-coll-assets');
            var data = [];
            var input = $('#coll_flexslider_assets_content');
            var raw = $('#coll_flexslider_assets_content').val();

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
                            type: 'image', // specific mime
                            author: userSettings.uid // specific user-posted attachment
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


                // remove item
                assetContainer.on('click', '.js-coll-asset-item .remove', function (el) {

                    // remove item from the data object
                    data.splice($(this).parent().index(), 1);
                    // update the input with the new value
                    updateData();
                    // remove the item from the asset container
                    $(this).parent().remove();

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


            }
            // functions
            var loadItems = function () {
                data = $.parseJSON(raw);
                if (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].type == 'image') {
                            addImageAsset(data[i].thumb)
                        }
                    }
                }
                else {
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
                var _item = $('<li class="item image js-coll-asset-item ui-state-default"><a class="remove"><i class="fa fa-times-circle"></i></a></li>')
                var _img = $('<img />')
                _img.attr('src', url);
                _item.prepend(_img)

                // add the item
                assetContainer.append(_item)
            }
            var updateData = function () {
                input.val(function () {
                    var _str = JSON.stringify(data);
                    _str = String(_str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                    return _str;
                })
            }
        }


        FlexSlider.init();

    });
}(jQuery));