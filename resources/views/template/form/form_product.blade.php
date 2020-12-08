<div class="container">
    <div class="row form-product">
        <!-- Detail product -->
        <div class="col-lg-7 col-md-7">
            <div class="cs-blog-view">
                <div class="cs-blog-view-img">
                    <img src="{{ isset($detailProduct['avatar']) ? $detailProduct['avatar'] : '' }}" alt="avatar product"class="img-fluid rounded-top" style="width: 635px;">
                </div>
                <div class="box-shadow p-5 rounded-top">
                    <div class="cs-blog-content">
                        <h2 class="cs-blog-title text-primary">{{isset($detailProduct['name']) ? $detailProduct['name'] : ''}}</h2>
                        <div class="cs-postedby text-primary">{{ isset($detailProduct['campaign_name']) ? $detailProduct['campaign_name'] : '' }} |  <span class="cs-blog-price-product">{{ isset($detailProduct['currency']) && $detailProduct['currency'] == 'USD'  ?  number_format($detailProduct['price'],2) : number_format($detailProduct['price'])}} {{isset($detailProduct['currency']) ? $detailProduct['currency'] : ''}}</span></div>
                        <hr>
                        <p>{!! isset($detailProduct['description']) ? $detailProduct['description'] : '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form product -->
        <div class="col-lg-5 col-md-5">
            <div class="box-shadow p-5 rounded-top rounded-bottom">
                <div class="cs-comment-form ">
                    <h6 class="mb-3">Thông tin khách hàng</h6>
                    <form method="post" action="//">
                        @csrf
                        <input type="hidden" name="campaign_id"
                            value="{{isset($detailProduct['campaign_id']) ? $detailProduct['campaign_id'] : ''}}" />
                        <input type="hidden" name="affiliator" value="{{isset($affiliator) ? $affiliator : ''}}" />
                        <input type="hidden" name="type_cd"
                            value="{{isset($detailProduct['type_cd']) ? $detailProduct['type_cd'] : ''}}" />
                        <input type="hidden" name="product_id"
                            value="{{isset($detailProduct['id']) ? $detailProduct['id'] : ''}}" />
                        <div class="row align-items-center">
                            @if(isset($detailProduct['type_cd']) && $detailProduct['type_cd'] !== 'form')
                            <div class="form-group col-sm-12">
                                <label>Họ và tên <em class="text-danger">*</em></label>
                                <input type="text" class="form-control" placeholder="Họ và tên" name="name"
                                    value="{{old('name') ? old('name') : ( isset($profile['display_name']) ? $profile['display_name'] : '' )}}">

                                @if($errors->has('name'))
                                <span class="form-text text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Email <em class="text-danger">*</em></label>
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                    value="{{old('email') ? old('email') : ( isset($profile['email']) ? $profile['email'] : '' ) }}">
                                @if($errors->has('email'))
                                <span class="form-text text-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Số điện thoại <em class="text-danger">*</em></label>
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="phone"
                                    value="{{old('phone') ? old('phone') : ( isset($profile['phone']) ? $profile['phone'] : '' ) }}">

                                @if($errors->has('phone'))
                                <span class="form-text text-danger">{{$errors->first('phone')}}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Địa chỉ" name="address"
                                    value="{{old('address') ? old('address') : ( isset($profile['address']) ? $profile['address'] : '' ) }}">

                                @if($errors->has('address'))
                                <span class="form-text text-danger">{{$errors->first('address')}}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Địa chỉ nhận hàng <em class="text-danger">*</em></label>
                                <input type="text" class="form-control" placeholder="Địa chỉ nhận hàng"
                                    name="shipping_address"
                                    value="{{old('shipping_address') ? old('shipping_address') : ( isset($profile['address']) ? $profile['address'] : '' ) }}">


                                @if($errors->has('shipping_address'))
                                <span class="form-text text-danger">{{$errors->first('shipping_address')}}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <textarea class="form-control" placeholder="Ghi chú" rows="4"
                                    name="note">{{old('note') ? old('note') : ''}}</textarea>
                                @if($errors->has('note'))
                                <span class="form-text text-danger">{{$errors->first('note')}}</span>
                                @endif
                            </div>
                            @elseif( isset($detailProduct['form']) && !empty($detailProduct['form']))

                            @foreach( json_decode($detailProduct['form'] , true) as $form)

                            @switch($form['type_input'])
                            @case('input')
                            <div class="form-group col-sm-12">

                                <label>{{ session('locale') !== null && session('locale') == 'en' && isset($form['name_row_en']) ? $form['name_row_en'] : $form['name_row_vi'] }}
                                    <em
                                        class="text-danger">{{ isset($form["required"]) && $form["required"] == 'true' ? '*' : ''}}</em>
                                </label>
                                <input type="text" class="form-control"
                                    placeholder="{{ session('locale') !== null && session('locale') == 'en' && isset($form['name_row_en']) ? $form['name_row_en'] : $form['name_row_vi'] }}"
                                    name="{{isset($form['name_input']) ? $form['name_input'] : ''}}"
                                    value="{{ old($form['name_input']) ? old($form['name_input']) : ( $form['name_input'] =='name' && isset($profile['display_name']) ? $profile['display_name'] :  ( isset($profile[$form['name_input']]) ?  $profile[$form['name_input']] : '' ) ) }}">

                                @if($errors->has($form["name_input"]))
                                <span
                                    class="form-text text-danger">{{$errors->first( isset($form["name_input"]) ? $form["name_input"] : "" )}}</span>
                                @endif
                            </div>
                            @break

                            @case('textarea')

                            <div class="form-group col-sm-12">

                                <label>{{ session('locale') !== null && session('locale') == 'en' && isset($form['name_row_en']) ? $form['name_row_en'] : $form['name_row_vi'] }}
                                    <em
                                        class="text-danger">{{ isset($form["required"]) && $form["required"] == 'true' ? '*' : ''}}</em>
                                </label>
                                <textarea type="text" class="form-control" rows="4"
                                    placeholder="{{ session('locale') !== null && session('locale') == 'en' && isset($form['name_row_en']) ? $form['name_row_en'] : $form['name_row_vi'] }}"
                                    name="{{isset($form['name_input']) ? $form['name_input'] : ''}}">{{ old($form['name_input']) ? old($form['name_input']) : ( isset($profile[$form['name_input']]) ? $profile[$form['name_input']] : '' ) }}</textarea>

                                @if($errors->has($form["name_input"]))
                                <span
                                    class="form-text text-danger">{{$errors->first(isset($form["name_input"]) ? $form["name_input"] : "" )}}</span>
                                @endif
                            </div>
                            @break
                            @case('checkbox')
                            <div class="form-group col-sm-12">

                                <label>{{ session('locale') !== null && session('locale') == 'en' && isset($form['name_row_en']) ? $form['name_row_en'] : $form['name_row_vi'] }}
                                    <em
                                        class="text-danger">{{ isset($form["required"]) && $form["required"] == 'true' ? '*' : ''}}</em>
                                </label>
                                <div class="kt-checkbox-list">
                                    @foreach( $form["arr_option"] as $key => $option)
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success p-0 col-12">
                                        <input type="checkbox"
                                            name="{{isset($form['name_input']) ? $form['name_input'] : ''}}[]"
                                            value="{{isset($option['value']) ? $option['value'] : ''}}"
                                            {{ old($form['name_input']) ?  (   is_array(old($form['name_input'])) ?  ( in_array($option['value'] , old($form['name_input']) )  ? 'checked' : '' )  :  ( $option['value'] == old($form['name_input']) ? 'checked' : ''  ) ) : ( old($form['name_input']) == null && $key == 0 ? 'checked' : '' ) }}>
                                        {{ session('locale') !== null && session('locale') == 'en' && isset($option["name_option_en"]) ? $option["name_option_en"] : ( isset($option["name_option_vi"]) ? $option["name_option_vi"] : '' ) }}
                                        <span></span>
                                    </label>
                                    @endforeach
                                </div>

                                @if($errors->has($form["name_input"]))
                                <span
                                    class="form-text text-danger">{{$errors->first( isset($form["name_input"]) ? $form["name_input"] : "")}}</span>
                                @endif
                            </div>

                            @break
                            @case('radio')
                            <div class="form-group col-sm-12">

                                <label>{{ session('locale') !== null && session('locale') == 'en' && isset($form['name_row_en']) ? $form['name_row_en'] : $form['name_row_vi'] }}
                                    <em
                                        class="text-danger">{{ isset($form["required"]) && $form["required"] == 'true' ? '*' : ''}}</em>
                                </label>
                                <div class="kt-radio-list">

                                    @foreach( $form["arr_option"] as $key => $option)
                                    <label class="kt-radio kt-radio--bold kt-radio--success p-0 col-12">
                                        <input type="radio"
                                            name="{{isset($form['name_input']) ? $form['name_input'] : ''}}"
                                            value="{{isset($option['value']) ? $option['value'] : ''}}"
                                            {{ old($form['name_input']) == NULL  && $key == 0 ? 'checked' : ( ( old($form['name_input']) === $option['value'] ) ? 'checked' : '' )    }}>
                                        {{ session('locale') !== null && session('locale') == 'en' && isset($option["name_option_en"]) ? $option["name_option_en"] : ( isset($option["name_option_vi"]) ? $option["name_option_vi"] : '') }}
                                        <span></span>
                                    </label>
                                    @endforeach
                                </div>

                                @if($errors->has($form["name_input"]))
                                <span
                                    class="form-text text-danger">{{$errors->first(isset($form["name_input"]) ? $form["name_input"] : "")}}</span>
                                @endif
                            </div>
                            @break
                            @endswitch
                            @endforeach
                            @endif
                            <div class="form-group col-sm-12">
                                <div>
                                    <h6>Phương thức thanh toán</h6>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <select class="form-control kt-selectpicker" name="payment_method">
                                    @foreach($listPaymentMethod as $key => $method)
                                    @if($detailProduct['currency'] == 'VND' && $method['currency'] !== 'VND') @continue
                                    @endif
                                    <option value="{{$method['id']}}">
                                        {{session('locale') == 'en' ? $method['name_en'] : $method['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="form-group col-lg-4 col-md-4">
                                    <h6 class="cart-totalTitle">Số lượng</h6>
                            </div>
                            <div class="form-group col-lg-8 col-md-8">
                                <div class="form-group cart-amount-icon">
                                    <span class="cart-amountMinus">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </span>
                                    <span class="cart-amountNumber">{{old('amount') !== null ? old('amount') : 1 }}</span>
                                    <input type="hidden" name="amount"
                                        value="{{old('amount') !== null ? old('amount') : 1 }}" id="amount"
                                        data-price="{{isset($detailProduct['price']) ? $detailProduct['price'] : '0' }}" />
                                    <span class="cart-amountPlus">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </span>
                                </div>
                                @if($errors->has("amount"))
                                <span class="form-text text-danger">{{$errors->first("amount")}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <h6 class="cart-priceTitle">Tổng tiền</h6>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="cart-totalPrice">
                                    <div class="cart-price c-total"><span id="total-price-text">{{ isset($detailProduct['currency']) && $detailProduct['currency'] == 'USD'  ?  number_format( ( old('total_price') !== null ? old('total_price') : $detailProduct['price'] ) ,2) : number_format(  old('total_price') !== null ? old('total_price') : $detailProduct['price'] )}}</span>{{isset($detailProduct['currency']) ? $detailProduct['currency'] : 'VND'}}</div>
                                    <input type="hidden" id="cart-currency" value="{{isset($detailProduct['currency']) ? $detailProduct['currency'] : 'VND'}}" />
                                    <input type="hidden" name="total_price" value="{{floatval( old('total_price') !== null ? old('total_price') : (isset($detailProduct['price']) ? $detailProduct['price'] : '0' )  )}}" id="total-price-input" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 ">
                                <div class="cart-btnBuy">
                                    <button class="btn-submit-form" id="btn-submit-form" type="submit">Tiếp tục</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
