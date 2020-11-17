{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!--begin::Content-->
<div id="app">
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="card-body">
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <div class="row align-items-center">
                                <div class="col-lg-10 pl-0">
                                    <div class="row align-items-center d-flex justify-content-around">
                                        <div class="col-md-8 my-2 my-md-0 pl-0">
                                            <div class="input-icon">
                                                <input type="text" v-model="text_search"  class="form-control" placeholder="Search by name subject ..."  />
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0 pl-0">
                                            <div class="d-flex align-items-center">
                                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary dropdown-toggle custom-dropdown-home" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        ${status}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <p @click="findByAll" class="dropdown-item" >All</p>
                                                        <p @click="findByProcess" class="dropdown-item" >Processed</p>
                                                        <p @click="findByPending"  class="dropdown-item" >Pending</p>
                                                        <p @click="findBySending"  class="dropdown-item" >Sending</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 mt-6 mt-lg-0 ">
                                    <p @click="fillData" href="#" class="btn btn-light-primary px-6 font-weight-bold mt-4">Search</p>
                                </div>
                            </div>
                        </div>
                        <!--end::Search Form-->
                        <!--end: Search Form-->
                        <!--begin: Datatable-->
                        <table class="table" id="table">
                            <thead>
                              <tr>
                                <th scope="col">Sender</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created at</th>
                              </tr>
                            </thead>
                            <tbody>
                                <!--begin: v-for -->
                                <tr  v-for="item in list_subject" @click="redirectToPrivate(item.id)" style="cursor: pointer" data-row="0" class="datatable-row" style="left: 0px;border-bottom: 1px solid #EBEDF3;" >
                                    <td  style="vertical-align: middle;" scope="col">
                                        <div style="width: 170px" class="d-flex align-items-center">
                                            <div class="symbol symbol-40 symbol-light-primary flex-shrink-0">
                                                <img alt="Pic" src="{{asset("img/avatars/1.jpg")}}">
                                            </div>
                                            <div class="ml-4">									
                                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${item.user.name}</div>									
                                                {{-- <a href="#" class="text-muted font-weight-bold text-hover-primary">${item.email}</a>								 --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;width:200px" data-field="CompanyName" aria-label="Witting, Lindgren and Kessler" class="datatable-cell">
                                        <span style="width: 126px;">${item.content}</span>
                                    </td>
                                    <td style="vertical-align: middle;width:300px" data-field="Country" aria-label="Philippines" class="datatable-cell">
                                        <span style="width: 126px;">${item.user.email}</span>
                                    </td>
                                    <td style="vertical-align: middle;" data-field="Status" aria-label="1" class="datatable-cell">
                                        <span style="width: 126px;">
                                            <span 
                                             v-bind:class="{ 
                                                'label-light-success': item.status==1,
                                                'label-light-primary': item.status==2,
                                                'label-light-info': item.status==3 
                                             }"
                                             class="label font-weight-bold label-lg   label-inline">
                                                <div v-if="item.status==1" >
                                                    Processed
                                                </div>
                                                <div v-else-if="item.status==2">
                                                    Pending
                                                </div>
                                                <div v-else>
                                                    Sending
                                                </div>
                                            </span>
                                        </span></td>
                                    <td style="vertical-align: middle;" data-field="ShipDate" aria-label="1/29/2017" class="datatable-cell">
                                        <span style="width: 126px;">${item.created_at}</span>
                                    </td>
                                </tr>
                                <!-- end: v-for -->
                            </tbody>
                          </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
</div>
<!--end::Content-->
@endsection

{{-- Styles Section --}}
@section('styles')
  <link rel="stylesheet" href="{{ asset('css/client/client.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <style>
      #table_filter {
      }
  </style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        new Vue({
            delimiters: ['${', '}'],
            el:"#app",
            data:{
                list_subject:[],
                table: null,
                text_search:"",
                status:'All',
                id_status:0,         
            },
            watch: {
            },
            created: function(){
                this.getData();

                if (this.table != null)
                    this.table.fnDestroy();
                this.table = $('#table').dataTable({
                    // lengthChange: false,
                    searching:false
                });
            },
            updated() {
                
            },
            methods:{
                getData(){
                    axios.get("{{ route('subjects.index') }}")
                    .then(
                        response=>{
                            this.list_subject=response.data;
                    })
                },
                redirectToPrivate(val){
                    let url = "{{ route('private', 'id=:id') }}"
                    window.location.href = url.replace(':id', val);
                },
                getDataByFill(){
                    axios.post("{{ route('fillData') }}",{
                        content:this.text_search,
                        status:this.id_status              
                    })
                    .then(response=>{
                        this.list_subject=response.data;
                    })
                    .catch(function (error) {
                        
                    });
                },
                findByAll(){
                    this.status="All"
                    this.id_status=0
                },
                findByProcess(){
                    this.status="Processed"
                    this.id_status=1
                },
                findByPending(){
                    this.status="Pending"
                    this.id_status=2
                },
                findBySending(){
                    this.status="Sending"
                    this.id_status=3
                },
                fillData(){
                    this.getDataByFill();                  
                }
            },  
        })
    </script>
@endsection
