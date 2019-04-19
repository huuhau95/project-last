@extends('layouts.app_client')

@section('content')
    <section class="main-container top-space col1-layout">
        <div class="main container">
            <div class="account-login">
                <div class="page-title">
                    <h2>{{ __('message.login_or_create_account') }}</h2>
                </div>
                <fieldset class="col2-set">
                    <div class="col-1 new-users"><strong>{{ __('message.new_customer') }}</strong>
                        <div class="content">
                            <p>{{ __('message.client_login_text') }}</p>
                            <div class="buttons-set">
                                <button id="login-create-account" class="button create-account" type="button">
                                    <span>{{ __('message.create_account') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 registered-users"><strong>{{ __('message.login') }}</strong>
                        <div class="content">
                            {{ Form::open(['method' => 'POST', 'route' => 'postLogin']) }}
                            @csrf
                            <ul class="form-list">
                                <li>
                                    {!! Form::label('email', __('message.email')) !!}
                                    {!! Form::text('email', '', ['class' => 'input-text required-entry', 'autofocus', 'autocomplete' => 'off']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </li>
                                <li>
                                   {!! Form::label('password', __('message.password')) !!}
                                   {!! Form::password('password', ['class' => 'input-text required-entry validate-password', 'autocomplete' => 'off']) !!}
                                   @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </li>
                            </ul>
                            <div class="buttons-set">
                                {!! Form::submit(__('message.login'), ['class' => 'button login loginUser']) !!}
                                @if (session('fail'))
                                    <br>
                                    <span class="text-danger">
                                        {{ session('fail') }}
                                    </span>
                                @endif
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </section>
@endsection

@section('js')

<script type="text/javascript">

jQuery(document).ready(function($) {
    $('#login-create-account').click(function(event) {
        window.location.href = route('client.register');
    });
});

</script>

@endsection
