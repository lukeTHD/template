@extends('admin.layouts.app')
@section('content')
    <!-- begin:: Content -->
    @if(request()->has('tab'))
        <?php $settings = settings(); ?>
        @if(request()->get('tab') === 'general')
            @include('admin.partials.settings.general',['settings' => $settings])
        @elseif(request()->get('tab') === 'game')
            @include('admin.partials.settings.game',['settings' => $settings])
        @elseif(request()->get('tab') === 'reading')
            @include('admin.partials.settings.reading',['settings' => $settings])
        @endif
    @endif
    <!-- end:: Content -->
@endsection
@section('scripts')

@endsection
