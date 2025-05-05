<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <div class="logo-header" data-background-color="dark">
      <a href="#" class="logo">
        <!-- شعار -->
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
  </div>

  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">

        <li class="nav-item active">
          <a href="{{ auth()->user()->is_designer ? route('designer.dashboard') : route('admin.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- قائمة للمشرف فقط --}}
        @if(auth()->user()->is_admin)
        <li class="nav-item">
          <a href="{{ route('admin.designers') }}">
            <i class="fas fa-users-cog"></i>
            <p>Manage Designers</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.orders') }}">
            <i class="fas fa-shopping-cart"></i>
            <p>Manage Orders</p>
          </a>
        </li>
        @endif

        {{-- قائمة للمصمم فقط --}}
        @if(auth()->user()->is_designer)
        <li class="nav-item">
          <a href="{{ route('designer.designs') }}">
            <i class="fas fa-tshirt"></i>
            <p>My Designs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('designer.orders') }}">
            <i class="fas fa-box-open"></i>
            <p>My Orders</p>
          </a>
        </li>
        @endif

        {{-- مشترك --}}
        <li class="nav-item">
          <a href="{{ route('profile.show') }}">
            <i class="fas fa-user"></i>
            <p>Profile</p>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->
