@extends('layouts.app')

@section('title', __('accounting::lang.journal_entry'))

@section('content')

@include('accounting::layouts.nav')

<!-- Content Header (Page header) -->
<section class="content">
    <section class="row content-header content-header-custom">
        <h1 class="content_h1 text-cusTheme1">@lang( 'accounting::lang.reports' )</h1>
    </section>
    <div class="row">
        <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-solid fa-scale-balanced fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-25">@lang( 'accounting::lang.trial_balance')</h3>
                </div>

                <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.trial_balance_description')</p>
                    <a href="{{route('accounting.trialBalance')}}" class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>

            </div>
        </div>

         <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-solid fa-clipboard fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-25">@lang( 'accounting::lang.ledger_report')</h3>
                </div>

               <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.ledger_report_description')</p>
                    <a @if($ledger_url) href="{{$ledger_url}}" @else onclick="alert(' @lang( 'accounting::lang.ledger_add_account') ')" @endif class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-regular fa-file-lines fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-25">@lang( 'accounting::lang.balance_sheet')</h3>
                </div>

                <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.balance_sheet_description')</p>
                    <a href="{{route('accounting.balanceSheet')}}" class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>

            </div>
        </div>

       <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-solid fa-file-contract fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-2">@lang( 'accounting::lang.account_recievable_ageing_report')</h3>
                </div>
                <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.account_recievable_ageing_report_description')</p>
                    <a href="{{route('accounting.account_receivable_ageing_report')}}" class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-solid fa-file-contract fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-2">@lang( 'accounting::lang.account_payable_ageing_report')</h3>
                </div>
                <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.account_payable_ageing_report_description')</p>
                    <a href="{{route('accounting.account_payable_ageing_report')}}" class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-solid fa-file-lines fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-2">@lang( 'accounting::lang.account_receivable_ageing_details')</h3>
                </div>
                <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.account_receivable_ageing_details_description')</p>
                    <a href="{{route('accounting.account_receivable_ageing_details')}}" class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <i class="fa-solid fa-file-lines fsz-5 d-block text-cusTheme mb-6"></i>
                    <h3 class="box-title text-cusTheme fsz-2">@lang( 'accounting::lang.account_payable_ageing_details')</h3>
                </div>
                <div class="box-body text-center" account_details_box>
                    <p class="fsz-15 text-cusTheme d-none" details>@lang( 'accounting::lang.account_payable_ageing_details_description')</p>
                    <a href="{{route('accounting.account_payable_ageing_details')}}" 
                    class="btn cusTheme-dark text-white">@lang( 'accounting::lang.view_report')</a>
                    <button class="btn cusTheme-dark cusTheme-dark outline" show_details_btn>Show Details</button>
                </div>
            </div>
        </div>

    </div>
</section>

@stop
<script src="{{ asset('assets/backend/js/custom.js?v=' . $asset_v) }}" defer></script>