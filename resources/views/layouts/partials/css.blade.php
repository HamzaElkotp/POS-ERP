<link rel="stylesheet" href="{{ asset('css/vendor.css?v=' . $asset_v) }}">

@if (in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')))
    <link rel="stylesheet" href="{{ asset('css/rtl.css?v=' . $asset_v) }}">
@endif

@yield('css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- app css -->
<link rel="stylesheet" href="{{ asset('css/app.css?v=' . $asset_v) }}">

@if (isset($pos_layout) && $pos_layout)
    <style type="text/css">
        .content {
            padding-bottom: 0px !important;
        }
    </style>
@endif
<style type="text/css">
    /*
 * Pattern lock css
 * Pattern direction
 * http://ignitersworld.com/lab/patternLock.html
 */
    .toast .toast-error {
        background-color: #161515 !important;
    }

    .toast-container {
        background-color: #161515 !important;
    }

    .toast-message {
        color: #161515 !important;
    }

    .patt-wrap {
        z-index: 10;
    }

    .patt-circ.hovered {
        background-color: #cde2f2;
        border: none;
    }

    .patt-circ.hovered .patt-dots {
        display: none;
    }

    .patt-circ.dir {
        background-image: url("{{ asset('/img/pattern-directionicon-arrow.png') }}");
        background-position: center;
        background-repeat: no-repeat;
    }

    .patt-circ.e {
        -webkit-transform: rotate(0);
        transform: rotate(0);
    }

    .patt-circ.s-e {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .patt-circ.s {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .patt-circ.s-w {
        -webkit-transform: rotate(135deg);
        transform: rotate(135deg);
    }

    .patt-circ.w {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .patt-circ.n-w {
        -webkit-transform: rotate(225deg);
        transform: rotate(225deg);
    }

    .patt-circ.n {
        -webkit-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .patt-circ.n-e {
        -webkit-transform: rotate(315deg);
        transform: rotate(315deg);
    }

    .collapse:not(.show) {
        display: block !important;
    }


    /* Styles for the card container */
.card {
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  width: auto;
  background-color: #fff;
}

/* Styles for the card body */
.card-body {
  padding: 10px;
}

/* Example of additional styling for card title */
.card-title {
  font-size: 1.25rem;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Example of additional styling for card text */
.card-text {
  font-size: 1rem;
  color: #333;
}

/* Example of additional styling for card image */
.card-image {
  max-width: 100%;
  height: auto;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}
.mb-4 {
  margin-bottom: 1rem; 
}
.mt-4 {
  margin-bottom: 1rem !important; 
}

</style>
@if (!empty($__system_settings['additional_css']))
    {!! $__system_settings['additional_css'] !!}
@endif
