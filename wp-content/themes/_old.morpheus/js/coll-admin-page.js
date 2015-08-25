(function ($) {
    "use strict";
    $(function () {


        var Page = new function () {
            var sectionContainer = $('.js-coll-sections'),
                data = [],
                input = $('#coll_page_sections_content'),
                raw = $('#coll_page_sections_content').val(),
                select = $('#coll_select_section')

            this.init = function () {
                // show hide metabox
                manageBox();


                /*
                 * Upload button click event, which builds the choose-from-library frame.
                 *
                 */
                select.change(function (e) {
                    var _this = $(this),
                        _slug = _this.find('option:selected').val(),
                        _name = _this.find('option:selected').text();

                    createSection(_slug, _name);
                });


                // remove item
                sectionContainer.on('click', '.js-coll-section-item .remove', function (el) {

                    // remove item from the data object
                    data.splice($(this).parent().index(), 1);
                    // update the input with the new value
                    updateData();
                    // remove the item from the asset container
                    $(this).parent().remove();

                });


                //make assets sortable
                sectionContainer.sortable({
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
            var manageBox = function () {
                //You can find this in the value of the Page Template dropdown
                var templateName = 'template-sectioned.php';

                //Page template in the publishing options
                var currentTemplate = $('#page_template');

                //Identify your metabox
                var metabox = $('#coll-page-sections');
                var textareabox = $('#postdivrich');

                //On DOM ready, check if your page template is selected
                if (currentTemplate.val() === templateName) {
                    metabox.show();
                    textareabox.hide();
                } else {
                    textareabox.show();
                    metabox.hide();

                }

                //Bind a change event to make sure we show or hide the metabox based on user selection of a template
                currentTemplate.change(function (e) {
                    if (currentTemplate.val() === templateName) {
                        metabox.show();
                        textareabox.hide();
                    }
                    else {
                        //You should clear out all metabox values here;
                        textareabox.show();
                        metabox.hide();
                    }
                });

            }
            var loadItems = function () {
                data = $.parseJSON(raw);
                if (data) {
                    for (var i = 0; i < data.length; i++) {

                        addSection(data[i].name)

                    }
                }
                else {
                    data = [];
                }


                updateData();
            }
            var createSection = function (slug, name) {
                addSection(name);
                // save info
                var _info = {'slug': slug, 'name': name};
                data.push(_info)
                updateData();
            }
            var addSection = function (name) {
                var _item = $('' +
                    '<li class="item page-section js-coll-section-item ui-state-default">' +
                    '<span class="text">' + name + '</span>' +
                    '<a class="remove"><i class="fa fa-times-circle"></i> </a>' +
                    '</li>'
                )


                // add the item
                sectionContainer.append(_item)
            }
            var updateData = function () {
                input.val(function () {
                    var _str = JSON.stringify(data);
                    _str = String(_str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                    return _str;
                })
            }
        }


        Page.init();

    });
}(jQuery));