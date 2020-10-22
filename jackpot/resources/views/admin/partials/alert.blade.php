@if(session()->has('message'))
    <p class="alert {{ session()->get('alert-class', 'alert-info') }} alert-bold rounded-0 kt-font-bolder">{{ session()->get('message') }}</p>
@endif
