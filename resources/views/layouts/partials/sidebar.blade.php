<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        {{-- <a href="{{ route('home') }}" class="logo">
            <span class="logo-lg">{{ Session::get('business.name') }}</span>
        </a> --}}
        <!-- Sidebar Menu -->
        {!! Menu::render('admin-sidebar-menu', 'adminltecustom') !!}

        <!-- /.sidebar-menu -->
    </section>

    <div class="staticLogo">
      <a href="{{ route('home') }}" class="logo ">
          <span class="logo-lg">
              {{ Session::get('business.name') }} 
              <i class="fa fa-circle text-success" id="online_indicator"></i>
          </span>
      </a>
    </div>
    <!-- /.sidebar -->
</aside>
