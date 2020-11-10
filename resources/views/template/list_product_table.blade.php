
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
                        
                        <div class="row">
                            <div class="col-lg-4 col-md-4 mb-2">
                                <label  class="col-form-label mb-0">Tìm kiếm:</label>
                                <input type="text" class="form-control kt-input form-control-border-shadow" data-col-index="key_word">
                            </div>
                            <div class="col-lg-4 col-md-4 mb-2">         
                                <label class="col-form-label mb-0">Chiến dịch:</label>
                                <select class="form-control kt-input form-control-border-shadow"  data-col-index="campaign_id">
                                    <option value="">Tất cả</option>
                                    @if(isset($listCampaign) && !empty($listCampaign))
                                        @foreach($listCampaign as $item)
                                            <option value="{{isset($item['id']) ? $item['id'] : ''}}"> {{isset($item['name']) ? $item['name'] : ''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 mb-2 text-center" style="padding-top: 2.4rem;">
                                <button type="button" class="btn btn-success btn-control-purple form-control-border-shadow w-100" id="kt_search">Tìm kiếm</button>
                            </div>
                            <div class="col-lg-2 col-md-2 mb-2 text-center" style="padding-top: 2.4rem;">
                                <button type="button" class="btn btn-warning btn-control-yellow form-control-border-shadow w-100" id="kt_reset">Làm mới</button>
                            </div>
                           
                        </div>
                    </div>
                </form>
                <div id="list-product-box">
                    <table class="table w-100" id="data-table-product">

                    </table>
                </div>

                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- js -->
