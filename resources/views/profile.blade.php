@extends('layouts.app_client')

@section('content')
    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                {!! Form::open(['method' => 'post', 'id' => 'form_update', 'files' => true]) !!}
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <label for="avatar">
                        @if ($user->image)
                            <img class="img-circle img-avatar" height="200px"
                                src="{{ asset(config('asset.image_path.avatar') . $user->image) }}">
                        @else
                            <img class="img-circle img-avatar" height="200px" src="{{ asset('images/default.jpeg') }}">
                        @endif
                    </label>
                    {!! Form::file('avatar', ['id' => 'avatar', 'class' => 'hidden d-none']) !!}
                </div>
                <div class="col-md-6">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Thông tin cá nhân</h3>
                        </div>
                        {!! Form::hidden('id', $user->id, ['d-none', 'id' => 'id']) !!}
                        <div class="form-group">
                            {!! Form::text('name', $user->name, ['class' => 'input', 'placeholder' => 'Họ và tên']) !!}
                            @if ($errors->has('name'))
                                <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::text('email', $user->email, ['class' => 'input', 'placeholder' => 'Email']) !!}
                            @if ($errors->has('email'))
                                <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::text('address', $user->address, ['class' => 'input', 'placeholder' => 'Địa chỉ']) !!}
                            @if ($errors->has('address'))
                                <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group">
                            {!! Form::text('phone', $user->phone, ['class' => 'input', 'placeholder' => 'Số điện thoại']) !!}
                            @if ($errors->has('phone'))
                                <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-checkbox">
                                <input type="checkbox" id="changepass">
                                <label class="font-weak" for="changepass">Thay đổi mật khẩu?</label>
                                <div class="caption">
                                    <div class="form-group">
                                        {!! Form::password('password', ['class' => 'input', 'id' => 'password1', 'placeholder' => 'Mật khẩu mới']) !!}
                                        @if ($errors->has('password'))
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {!! Form::password('re_password', ['class' => 'input', 'id' => 'password2', 'placeholder' => 'Nhập lại mật khẩu mới']) !!}
                                        @if ($errors->has('re_password'))
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('re_password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            {!! Form::button(__('message.update'), ['class' => 'btn primary-btn btnSubmit']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                {!! Form::close() !!}
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection


@section('js')

<script type="text/javascript">

$(document).ready(function() {
    var id = $('#id').val();

    function funtionAjax() {
        $.ajax({
            url: route('user.update', id),
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('form#form_update')[0]),
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
            }
            reader.readAsDataURL(this.files[0]);
            event.preventDefault();

            funtionAjax();
        }
    })



    $('.btnSubmit').click(function(event) {
        event.preventDefault();

        funtionAjax();
    });
});
</script>

@endsection
