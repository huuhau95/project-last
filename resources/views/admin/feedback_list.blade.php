@extends('layouts.app2')

@section('page-title')
    <li><a href="{{route('admin.index')}}">{{ __('message.title.dashboard') }}</a></li>
    <li class="active">{{ __('message.feedback') }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                {{ __('message.feedback') }}
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="feedback">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('message.user') }}</th>
                            <th scope="col">{{ __('message.product') }}</th>
                            <th scope="col">{{ __('message.content') }}</th>
                            <th scope="col">{{ __('message.status') }}</th>
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

$(document).ready(function() {
    var notificationsWrapper = $('.for-feedback');
    var notificationsToggle = notificationsWrapper.find('button[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('.feedback-dropdown');

    var table = $('#feedback').DataTable({
        ajax: {
            processing: true,
            serverSide: true,
            order: [0, "desc"],
            url: '{!! route('admin.feedback.json') !!}',
            type: 'get',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user.name', name: 'user.name' },
            { data: 'product.name', name: 'product.name' },
            { data: 'content', name: 'content' },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, row) {
                    var checked = (data == 1) ? 'checked' : '';
                    return `<a href="#" class="active">
                        <label class="switch switch-3d switch-primary mr-3">
                            <input type="checkbox" class="switch-input" ${checked}>
                            <span class="switch-label"></span><span class="switch-handle"></span>
                        </label>
                    </a>`;
                },
            },
        ],
    });

    Pusher.logToConsole = false;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('FeedbackEvent');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('send-feedback', function(data) {
        table.ajax.reload(null, false);
        notificationsCount += 1;
    })

    $('#feedback tbody').on('click', '.active', function(event) {
        event.preventDefault();
        var id = $(this).closest('tr').find('td:eq(0)').text();

        $.ajax({
            url: route('admin.feedback.active', id),
            type: 'GET',
        })
        .done(function(data) {
            if (data == 'actived') {
                notificationsCount -= 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('#count_feedback').text(notificationsCount);
                $('#feedback' + id).remove();
            } else {
                var avatar = (data.avatar ? 'avatars/' + data.avatar : 'default.jpeg');
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('#count_feedback').text(notificationsCount);
                $('.feedback-dropdown').append( `
                    <a class="dropdown-item media bg-flat-color-1" id="feedback${data.id}" href="#">
                        <span class="photo media-left">
                            <img alt="avatar" class="user-avatar rounded-circle" src="http://coffee.mathemes.info/images/${avatar}">
                        </span>
                        <span class="message media-body">
                            <span class="name float-left"></span>
                            <p>${data.content}</p>
                        </span>
                    </a>
                `);
            }

            table.ajax.reload(null, false);
            console.log("success");
        })
        .fail(function() {
            swal('Something wrong !', {icon: 'error'});
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });
});
</script>

@endsection
