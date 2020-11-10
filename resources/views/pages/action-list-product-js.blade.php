<script>
"use strict";
$(document).ready(function () {

    let listProductForPage =  <?= isset($listProduct) ? json_encode($listProduct) : [] ?> ;
    
    let itemProductHtml = $('#list-product-page-tmpl:first').clone(); 
 
    if(listProductForPage.length > 0){
        let listProductDivHtml = listProductForPage.map(function(item) {
            return getItemProduct( itemProductHtml , item.id,  item.name , item.avatar, 'abc.com' , item.price , item.currency ) ;
        });
        $('#list-product-page-tmpl').html( listProductDivHtml.join(''));
    }

    // Show tool manage product
    $('#list-product-page-tmpl').on('click' ,'.item-product-page-tmpl', function(e) {
        e.preventDefault();
        let posManageP = $('#list-product-page-tmpl').offset();
        $("#tool-manage-products-tmpl").css({
            "opacity": "1",
            "left": posManageP.left + 15 ,
            "top": posManageP.top
        });
    });


    // Show list product to chose in page
    DatatablesSearchOptionsAdvancedSearchTableProduct.init();
    $('#tool-manage-products-tmpl').on('click' , function(e){
        e.preventDefault();
        $('#show-modal-list-product-table').modal('toggle');
        DatatablesSearchOptionsAdvancedSearchTableProduct.reloadDataAffterUpdate();
    });

    $('#data-table-product').on('click' , '.check-product' , function(e){
        let that = $(this);
        let valIdProduct =  that.data('id-product');
        let valNameProduct =  that.data('name-product');
        let valAvatarProduct =  that.data('avatar-product');
        let valHrefProduct =  that.data('href-product');
        let valPriceProduct =  that.data('price-product');
        let valCurrencyProduct =  that.data('currency-product');
        if(that.prop("checked")){
            let listItemProductDivHtml =   getItemProduct( itemProductHtml , valIdProduct , valNameProduct , valAvatarProduct, valHrefProduct , valPriceProduct , valCurrencyProduct);
            $('#list-product-page-tmpl').append(listItemProductDivHtml);
        }else{
            $(`.id-product-tmpl[data-id-product="${valIdProduct}"]`).remove();
        }
    }); 


});

let DatatablesSearchOptionsAdvancedSearchTableProduct = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    let table;
    let initTableProduct = function() {
        // begin first table
        
        table = $('#data-table-product').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row '<'col-sm-12'tr>><'row custom-data-tables-bottom'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager' lp>>`,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,
            language: {
                info: " Hiển thị _START_ đến _END_ trong _TOTAL_ kết quả",
                infoEmpty: "Không có kết quả",
                processing: "Đang xử lý...",
                lengthMenu: "Hiển thị  _MENU_ mục ",
                zeroRecords: "Không có kết quả",
            },
            searchDelay: 500,
            processing: true,
            serverSide: true,
            orderable: false,
            ajax: {
                url: "{{route('campaign.listProductsApiTable')}}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            order: [[ 0, "desc" ]],
            columns: [
                {
                    data: 'id',
                    orderable: false,
                    className: 'select-checkbox text-center',
                    render: function (data, type, full, meta){
                        let listIdChecked = getListIdProductChecked();
                        return `<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand"><input type="checkbox" class="check-product" value="" data-id-product="${data}" ${listIdChecked.includes(data) ? 'checked' : ''} data-name-product="${full.name}"  data-avatar-product="${full.avatar}"  data-price-product="${full.price}" data-href-product="${full.href}" data-currency-product="${full.currency}"><span></span></label>`; 
                    }
                },
                {
                    data: 'avatar',
                    name: 'avatar',
                    title: 'Hình ảnh',
                    width: 150,
                    autoWidth: false,
                    render: function(data, type, full, meta) {   
                        return  `<img class="image-product" src="` + (data !== '' && data !== null ? data :'') +`" alt="avatar" >`
                    },
                },
                {
                    data: 'campaign_name',
                    name: 'campaign_name',
                    title: 'Chiến dịch',
                    className: 'text-uppercase',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Tên sản phẩm',
                    className: 'text-inherit',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                },
                {
                    data: 'price',
                    name: 'price',
                    width: 150,
                    title: 'Giá',
                    render: function(data, type, full, meta) {
                        return `<p>${formatPrice( data , full.currency )}</p>`;
                    },
                },
                {
                    data: 'currency',
                    name: 'currency',
                    width: 150,
                    title: 'Tiền tệ',
                    className: 'text-uppercase',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                },
               
            ],
        });

        $('#kt_search').on('click', function(e) {
            e.preventDefault();
            let params = {};
            $('.kt-input').each(function() {
                var i = $(this).data('col-index');
                if ($(this).val() || $(this).val() !== '') {
                    params[i] = $(this).val();
                }
            });
            table.column(1).search(JSON.stringify(params), true, false);
            table.table().draw();
        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.kt-input').each(function() {
                $(this).val('');
                table.column(1).search('', false, false);
            });
            table.table().draw();
        });
    };

    return {
        //main function to initiate the module
        init: function() {
            initTableProduct();
        },
        reloadDataAffterUpdate: function() {
            table.ajax.reload(null, false);
        }

    };

}();

function formatUSD(number, decPlaces, decSep, thouSep){
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;
    
    return sign + (j ? i.substr(0, j) + thouSep : "") + i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) + (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}

function formatVND(number){ return (''+number).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"); };

function formatPrice(number, currency){
        currency = (currency.trim()).toUpperCase();
        if (currency == 'VND' ) {
            return formatVND(number);
        }
        if (currency == 'USD' ) {
            return formatUSD(number, 2, '.', ',');
        }
    }

function getListIdProductChecked(){
 let  listIdProductChecked = [];
  $('#list-product-page-tmpl .id-product-tmpl').each( function(){
      let idProduct = $(this).data('id-product');
      listIdProductChecked.push(idProduct);
  });
  return listIdProductChecked;
};

function getItemProduct( itemHtml , id_product , name_product , avatar_product, href_product , price_product , currency_product){
   
    let itemHtmlNew = itemHtml;
    itemHtmlNew.find('.id-product-tmpl').attr('data-id-product', id_product);
    itemHtmlNew.find('.name-product').text(name_product);
    itemHtmlNew.find('.name-product').attr('data-name-product', name_product);
    itemHtmlNew.find('.avatar-product').attr('data-avatar-product', avatar_product);
    itemHtmlNew.find('.avatar-product').attr('src', avatar_product);
    itemHtmlNew.find('.href-product').attr('data-href-product', href_product);
    itemHtmlNew.find('.href-product').attr('href', href_product);
    itemHtmlNew.find('.price-product').text(formatPrice( price_product , currency_product ));
    itemHtmlNew.find('.price-product').attr('data-price-product', price_product);
    itemHtmlNew.find('.currency-product').text(currency_product);
    itemHtmlNew.find('.currency-product').attr('data-currency-product', price_product);
    return $(itemHtmlNew).html();
}


</script>
