
 @include('template.tool.manage_product')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="show-modal-list-product-table"
    aria-labelledby="listProductTable" aria-modal="true">
    <div class="modal-dialog modal-lg modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header">
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
                <div id="list-product-box">
                    <table class="table  table-hover" id="data-table-product">

                    </table>
                </div>

                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- js -->
