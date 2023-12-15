@extends('layouts.app')

@section('title', __('accounting::lang.income_list'))

@section('content')

    @include('accounting::layouts.nav')

    <!-- Content Header (Page header) -->

    <section class="content">

        <section class="row content-header content-header-custom">
            <h1 class="content_h1 text-cusTheme1">@lang('accounting::lang.income_list')</h1>
        </section>


        <div class="col-md-4">
            <div class="form-group labelcus">
                {!! Form::label('date_range_filter', __('report.date_range') . ':') !!}
                {!! Form::text('date_range_filter', null, [
                    'placeholder' => __('lang_v1.select_a_date_range'),
                    'class' => 'form-control',
                    'readonly',
                    'id' => 'date_range_filter',
                ]) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="box graph-details">
                <div class="box-header with-border text-center">
                    <h2 class="box-title text-cusTheme">@lang('accounting::lang.income_list')</h2>
                    <p>{{ @format_date($start_date) }} ~ {{ @format_date($end_date) }}</p>
                </div>

                <div class="box-body">

                    @php
                        $total_assets = 0;
                        $total_liab_owners = 0;
                    @endphp

                    <table class="table table-stripped table-bordered zefot-table cust" style="min-height: 300px">
                        <thead>
                            <tr>
                                <th>الحساب الرئيسي</th>
                                <th>نوع الحساب</th>
                                <th>الحساب</th>
                                <th>إيرادات</th>
                                <th>مصروفات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr>
                                    <td>{{ $account->account_sub_type->account_primary_type }}</td>
                                    <td>{{ $account->account_sub_type->name }}</td>
                                    <td>{{ $account->name }} ' - ' {{ $account->level }}</td>
                                    <td class="deb">
                                        {{ (float) $account->transac_sum()->where('type', 'debit')->where('operation_date', '>=', $start_date)->where('operation_date', '<=', $end_date)->sum('amount') }}
                                    </td>
                                    <td class="crd">
                                        {{ (float) $account->transac_sum()->where('type', 'credit')->where('operation_date', '>=', $start_date)->where('operation_date', '<=', $end_date)->sum('amount') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <td></td>
                                <td></td>
                                <th id="deb_tot"></th>
                                <th id="crd_tot"></th>
                            </tr>
                            <tr>
                                <th colspan="3">صافي الربح خلال الفتره</th>
                                <th colspan="2" id="fin"></th>
                            </tr>
                        </tfoot>
                    </table>


                </div>

            </div>
        </div>

    </section>

@stop

@section('javascript')

    <script type="text/javascript">
        $(document).ready(function() {

            dateRangeSettings.startDate = moment('{{ $start_date }}');
            dateRangeSettings.endDate = moment('{{ $end_date }}');

            $('#date_range_filter').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(
                        moment_date_format));
                    apply_filter();
                }
            );
            $('#date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#date_range_filter').val('');
                apply_filter();
            });

            function apply_filter() {
                var start = '';
                var end = '';

                if ($('#date_range_filter').val()) {
                    start = $('input#date_range_filter')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    end = $('input#date_range_filter')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                }

                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('start_date', start);
                urlParams.set('end_date', end);
                window.location.search = urlParams;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var cell = document.getElementsByClassName("deb");
            var val = 0;
            var i = 0;
            while (cell[i] != undefined) {
                val += parseFloat(cell[i].innerHTML);
                i++;
            } //end while
            document.getElementById("deb_tot").innerHTML = parseFloat(val).toFixed(0);

            var cell = document.getElementsByClassName("crd");
            var val = 0;
            var i = 0;
            while (cell[i] != undefined) {
                val += parseFloat(cell[i].innerHTML);
                i++;
            } //end while
            document.getElementById("crd_tot").innerHTML = parseFloat(val).toFixed(0);

            let db = parseFloat($('#deb_tot').text());
            let cr = parseFloat($('#crd_tot').text());
            // alert(db - cr);
            document.getElementById("fin").innerHTML = parseFloat(db - cr).toFixed(0);

        });
    </script>

@stop
