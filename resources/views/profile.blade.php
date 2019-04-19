@extends('layouts.app_client')

@section('content')
    <div class="container margin_60_35">
        <div class="row">
            {!! Form::open(['method' => 'post', 'id' => 'form_update', 'files' => true]) !!}
            <div class="col-md-4 col-sm-4">
                <div class="indent_title_in">
                    <h3></h3>
                </div>
                <label for="avatar">
                    @if ($user->image)
                        <img class="img-circle img-avatar" height="300px"
                            src="{{ asset(config('asset.image_path.avatar') . $user->image) }}">
                    @else
                        <img class="img-circle img-avatar" height="300px" src="{{ asset('images/default.jpeg') }}">
                    @endif
                </label>
                {!! Form::file('avatar', ['id' => 'avatar', 'class' => 'hidden d-none']) !!}
            </div>
            <div class="col-md-8 col-sm-8">
                <div class="indent_title_in">
                    <h3><i class="icon-user"></i> {{ __('message.info') }}</h3>
                </div>
                <div class="wrapper_indent">
                    <div class="form-group">
                        {!! Form::label('name', __('message.name')) !!}
                        {!! Form::hidden('id', $user->id, ['d-none', 'id' => 'id']) !!}
                        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                        @if ($errors->has('name'))
                            <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', __('message.email')) !!}
                        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                        @if ($errors->has('email'))
                            <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', __('message.address')) !!}
                        {!! Form::text('address', $user->address, ['class' => 'form-control']) !!}
                        @if ($errors->has('address'))
                            <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', __('message.phone')) !!}
                        {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
                        @if ($errors->has('phone'))
                            <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>
                    {!! Form::button(__('message.update'), ['class' => 'btn btnSubmit']) !!}
                </div><!-- End wrapper_indent -->
                <hr>
                <div class="indent_title_in">
                    <h3><i class="icon_lock_alt"></i> {{ __('message.password.change') }}</h3>
                </div>
                <div class="wrapper_indent">
                    <div class="form-group">
                        {!! Form::label('password', __('message.password.change')) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password1']) !!}
                        @if ($errors->has('password'))
                            <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('re_password', __('message.password.confirm')) !!}
                        {!! Form::password('re_password', ['class' => 'form-control', 'id' => 'password2']) !!}
                        @if ($errors->has('re_password'))
                            <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('re_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    {!! Form::button(__('message.update'), ['class' => 'btn btnSubmit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
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
