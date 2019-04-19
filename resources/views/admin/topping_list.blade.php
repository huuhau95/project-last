@extends('layouts.app2')

@section('page-title')
    <li><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li><a>{{ __('message.topping') }}</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('message.topping') }}</strong>
                <div class="float-right">
                    <a href="#" class="btn btn-outline-info" id="create-topping"
                       title="show" data-toggle="modal" data-target="#modal-topping">{{ __('message.create') }}</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="admin_topping_list">
                    <thead>
                    <tr>
                        <th>{{ __('message.id') }}</th>
                        <th>{{ __('message.topping') }}</th>
                        <th>{{ __('message.price') }}</th>
                        <th>{{ __('message.quantity') }}</th>
                        <th>{{ __('message.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal-topping" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-topping']) !!}
                <div class="modal-header">
                    <h5>{{ __('message.topping') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="form-group-id">
                        {!! Form::label('id', __('message.id'), ['class' => 'form-control-label']) !!}
                        {!! Form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('topping', __('message.topping'), ['class' => 'form-control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'topping', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price', __('message.price'), ['class' => 'form-control-label']) !!}
                        {!! Form::number('price', null, ['class' => 'form-control', 'id' => 'price', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('quantity', __('message.quantity'), ['class' => 'form-control-label']) !!}
                        {!! Form::number('quantity', null, ['class' => 'form-control', 'id' => 'quantity', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(__('message.create'), ['class' => 'btn btn-info', 'id' => 'action']) !!}
                    {!! Form::button('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var nf = new Intl.NumberFormat();
            var topping_table = $('#admin_topping_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: route('admin.topping.json'),
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'price',
                        name: 'price',
                    }, {
                        data: 'quantity',
                        name: 'quantity',
                    }, {
                        data: null,
                        name: null,
                        defaultContent: [
                            '<button class="btn btn-outline-primary" title="Update" data-toggle="modal" data-target="#modal-topping" id="btnUpdatetopping"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-outline-danger" title="Delete" id="btnDeletetopping"><i class="fa fa-trash"></i></button> '
                        ],
                    },
                ],
            });

            $('#create-topping').click(function (event) {
                event.preventDefault();
                $('#form-group-id').hide();
                $('#form-topping')[0].reset();
                $('#action').val('Create');
            });

            $('#admin_topping_list tbody').on('click', '#btnUpdatetopping', function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                $('#form-group-id').show();
                $('#id').val(row.find('td:eq(0)').text());
                $('#topping').val(row.find('td:eq(1)').text());
                $('#price').val(row.find('td:eq(2)').text());
                $('#quantity').val(row.find('td:eq(3)').text());
                $('#action').val('Update');
            });

            $('#admin_topping_list tbody').on('click', '#btnDeletetopping', function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                var id = row.find('td:eq(0)').text();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            url: route('admin.topping.destroy', {id: id}),
                            success: function (data) {
                                swal({
                                    title: "Success",
                                    icon: "success",
                                    timer: 2000,
                                });
                                topping_table.ajax.reload(null, false);
                            },
                            error: function(xhr, status, error) {
                                toastr.error(JSON.parse(xhr.responseText), 'Error!');
                            }
                        });
                    }
                })
            });

            $('#action').click(function (event) {
                event.preventDefault();
                var id = $('#id').val();
                var url = route('admin.topping.store');
                if (id != '') {
                    url = route('admin.topping.update', id);
                }
                $.ajax({
                    type: 'post',
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData($('form#form-topping')[0]),
                    success: function (res) {
                        topping_table.ajax.reload(null, false);
                        $('#modal-topping').modal('hide');
                        swal({
                            title: "Success",
                            icon: "success",
                            timer: 2000,
                        });
                    },
                    error: function (xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        if (xhr.status == 403) {
                            toastr.error(err, 'Error!');
                        }
                        else { 
                            var errors = Object.entries(err.errors);
                            errors.forEach(function (value, index) {
                                toastr.error(value[1][0], 'Error!');
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
