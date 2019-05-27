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
        $('.quantity').on('blur change', function(event) {
            event.preventDefault();
            var key = $(this).attr('data-id');
            var quantity = $(this).val();
            if (quantity <= 0) {
                swal({
                    title: "Sản phẩm mua phải có số lượng lớn hơn 0 và nhỏ hơn 10",
                    icon: "error",
                    timer: 3000,
                });
                setTimeout(location.reload(), 3000);
            } else if (quantity > 10) {
                swal({
                    title: "Sản phẩm mua phải có số lượng lớn hơn 0 và nhỏ hơn 10",
                    icon: "error",
                    timer: 3000,
                });
                setTimeout(location.reload(), 3000);
            } else {
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
            }
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
                        title: "Đặt hàng thành công !",
                        icon: "success",
                        timer: 3000,
                    });
                    $('#div-check-out').fadeOut();
                    window.location.href = route('client.index');
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

        // product equal hieght
        var highestBoxProduct = 0;
        $('.product-equal-height', this).each(function(){
            if($(this).height() > highestBoxProduct) {
              highestBoxProduct = $(this).height(); 
            }
        });  
                
        $('.product-equal-height',this).height(highestBoxProduct);
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
