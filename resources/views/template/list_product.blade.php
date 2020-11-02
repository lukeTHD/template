<!-- <div class="" id="list-product">
   <div class="col-lg-3">
   </div>
</div> -->
<div class="container">
    <div class="row list-product-append">
        <div class="col-lg-3 col-md-3">
            <div class="card mb-4 box-shadow list-product-append-add">
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
<div class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" id="show-modal-list-product"
    aria-labelledby="listProduct" aria-modal="true">
    <div class="modal-dialog modal-lg" >
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
                <div class="row" id="list-product-box">

                </div>

                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- css -->
<style>
.btn-add-product {
    margin: 5vh auto;
    width: 80px;
    height: 80px;
    background: white;
    border-radius: 50%;
    font-size: 30px;
    border: none;
    color: #E1332D;
    text-decoration: none;
    cursor: pointer;
    display: block;
    box-shadow: 1px 1px 5px 0px rgba(0, 0, 0, 0.18);
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}

.modal-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1.25rem;
    border-bottom: 1px solid #ebedf2;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}

.form-control {
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #e2e5ec;
    border-radius: 4px;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}

.btn {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.btn-success {
    color: #fff;
    background-color: #0abb87;
    border-color: #0abb87;
    color: #ffffff;
}

.list-product-append-add{
    height: 86%;
    border-radius: .5rem;
    border-width: 0;
    border-style: solid;
    border-color: #e2e8f0;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04);
    min-height: 300px;

}

</style>
<!-- js -->
