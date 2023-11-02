<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'POS') }}</title> 

    @include('layouts.partials.css')
    <style>
        body {
            background-image: url("https://odoocdn.com/openerp_website/static/src/img/2016/components/arch_1.jpg");
            background-size: cover; /* Adjust as needed */
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .login-form.col-md-12.col-xs-12.right-col-content {
            background: #f7f7f7;
            border-radius: 20px;
            box-shadow: 4px 4px 4px 6px rgba(0, 0, 0, 0.1); /* Adjust shadow values as needed */


        justify-content: center;
        align-items: center;

        }

    </style>
    
    

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status') && session('status.success'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
    @endif
    <div class="container-fluid">
        <div class="row eq-height-row">
            <div class="col-md-12 col-sm-12 col-xs-12 eq-height-col" style="display: flex; justify-content: center; align-items: center;">
                <div class="row">
                <div class="col-md-3 col-xs-4" style="text-align: left; margin-left:60px;">
                    <select class="form-control input-sm" id="change_lang" style="margin: 10px;">
                    @foreach(config('constants.langs') as $key => $val)
                        <option value="{{$key}}" 
                            @if( (empty(request()->lang) && config('app.locale') == $key) 
                            || request()->lang == $key) 
                                selected 
                            @endif
                            >
                            {{$val['full_name']}}
                        </option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-9 col-xs-8" style="text-align: right;padding-top: 10px;">
                    @if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                        <!-- Register Url -->
                        @if(config('constants.allow_registration'))
                            <a href="{{ route('business.getRegister') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif" class="btn bg-maroon btn-flat" ><b>{{ __('business.not_yet_registered')}}</b> {{ __('business.register_now') }}</a>
                            <!-- pricing url -->
                            @if(Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing')
                                &nbsp; <a href="{{ action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']) }}">@lang('superadmin::lang.pricing')</a>
                            @endif
                        @endif
                    @endif
                    @if($request->segment(1) != 'login')
                        &nbsp; &nbsp;<span class="text-white">{{ __('business.already_registered')}} </span><a href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login']) }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">{{ __('business.sign_in') }}</a>
                    @endif
                </div>
                
                @yield('content')
                </div>
            </div>
        </div>
    </div>

    
    @include('layouts.partials.javascripts')
    
    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    
    @yield('javascript')

    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2_register').select2();

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>