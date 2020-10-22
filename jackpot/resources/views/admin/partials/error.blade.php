@if ($errors->any())
    <div class="alert alert-solid-danger alert-bold {{ $class }}" role="alert">
    @foreach ($errors->all() as $error)
        <div class="d-block kt-font-bolder">{{$error}}</div>
    @endforeach
    </div>
@endif
