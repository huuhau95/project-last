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
