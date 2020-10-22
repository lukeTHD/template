@extends('admin.layouts.app')
@section('content')
    <?php
    $roles = api('api.roles.index');
    $id = param('group');
    $response = api(['api.groups.show', ['id' => $id]]);
    $group = get_one($response);
    $roleIds = collect($group['roles'])->map(function($value) {
        return collect($value)->only(['id']);
    })->flatten()->toArray();
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-plus"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.group.add') }} </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                    </button>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" action="{{ route('admin.groups.update',['group' => $id]) }}" method="POST" id="kt_form">
                    @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                    @include('admin.partials.alert')
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.group.info') }}
                                        :</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                        <div class="col-9">
                                            <input class="form-control" name="name" type="text"
                                                   value="{{ $group['name'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-3 col-form-label">{{ __('label.description') }}</label>
                                        <div class="col-9">
                                            <textarea class="form-control" rows="4"
                                                      name="description">{{ $group['description'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="kt-section kt-section--last">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.group.role') }}
                                        :</h3>
                                    <div class="form-group form-group-last row">
                                        @if($roles)
                                            @foreach($roles as $role)
                                                <div class="col-3">
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" @if(in_array($role['id'],$roleIds)) checked="checked" @endif name="roles[]"
                                                               value="{{ $role['id'] }}"> {{ $role['description'] }}
                                                        <small class="text-muted">( {{ $role['name'] }} )</small>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
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
@endsection
