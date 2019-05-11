<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('admin.index') }}"><img alt="Freshia" src="{{ asset('images/logo.png') }}" width="200px"></a>
            <a class="navbar-brand hidden" href=".{{ route('admin.index') }}"><img src="{{ asset('images/framgia2.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('admin.index') }}">
                        <i class="menu-icon fa fa-dashboard"></i>{{ __('message.title.dashboard') }}
                    </a>
                </li>
            @if (Auth::user()->role_id == 1) {
                
                <h3 class="menu-title"> {{ __('message.manager') }} {{ __('message.title.system') }}</h3>
                <li>
                    <a href="{{ route('admin.user.index') }}">
                        <i class="menu-icon fa fa-user"></i> {{ __('message.manager') }} {{ __('message.user') }}</a>
                </li>
                <li>
                    <a href="{{ route('admin.role.index') }}">
                        <i class="menu-icon fa fa-user"></i> {{ __('message.manager') }} {{ __('message.role') }}</a>
                </li>
                <li>
                <a href="{{ route('admin.slide.index') }}">
                        <i class="menu-icon fa fa-user"></i> {{ __('message.manager') }} {{ __('message.slides') }}</a>
                </li>
            <li>
                <a href="{{ route('admin.contact.index') }}">
                        <i class="menu-icon fa fa-user"></i> Liên Hệ</a>
                </li>
                <h3 class="menu-title"> {{ __('message.manager') }} {{ __('message.title.business') }}</h3>
                <li>
                    <a href="{{ route('admin.category.index') }}">
                        <i class="menu-icon fa fa-user"></i> {{ __('message.manager') }} {{ __('message.category') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.product.index') }}">
                        <i class="menu-icon fa fa-user"></i> {{ __('message.manager') }} {{ __('message.product') }}
                    </a>
                </li>
            @endif
    
                <h3 class="menu-title">{{ __('message.order') }}</h3>
                <li>
                    <a href="{{ route('admin.order.index') }}">
                        <i class="menu-icon fa fa-user"></i> {{ __('message.manager') }} {{ __('message.bill') }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
