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
            <li><a href="#">{{ __('message.title.home') }}</a></li>
            <li class="dropdown mega-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">{{ __('message.product') }} <i class="fa fa-caret-down"></i></a>
              <div class="custom-menu">
                <div class="row">
                  @foreach($category_with_product as $category)
                  <div class="col-md-4">
                    <ul class="list-links">
                      <li>
                        <h3 class="list-links-title">{{ $category->name }}</h3></li>
                        @for($i = 0; $i < count($category->products); $i++)
                        <li class="level2 nav-6-1-1">
                          <a href="{{ route('client.product.detail', ['id' => $category->products[$i]->id]) }}">
                            <span>{{ $category->products[$i]->name }}</span>
                          </a>
                        </li>
                        @endfor
                      </ul>
                      <hr class="hidden-md hidden-lg">
                    </div>
                    @endforeach
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- menu nav -->
        </div>
      </div>
      <!-- /container -->
    </div>
    <!-- /NAVIGATION -->
