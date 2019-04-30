@extends('layouts.app2')

@section('page-title')
    <li><a href="{{route('admin.index')}}">{{ __('message.title.dashboard') }}</a></li>
    <li class="active">{{ __('message.order') }}</li>
@endsection

@section('content')
<div class="animated">
    <div class="rows">
        <div class="card">
            <div class="card-header">
                {{ __('Manager Order') }}

            </div>

            <div class="card-body">
                <table class="table table-bordered" id="admin_order_list">
                    <thead>
                        <tr>
                            <th>{{ __('message.id') }}</th>
                            <th>{{ __('message.order_title.receiver') }}</th>
                            <th>{{ __('message.order_title.time_order') }}</th>
                            <th>{{ __('message.order_title.address_order') }}</th>
                            <th>{{ __('message.order_title.phone_order') }}</th>
                            <th>{{ __('message.order_title.status') }}</th>
                            <th width="15%">{{ __('message.order_title.note') }}</th>
                            <th>{{ __('message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modal-order_detail" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-9">
                        <div class="col-4">
                            <h1 class="col-form-label">{{ __('message.order_title.detail' ) }}</h1>
                        </div>
                        <div class="col-5">
                            <select name="status" id="status" class="form-control disabled">
                                <option value="1">{{ __('message.order_title.processed') }}</option>
                                <option value="0">{{ __('message.order_title.unprocessed') }}</option>
                                <option value="-1">{{ __('message.order_title.canceled') }}</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table" id="order_detail">
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <h4><span style="float: left;" id="totals"></span></h4>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var nf = new Intl.NumberFormat();

            var order_table = $('#admin_order_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: route('admin.order.json'),
                },
                deferRender: true,
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'receiver',
                        name: 'receiver',
                    },
                    {
                        data: 'order_time',
                        name: 'order_time',
                        render: function(data) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    {
                        data: 'order_place',
                        name: 'order_place',
                    },
                    {
                        data: 'order_phone',
                        name: 'order_phone',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return data == 1 ? 'Processed' : (data == 0 ? 'Unprocessed' : 'Canceled');
                        }
                    },
                    {
                        data: 'note',
                        name: 'note',
                    },
                    {
                        data: null,
                        name: null,
                        defaultContent: [
                            '<a href="" title="infor" class="btn btn-outline-primary detail_order">' +
                            '<i class="fa fa-info"></i></a>'
                        ],
                    },
                ],
            });
            $('#admin_order_list tbody').on('click', '.detail_order', function(event) {
                $('#status').prop('disabled', false);
                event.preventDefault();
                var id_order = $(this).closest('tr').find('td:eq(0)').text();
                $.ajax({
                    url: route('admin.order.show', id_order),
                    type: 'get',
                })
                .done(function(res) {
                    if (Number(res.status) === 1 || Number(res.status) === -1) {
                        $('#status').prop('disabled', true);
                    }
                    $('#status').val(res.status);
                    $('#status').attr('data-id', res.id);
                })

                $('#detail_order_list').empty();
                $.ajax({
                    url: route('admin.order.detail.json', id_order),
                    type: 'get',
                    dataType: '',
                    data: {},
                })
                .done(function(res) {
                    $('#order_detail tbody').empty();
                    var html = '';
                    var totals = 0;
                    res.forEach(function (element) {
                        var base_url_image = '{{ asset(config('asset.image_path.product')) }}' + '/';
                        var image = element.product.images[0].name;
                        html += '<tr>' +
                            '<td width="15%">' +
                            '<img class="img-thumbnail" src="' + base_url_image + image + '">' +
                            '</td>' +
                            '<td><p>' + element.product.name + '</p><p> Size: '+ element.size +'</p> Màu: '+ element.color +'</p></p> Số lượng: '+ element.quantity +'</p></td>' +
                            '<td width="44%">';
                        var price = element.product_price * element.quantity;
                        html += '</td>' +
                            '<td width="20%"> Price: ' + nf.format(price) + ' ₫' + '</td>' +
                            '</tr>';

                        $('#order_detail tbody').html(html);
                        totals += price;
                    });
                    $('#totals').empty();
                    $('#totals').append('<span style="color: red";font-weight: bold>Totals: </span>' + nf.format(totals) + ' ₫');
                })
                .fail(function() {
                    console.log("error");
                })
                $('#modal-order_detail').modal('show');
            });

            $('#status').change(function(event) {
                event.preventDefault();
                var order_id = $(this).attr('data-id');
                var status = $(this).val();
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
                            url: route('admin.order.change_status'),
                            type: 'post',
                            data: {id: order_id, status: status},
                        })
                        .done(function() {
                            $('#modal-order_detail').modal('hide');
                            order_table.ajax.reload(null, false);
                            swal({
                                title: "Success",
                                icon: "success",
                                timer: 2000,
                            });
                        })
                        .fail(function() {
                            console.log("error");
                        })
                    }
                })
            });
        });
    </script>
@endsection
