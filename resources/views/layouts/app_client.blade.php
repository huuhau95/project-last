<!DOCTYPE html>
<html lang="en">
<head>
    @routes()
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicons Icon -->
    {{-- <link rel="shortcut icon" href="http://htmldemo.themessoft.com/freshia/version3/favicon1.ico" type="image/x-icon"> --}}
    {{-- <link rel="icon" href="http://htmldemo.themessoft.com/freshia/version3/favicon1.ico" type="image/x-icon"> --}}
    <title>{{ config('app.name', 'E-SHOP') }}</title>
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
@yield('css')
</head>

<body class="home cms-index-index cms-home-page">
    <div id="page">
        <!-- Header -->
        @include('layouts.header_client')
        @include('layouts.menu_client')
        @yield('content')
        @include('layouts.footer_client')
    </div>
    <!-- JavaScript -->
    <script src="{{ asset('asset/client/js/themessoft/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/themessoft/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/themessoft/slick.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/themessoft/nouislider.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/themessoft/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/themessoft/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('asset/client/js/themessoft/toastr.min.js') }}"></script>
    <script src="{{ asset('asset/client/js/themessoft/jquery.validate.min.js') }}"></script>

    @yield('js')
    <script>

    jQuery(document).ready(function ($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var nf = new Intl.NumberFormat();

        $('.btnBuy').click(function (event) {
            event.preventDefault();
            $('.modal-title').html("");
            var id_sp = $(this).attr("data-id");
            $.ajax({
                url: route('client.product.detail.json', {id: id_sp}),
                type: 'get',
                dataType: '',
                data: {},
            })
            .done(function (res) {
                $('.modal-title').html(res.name);
                $('#product_id_modal').val(res.id);
            })
            .fail(function () {
                console.log("error");
            })
        });

        $('.form_order').validate({
            rules: {
                size: 'required',
            },
            messages: {
                size:{
                    required: 'Choose Size',
                },
            },
            errorPlacement: function(error, element) {
                if (element.is(':radio')) {
                    $("#error-size-index-add-cart").html( error );
                } else {
                    error.insertAfter( element );
                }
            }
        });

        $('.btnSubmitOrder').click(function (event) {
            event.preventDefault();
            if ($('.form_order').valid()) {
                $.ajax({
                    url: route('user.cart.add'),
                    type: 'post',
                    dataType: '',
                    data: $('.form_order').serialize(),
                })
                .done(function () {
                    swal({
                        title: "Đã thêm vào giỏ hàng",
                        icon: "success",
                        timer: 2000,
                    });
                    window.location.href = route('client.showCart');
                })
                .fail(function () {
                    console.log("error");
                })
            }
        });

        $('#empty_cart_button').click(function (event) {
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
                        url: route('user.cart.remove'),
                        type: 'get',
                        dataType: '',
                        data: {},
                    })
                    .done(function () {
                        console.log("success");
                        window.location.href = route('client.showCart');
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function () {
                        console.log("complete");
                    });
                }
            })
        });

        //search index client
        $('#keysearch').on('keyup', function (event) {
            var request_value = '';
            if ($('#keysearch').val() != '') {
                request_value = $('#keysearch').val();
            }
            $.ajax({
                url: route('client.live_search'),
                type: 'post',
                dataType: '',
                data: {keyword: request_value},
            })
            .done(function (res) {
                if (request_value == '') {
                    $('#box_search').hide();
                }
                $('#box_search').show();
                $('#box_search').empty();
                var result = '';
                if (!res.length) {
                    result = $('#box_search').hide();
                    ;
                } else {
                    var url = route('client.search', {keyword: request_value});
                    res.forEach(function (element, index) {
                        var url_product = route("client.product.detail", {id: element.id})
                        result += '<a href="' + url_product + '">' +
                        '<div class="element_search">' +
                        '<div class="image">' +
                        '<img class="img-thumbnail" src="{{ asset('images/products/1.jpg') }}">' +
                        '</div>' +
                        '<div class="info">' +
                        '<p class="product-title">' + element.name + '</p>';
                        if (element.discount) {
                            result += '<p class="product-price">' +
                            '<span class="product-old-price">' + nf.format(element.price) + ' ₫</span>' +
                            '<span class="product-discount"> (' + element.discount + '%)</span>' +
                            '</p>';
                        }
                        result += '<p class="product-new-price">' + nf.format(element.price * (1 - element.discount / 100)) + '  ₫</p>' +
                        '</div>' +
                        '</div>' +
                        '</a>';
                    });
                    result += '<div class="load-more">' +
                    '<a href="' + url + '">' +
                    '<div>Load More</div>' +
                    '</a>' +
                    '</div>'
                }
                $('#box_search').html(result);
            })
        });

        $('.favorite').click(function (event) {
            event.preventDefault();
            var id_product = $(this).attr('data-id');
            $.ajax({
                url: '{{ route('client.favorite') }}',
                type: 'post',
                dataType: '',
                data: {id: id_product},
            })
            .done(function () {
                swal({
                    title: "Add to favorite list",
                    icon: "success",
                    timer: 2000,
                });
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
        });

        $('#checkout').click(function (event) {
            event.preventDefault();
            var user_current = $(this).attr('data-user');
            $.ajax({
                url: route('client.cart'),
                type: 'get',
                dataType: '',
                data: {},
            })
            .done(function (res) {
                if (res.length !== 0) {
                    var total_price = 0;
                    res.forEach(function (element) {
                        total_price += element.item_price;
                    });
                    if (user_current !== '') {
                        var user = JSON.parse(user_current)
                        $('#checkout-receiver').val(user.name);
                        $('#checkout-place').val(user.address);
                        $('#checkout-email').val(user.email);
                        $('#checkout-phone').val(user.phone);
                        var discount = user.potential ? user.potentials.discount : 0;
                        total_price = total_price * (1 - discount / 100);
                        $('.price_cart').html(nf.format(Math.ceil(total_price)));
                    }
                }
            })
            $('#div-check-out').fadeIn();
        });

        $('.reduce_quantity').click(function (event) {
            event.preventDefault();
            var key = $(this).attr('data-id');
            var quantity = $(this).attr('data-quantity');
            if (quantity == 1) {
                swal({
                    title: "Number must be lagre than 0",
                    icon: "error",
                    timer: 2000,
                });
            } else {
                $.ajax({
                    url: route('user.cart.reduce'),
                    type: 'post',
                    dataType: '',
                    cache: false,
                    data: {
                        'key': key,
                    },
                })
                .done(function () {
                    // swal({
                    //     title: "Update Success",
                    //     icon: "success",
                    //     timer: 2000,
                    // });
                    location.reload();
                })
                .fail(function () {
                    console.log("error");
                })
            }
        });

        $('.quantity').on('blur change', function(event) {
            event.preventDefault();
            var key = $(this).attr('data-id');
            var quantity = $(this).val();
            $.ajax({
                url: route('user.cart.increase'),
                type: 'post',
                dataType: '',
                cache: false,
                data: {
                    'key': key,
                    'quantity': quantity
                },
            })
            .done(function () {
                swal({
                    title: "Cập nhật giỏ hàng thành công",
                    icon: "success",
                    timer: 2000,
                });
                location.reload();
            })
            .fail(function () {
                console.log("error");
            })
        });

        //check out cart
        $('#btn_checkout').click(function (event) {
            event.preventDefault();
            if ($('#form-checkout').valid()) {
                $.ajax({
                    url: route('client.checkout'),
                    type: 'post',
                    dataType: '',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: new FormData($('form#form-checkout')[0]),
                })
                .done(function () {
                    swal({
                        title: "Thanh toán thành công !",
                        icon: "success",
                        timer: 3000,
                    });
                    $('#div-check-out').fadeOut();
                    // window.location.href = route('client.index');
                })
                .fail(function (xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    var errors = Object.entries(err.errors);
                    errors.forEach(function (value, index) {
                        toastr.error(value[1][0], 'Error!');
                    });
                })
            }
        });

        $('#form-checkout').validate({
            rules: {
                receiver: {
                    required: true,
                    maxlength: 100,
                    minlength: 0,
                },
                email: {
                    required: true,
                    email: true,
                },
                place: {
                    required: true,
                    maxlength: 300,
                },
                phone: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },
                note: {
                    maxlength: 300,
                },
            },
            messages: {
                receiver:{
                    required: 'Không được để trống tên',
                    maxlength: 'Tên lớn hơn 100 kí tự !',
                },
                email: {
                    required: 'Email không được để trống',
                    email: 'Email không đúng định dạng',
                },
                place: {
                    required: 'Địa chỉ không được trống',
                    maxlength: 'Địa chỉ nhập không được quá 300 kí tự',
                },
                phone: {
                    required: 'Số điện thoại không được để trống',
                    number: 'Số điện thoại không phải là số',
                    maxlength: 'Số điện thoại quá dài',
                    minlength: 'Số điện thoại quá ngắn',
                },
                note: {
                    maxlength: 'Ghi chú quá dài',
                },
            },
        });

        $('.btn-continue').click(function(event) {
            event.preventDefault();
            location.href = route('client.filter');
        });
    });

    </script>
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0&appId=2138743409685630&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
