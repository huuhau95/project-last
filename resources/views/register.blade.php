@extends('layouts.app_client')

@section('content')
<style type="text/css" media="screen">
    .invalid-feedback {
        color: red;
    }
</style>
    <section class="main-container top-space col1-layout">
        <div class="main container">
            <div class="account-login">
                <div class="page-title">
                    <h2>{{ __('message.register_title') }}</h2>
                </div>
                <fieldset class="col2-set">
                    {!! Form::open(['method' => 'post', 'route' => 'register', 'files' => true, 'id' => 'client_user_register']) !!}
                    <div class="col-1 new-users">
                        <strong>{{ __('message.new_customer') }}</strong>
                        <div class="content">
                            <ul class="form-list">
                                <li>
                                    {!! Form::label('email', __('message.email')) !!}
                                    {!! Form::text('email', '', ['class' => 'input-text', 'id' => 'email',
                                     'autocomplete' => 'off', 'placeholder' => 'Email Address']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('email') }}*
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    {!! Form::label('password', __('message.password'), []) !!}
                                    {!! Form::password('password', ['class' => 'input-text', 'id' => 'password',
                                     'placeholder' => 'Password']) !!}
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('password') }}*
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    {!! Form::label('password-confirm', __('message.re_password')) !!}
                                    {!! Form::password('password_confirmation', ['class' => 'input-text', 'id' => 'password_confirmation',
                                     'placeholder' => 'password confirmation', 'id' => 'password-confirm']) !!}
                                </li>
                                <li>
                                    {!! Form::label('name', __('message.full_name')) !!}
                                    {!! Form::text('name', '', ['class' => 'input-text', 'id' => 'name',
                                     'placeholder' => 'Your name']) !!}
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('name') }}*
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    {!! Form::label('address', __('message.address')) !!}
                                    {!! Form::text('address', '', ['class' => 'input-text', 'id' => 'address',
                                     'placeholder' => 'Your Address']) !!}
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('address') }}*
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    {!! Form::label('phone', __('message.phone')) !!}
                                    {!! Form::number('phone', '', ['class' => 'input-text', 'id' => 'phone',
                                     'placeholder' => 'Your Phone']) !!}
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('phone') }}*
                                        </span>
                                    @endif
                                </li>
                            </ul>
                            <div class="buttons-set">
                                <button id="register" name="send" type="submit" class="button login">
                                    <span>{{ __('message.register') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 registered-users">
                        <div class="content">
                            <br>
                            <h4>{{ __('message.avatar') }}</h4>
                            <div class="buttons-set">
                                <div id="" class="img-fluid">
                                    <img id="image_review_create" src="{{ asset('images/default.jpeg') }}"
                                         style="max-height: 350px;max-width: 200px" class="card-img">
                                </div>
                            </div>
                            {!! Form::file('avatar', ['class' => 'd-none', 'id' => 'avatar_client', 'class' => 'form-control-']) !!}
                            {!! Form::hidden('role', 3) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </fieldset>
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
