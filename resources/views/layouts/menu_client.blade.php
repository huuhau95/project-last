  <!-- NAVIGATION -->
  <div id="navigation">
    <!-- container -->
    <div class="container">
      <div id="responsive-nav">
        <!-- category nav -->
        <!-- /category nav -->

        <!-- menu nav -->
        <div class="menu-nav">
          <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
          <ul class="menu-list">
            <li><a href="{{ route('client.index') }}">{{ __('message.title.home') }}</a></li>
            <li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">{{ __('message.product') }} <i class="fa fa-caret-down"></i></a>
              <ul class="custom-menu">
                @foreach($category_with_product as $category)
                <li>
                  <a href="{{ route('client.showProductByCate', ['category_id' => $category->id]) }}" title="">
                    {{ $category->name }}
                  </a>
                </li>
                @endforeach
              </ul>
              </li>
              <li><a href="{{ route('user.contact.get') }}">Liên hệ</a></li>
            </ul>
          </div>
          <!-- menu nav -->
        </div>
      </div>
      <!-- /container -->
    </div>
    <!-- /NAVIGATION -->
