<div class="bg-gray py-80 no-header section-page" data-section-index="14">
    @if(isset($listProduct) && !empty($listProduct) && isset($preview))
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-head text-center">
                        <h1 class="text-primary edit-text" data-number-text="165" data-content="Our Blog" data-type="text">Our Blog</h1>
                        <p class="edit-text" data-number-text="166" data-content="A place where we speak our mind. Product Udates, Marketing, Sales and some fun. Subscribe for email updates." data-type="text">A place where we speak our mind. Product Udates, Marketing, Sales and some fun. Subscribe for email updates.</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($listProduct as $key => $product)
                <div class="col-md-4">
                    <!-- Price-Box  <Start> -->
                    <div class="cs-price-card mt-5 aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1300">
                        <div class="cs-webnair-card">
                            <a href="#"><img class="card-img-top" src="{{isset($product['avatar']) ? $product['avatar'] : '' }}" alt="Card image cap"></a>
                        </div>
                        <div class="cs-price-card-content" style="padding: 10px 10px 30px;">
                            <div class="cs-price-card-features">
                                <a href="blog-single.html"><h4 class="card-title text-primary">{{isset($product['name']) ? $product['name'] : ''}}</h4></a>
                                <h3>{{ isset($product['currency']) && $product['currency'] == 'USD'  ?  number_format($product['price'],2) : number_format($product['price'])}}<sub><small>{{isset($product['currency']) ?  $product['currency'] : '' }}</small></sub></h3>
                            </div>
                            <div><a href="#" data-href-product="" class="cbtn btn-grad btn-round btn-sm href-product">Mua ngay</a></div>
                        </div>
                    </div>
                    <!-- Price-Box </End> -->
                </div>
            @endforeach
            </div>
        </div>
    @endif
</div>

