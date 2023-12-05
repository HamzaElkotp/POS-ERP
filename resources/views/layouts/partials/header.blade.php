@inject('request', 'Illuminate\Http\Request')
<!-- Main Header -->

<header class="main-header no-print">
    <nav class="navbar navbar-static-top mx-0" role="navigation">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="#" class="navbar-brand sidebar-toggle" data-toggle="offcanvas" role="button">
                &#9776;
                <span class="sr-only">Toggle navigation</span>
            </a>
        </div>

        <ul class="col-md-6 justify-content-center nav col-12 col-md-auto">
            @if (Module::has('Superadmin'))
                @includeIf('superadmin::layouts.partials.active_subscription')
            @endif

            @if (!empty(session('previous_user_id')) && !empty(session('previous_username')))
                <a href="{{ route('sign-in-as-user', session('previous_user_id')) }}"
                    class="btn btn-flat btn-danger m-8 btn-sm mt-10">
                    <i class="fas fa-undo"></i> @lang('lang_v1.back_to_username', ['username' => session('previous_username')])
                </a>
            @endif
            
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ action([\App\Http\Controllers\SellPosController::class, 'create']) }}"><i class="fa-solid fa-table-columns px-2"></i> pos</a>
            </li>
            @if (Module::has('Essentials'))
                @includeIf('essentials::layouts.partials.header_part')
            @endif
            <li class="nav-item">
                <a href="#" class="clock_in_btn" data-container="#task_modal" data-toggle="tooltip" data-target="#task_modal" data-type="clock_in" data-placement="bottom" data-original-title="" title=""><i class="fa-regular fa-clock px-2"></i><span>Clock In</span></a>
            </li>
            <div class="m-8 pull-left mt-10 hidden-xs text-white">
                <i class="fa-solid fa-calendar-day px-2"></i> {{ @format_date('now') }}
            </div>
        </ul>

        <div class="col-md-3 navbar-custom-menu flex-row-reverse">
            <ul class="nav navbar-nav flex-row">

                @include('layouts.partials.header-notifications')
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar -->
                        @php
                            $profile_photo = auth()->user()->media;
                        @endphp
                        @if (!empty($profile_photo))
                            <img src="{{ $profile_photo->display_url }}" class="user-image" alt="User Image">
                        @endif
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            @if (!empty(Session::get('business.logo')))
                                <img src="{{ asset('uploads/business_logos/' . Session::get('business.logo')) }}"
                                    alt="Logo">
                            @endif
                            <p>
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer -->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ action([\App\Http\Controllers\UserController::class, 'getProfile']) }}"
                                    class="btn btn-default btn-flat">@lang('lang_v1.profile')</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'logout']) }}"
                                    class="btn btn-default btn-flat">@lang('lang_v1.sign_out')</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>