@extends('layouts.app_client')

@section('content')
<style type="text/css" media="screen">
.invalid-feedback {
    color: red;
}
</style>
<section class="main-container top-space col1-layout">
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('client.index') }}">Trang chủ</a></li>
                <li class="active">Đăng ký</li>
            </ul>
        </div>
    </div>
    <div class="main container">
        <div class="account-login" style="margin:5% 0">
            {!! Form::open(['method' => 'post', 'route' => 'register', 'files' => true, 'id' => 'client_user_register']) !!}
            <fieldset class="col2-set">
                <div class="col-md-offset-1 col-md-3 registered-users">
                    <div class="content">
                        <br>
                        <h4>{{ __('message.avatar') }}</h4>
                        <div class="buttons-set" style="margin-bottom: 20px">
                            <div id="" class="img-fluid">
                                <img id="image_review_create" src="{{ asset('images/default.jpeg') }}"
                                style="max-height: 350px;max-width: 200px" class="card-img">
                            </div>
                        </div>
                        {!! Form::file('avatar', ['class' => 'd-none', 'id' => 'avatar_client', 'class' => 'form-control-']) !!}
                        {!! Form::hidden('role', 3) !!}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-1 new-users">
                        <div class="content">
                            <div class="form-group">
                                {!! Form::label('email', __('message.email')) !!}
                                {!! Form::text('email', '', ['class' => 'input', 'id' => 'email',
                                'autocomplete' => 'off', 'placeholder' => 'Email']) !!}
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('email') }}*
                                </span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('name', __('message.full_name')) !!}
                                {!! Form::text('name', '', ['class' => 'input', 'id' => 'name',
                                'placeholder' => 'Họ và tên']) !!}
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('name') }}*
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', __('message.address')) !!}
                                {!! Form::text('address', '', ['class' => 'input', 'id' => 'address',
                                'placeholder' => 'Địa chỉ']) !!}
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('address') }}*
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone', __('message.phone')) !!}
                                {!! Form::number('phone', '', ['class' => 'input', 'id' => 'phone',
                                'placeholder' => 'Số điện thoại']) !!}
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('phone') }}*
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', __('message.password'), []) !!}
                                {!! Form::password('password', ['class' => 'input', 'id' => 'password',
                                'placeholder' => 'Mật khẩu']) !!}
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('password') }}*
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('password-confirm', __('message.re_password')) !!}
                                {!! Form::password('password_confirmation', ['class' => 'input', 'id' => 'password_confirmation',
                                'placeholder' => 'Nhập lại mật khẩu', 'id' => 'password-confirm']) !!}
                            </div>
                            <div class="buttons-set">
                                <button id="register" name="send" type="submit" class="button login primary-btn">
                                    <span>{{ __('message.register') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection

@section('js')

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $('#avatar_client').val('');
        $('#avatar_client').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image_review_create').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>

@endsection
