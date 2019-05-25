@extends('layouts.app_client')
@section('content')
    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="order-summary clearfix">
                        <div class="section-title">
                            <h3 class="title">Lịch sử mua hàng</h3>
                        </div>
                        <table class="shopping-cart-table table" id="order_list">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người nhận</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if(count($orders))
                                @foreach($orders as $order)
                                <tr>
                                    <td id="order_id">{{ $order->id }}</td>
                                    <td>{{ $order->receiver }}</td>
                                    <td>{{ $order->order_email }}</td>
                                    <td>{{ $order->order_phone }}</td>
                                    <td id="order_status">
                                        @switch ($order->status)
                                            @case(-1)
                                            {{ 'Đã hủy' }}
                                            @break
                                            @case(1)
                                            {{ 'Đã giao hàng' }}
                                            @break
                                            @case(2)
                                            {{ 'Người giao hàng đã nhận đơn' }}
                                            @break
                                            @case(3)
                                            {{ 'Đang giao hàng' }}
                                            @break
                                            @default
                                            {{ 'Chưa giao hàng' }}
                                            @break
                                        @endswitch
                                        <input type="text" id="status_order" hidden value="{{ $order->status }}">
                                    </td>
                                    <td class="total text-center"><strong class="primary-color">{{ number_format($order->total) }}</strong></td>
                                    <td class="text-right">
                                        <a class="main-btn icon-btn" title="Xem chi tiết" id="detail_order">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if($order->status == 0)
                                        <a id="cancel_order" class="main-btn icon-btn"><i class="fa fa-close"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" style="text-align: center;">
                                        Bạn không có đơn hàng nào
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {!! $orders->appends(request()->input())->links() !!}
                    </div>

                </div>
            </div>
            <!-- /row -->
            <!-- Modal detail -->
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
            <!-- End modal detail -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
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
                    title: "Bạn có chắc chắn muốn hủy đơn hàng?",
                    icon: "warning",
                    buttons: ["Thoát", "Đồng ý"],
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
                            row.find('#order_status').text('Đã hủy');
                            row.find('#cancel_order').remove();
                            swal({
                                title: "Đơn hàng đã được hủy",
                                icon: "success",
                                timer: 2000,
                            });
                        })
                        .fail(function() {
                            alert('Có lỗi! Vui lòng kiểm tra lại.');
                        })
                    }
                })
            })
        });
    </script>
@endsection
