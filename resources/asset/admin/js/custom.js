frejQuery(document).ready(function($) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    var urlOrigin = window.location.origin;

    var nf = new Intl.NumberFormat();

    /**
     * admin category page
     */
    var category_table = $('#admin_category_list').DataTable({
        ajax: {
            url: route('admin.category.json'),
            dataSrc: '',
            type: 'get',
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            {
                data: null,
                defaultContent: [
                    '<button class="btn btn-outline-primary" title="Update" data-toggle="modal" data-target="#CategoryModal" id="btnUpdateCategory"><i class="fa fa-edit"></i></button> ' +
                    '<button class="btn btn-outline-danger" title="Delete" id="btnDeleteCategory"><i class="fa fa-trash-o"></i></button> '
                ],
            },
        ],
    });

    $('#btnCreateCategory').click(function() {

        $('#category_id').val('');

        $('#category_name').val('');

        $('#category_group_id').hide();

    });

    $('#admin_category_list tbody').on('click', '#btnUpdateCategory', function() {

        $('#category_group_id').show();

        $('#category_id').prop('readonly', true);

        var row = $(this).closest('tr');

        var id = row.find('td:eq(0)').text();

        var name = row.find('td:eq(1)').text();

        $('#category_id').val(id);

        $('#category_name').val(name);

    });

    $('#btnSubmitCategory').click(function() {

        var id = $('#category_id').val();

        var name = $('#category_name').val();

        var url = route('admin.category.store');

        if (id != '') {
            url = route('admin.category.update', { id: id });
        }

        $.ajax({
            type: 'post',
            url: url,
            data: {
                'name': name,
            },
            success: function(res) {
                category_table.ajax.reload();
                $('#CategoryModal').modal('hide');
                toastr.success('Action Success');
            },
            error: function(res) {
                var error = res.responseJSON.errors.name[0];
                toastr.error(error);
            },
        });
    });

    $('#admin_category_list tbody').on('click', '#btnDeleteCategory', function() {

        if (confirm('Co xoa the loai nay ko ?')) {

            var row = $(this).closest('tr');

            var id = row.find('td:eq(0)').text();

            $.ajax({
                type: 'get',
                url: route('admin.category.destroy', { id: id }),
                success: function(res) {
                    category_table.ajax.reload();
                    toastr.success('Action Success');
                },
                error: function(res) {
                    console.log(res);
                },
            });
        }

    });


    /**
     * admin role page
     */
    var role_table = $('#admin_role_list').DataTable({
        ajax: {
            url: route('admin.role.json'),
            dataSrc: '',
            type: 'get',
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            {
                data: null,
                defaultContent: [
                    '<button class="btn btn-outline-primary" title="Update" data-toggle="modal" data-target="#RoleModal" id="btnUpdateRole"><i class="fa fa-cog"></i></button> ' +
                    '<button class="btn btn-outline-danger" title="Delete" id="btnDeleteRole"><i class="fa fa-trash-o"></i></button> '
                ],
            },
        ],
    });


    $('#btnCreateRole').click(function() {

        $('#role_id').val('');

        $('#role_name').val('');

        $('#role_group_id').hide();

    });

    $('#admin_role_list tbody').on('click', '#btnUpdateRole', function() {

        $('#role_group_id').show();

        $('#role_id').prop('readonly', true);

        var row = $(this).closest('tr');

        var id = row.find('td:eq(0)').text();

        var name = row.find('td:eq(1)').text();

        $('#role_id').val(id);

        $('#role_name').val(name);

    });

    $('#btnSubmitRole').click(function() {

        var id = $('#role_id').val();

        var name = $('#role_name').val();

        var url = route('admin.role.store');

        if (id != '') {
            url = route('admin.role.update', { id: id });

        }

        $.ajax({
            type: 'post',
            url: url,
            data: {
                'name': name,
            },
            success: function(res) {
                role_table.ajax.reload();
                $('#RoleModal').modal().hide();
                toastr.success('Action Success');
            },
            error: function(res) {
                console.log(res);
            },
        });
    });

    $('#admin_role_list tbody').on('click', '#btnDeleteRole', function() {

        if (confirm('Co xoa the loai nay ko ?')) {

            var row = $(this).closest('tr');

            var id = row.find('td:eq(0)').text();

            $.ajax({
                type: 'get',
                url: route('admin.category.destroy', { id: id }),
                success: function(res) {
                    role_table.ajax.reload();
                    toastr.success('Action Success');
                },
                error: function(res) {
                    console.log(res);
                },
            });
        }
    });

    /**
     * admin topping page
     */

    var topping_table = $('#admin_topping_list').DataTable({
        ajax: {
            url: route('admin.topping.json'),
            dataSrc: '',
            type: 'get',
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            {
                data: 'price',
                render: function(data)
                {
                    return nf.format(data) + ' ₫';
                }
            },
            {
                data: 'quantity',
                render: function(data)
                {
                    return nf.format(data);
                }
            },
            {
                data: null,
                defaultContent: [
                    '<button class="btn btn-outline-primary" title="Update" data-toggle="modal" data-target="#ToppingModal" id="btnUpdateTopping"><i class="fa fa-edit"></i></button> ' +
                    '<button class="btn btn-outline-danger" title="Delete" id="btnDeleteTopping"><i class="fa fa-trash-o"></i></button> '
                ],
            },
        ],
    });

    $('#btnCreateTopping').click(function() {

        $('#topping_id').val('');

        $('#topping_name').val('');

        $('#topping_price').val('');

        $('#topping_quantity').val('');

        $('#topping_group_id').hide();

    });

    $('#admin_topping_list tbody').on('click', '#btnUpdateTopping', function() {

        $('#topping_group_id').show();

        $('#topping_id').prop('readonly', true);

        var row = $(this).closest('tr');

        var id = row.find('td:eq(0)').text();

        var name = row.find('td:eq(1)').text();

        var price = row.find('td:eq(2)').text();

        $('#topping_id').val(id);

        $.ajax({
            url: route('admin.topping.show', { id: id }),
            success: function(data) {

                $('#topping_name').val(data.name);

                $('#topping_price').val(data.price);

                $('#topping_quantity').val(data.quantity);
            }
        })
    });

    $('#btnSubmitTopping').click(function() {

        var id = $('#topping_id').val();

        var name = $('#topping_name').val();

        var price = $('#topping_price').val();

        var quantity = $('#topping_quantity').val();


        var url = route('admin.topping.store');

        if (id != '') {
            url = route('admin.topping.update', { id: id });
        }

        $.ajax({
            type: 'post',
            url: url,
            data: {
                'name': name,
                'price': price,
                'quantity': quantity
            },
            success: function(res) {
                topping_table.ajax.reload();
                $('#ToppingModal').modal().hide();
                toastr.success('Action Success');
            },
            error: function(res) {
                console.log(res);
            },
        });
    });

    $('#admin_topping_list tbody').on('click', '#btnDeleteTopping', function() {

        if (confirm('Delete this topping ?')) {

            var row = $(this).closest('tr');

            var id = row.find('td:eq(0)').text();

            $.ajax({
                type: 'get',
                url: route('admin.topping.destroy', { id: id }),
                success: function(res) {
                    topping_table.ajax.reload();
                    toastr.success('Action Success');
                },
                error: function(res) {
                    console.log(res);
                },
            });
        }
    });

    /**
     * admin product page
     **/

    var product_table = $('#admin_product_list').DataTable({
        ajax: {
            url: route('admin.product.json'),
            dataSrc: '',
            type: 'get',
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'quantity' },
            {
                data: null,
                defaultContent: [
                    '<a href="" id="showImageProduct" data-toggle="modal" data-target="#UpdateImageModal">' +
                    '<i class="fa fa-picture-o fa-3x" ></i>' +
                    '</a>'
                ],
            },
            {
                data: 'price',
                render: function(data)
                {
                    return nf.format(data) + ' ₫';
                }
            },
            {
                data: 'description',
                render: function(data, type, row) {
                    return data.substr(0, 40) + "...";
                }
            },
            { data: 'category.name' },
            {
                data: null,
                defaultContent: [
                    '<button class="btn btn-outline-primary" title="Update" data-toggle="modal" data-target="#ProductModal" id="btnUpdateProduct"><i class="fa fa-edit"></i></button> ' +
                    '<button class="btn btn-outline-danger" title="Delete" id="btnDeleteProduct"><i class="fa fa-trash-o"></i></button> '
                ],
            },
        ],
    });

    $('#btnCreateProduct').click(function() {

        $('#choose_image_product_modal').html('Chọn ảnh');

        $('#image_review_create').hide();

        $('#group_product_id').hide();

        $('#product_name').val('');

        $('#product_id').val('');

        $('#product_price').val('');

        $('#product_quantity').val('');

        $('#product_image').val('');

        $.ajax({
            type: 'get',
            url: route('admin.category.json'),
            dataType: 'json',
            success: function(data) {

                var arr = Object.entries(data);

                var option = '';

                arr.forEach(function(element, index) {

                    option += '<option value="' + element[1].id + '">' + element[1].name + '</option>';

                });

                $('#product_category').append(option);
            },
        });
    });

    $('#admin_product_list tbody').on('click', '#btnUpdateProduct', function() {

        $('#choose_image_product_modal').html('Main Picture');

        $('#product_image').hide();

        var row = $(this).closest('tr');

        var id = row.find('td:eq(0)').text();

        $.ajax({

            type: 'get',

            url: route('admin.category.json'),

            dataType: 'json',

            success: function(data) {

                var arr = Object.entries(data);

                var option = '';

                arr.forEach(function(element, index) {

                    option += '<option value="' + element[1].id + '">' + element[1].name + '</option>';

                });

                $('#product_category').append(option);
            },
        });

        $.ajax({

            type: 'get',

            url: route('admin.product.show', { id: id }),

            success: function(data) {

                $('#product_category').val(data.category_id);

                $('#product_name').val(data.name);

                $('#product_price').val(data.price);

                $('#product_quantity').val(data.quantity);

                CKEDITOR.instances['ckeditor_product_descrition'].setData(data.description);

                var image = data[0].images;

                $('#image_review_create').attr('src', urlOrigin + '/images/products/' + data.main_image);
            },
        });

        $('#product_id').val(id);

        $('#product_id').attr('readonly', true);

    });

    $('#product_image').change(function() {

        $('#image_review_create').show();

        if (this.files && this.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('#image_review_create').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#btnSubmitProduct').click(function(event) {

        event.preventDefault();

        var id = $('#product_id').val();

        var url = route('admin.product.store');

        if (id != '') {

            url = route('admin.product.update', { id: id });
        }
        var form = new FormData($('form#add_product_form')[0]);

        form.append('description', CKEDITOR.instances['ckeditor_product_descrition'].getData());

        $.ajax({
            method: 'post',
            data: form,
            url: url,
            contentType: false,
            processData: false,
            cache: false,
            success: function(res) {
                product_table.ajax.reload();
                $('#ProductModal').modal().hide();
                toastr.success('Action Success');
            },
            error: function(res) {
                console.log(res)
            },
        });
    });

    $('#admin_product_list tbody').on('click', '#showImageProduct', function() {

        var slideIndex = 1;

        $('#image_product_id').val('');

        $('#images-container .images').empty();

        var row = $(this).closest('tr');

        var id = row.find('td:eq(0)').text();

        $('#image_product_id').val(id);

        $.ajax({

            type: 'get',

            url: route('admin.product.images', { id: id }),

            success: function(data) {

                $('#image-button').hide();

                var arr = Object.entries(data);

                var div_images = '';

                var name_image_current = '';

                if (arr.length > 0) {

                    arr.forEach(function(element, index) {

                        var url_image = urlOrigin + "/images/products/" + element[1].name;

                        div_images += '<div class="mySlides">' +
                            '<div class="numbertext">' + (index + 1) + ' / ' + arr.length + '</div>' +
                            '<img  src="' + url_image + '" style="width:100%">' +
                            '<div class="text-cap">' + 'Caption Text' + '</div>' +
                            '</div>';
                    });

                    if (arr.length > 1) {
                        $('#image-button').show();
                    }

                    name_image_current = '<input id="image_current_id" value="' + arr[0][1].name + '" hidden>';

                    $('.images').append(div_images);

                    $('.images').append(name_image_current);

                    showSlides(1);

                    $('#image-prev').click(function() {

                        showSlides(slideIndex -= 1);
                    });

                    $('#image-next').click(function() {

                        showSlides(slideIndex += 1);
                    });

                    function showSlides(n) {

                        var slides = document.getElementsByClassName("mySlides");

                        if (n > slides.length) {

                            slideIndex = 1;
                        }

                        if (n < 1) {

                            slideIndex = slides.length;

                        }

                        for ($i = 0; $i < slides.length; $i++) {

                            slides[$i].style.display = "none";
                        }

                        slides[slideIndex - 1].style.display = "block";

                        $('#image_current_id').val(arr[slideIndex - 1][1].id);

                    }

                } else {

                    $('#main-image-button').hide();

                    div_images = '<h3 class="text-center">No Image</h3>';

                    $('#images-container .images').append(div_images);
                }
            },
            error: function(res) {
                console.log(res);
            },
        });
    });

    $('#addImageProduct').click(function() {
        $("#file_image_product").click();
    });

    $('#file_image_product').change(function() {

        var product_id = $('#image_product_id').val();

        var form = new FormData($('form#add_more_image_form')[0]);

        form.append('product_id', product_id);

        $.ajax({
            cache: false,
            contentType: false,
            processData: false,
            url: route('admin.product.uploadimage'),
            type: 'post',
            data: form,
            success: function(res) {
                $('#UpdateImageModal').modal('hide');
                toastr.success('Action Success');
            },
            error: function(res) {
                console.log(res)
            }
        });
    });

    $('#main_image_button').click(function(event) {

        var main_picture_id = $('#image_current_id').val();

        var product_id = $('#image_product_id').val();

        $.ajax({
                url: route('admin.product.change_main_image'),
                type: 'post',
                dataType: '',
                data: {
                    'image_id': main_picture_id,
                    'product_id': product_id,
                },
            })
            .done(function(res) {
                console.log("picture: " + product_id + " doi image co id: " + main_picture_id + " lam anh chinh");
            })
            .fail(function(res) {
                console.log(res);
            })
            .always(function() {
                console.log("complete");
            });
    });
});
