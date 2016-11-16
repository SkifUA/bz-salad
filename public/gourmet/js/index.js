/**
 * Created by valeriy on 08.11.16.
 */

$(document).ready(function () {
    $('#send-commit-btn').on('click', function () {
        var text = $('#textarea-commit').val();
        if (text != '') {
            $.ajax({
                type: "POST",
                url: "/comments/save",
                data: {comment: text},
                dataType: "html",
                cache: false,
                success: function (data) {
                    // $('#listProducts').html(data);
                    // documentReady();
                },
                error: function (xhr, str) {
                    // var errorData = [];
                    // errorData.db = TEXT_MESSAGE_BET_ERROR_DB;
                    // showErrorMessage(errorData);
                }
            });
        }
    })

});
