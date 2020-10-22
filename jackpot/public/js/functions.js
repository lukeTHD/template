function submit(id) {
    $('#' + id).submit();
}

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}

jQuery(document).ready(function () {
    $('.selectpicker').selectpicker();
    $('.toggle').click(function() {
        var elm = $(this).data('toggle');
        $("#" + elm).stop().slideToggle('fast');
    });
});
