{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
<div id="app">
    <div class="d-flex flex-row">
        <!--begin::Aside-->
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-left flex-grow-1">
                        <!--begin::Aside Mobile Toggle-->
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
                            <span class="svg-icon svg-icon-lg">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"></path>
                                        <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </button>
                        <!--end::Aside Mobile Toggle-->
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor icon-md"></i>
                            </button>
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-left dropdown-menu-md">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover py-5">
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon-delete"></i>
                                            </span>
                                            <span class="navi-text mt-1 ml-2">Delete</span>
                                        </a>
                                    </li>
                                    <li class="navi-separator my-3"></li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon-visible"></i>
                                            </span>
                                            <span class="navi-text">
                                                Mark as unread</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <div class="text-center flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5">Matt Pears</div>
                    </div>
                    <div class="text-right flex-grow-1">
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div id="box-chat" class="scroll scroll-pull ps ps--active-y" data-mobile-height="350" style="height: 271px; overflow: hidden;">
                        <!--begin::Messages-->
                        <div v-for="item in list" >
                            <!--begin::Message In-->
                            <div v-if="item.fromId != null">
                                <div class="d-flex flex-column mb-5 pt-2 align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-40 mr-3">
                                        <img alt="Pic" src="{{asset("img/avatars/1.jpg")}}">
                                        </div>
                                        <div>
                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
                                            <span class="text-muted font-size-sm">${item.create_at_format}</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">${item.content}</div>
                                </div>  
                            </div>
                            <!--end::Message In-->
                            <!--begin::Message Out-->
                            <div v-else>
                                <div class="d-flex flex-column mb-5 pt-2 align-items-end">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="text-muted font-size-sm">${item.create_at_format}</span>
                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                                        </div>
                                        <div class="symbol symbol-circle symbol-40 ml-3">
                                            <img alt="Pic" src="{{asset("img/avatars/0.jpg")}}">
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">${item.content}</div>
                                </div> 
                            </div>
                            <!--end::Message Out-->
                        </div>
                        <!--end::Messages-->
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 271px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 69px;"></div></div></div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer align-items-center">
                    <!--begin::Compose-->
                    <textarea v-model="content" @keyup.enter="clickAddContent()" class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        <div class="mr-3">
                            <a href="#" class="btn btn-clean btn-icon btn-md mr-1">
                                <i class="flaticon2-photograph icon-lg"></i>
                            </a>
                            <a href="#" class="btn btn-clean btn-icon btn-md">
                                <i class="flaticon2-file icon-lg"></i>
                            </a>
                        </div>
                        <div>
                            <button  @click="clickAddContent()" type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
                        </div>
                    </div>
                    <!--begin::Compose-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
</div>
<!--end::Content-->
@endsection

{{-- Styles Section --}}
@section('styles')
   
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/features/miscellaneous/sweetalert2.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script>

        function scrollBottomChat() {
            setTimeout(function() {
                $("#box-chat").scrollTop(99999999);
            },300)
        }

        function showSweetAlertErr(){
            Swal.fire("Thất bại", "Vui lòng kiểm tra lại", "error");
        }

        new Vue({
            delimiters: ['${', '}'],
            el:"#app",
            data:{
                list:[],
                fromId:null,
                content:'',
                toId:1,
                status:'1',
                link:'1',
                type:'1',
            },
            mounted(){
                axios.get('http://localhost:81/template/public/api/testapi2/1')
                .then(
                    response=>{this.list=response.data;
                    })
                    .then(function(){
                        scrollBottomChat();
                    });
            },
            methods:{
                clickAddContent:function(){
                    axios.post('http://localhost:81/template/public/api/testapi',{
                            fromId:this.fromId,
                            content:this.content,
                            toId:this.toId,
                            status:this.status,
                            link:this.link,
                            type:this.type,                  
                    })
                    .then(response=>{
                        this.list.push(response.data);
                        console.log("thanh cong");
                        this.content='';
                        scrollBottomChat();
                    })
                    .catch(function (error) {
                        showSweetAlertErr();
                    });
                },
            },  
        })
    </script>  
@endsection
