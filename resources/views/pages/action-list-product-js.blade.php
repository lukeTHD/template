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
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager' lp>>`,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            searchDelay: 500,
            processing: true,
            serverSide: true,
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
                    className: 'select-checkbox',
                    render: function (data, type, full, meta){
                        let listIdChecked = getListIdProductChecked();
                        return `<input type="checkbox" class="check-product" value="" data-id-product="${data}" ${listIdChecked.includes(data) ? 'checked' : ''} data-name-product="${full.name}"  data-avatar-product="${full.avatar}"  data-price-product="${full.price}" data-href-product="${full.href}" data-currency-product="${full.currency}" >`; 
                    }
                },
                {
                    data: 'avatar',
                    name: 'avatar',
                    title: 'Hình ảnh',
                    autoWidth: false,
                    render: function(data, type, full, meta) {
                        
                        return  `<img class="image-product" src="` + (data !== '' && data !== null ? data :'') +`" alt="avatar" >`
                    },
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Tên sản phẩm',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                },
                {
                    data: 'price',
                    name: 'price',
                    title: 'Giá',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                },
                {
                    data: 'currency',
                    name: 'currency',
                    title: 'Tiền tệ',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                },
                {
                    data: 'campaign_name',
                    name: 'campaign_name',
                    title: 'Chiến dịch',
                    render: function(data, type, full, meta) {
                        return `<p>${data}</p>`;
                    },
                }
            ],
        });

        // $('#kt_search').on('click', function(e) {
        //     e.preventDefault();

        //     var params = {};
        //     $('.kt-input').each(function() {
        //         var i = $(this).data('col-index');
        //         if ($(this).val() || $(this).val() !== '') {
        //             params[i] = $(this).val();
        //         }
        //     });

        //     table.column(1).search(JSON.stringify(params), true, false);
        //     table.table().draw();
        // });
        

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
    itemHtmlNew.find('.price-product').text(price_product);
    itemHtmlNew.find('.price-product').attr('data-price-product', price_product);
    itemHtmlNew.find('.currency-product').text(currency_product);
    itemHtmlNew.find('.currency-product').attr('data-currency-product', price_product);
    return $(itemHtmlNew).html();
}

</script>
