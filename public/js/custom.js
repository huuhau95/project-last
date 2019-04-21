    jQuery(document).ready(function () {
        jQuery('#rev_slider_4').show().revolution({
            dottedOverlay: 'none',
            delay: 5000,
            startwidth: 915,
            startheight: 440,
            hideThumbs: 200,
            thumbWidth: 200,
            thumbHeight: 50,
            thumbAmount: 2,
            navigationType: 'thumb',
            navigationArrows: 'solo',
            navigationStyle: 'round',
            touchenabled: 'on',
            onHoverStop: 'on',
            swipe_velocity: 0.7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: false,
            spinner: 'spinner0',
            keyboardNavigation: 'off',
            navigationHAlign: 'center',
            navigationVAlign: 'bottom',
            navigationHOffset: 0,
            navigationVOffset: 20,
            soloArrowLeftHalign: 'left',
            soloArrowLeftValign: 'center',
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: 'right',
            soloArrowRightValign: 'center',
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: 'on',
            fullScreen: 'off',
            stopLoop: 'off',
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: 'off',
            autoHeight: 'off',
            forceFullWidth: 'on',
            fullScreenAlignForce: 'off',
            minFullScreenHeight: 0,
            hideNavDelayOnMobile: 1500,
            hideThumbsOnMobile: 'off',
            hideBulletsOnMobile: 'off',
            hideArrowsOnMobile: 'off',
            hideThumbsUnderResolution: 0,
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0,
            fullScreenOffsetContainer: ''
        });
    });

    jQuery(document).ready(function ($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var nf = new Intl.NumberFormat();

        function loadCart() {
            var htmlCart = '' +
            '<ul class="mini-products-list" id="cart-sidebar">';
            $.ajax({
                url: route('client.cart'),
                type: 'get',
                dataType: '',
                data: {},
            })
            .done(function (res) {
                var empty_cart = '<h4 style="margin: 10px auto;padding: 10px 20px ;width: 100%">' +
                'Bạn chưa mua sản phẩm nào ! </h4>';
                if (res.length !== 0) {
                    $total_price = 0;
                    $count_product = 0;
                    res.forEach(function (element) {
                        $total_price += element.item_price;
                        $count_product += Number(element.item.quantity);
                    });
                    $('.count_cart').html($count_product);
                    $('.price_cart').html(nf.format(Math.round($total_price)));
                    var count_cart = res.length < 3 ? res.length : 3;
                    for (var i = 0; i < count_cart; i++) {
                        var url_image = '{{ asset(config('asset.image_path.product')) }}' + '/';
                        var item = '' +
                        '<li class="item first">' +
                        '<div class="item-inner">' +
                        '<a class="product-image" title="Retis lapen casen" href="#l">' +
                        '<img src="' + url_image + res[i].item.product.image + '">' +
                        '</a>' +
                        '<div class="product-details">' +
                        '<div class="access">' +
                        '<a class="btn-remove1 btnRemove" href="#" data-id="' + res[i].key + '" >' +
                        '</a>' +
                        '</div>' +
                        '<strong>' + res[i].item.quantity + '</strong> x <span' +
                        'class="price">' + nf.format(res[i].item.product_price) + ' ₫' + '</span>' +
                        '<p class="product-name"><a href="#">' + res[i].item.product.name + '</a></p>';
                        res[i].item.toppings.forEach(function (element, index) {
                            item += '<span class="product-name" style="padding: 5px 10px 0px 2px;display: inline-block">' + element.name + '</span>';
                        });
                        item += '</div></div></li>';
                        htmlCart += item;
                    }
                    htmlCart += '</ul>';
                    if (res.length >= 3) {
                        htmlCart += '<h3 class="text text-center">...Load more...</h3>';
                    }
                    $('#car_list').html(htmlCart);
                    $('#action_order').show();
                } else {
                    $('#car_list').html(empty_cart);
                    $('#action_order').hide();
                }
            })
        };

        loadCart();

        $('.btnBuy').click(function (event) {
            event.preventDefault();
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

        $('#form_order').validate({
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

        $('#btnSubmitOrder').click(function (event) {
            event.preventDefault();
            if ($('#form_order').valid()) {
                $.ajax({
                    url: route('user.cart.add'),
                    type: 'post',
                    dataType: '',
                    data: $('#form_order').serialize(),
                })
                .done(function () {
                    swal({
                        title: "Add to cart successfully",
                        icon: "success",
                        timer: 2000,
                    });
                    loadCart();
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    $('#form_order')[0].reset();
                    $('#order').modal('hide');
                });
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
                    loadCart();
                    location.reload();
                })
                .fail(function () {
                    console.log("error");
                })
            }
        });

        $('.increase_quantity').click(function (event) {
            event.preventDefault();
            var key = $(this).attr('data-id');
            var quantity = $(this).attr('data-quantity');
            $.ajax({
                url: route('user.cart.increase'),
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
                loadCart();
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
                        title: "Order send !",
                        icon: "success",
                        timer: 3000,
                    });
                    $('#div-check-out').fadeOut();
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
                    required: 'Name is empty',
                    maxlength: 'Name must smaller 100 character !',
                },
                email: {
                    required: 'Email is empty',
                    email: 'Email is wrong',
                },
                place: {
                    required: 'Place is empty',
                    maxlength: 'Place must smaller 300 character',
                },
                phone: {
                    required: 'Phone is empty',
                    number: 'Not a phone',
                    maxlength: 'Phone too long',
                    minlength: 'Phone too short',
                },
                note: {
                    maxlength: 'Note must smaller 300 character',
                },
            },
        });

        $('.btn-continue').click(function(event) {
            event.preventDefault();
            location.href = route('client.filter');
        });
    });
