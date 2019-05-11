@extends('layouts.app2')

@section('page-title')
<li><a href="{{route('admin.index')}}">{{ __('message.title.dashboard') }}</a></li>
<li class="active">{{ __('message.product') }}</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="rows">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('message.product') }}</strong>
                    <div class="float-right">
                        <a href="#" id="create-product"
                        class="btn btn-outline-info" data-toggle="modal"
                        data-target="#modal-product">
                        {{ __('message.create') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table class="table table-striped table-bordered" id="admin_product_list">
                        <thead>
                            <tr>
                                <th>{{ __('message.id') }}</th>
                                <th>{{ __('message.product') }}</th>
                                <th>{{ __('message.category') }}</th>
                                <th>{{ __('message.image') }}</th>
                                <th>{{ __('message.brief') }}</th>
                                <th>{{ __('message.order_detai_title.description') }}</th>
                                <th>{{ __('message.discount') }}</th>
                                <th>{{ __('message.price') }}</th>
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
</div>
</div>

<div id="modal-product" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-product']) !!}
            <div class="modal-header">
                <h5>{{ __('message.product') }}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group" id="form-group-id">
                            {!! Form::label('id', __('message.id'), ['class' => 'form-control-label']) !!}
                            {!! Form::text('id', null, ['class' => 'form-control col-md-10',
                            'required' => 'required', 'placeholder' => 'ID Product', 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', __('message.name'), ['class' => 'form-control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control col-md-10',
                            'required' => 'required', ' id' => 'name', 'placeholder' => 'Name',
                            'autocomplete' => 'off']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('quantity', __('message.quantity'), ['class' => 'form-control-label']) !!}
                            {!! Form::number('quantity', null, ['class' => 'form-control col-md-10',
                            'required' => 'required', ' id' => 'quantity', 'placeholder' => 'Quantity']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', __('message.price'), ['class' => 'form-control-label']) !!}
                            {!! Form::number('price', null, ['class' => 'form-control col-md-10',
                            'required' => 'required', ' id' => 'price', 'placeholder' => 'Price']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('discount', __('message.discount'), ['class' => 'form-control-label']) !!}
                            {!! Form::number('discount', null, ['class' => 'form-control col-md-10',
                            'required' => 'required', ' id' => 'discount', 'placeholder' => 'Discount']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', __('message.image'), ['class' => 'form-control-label']) !!}
                            {!! Form::file('image', ['id' => 'image', 'class' => 'col-md-10',
                            'required' => 'required', ' id' => 'image', 'name'=> 'image[]', 'multiple']) !!}
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="form-control-label">Category</label>
                            <select class="form-control col-md-10" required="required" id="category_id" name="category_id">
                            </select>
                        </div>
                        <div class="form-group">
                         <div class="checkbox">
                          <label><input type="checkbox" id="selling" name="selling" class="selling" value="1">Sản phẩm bán chạy</label>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                {!! Form::label('id', __('message.review'), ['class' => 'form-control-label']) !!}
                <div id="" class="img-fluid">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    {!! Form::label('brief', __('message.brief'), ['class' => 'form-control-label']) !!}
                    {!! Form::textarea('brief', null, ['class' => 'form-control col-md-10',
                    'required' => 'required', ' id' => 'brief', 'placeholder' => 'Brief',
                    'autocomplete' => 'off']) !!}
                </div>

                {!! Form::label('description', __('message.description'), ['class' => 'form-control-label']) !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var nf = new Intl.NumberFormat();
        CKEDITOR.replace('description')
        var product_table = $('#admin_product_list').DataTable({
            processing: true,
            serverSide: true,
            order: ['0', 'desc'],
            ajax: {
                url: route('admin.product.json'),
            },
            columns: [
            {
                data: 'id',
                name: 'id'
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: 'category.name',
                name: 'category.name'
            }, {
                data: 'images',
                name: 'images',
                render: function (data, type, row) {
                    var base_url_image = '{{ asset(config('asset.image_path.product')) }}/';
                    if(data[0]){
                        return `<img src="` + base_url_image + `${data[0]['name']}">`
                    }else{
                        return `<img src="` + base_url_image + `default.png">`
                    }
                }
            }, {
                data: 'brief',
                name: 'brief',
                render: function (data, type, row) {
                    return data.substr(0, 20) + "...";
                }
            }, {
                data: 'description',
                name: 'description',
                render: function (data, type, row) {
                    return data.substr(0, 20) + "...";
                }
            }, {
                data: 'discount',
                name: 'discount',
                render: function (data) {
                    return nf.format(data) + ' %';
                }
            }, {
                data: 'price',
                name: 'price',
                render: function (data) {
                    return nf.format(data) + ' ₫';
                }
            }, {
                data: null,
                name: null,
                defaultContent: [
                '<button class="btn btn-outline-primary" title="Update" data-toggle="modal" data-target="#modal-product" id="btnUpdateProduct"><i class="fa fa-edit"></i></button> ' +
                '<button class="btn btn-outline-danger" title="Delete" id="btnDeleteProduct"><i class="fa fa-trash-o"></i></button> '
                ],
            },
            ],
        });

        function loadSelectCategory() {
            $.ajax({
                type: 'get',
                url: route('admin.product.category_select'),
                dataType: 'json',
                success: function (data) {
                    var arr = Object.entries(data);
                    var option = '<option value="" hidden>Chọn loại sản phẩm</option>';;
                    arr.forEach(function (element, index) {
                        option += '<option value="' + element[0] + '">' + element[1] + '</option>';
                    });
                    $('#category_id').html(option);
                },
            });
        }

        $('#create-product').click(function (event) {
            event.preventDefault();
            $('#form-group-id').hide();
            loadSelectCategory();
            $('.image_review_create').hide();
            $('#form-product')[0].reset();
            $('#action').val('Create');
            CKEDITOR.instances['description'].setData('');
        });

        $('#admin_product_list tbody').on('click', '#btnUpdateProduct', function () {
            $('#form-group-id').show();
            $( "#image" ).val("")
            $(".img-fluid").html("");
            $('#action').val('Update');
            var row = $(this).closest('tr');
            var id = row.find('td:eq(0)').text();
            loadSelectCategory();
            $.ajax({
                type: 'get',
                url: route('admin.product.show', {id: id}),
                success: function (data) {
                    if(data.selling == 1){
                        $("#selling").prop("checked", true);
                    }else{
                        $("#selling").prop('checked', false);
                    }
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#price').val(data.price);
                    $('#discount').val(data.discount);
                    $('#quantity').val(data.quantity);
                    $('#category_id').val(data.category_id);
                    $('#brief').val(data.brief);
                    CKEDITOR.instances['description'].setData(data.description);
                    if(data.images.length > 0){
                        for (var i = 0; i <= data.images.length; i++) {
                            if(data.images[i] != undefined){
                              var base_url_image = '{{ asset(config('asset.image_path.product')) }}';
                              var html = '<img data-id="'+data.images[i].id+'" title="Click đúp chuột để xóa ảnh" class="image_review_create" style="max-height: 150px; margin: 2% 0" class="card-img" src="'+base_url_image +'/'+ data.images[i].name+'">';
                              $(".img-fluid").append(html);
                          }
                      }
                  }
              },
          });
        });

        $('#admin_product_list tbody').on('click', '#btnDeleteProduct', function () {
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
                        url: route('admin.product.destroy', {id: id}),
                        success: function (data) {
                            swal({
                                title: "Success",
                                icon: "success",
                                timer: 2000,
                            });
                            product_table.ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            toastr.error(JSON.parse(xhr.responseText), 'Error!');
                        }
                    });
                }
            })
        });
        $("body").on('dblclick', '.image_review_create', function(e) {
            e.preventDefault();
            var data_id = $(this).attr("data-id");
            var that = $(this)
            $.ajax({
                method: 'post',
                data: {data_id: data_id},
                url: route('admin.product.destroy_image'),
                success: function (res) {
                    swal({
                        title: "Xóa ảnh thành công",
                        icon: "success",
                        timer: 2000,
                    });
                    that.css("display", "none");
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
                }
        });
        });

        $('#image').change(function () {
            $(".img-fluid").html("");
            if (this.files && this.files[0]) {

                for (var i = 0; i <= this.files.length; i++) {
                    var reader = new FileReader();
                    if(this.files[i] != undefined){

                     reader.onload = function (e) {
                    console.log(e);
                     var html = '<img  class="image_review_create" src="'+e.target.result+'" style="max-height: 150px; margin: 2% 0" class="card-img">';
                     $(".img-fluid").append(html);
                     }
                        reader.readAsDataURL(this.files[i]);
                     }
                }

            }
        });

        $('#action').click(function (event) {
            event.preventDefault();
            var id = $('#id').val();
            var url = route('admin.product.store');
            if (id != '') {
                url = route('admin.product.update', id);
            }
            var form = new FormData($('form#form-product')[0]);
            form.append('description', CKEDITOR.instances['description'].document.getBody().getText());
            $.ajax({
                method: 'post',
                data: form,
                url: url,
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    product_table.ajax.reload(null, false);
                    $('#modal-product').modal('hide');
                    swal({
                        title: "Success",
                        icon: "success",
                        timer: 2000,
                    });
                    CKEDITOR.instances['description'].setData('');
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
