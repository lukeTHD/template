<!-- <div class="" id="list-product">
   <div class="col-lg-3">
   </div>
</div> -->
<div class="container">
    <div class="row list-product-append">
        <div class="col-lg-3 col-md-3">
            <div class="card mb-4 box-shadow list-product-append-add" style="background-color: white;">
                <div class="card-body">
                    <div class="justify-content-between text-center">
                        <div class="btn-group">
                            <button type="button" class="btn-add-product">＋</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="show-modal-list-product"
    aria-labelledby="listProduct" aria-modal="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content-new">
            <div class="modal-header-new">
                <h5 class="modal-title" id="exampleModalLabel">Danh sách các sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label mb-0">Tìm kiếm:</label>
                        <div class="row">
                            <div class="col-lg-10 col-md-10 mb-2">
                                <input type="text" class="form-control" id="key-word">
                            </div>
                            <div class="col-lg-2 col-md-2 mb-2 text-center">
                                <button type="button" class="btn btn-success w-100" id="btn-search-product">Tìm
                                    kiếm</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row" id="list-product-box">

                </div>

                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- js -->
