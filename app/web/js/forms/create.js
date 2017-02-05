/**
 * Created by Matthew Patell on 2017-02-05.
 */

$(function () {

    var body        = $('body');
    var user_form   = $('#user-form');

    var getField = function (type, resultCallback) {
        $.ajax({
            method: 'POST',
            url: '/forms/field',
            data: {type: type},
            success: function (response) {
                user_form.append(response);
            }
        });
    };

    $('.field-type').click(function () {

        var type = $(this).data('type');

        getField(type);
    });

});