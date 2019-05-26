@extends('layouts.app_client')

@section('content')
<div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3"></div>
                 {{ Form::open(['method' => 'POST', 'route' => 'postLogin']) }}
                            @csrf
                    <div class="col-md-6">
                        <div class="billing-details">
                            <p>Bạn chưa có tài khoản ? <a href="{{ route('client.register') }}">Đăng ký</a></p>
                            <div class="section-title">
                                <h3 class="title">Đăng nhập tài khoản</h3>
                            </div>
                            @if (session('fail'))
                            <div class="alert alert-danger">
                              <strong>Cảnh báo!</strong> {{ session('fail') }} negative action.
                            </div>
                            @endif
                            <div class="form-group">
                                 {!! Form::label('email', __('message.email')) !!}
                                    {!! Form::text('email', '', ['class' => 'input required-entry', 'autofocus', 'autocomplete' => 'off']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                   {!! Form::label('password', __('message.password')) !!}
                                   {!! Form::password('password', ['class' => 'input required-entry validate-password', 'autocomplete' => 'off']) !!}
                                   @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                            </div>
                            <div class="pull-right">
                                {!! Form::submit(__('message.login'), ['class' => 'button login loginUser primary-btn']) !!}
                            </div>
                        </div>
                    </div>
                 {!! Form::close() !!}
                <div class="col-md-3"></div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
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
