@extends('layouts.app2')

@section('page-title')
    <li><a href="{{route('admin.index')}}">{{ __('Dashboard') }}</a></li>
    <li><a href="{{route('admin.user.index')}}">{{ __('User list') }}</a></li>
    <li class="active">{{ __('message.update') }}</li>
@endsection

@section('content')

<div class="container-fluid">
    {!! Form::open(['method' => 'post', 'id' => 'form_edit_user', 'files' => true]) !!}
        <div class="card-body row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header ">
                        <strong class="card-title mb-3">{{ __('Profile Card') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block text-center">
                            {!! Form::file('avatar', ['class' => 'd-none', 'id' => 'avatar']) !!}
                            <label for="avatar">
                                @if ($user->image)
                                    <img class="rounded-circle mx-auto d-block img-avatar" height="200px" src="{{ asset(config('asset.image_path.avatar') . $user->image) }}" alt="Card image cap">
                                @else
                                    <img class="rounded-circle mx-auto d-block img-avatar" height="200px" src="{{ asset('images/default.jpeg') }}" alt="Card image cap">
                                @endif
                            </label>
                            <h5 class="text-sm-center mt-2 mb-1"> {{ $user->name }} </h5>
                            <div class="location text-sm-center"><i class="fa fa-map-marker"></i> {{ $user->address }}</div>
                        </div>
                        <hr>
                     
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header ">
                        <strong class="card-title mb-3">{{ __('Base infomation') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            {!! Form::label('name', __('Name'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::hidden('id', $user->id, ['class' => 'd-none', 'id' => 'id']) !!}
                                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('email', __('Email'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::email('email', $user->email, ['readonly', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('address', __('Addess'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('address', $user->address, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('phone', __('Phone'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::number('phone', $user->phone, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('permission', __('Permission'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('permission', $user->role->name, ['readonly' ,'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::button(__('Update Information'), ['class' => 'btn btn-outline-info btn-lg btn-block btnSubmit']) !!}
                </div>
                <div class="card">
                    <div class="card-header ">
                        <strong class="card-title mb-3">{{ __('Change password') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            {!! Form::label('password', __('New password'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('re_password', __('Re-password'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::password('re_password', ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::button(__('Change password'), ['class' => 'btn btn-outline-info btn-lg btn-block btnSubmit']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function() {
    var id = $('#id').val();

    function funtionAjax() {
        $.ajax({
            url: route('admin.user.update', id),
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('form#form_edit_user')[0]),
        })
        .done(function(data) {
            swal(data, {icon: 'success'});
            console.log("success");
        })
        .fail(function() {
            swal('Something wrong !', {icon: 'error'});
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    };

    $('#avatar').change(function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img-avatar').attr('src', e.target.result);
                $('.avatar-header').attr('src', e.target.result); // avatar in header.blade.php
            }
            reader.readAsDataURL(this.files[0]);
            event.preventDefault();

            funtionAjax();
        }
    })



    $('.btnSubmit').click(function(event) {
        event.preventDefault();
        if ($("#password").val()=='' || $("#re_password").val()=='') {
            toastr.error('Mật khẩu và nhập lại mật khẩu là bắt buộc ', 'Error!');
        }else if($("#password").val() != $("#re_password").val()){
             toastr.error('Mật khẩu và nhập lại mật khẩu không khớp ', 'Error!');
        }else{
        funtionAjax();
        }
    });
});

</script>

@endsection
