@extends('admin.layouts.app')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="app">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-plus"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.faq.list') }} </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" v-on:click="addFAQ()" class="btn btn-success mr-3">
                        <i class="la la-plus"></i>
                        <span class="kt-hidden-mobile">{{ __('label.faq.add') }}</span>
                    </button>
                    <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                    </button>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" action="{{ route('admin.faqs.store') }}" method="POST" id="kt_form">
                    @csrf
                    <textarea name="faqs" class="form-control d-none"><% FAQsJson %></textarea>
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                            @include('admin.partials.alert')
                            <div class="kt-section kt-section--last">
                                <div class="kt-section__body">
                                    <div class="accordion accordion-solid accordion-panel accordion-toggle-svg"
                                         id="accordionExample8">
                                        <div class="card" v-for="(faq,key) in faqs">
                                            <div class="card-header" id="headingOne8">
                                                <div class="card-title border" data-toggle="collapse"
                                                     :data-target="bindDataTarget(key)" aria-expanded="true"
                                                     aria-controls="collapseOne8">
                                                    <span v-if="faq.question"><% faq.question %></span>
                                                    <span v-else><i>{{ __('label.no_question_yet') }}</i></span>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1"
                                                         class="kt-svg-icon">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path
                                                                d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                                                fill="#000000" fill-rule="nonzero"></path>
                                                            <path
                                                                d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                                transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div v-bind:id="bindDataTarget(key,true)" class="collapse"
                                                 aria-labelledby="headingOne8"
                                                 data-parent="#accordionExample8" style="">
                                                <div class="card-body border border-top-0 p-3">
                                                    <div class="form-group">
                                                        <label>Question</label>
                                                        <input v-model="faq.question" type="text"
                                                               class="form-control rounded-0">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Answer</label>
                                                        <textarea rows="3" v-model="faq.answer"
                                                                  class="form-control rounded-0"></textarea>
                                                    </div>
                                                    <div class="form-group form-group-last text-right">
                                                        <button type="button" aria-expanded="false" v-on:click="removeFAQ($event,key)"
                                                                class="btn btn-sm btn-danger"><i
                                                                class="la la-trash mr-0"></i><small>Delete</small></button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script>
        new Vue({
            el: '#app',
            delimiters: ['<%', '%>'],
            data: {
                faqs: {!! $faqs !!}
            },
            methods: {
                addFAQ: function () {
                    this.faqs.push({
                        'question': '',
                        'answer': ''
                    });
                },
                bindDataTarget: function (id, isDOM = false) {
                    return (isDOM ? '' : '#') + 'collapse' + id + '-' + 2;
                },
                removeFAQ: function (event, key) {
                    event.preventDefault();
                    this.faqs = this.faqs.filter(function (item, index) {
                        return index !== key;
                    });
                }
            },
            computed: {
                FAQsJson: function () {
                    return JSON.stringify(this.faqs);
                }
            }
        })
    </script>

@endsection
