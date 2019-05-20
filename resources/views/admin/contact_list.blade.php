@extends('layouts.app2')

@section('page-title')
    <li><a href="{{route('admin.index')}}">{{ __('message.title.dashboard') }}</a></li>
    <li class="active">Liên Hệ</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Liên hệ</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="admin_size_list">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>{{ __('message.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
            var size_table = $('#admin_size_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: route('admin.contact.json'),
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'email',
                        data: 'email',
                    },
                    {
                        data: 'content',
                        data: 'content',
                    },
                    {
                        data: null,
                        name: null,
                        defaultContent: [
                           '<button class="btn btn-outline-danger" title="Xóa" id="btnDeleteSize"><i class="fa fa-trash-o"></i></button>'
                        ],
                    },
                ],
            });

            $('#create-size').click(function (event) {
                event.preventDefault();
                $('#form-group-id').hide();
                $('#form-size')[0].reset();
                $('#action').val('Create');
            });

            $('#admin_size_list tbody').on('click', '#btnUpdateSize', function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                $('#form-group-id').show();
                $('#id').val(row.find('td:eq(0)').text());
                $('#size').val(row.find('td:eq(1)').text());
                $('#percent').val(row.find('td:eq(2)').text());
                $('#action').val('Update');
            });

            $('#admin_size_list tbody').on('click', '#btnDeleteSize', function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                var id = row.find('td:eq(0)').text();
                swal({
                    title: "Bạn có chắc chắn muốn xóa?",
                    text: "Sau khi xóa bạn không thể khôi phục được dữ liệu này!",
                    icon: "warning",
                    buttons: ["Hủy bỏ", "Xóa"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            url: route('admin.contact.destroy', {id: id}),
                            success: function (data, res) {
                                swal({
                                    title: "Thành công",
                                    icon: "success",
                                    timer: 2000,
                                });
                                size_table.ajax.reload(null, false);
                            },
                            error: function(xhr, status, error) {
                                toastr.error(JSON.parse(xhr.responseText), 'Có lỗi!');
                            }
                        });
                    }
                })
            });

            $('#action').click(function (event) {
                event.preventDefault();
                var id = $('#id').val();
                var url = route('admin.size.store');
                if (id != '') {
                    url = route('admin.size.update', id);
                }
                $.ajax({
                    type: 'post',
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData($('form#form-size')[0]),
                    success: function (res) {
                        size_table.ajax.reload(null, false);
                        $('#modal-size').modal('hide');
                        swal({
                            title: "Thành công",
                            icon: "success",
                            timer: 2000,
                        });
                    },
                    error: function (xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        if (xhr.status == 403) {
                            toastr.error(err, 'Có lỗi!');
                        }
                        else {
                            var errors = Object.entries(err.errors);
                            errors.forEach(function (value, index) {
                                toastr.error(value[1][0], 'Có lỗi!');
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
