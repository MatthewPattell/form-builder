/**
 * Created by Matthew Patell on 2017-02-05.
 */

/**
 * Romove from array empty elements
 *
 * @param deleteValue
 * @returns {Array}
 */
Array.prototype.clean = function(deleteValue) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == deleteValue) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
};

$(function () {

    var body        = $('body');
    var user_form   = $('#user-form');
    var field_prop_wrap = $('.field-properties_wrap');

    /**
     * Enable drag and drop fields.
     * Enable sorting user fields
     */
    dragula([document.querySelector('#user-form'), document.querySelector('#fields-types')], {
        copy: function (el, source) {
            return $(el).find('.field-type').length;
        },
        moves: function (el, container, handle) {

            if ($(container).closest(user_form).length) {
                return handle.classList.contains('move-field');
            }

            return true;
        }
    }).on('drop', function (el, source) {

        if ($(el).find('.field-type').length && source) {
            var el = $(el);
            var type = el.find('.field-type').data('type');

            el.removeAttr('class');

            getField(type, function (response) {
                if (user_form.find('.form-group').length) {
                    el.after(response);
                } else {
                    user_form.append(response);
                }

                el.remove();
            });
        }
    });

    /**
     * Get html field by type
     *
     * @param type
     * @param resultCallback
     */
    var getField = function (type, resultCallback) {
        $.ajax({
            method: 'POST',
            url: '/forms/field',
            data: {type: type},
            success: function (response) {
                if (typeof resultCallback == "function") {
                    resultCallback(response);
                } else {
                    user_form.append(response);
                }
            }
        });
    };

    /**
     * Add field to user form
     */
    $('.field-type').click(function () {
        getField($(this).data('type'));
    });

    /**
     * Remove field from user form
     */
    body.on('click', '.remove-field', function () {
        if (confirm("Are you sure you want to delete this field")) {
            $(this).closest('.form-group').remove();
            field_prop_wrap.html('Field not found.');
        }
    });

    /**
     * Get filed properties
     */
    body.on('click', '.edit-field', function () {

        var el      = $(this);
        var config  = el.closest('.config-buttons');

        $.ajax({
            method: 'POST',
            url: '/forms/field-properties',
            data: {
                id: config.data('id'),
                type: config.data('type'),
                html: el.closest('.form-group').html(),
            },
            success: function (response) {
                var h4 = $('h4[data-class="toggle-properties"]');

                if (!h4.hasClass('open')) {
                    h4.click();
                }

                field_prop_wrap.html(response);
            }
        });
    });

    /**
     * Change properties for user field
     */
    body.on('keyup change', '.field-properties_wrap input, .field-properties_wrap select, .field-properties_wrap textarea', function () {
        var prop_input  = $(this);
        var related_id  = prop_input.closest('[data-reltion-id]').data('reltion-id');
        var field_wrap  = user_form.find('[data-id="'+ related_id +'"]').closest('.form-group');

        var field_element = field_wrap.find(prop_input.data('element'));

        switch (prop_input.data('type')) {
            case 'text':
                field_element.text(prop_input.val());
            break;

            case 'css':
                var style       = prop_input.val().split(':');
                var css_prop    = $.trim(style[0]);
                var css_value   = $.trim(style[1]);

                if (field_element.css(style[0]) != style[1]) {
                    field_element.css(style[0], style[1]);
                } else {
                    field_element.css(style[0], '');
                }

            break;

            case 'value':
                if (prop_input.data('element') == 'select') {
                    var select_values = prop_input.val().split('\n').clean("");
                    field_element.html('');

                    for (var i = 0; i < select_values.length; i++) {
                        var option      = select_values[i].split('::');
                        var jq_option   = $('<option/>', {
                            value: 1 in option ? option[0] : '',
                            text: 1 in option ? option[1] : (0 in option ? option[0] : '')
                        });

                        field_element.append(jq_option);
                    }

                    break;
                } else if (prop_input.data('element') == 'textarea') {
                    field_element.val(prop_input.val());
                    break;
                }
            default:
                if (prop_input.attr('type') == 'checkbox' && !prop_input.prop('checked')) {
                    field_element.removeAttr(prop_input.data('type'));
                } else {
                    field_element.attr(prop_input.data('type'), prop_input.val());

                    // Fix radio detect checked in backend
                    if (field_element.attr('type') == 'radio' && prop_input.data('type') == 'checked') {
                        field_element.prop(prop_input.data('type'), true);
                    }
                }
            break;
        }
    });

    /**
     * Toggle show/hide right sidebar
     */
    $('.toggle').click(function () {
        var h4 = $(this).find('h4');
        var icon = h4.find('.glyphicon');
        var icon_class          = icon.attr('class');
        var icon_class_replace  = icon.data('replace');

        if (h4.hasClass('open')) {
            h4.removeClass('open');
            $('.row[data-class="'+ h4.data('class') +'"]').slideUp(200);
        } else {
            h4.addClass('open');
            $('.row[data-class="'+ h4.data('class') +'"]').slideDown(200);
        }

        icon
            .removeClass(icon_class)
            .addClass(icon_class_replace)
            .data('replace', icon_class);
    });

    /**
     * Fix radio checked detect in backend.
     */
    body.on('change', 'input[type="radio"]', function () {
        var el = $(this);

        if (el.prop('checked')) {
            el.attr('checked', true);
        } else {
            el.removeAttr('checked');
        }
    });

    /**
     * Disable buttons event in user form
     */
    body.on('click', 'button, input[type="submit"]', function (e) {
        e.preventDefault();
    });

    /**
     * Save user form
     */
    $('#form-save').click(function (e) {
        e.preventDefault();

        $('#user-result').val(user_form.html());
        $('#common-form').submit();
    });
});