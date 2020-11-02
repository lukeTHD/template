<script>
$(document).ready(function() {

    $(".edit-text").editable();

    $('.btn-href').on('click', function(e) {
        e.preventDefault();

    });
    $('.btn-href').on('dblclick', function(e) {
        e.preventDefault();
        $(this).attr('contenteditable', 'true');
    });
    $('.edit-text-double-click').on('dblclick', function(e) {
        e.preventDefault();
        $(this).attr('contenteditable', 'true');
    });

    var arrData = []
    let tmpDataText = getAllDataText(arrData);
    let tmpDataImage = getAllDataImage(arrData);
    let tmpListProductId = updateListProductSave(); //Action save to run


    // console.log(arrData);
    $(".edit-text").blur(function() {
        // console.log($(this).text());
        let that = $(this);
        let dataNumberText = that.data('number-text');
        let dataContent = that.text();
        let dataType = that.data('type');
        arrData[dataNumberText] = {
            'number-text': dataNumberText,
            'content': dataContent,
            'type': dataType
        };
        that.attr('data-content', dataContent);
        if (dataType == "button") {
            that.attr('contenteditable', 'false');
        }
    });

    $('#btn-save-page').on('click', function(e) {
        e.preventDefault();
        swal({
            title: ' Bạn hãy nhập tên để lưu ',
            content: {
                element: "input",
                attributes: {
                    type: "text",
                },
            },
        }).then((result) => {
            if(result != ''){
                let name = result
                console.log(1);
                console.log(name);

            }else{

            }
        })

    });

    $('#closeToolbarImg').on('click', function(e) {
        $(".sticky-toolbar-setting-image").css({
            "opacity": "0",
        });
    });

    $('.edit-image').on('click', function(e) {
        let that = $(this);
        var posP = that.offset();
        $(".sticky-toolbar-setting-image").css({
            "opacity": "1",
            "left": posP.left,
            "top": posP.top - 34
        });

        that.parent().find('.edit-image').removeClass('selected-image');
        // $(".edit-image").removeClass("selected-image");
        that.addClass('selected-image');
    });

    $('#imgupload').on('click', function(e) {
        swal({
            content: {
                element: "input",
                attributes: {
                    type: "file",
                    accept: 'image/*',
                },
            },
        }).then(async function(result) {
            if (result != '') { // result: path name file
                var formData = new FormData();
                formData.append('image', $('.swal-content__input')[0].files[0]);
                let string = result.split('\\').pop()
                $.ajax({
                    url: "{{ route('template.upLoadFile') }}/" + string,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        let destinationPath = "{{url('/')}}/" + data
                            .destinationPath;
                        let nameImg = data.nameImg;
                        $('.selected-image').attr("src", data.link);
                        let height = $('.selected-image').data("height");
                        let width = $('.selected-image').data("width");
                        $('.selected-image').css({
                            "max-height": height,
                            "max-width": width
                        });
                        // $('.selected-image').css("max-width", width);
                        $('.selected-image').data("content", data.link);
                        // $(".edit-image").removeClass("selected-image");
                        // console.log(getAllDataImage(arrData));
                    }
                })
            }
        });
    });

    // Show list product
$('.btn-add-product').on('click', function(e) {
    $('#show-modal-list-product').modal('toggle');
    let productId = updateListProductSave();
    $.ajax({
        url: "{{ route('campaign.listProductsApi') }}",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        method: "GET",
        contentType: false,
        processData: false,
        success: function(data) {
            let list_product_box = $('#list-product-box');
            let dataLirProduct = data.data.result ? data.data.result : [];
            let listItemProductDivHtml = dataLirProduct.map(function(item) {
                return getDivItemProduct( item.id , item.price , item.currency , item.avatar , item.name, false, productId) ;
            });
            console.log(productId);
            list_product_box.html( listItemProductDivHtml.join(''));
        }
    })
    });

    // Select product
    $('#list-product-box').on('click', '.is-check-product', function(e) {
        let that = $(this);
        let divParent = $('.list-product-append');
        if (that.is(":checked")) {
            let id = that.data('id');
            let name = that.data('name');
            let price = that.data('price');
            let avatar = that.data('avatar');
            let currency = that.data('currency');
            let newProductElement = getDivItemProduct(id , price , currency , avatar , name , true );
            divParent.append(newProductElement);
        }
    });

    // remove product
    $('.list-product-append').on('click', '.remove-product', function(e){
        $(this).parent().remove();
    });

});

function getAllDataText(arrData) {
    $(".edit-text").each(function(index) {
        let that = $(this);
        let dataNumberText = that.data('number-text');
        let dataContent = that.data('content');
        let dataType = that.data('type');

        arrData[dataNumberText] = {
            'number-text': dataNumberText,
            'content': dataContent,
            'type': dataType
        }
    });

    return arrData;
}

function getAllDataImage(arrData) {
    $(".edit-image").each(function() {
        let that = $(this);
        let dataNumberImage = that.data('number-text');
        let dataContent = that.data('content');
        let dataType = that.data('type');
        arrData[dataNumberImage] = {
            'number-text': dataNumberImage,
            'content': dataContent,
            'type': dataType
        }
    });
    return arrData;
}

function getDivItemProduct( id , price , currency , avatar , name , isDelete = false , productId = null){
    return `<div class="${isDelete ? 'col-xl-3 col-lg-3 col-md-3' : 'col-xl-4 col-lg-4 col-md-4' } ${isDelete ? 'mt-0' : 'mt-5' } mb-5 list-product-ajax item-product" data-id="${id}">
                        ${isDelete ?
                        `<span class="remove-product">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </span>` : '' }
                        <div class="card ">
                            <img src="${avatar}" class="card-img-top name-card-avatar" alt="...">
                            <div class="card-body">
                                <h5 class="card-title name-card-title">${name}</h5>
                                <h5 class="card-title mb-0 ${ isDelete ? 'pb-4' : ''} name-card-price"> ${price}</h5>
                            </div>
                            ${isDelete ? '' :`
                            <div class="card-footer">
                                <div class="form-check text-muted"><label class="form-check-label ">
                                        <input type="checkbox" ${ productId && productId.includes(id) ? 'checked' :''} class="form-check-input is-check-product " name="check-product" value="${id}" data-id="${id}"
                                            data-avatar="${avatar}"
                                            data-price="${price}" data-currency="${currency}" data-name="${name}">Chọn sản phẩm
                                    </label>
                                </div>
                            </div>`}
                        </div>
                    </div>`;

}

function updateListProductSave(){
    let arrproductId = [];
    $('.list-product-append .item-product').each(function(e){
        arrproductId.push($(this).data('id'));
    });
    return arrproductId;
}
</script>
