@if($errors->count())
    <div class="pt-3">
        <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
    </div>
@endif
@if(Session::has('danger'))
    <div class="pt-3">
        <div class="alert alert-danger">
        {!! Session::get('danger') !!}
    </div>
    </div>
@endif
@if(Session::has('success'))
    <div class="pt-3">
        <div class="alert alert-success">
        {!! Session::get('success') !!}
    </div>
    </div>
@endif
@if(Session::has('info'))
    <div class="pt-3">
        <div class="alert alert-info">
        {!! Session::get('info') !!}
    </div>
    </div>
@endif