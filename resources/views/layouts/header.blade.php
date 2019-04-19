<header id="header" class="header">
<div class="header-menu">
    <div class="col-sm-7">
        {{-- <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a> --}}
        <div class="header-left">
            <div class="dropdown for-notification">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>
                    <span class="count bg-danger" data-count="{{ count($data['active']) }}" id="count_user">{{ count($data['active']) }}</span>
                </button>
                <div class="dropdown-menu append_active" aria-labelledby="notification">
                    @foreach ($data['active'] as $d)
                        <div class="dropdown-item active_item" data-id="{{ $d->id }}">
                            <a class="text-primary btn-link btn_active_user" href="{{ route('admin.user.index') }}">
                                @if ($d->image)
                                    <img class="user-avatar rounded-circle avatar-header" src="{{ asset(config('asset.image_path.avatar') . $d->image) }}" height="20px" alt="User Avatar">
                                    @else
                                        <img class="user-avatar rounded-circle avatar-header" src="{{ asset('images/default.jpeg') }}" alt="User Avatar" height="20px">
                                    @endif
                                &nbsp{{ $d->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="dropdown for-feedback">
                <button class="btn btn-secondary dropdown-toggle" type="button"
                id="message"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="count bg-primary" data-count="{{ count($data['feedback']) }}" id="count_feedback">{{ count($data['feedback']) }}</span>
                </button>
                <div class="dropdown-menu feedback-dropdown" aria-labelledby="message">
                    @foreach ($data['feedback'] as $f)
                        <a class="dropdown-item media bg-flat-color-1" id="feedback{{ $f->id }}" href="{{ route('admin.feedback.index') }}">
                            <span class="photo media-left">
                                <img alt="avatar" class="user-avatar rounded-circle" src="{{ asset('images/default.jpeg') }}">
                            </span>
                            <span class="message media-body">
                                <span class="name float-left">{{ $f->user->name }}</span>
                                <p>{{ $f->content }}</p>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="user-area dropdown float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Auth::user()->image)
                    <img class="user-avatar rounded-circle avatar-header" src="{{ asset(config('asset.image_path.avatar') . $data['currentUser']->image) }}" alt="User Avatar">
                @else
                    <img class="user-avatar rounded-circle avatar-header" src="{{ asset('images/default.jpeg') }}" alt="User Avatar">
                @endif
            </a>
            <div class="user-menu dropdown-menu" >
                <a class="nav-link" href="{{ route('admin.user.edit') }}">
                    <i class="fa fa-user"></i> {{ __('message.profile') }}
                </a>
                <a class="nav-link" href="{{ route('admin.logout') }}"><i class="fa fa-power -off"></i>Logout</a>
            </div>
        </div>
        <div class="language-select dropdown" id="language-select">
            @if(Session::get('website_language') == 'vi')
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true" aria-expanded="true">
                    {{-- <i class="flag-icon flag-icon-vn"></i> --}}
                    <img src="{{ asset('images/vn_flat.png') }}" class="img-fluid">
                </a>
                <div class="dropdown-menu" aria-labelledby="language" >
                    <div class="dropdown-item">
                        <a href="{{ route('user.change-language', ['en']) }}">
                            <img src="{{ asset('images/en_flat.png') }}" class="img-fluid">
                        </a>
                    </div>
                </div>
            @else
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true" aria-expanded="true">
                    {{-- <i class="flag-icon flag-icon-vn"></i> --}}
                    <img src="{{ asset('images/en_flat.png') }}" class="img-fluid">
                </a>
                <div class="dropdown-menu" aria-labelledby="language" >
                    <div class="dropdown-item">
                        <a href="{{ route('user.change-language', ['vi']) }}">
                            <img src="{{ asset('images/vn_flat.png') }}" class="img-fluid">
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</header><!-- /header -->
<!-- Header-->


@section('pusher')
<script type="text/javascript" async="">
jQuery(document).ready(function($) {

    var notificationsWrapper = $('.for-feedback');
    var notificationsToggle = notificationsWrapper.find('button[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('.feedback-dropdown');

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('FeedbackEvent');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('send-feedback', function(data) {
        console.log('eyy' ,data)
        var existingNotifications = notifications.html();
        var avatar = data.user_avatar ? 'avatars/' + data.user_avatar : 'default.jpeg';
        var newNotificationHtml = `
            <a class="dropdown-item media bg-flat-color-1" id="feedback${data.id}" href="{!! route('admin.feedback.index') !!}">
                <span class="photo media-left">
                    <img alt="avatar" class="user-avatar rounded-circle" src="{{ asset('images/') }}/${avatar}">
                </span>
                <span class="message media-body">
                    <span class="name float-left">${data.user_name}</span>
                    <p>${data.content}</p>
                </span>
            </a>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('#count_feedback').text(notificationsCount);
        notificationsWrapper.show();
    });

    var notificationsWrapperUser = $('.for-notification');
    var notificationsToggleUser = notificationsWrapperUser.find('button[data-toggle]');
    var notificationsCountElemUser = notificationsToggleUser.find('span[data-count]');
    var notificationsCountUser = parseInt(notificationsCountElemUser.data('count'));
    var notificationsUser = notificationsWrapperUser.find('.append_active');

    // Subscribe to the channel we specified in our Laravel Event
    var channelUser = pusher.subscribe('UserEvent');

    // Bind a function to a Event (the full Laravel class)
    channelUser.bind('send-user', function(data) {
        console.log(data);
        var existingNotificationsUser = notificationsUser.html();
        var avatar = (data.user_avatar ? 'avatars/' + data.user_avatar : 'default.jpeg');
        var newNotificationHtmlUser = `
            <div class="dropdown-item active_item" data-id="${data.id}">
                <a class="text-primary btn-link btn_active_user" href="{!! route('admin.feedback.index') !!}">
                    <img class="user-avatar rounded-circle avatar-header" src="{{ asset(config('asset.image_path.public')) }}${avatar}" alt="User Avatar" height="20px">
                    &nbsp${data.user_name}
                </a>
            </div>
        `;
        notificationsUser.html(newNotificationHtmlUser + existingNotificationsUser);

        notificationsCountUser += 1;
        notificationsCountElemUser.attr('data-count', notificationsCountUser);
        notificationsWrapperUser.find('#count_user').text(notificationsCountUser);
        notificationsWrapperUser.show();
    });
});
</script>
@endsection
