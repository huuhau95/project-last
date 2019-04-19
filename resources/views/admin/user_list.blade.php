@extends('layouts.app2')

@section('page-title')
    <li><a href="{{route('admin.index')}}">{{ __('message.title.dashboard') }}</a></li>
    <li class="active">{{ __('message.user') }}</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="rows">
        <div class="col-md-12">
            @if (session('success'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if (session('fail'))
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    {{session('fail')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('message.user') }}</strong>
                    <div class="float-right">
                        <button data-toggle="modal" data-target="#modal_create" id="show-modal" class="btn btn-outline-info" title="show">{{ __('message.create') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="user_list" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('message.name') }}</th>
                                <th scope="col">{{ __('message.email') }}</th>
                                <th scope="col">{{ __('message.address') }}</th>
                                <th scope="col">{{ __('message.phone') }}</th>
                                <th scope="col">{{ __('message.avatar') }}</th>
                                <th scope="col">{{ __('message.role') }}</th>
                                <th scope="col">{{ __('message.active') }}</th>
                                <th scope="col">{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"></div>
            {!! Form::open(['method' => 'POST', 'class' => 'form', 'files' => true, 'id' => 'form_create_user']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::hidden('_token', csrf_token(), ['id' => '_token']) !!}
                        {!! Form::hidden('id', '', ['id' => 'id']) !!}
                        {!! Form::label('name', __('message.name'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::text('name', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', __('message.email'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::text('email', '', ['class' => 'form-control', 'readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', __('message.password'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('re_password', __('message.re_password'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::password('re_password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', __('message.address'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::text('address', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', __('message.phone'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::number('phone', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('avatar', __('message.avatar'), ['class' => 'pr-1 form-control-label']) !!}
                        {!! Form::file('avatar', ['id' => 'avatar', 'name' => 'avatar']) !!}
                        <p><img src="#" id="imageSrc" height="80px" class="d-none"></p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('role', __('message.permission'), ['class' => 'pr-1 form-control-label']) !!}
                        <select name="role" id="role" class="form-control">
                            @foreach ($roles as $r)
                                <option value="{{$r->id}}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                {!! Form::button(__('message.close'), ['class' => 'btn btn-warning', 'data-dismiss' => 'modal', 'id' => 'close-modal']) !!}
                {!! Form::submit(__('message.submit'), ['class' => 'btn btn-success action_button', 'id' => 'create_user']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('script')

<script type="text/javascript" async>
jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    var tableTest = $('#user_list').DataTable({
        processing: true,
        serverSide: true,
        order: [0, "desc"],
        ajax: '{!! route('admin.user.json') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address' },
            { data: 'phone', name: 'phone' },
            {
                data: 'image',
                name: 'image',
                render: function(data) {
                    return data ? `<img data-image="${data}" src="{{ asset(config('asset.image_path.avatar')) }}/${data}" height="80px">` : `<img src="{{ asset(config('asset.image_path.default')) }}" height="80px">`;
                }
            },
            {
                data: 'role',
                name: 'role',
                render: function(data) {
                    return `<span data-role="${data.id}">${data.name}</span>`;
                }
            },
            {
                data: 'active',
                name: 'active',
                render: function(data, type, row) {
                    var checked = (data == 1) ? 'checked' : '';
                    return `<a href="#" class="active">
                        <label class="switch switch-3d switch-primary mr-3" for="active_user">
                            <input type="checkbox" class="switch-input" ${checked}>
                            <span class="switch-label"></span><span class="switch-handle"></span>
                        </label>
                    </a>`;
                },
            },
            {
                data: null,
                name: null,
                defaultContent: [
                    '<a class="btn btn-outline-primary show_edit_modal" title="Edit"><i class="fa fa-edit"></i></a>' +
                    '<a class="btn btn-outline-danger destroy" title="Remove"><i class="fa fa-remove"></i></a>'
                ]
            },
        ],
    });

    Pusher.logToConsole = false;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1',
        forceTLS: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('UserEvent');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('send-user', function(data) {
        tableTest.ajax.reload(null, false);
    })

    $('body').on('click', '#show-modal', function(event) {
        event.preventDefault()
        console.log('ok')
        $('#imageSrc').addClass('d-none');
        $('.action_button').addClass('create_user').removeClass('edit_user');
        $('#id').val('');
        $('#name').val('');
        $('#password').val('');
        $('#re_password').val('');
        $('#email').val('').attr('readonly', false);
        $('#address').val('');
        $('#phone').val('');
        $('#role').attr('disabled', false);
    });

    $('#modal_create').on('click', '.create_user', function (event) {
        event.preventDefault();
        $.ajax({
            url: route('admin.user.store'),
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('form#form_create_user')[0]),
        })
        .done(function(data) {
            if (data == 'success') {
                tableTest.ajax.reload(null, false)
                $('#modal_create').modal('hide')
                swal({icon: 'success'})
            } else {
                swal(data, {icon: 'error'})
            }
        })
        .fail(function() {
            swal("Something wrong !", {
                icon: "error",
            });
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });

    $('#user_list tbody').on('click', '.destroy', function(event) {
        var id = $(this).closest('tr').find('td:eq(0)').text();
        event.preventDefault();

        swal({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this user!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: route('admin.user.destroy', id),
                    type: 'get',
                })
                .done(function(data) {
                    if (data == 'fail') {
                        swal('You dont have permission !', {icon: 'error'});
                    } else {
                        swal(data, {
                            icon: "success",
                        });
                        tableTest.ajax.reload(null, false);
                        console.log("success");
                    }
                })
                .fail(function() {
                    console.log('fail');
                    swal("Something wrong !", {icon: "error"});
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });
    });

    $('#user_list tbody').on('click', '.show_edit_modal', function(event) {
        event.preventDefault();

        $('#modal_create').modal('show');
        $('.action_button').addClass('edit_user').removeClass('create_user');

        var tr = $(this).closest('tr');
        var id = tr.find('td:eq(0)').text();
        var name = tr.find('td:eq(1)').text();
        var email = tr.find('td:eq(2)').text();
        var address = tr.find('td:eq(3)').text();
        var phone = tr.find('td:eq(4)').text();
        var image = tr.find('img').attr('src');
        var role = tr.find('span').data('role');

        $('#id').val(id);
        $('#name').val(name);
        $('#email').val(email).attr('readonly', true);
        $('#address').val(address);
        $('#phone').val(phone);
        $('#imageSrc').attr('src', image).removeClass('d-none');
        $('#role').val(role).attr("disabled", true);

        $('#avatar').change(function(e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imageSrc').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        })

        $('#modal_create').on( 'click', '.edit_user', function (event) {
            event.preventDefault();

            $.ajax({
                url: route('admin.user.update', id),
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('form#form_create_user')[0]),
            })
            .done(function(data) {
                console.log(data);
                tableTest.ajax.reload(null, false);
                $('#modal_create').modal('hide');
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
        });
    });

    $('#user_list tbody').on('click', '.active', function(event) {
        event.preventDefault();
        var id = $(this).closest('tr').find('td:eq(0)').text();
        var count = Number($('#count_user').text());

        $.ajax({
            url: route('admin.user.active', id),
            type: 'GET',
        })
        .done(function(data) {
            if (data != 'actived') {
                $('#count_user').text(count + 1); // set count unactive user
                var img = data.image ? ('avatars/' + data.image) : 'default.jpeg';
                $('.append_active').append(`
                   <div class="dropdown-item active_item" data-id="${data.id}">
                        <a class="text-primary btn-link btn_active_user" href="#">
                           <img class="user-avatar rounded-circle avatar-header" src="{{ asset(config('asset.image_path.public')) }}${img}" height="20px" alt="User Avatar"> &nbsp ${data.name}

                        </a>
                    </div>
               `);
            } else {
                $('#count_user').text(count - 1);
                $('div.active_item[data-id="' + id + '"]').remove();
            }
            tableTest.ajax.reload(null, false);
            console.log("success");
        })
        .fail(function() {
            swal('Something wrong !', {icon: 'error'});
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });

    $('.btn_active_user').click(function(event) {
        event.preventDefault();

        var id = $(this).parents().data('id');

        swal({
            title: 'Are you sure?',
            text: 'You will active this user',
            icon: 'warning',
            buttons: true,
            dangerMode: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: route('admin.user.active', id),
                    type: 'GET',
                })
                .done(function(data) {
                    if (data == 'actived') {
                        $('#count_user').text($('#count_user').text() - 1);
                        $('div.active_item[data-id="' + id + '"]').remove();
                        console.log("success");

                        tableTest.ajax.reload(null, false);
                    } else {
                        swal(data, {icon: 'error'});
                    }
                })
                .fail(function() {
                    swal('Something wrong !', {icon: 'error'});
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });
    });
});
</script>

@endsection
