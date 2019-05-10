@extends('layouts.app_client')
@section('content')
    <section class="main-container col1-layout">
        <div class="main container">
            <div class="col-main">
                <div class="cart wow bounceInUp animated">
                    <div class="page-title" style="text-align: center; margin: 5% 0">
                        <h2>Lịch sử mua hàng của tôi</h2>
                    </div>
                    @if(count($orders))
                    <table class="table table-bordered" id="order_list">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td id="order_id">{{ $order->id }}</td>
                                <td>{{ $order->receiver }}</td>
                                <td>{{ $order->order_place }}</td>
                                <td>{{ $order->order_phone }}</td>
                                <td>{{ date('d/m/Y h:i:sa', strtotime($order->order_time)) }}</td>
                                <td width="8%">
                                    @switch ($order->status)
                                        @case(-1)
                                        {{ 'Canceled' }}
                                        @break
                                        @case(1)
                                        {{ 'Success' }}
                                        @break
                                        @default
                                        {{ 'UnProcess' }}
                                        @break
                                    @endswitch
                                    <input type="text" id="status_order" hidden value="{{ $order->status }}">
                                </td>
                                <td width="20%">
                                    <a id="detail_order" class="btn btn-outline-warning" href="">Detail</a>
                                    @if($order->status == 0)
                                        <a id="cancel_order" class="btn btn-outline-warning" href="">Cancel</a>
                                    @endif
                                </td>
                            <tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $orders->appends(request()->input())->links() !!}
                    @else
                        <h3 style="text-align: center; margin: 5% 0">Bạn không có đơn hàng nào</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal">
        <div class="modal-dialog" style="max-width: 700px;margin-top: 100px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Chi tiết đơn hàng <span id="order_status"></span></h4>
                </div>
                <div class="modal-body">
                    <table class="table" id="order_detail">
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <h4><span style="float: left;" id="totals"></span></h4>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    </section>
@endsection

@section('js')
<script type="text/javascript">
        jQuery(document).ready(function ($) {

            $('#order_list tbody').on('click', '#edit_order', function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                var td = row.find('#status_order').val();
                if (td == 1) {
                    alert("Order in process. Can't not update");
                }
            });

            $('#order_list tbody').on('click', '#detail_order', function (event) {
                var nf = new Intl.NumberFormat();
                event.preventDefault();
                var row = $(this).closest('tr');
                id = row.find('td:eq(0)').text();
                $.ajax({
                    url: route('client.order.order_detail', {order_id: id}),
                    type: 'get',
                    dataType: '',
                    data: {},
                })
                .done(function (res) {
                    $('#order_detail tbody').empty();
                    var html = '';
                    var totals = 0;
                    res.forEach(function (element) {
                        html += '<tr>' +
                            '<td width="20%">' +
                            '<img class="img-thumbnail" src="{{ asset(config('asset.image_path.product'). '2.jpg') }}">' +
                            '</td>' +
                            '<td><p>' + element.product.name + '</p><p> Size: '+ element.size.name +'</p></td>' +
                            '<td width="46%">';
                        var price = element.product_price;
                        element.toppings.forEach(function (element) {
                            html += '<span style="padding:5px;display: inline-block;background-color: #F0F8FF;border-radius: 10px;margin-left: 5px;margin-bottom: 5px">' +
                                element.name +
                                '</span>';
                            price += element.pivot.topping_price;
                        });
                        html += '</td>' +
                            '<td width="13%">' + nf.format(price) + ' ₫' + '</td>' +
                            '</tr>';

                        $('#order_detail tbody').html(html);
                        totals += price;
                    });
                    $('#totals').empty();
                    $('#totals').append('<span style="color: red";font-weight: bold>Totals: </span>' + nf.format(totals) + ' ₫');

                })
                .fail(function () {
                    console.log("error");
                })

                $("#myModal").modal("show");
            });

            $('#order_list tbody').on('click', '#cancel_order',function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                var order_id = row.find('td:eq(0)').text();
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
                            url: route('client.order.cancel_order', { order_id: order_id }),
                            type: 'get',
                            dataType: '',
                            data: {},
                        })
                        .done(function() {
                            row.find('td:eq(5)').text('Canceled ');
                            row.find('#cancel_order').remove();
                            swal({
                                title: "Order is canceled",
                                icon: "success",
                                timer: 2000,
                            });
                        })
                        .fail(function() {
                            alert('Error when process');
                        })
                    }
                })
            })
        });
    </script>
@endsection
