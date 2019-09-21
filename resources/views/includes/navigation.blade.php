<nav class="sidebar-nav">
  <ul class="menu">
    
    <li class="{{Route::currentRouteName() == 'home' ? 'active' : ''}}">
      <a href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
      </a>
    </li>

    <li class="{{Route::currentRouteName() == 'customer.list' ? 'active' : ''}}">
      <a href="{{ route('customer.list') }}">
        <i class="fas fa-user-tie"></i>
        <span>Customers</span>
      </a>
    </li>
    <!-- <li>
      <a class="nav-link" href="{{ route('organization.list') }}">Organizations</a>
    </li>
    <li>
      <a class="nav-link" href="{{ route('model.years') }}">Model Year</a>
    </li>
    <li>
      <a class="nav-link" href="{{ route('manufacturer.list') }}">Manufacturer</a>
    </li>
    <li>
      <a class="nav-link" href="{{ route('condition.list') }}">Condition Status</a>
    </li>
    <li>
      <a class="nav-link" href="{{ route('state.list') }}">States</a>
    </li>-->
    @if(Auth::user()->id == 1 || Auth::user()->id == 18)
    <li class="{{Route::currentRouteName() == 'users.list' || Route::currentRouteName() == 'create.user' || Route::currentRouteName() == 'edit.user' ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('users.list') }}">
      <i class="fas fa-users"></i>
        <span>Users</span>
      </a>
    </li>
    @endif
    <li class="{{(Route::currentRouteName() == 'trailer.list' || Route::currentRouteName() == 'create.trailer' || Route::currentRouteName() == 'view.trailer' || Route::currentRouteName() == 'edit.trailer') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('trailer.list')}}">
        <i class="fas fa-truck-moving"></i>  
        <span>Trailers Details</span>
      </a>
    </li>
    <li class="{{Route::currentRouteName() == 'invoice.list' ? 'active' : ''}}">
      <a class="nav-link" href="{{route('invoice.list')}}">
        <i class="fas fa-file-invoice"></i>
        <span>Trailer Financials</span>
      </a>
    </li>
    <li class="{{Route::currentRouteName() == 'edit.profile' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('edit.profile') }}">
           <i class="glyphicon glyphicon-user"></i>
            <span>{{ __('Account') }}</span>
        </a>    
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
            <i class="glyphicon glyphicon-log-out"></i>                 
            <span>{{ __('Logout') }}</span>
        </a>    
    </li>
  </ul>    
</nav>