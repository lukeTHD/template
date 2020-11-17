{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
<div id="app">
    <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_view">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                <!--begin::Left-->
                <div class="d-flex align-items-center my-2">
                    <a href="{{url('/home')}}" class="btn btn-clean btn-icon btn-sm mr-6 ml-4" data-inbox="back">
                        <i class="flaticon2-left-arrow-1"></i>
                    </a>
                    <p @click="reload" class="btn btn-clean btn-icon btn-sm mr-4 mt-4">
                        <i class="flaticon2-reload"></i>
                    </p>
                </div>
                <!--end::Left-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0">
                <!--begin::Header-->
                <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-5">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center mr-2 py-2">
                        <div class="font-weight-bold font-size-h3 mr-3">${title}</div>
                        <span 
                             v-bind:class="{ 
                                'label-light-success': status==1,
                                'label-light-primary': status==2,
                                'label-light-info': status==3 
                            }"
                            class="label font-weight-bold label-lg   label-inline">
                                <div v-if="status==1" >
                                    Processed
                                </div>
                                <div v-else-if="status==2">
                                    Pending
                                </div>
                                <div v-else>
                                    Sending
                                </div>
                        </span>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Messages-->
                <div class="mb-3 custom-box-messenger" id="box-chat">
                    <div v-for="item in list_contact">
                        <div v-if="item.user_id!=2">
                            <div class="box-messenger">
                                <div class="box-messenger__header">
                                    <div class="symbol symbol-50 pl-4 " >
                                        <div class="d-flex align-items-center ">
                                            <div class="symbol-label" style="background-image: url({{asset("img/avatars/1.jpg")}})"></div>
                                            <div class="ml-4  ">
                                                <p class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary">${item.user.name}</p>
                                                <span class="font-weight-bold text-muted cursor-pointer " data-toggle="dropdown">${item.user.email}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold text-muted pr-4 ">${item.created_at_format}</div>
                                </div>
                                <div  class="px-4 py-4">
                                    <span v-html="item.content"></span>
                                    <div v-if="item.link == 1">
                                        <img class="box-messenger__img " v-bind:src="item.urlLink">
                                    </div>
                                </div>
                            </div>                       
                        </div>
                        <div v-else> 
                            <div class="box-messenger">
                                <div v-bind:class="{ 'box-messenger__header-rep': true }" class="box-messenger__header">
                                    <div class="symbol symbol-50 pl-4 " >
                                        <div class="d-flex align-items-center ">
                                            <div class="symbol-label" style="background-image: url({{asset("img/avatars/1.jpg")}})"></div>
                                            <div class="ml-4  ">
                                                <p class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary">${item.user.name}</p>
                                                <span class="font-weight-bold text-muted cursor-pointer " data-toggle="dropdown">${item.user.email}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold text-muted pr-4 ">${item.created_at_format}</div>
                                </div>
                                <div  class="px-4 py-4 d-flex flex-column text-right">
                                    <span v-html="item.content"></span>
                                    <div v-if="item.link == 1">
                                        <img class="box-messenger__img " v-bind:src="item.urlLink">
                                    </div>                                                                                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Messages-->
                <!--begin::Reply-->
                
                <!--end::Reply-->
                <!--begin::Footer-->                
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
        <div class="border-0 ql-container ql-snow">
            <div class="summernote" id="kt_summernote_1"></div>
            <div class="d-flex">
                <div class="btn-group mr-4 " >
                    <span @click="clickAddTiny" class="btn btn-primary font-weight-bold px-6">Send</span>
                </div>
                <div class="dropdown" >
                    <button class="btn btn-outline-primary dropdown-toggle custom-dropdown-home" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div v-if="status==1" >
                            Processed
                        </div>
                        <div v-else-if="status==2">
                            Pending
                        </div>
                        <div v-else>
                            Sending
                        </div>    
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <p @click="clickChangeStatusPro" class="dropdown-item" >Processed</p>
                        <p @click="clickChangeStatusPen" class="dropdown-item" >Pending</p>
                        <p @click="clickChangeStatusSen" class="dropdown-item" >Sending</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>          
</div>
<!--end::Content-->
@endsection

{{-- Styles Section --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('css/client/client.css') }}">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<base href="{{asset('/')}}">
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/editors/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/inbox/inbox.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/features/miscellaneous/sweetalert2.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script>
        function scrollBottomChat() {
            setTimeout(function() {
                $("#box-chat").animate({ scrollTop: $(document).height() }, "slow​")
            },300)
        }

        function showSweetAlertErr(){
            Swal.fire("Thất bại", "Vui lòng điền dữ liệu", "error");
        }

        function LoadIcon(){
            Swal.fire({
                title: "",
                text: "",
                timer: 1000,
                onOpen: function() {
                    Swal.showLoading()
                }
            })
        }

        new Vue({
            delimiters: ['${', '}'],
            el:"#app",
            data:{
                id_subject:null,
                list_contact:null,
                title:"",
                text_content:"",
                id_user:2,
                status:null,
                text_tiny:null,
                name_file:"",
                time:null
            },
            created: function(){
                scrollBottomChat();
                let uri = window.location.search.substring(1); 
                let params = new URLSearchParams(uri);
                this.id_subject=params.get("id");

                this.getListMessages();

                let url = "{{ route('subjects.show', ':id') }}";
                axios.get(url.replace(':id', this.id_subject))
                .then( response => {
                    if(response.data){
                        this.title = response.data.content;
                        this.status = response.data.status;
                    }
                    else{
                        window.location.href = "{{ route('pageNotFound') }}";
                    }
                })
                .catch(function(error){
                    console.log("errr")
                })

                //this.time = this.getDateTimeNow();
            },
            mounted(){
                
            },
            watch:{
                status:function(val){
                    let url = "{{ route('subjects.update', ':id') }}";
                    axios
                    .put(url.replace(':id', this.id_subject), {
                        status: val,
                    })
                    .then((req) => {
                        //showSweetAlertSuccess();
                        console.log('Cập nhật thành công!');
                    });
                }         
            },
            methods:{
                getNow: function() {
                    const today = new Date();
                    const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    const dateTime = date +' '+ time;
                    return dateTime;
                },

                getListMessages:function(){
                    let url = "{{ route('subject.all-message', ':id') }}";
                    axios.get(url.replace(':id', this.id_subject))
                    .then( response => {
                        this.list_contact = response.data;
                        //console.log(response.data[24].content);
                    })
                    .catch(function(error){
                        console.log("errr")
                    })
                },

                reload:function(){
                    LoadIcon();
                    this.getListMessages();
                },

                storeMessage:function(){
                    axios.post("{{ route('message.store-message') }}",{
                        subject_id:this.id_subject,
                        user_id:this.id_user,
                        content:this.text_content,             
                    })
                    .then(response=>{
                        this.text_content='';
                        this.getListMessages();
                    })
                    .catch(function (error) {
                        showSweetAlertErr();
                    });
                },

                handleFileUpload:function(){
                    this.file = this.$refs.file.files[0];
                },
                clickChangeStatusPro:function(){
                    this.status=1;
                },
                clickChangeStatusPen:function(){
                    this.status=2;
                },
                clickChangeStatusSen:function(){
                    this.status=3;
                },
                clickUploadImg:function(){
                    $('#file').click();
                },
                clickAddTiny:function(){
                    if($('.summernote').summernote('isEmpty')){
                        showSweetAlertErr();
                    }
                    else{
                        this.text_content = $('.summernote').summernote('code');
                        this.storeMessage();                 
                        LoadIcon();
                        $('.summernote').summernote('code','');
                    }              
                }
            },  
        })
    </script>  
@endsection
