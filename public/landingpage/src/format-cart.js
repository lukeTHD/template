
$(document).ready(function() {

    const formatUSD = (number, decPlaces, decSep, thouSep) => {
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSep = typeof decSep === "undefined" ? "." : decSep;
        thouSep = typeof thouSep === "undefined" ? "," : thouSep;
        var sign = number < 0 ? "-" : "";
        var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
        var j = (j = i.length) > 3 ? j % 3 : 0;
        
        return sign +
            (j ? i.substr(0, j) + thouSep : "") +
            i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
            (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
    }
    
    const formatVND = (number) => (''+number).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

    const formatPrice = (number, currency) => {
        currency = (currency.trim()).toUpperCase();
        if (currency == 'VND' ) {
            return formatVND(number);
        }
        if (currency == 'USD' ) {
            return formatUSD(number, 2, '.', ',');
        }
    }

    let totalProduct = Number($('.cart-amountNumber').text()) ? Number($('.cart-amountNumber').text()) : 1;
    $('.cart-amountMinus').on('click', function() {
        if (totalProduct > 1) {
            let tl = (totalProduct -= 1).toString();
            $('.cart-amountNumber').text(tl);
            $('.cart-amountNumber').val(tl);
            $('#amount').val(tl).trigger("change");
        }
    })
    $('.cart-amountPlus').on('click', function() {
        let tl = (totalProduct += 1).toString();
        $('.cart-amountNumber').text(tl);
        $('#amount').val(tl).trigger("change");
    })
    $('body').on("change", "#amount", function() {
        let productPrice = parseFloat($(this).data("price"));
        let value = parseInt($(this).val());
        //cart-currency
        $('#total-price-text').html(formatPrice(productPrice * value, $('#cart-currency').val()));
        $('#total-price-input').val(productPrice * value).trigger("change");
    });

    
});
