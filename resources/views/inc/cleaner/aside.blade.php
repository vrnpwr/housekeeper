<!-- ################################ ASIDE ###################################### -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  @php
  $prefix = Auth::user()->type;
  @endphp
  @if($prefix == 'host' )
  <a href="{{ url('dashboard') }}" class="brand-link">
    @else
    <a href="{{ url($prefix.'/dashboard') }}" class="brand-link">
      @endif
      <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Housekeeper</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @php
          $image_url = Auth::user()->image ? '/images/'.Auth::user()->image : 'admin-lte/dist/img/user2-160x160.jpg'
          @endphp
          <img src="{{ asset($image_url) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          {{-- All uder this condition will display for cleaner --}}
          @if(Auth::user()->type == 'cleaner')

          {{-- Myjobs --}}
          <li class="nav-item has-treeview">
            <a href="{{ url('cleaner/myjobs') }}" class="nav-link">
              <i class="nav-icon fa fa-recycle" aria-hidden="true"></i>
              <p>
                My Jobs
              </p>
            </a>

            {{-- Schedule --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Schedule
              </p>
            </a>
          </li>
          {{-- My Reviews --}}
          <li class="nav-item has-treeview">
            <a href="{{ url('cleaner/reviews') }}" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                My Reviews
              </p>
            </a>
          </li>
          {{-- Invitations --}}
          <li class="nav-item has-treeview">
            <a href="{{ url('cleaner/invites') }}" class="nav-link">
              <i class="nav-icon fas fa-user-plus" aria-hidden="true"></i>
              {{-- <i class="nav-icon fas fa-star"></i> --}}
              <p>
                Invitations
              </p>
            </a>
          </li>
          {{-- Curent Customers --}}
          <li class="nav-item has-treeview">
            <a href="{{ url('cleaner/customers') }}" class="nav-link">
              <i class="nav-icon fa fa-envelope" aria-hidden="true"></i>
              <p>
                My Customers
              </p>
            </a>
          </li>
          {{-- Settings --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('cleaner/profile') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('cleaner/notification') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>
            </ul>
          </li>

          </li>

          @endif

          {{-- Logout will display for all types of users --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>{{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>






        </ul>
        </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>