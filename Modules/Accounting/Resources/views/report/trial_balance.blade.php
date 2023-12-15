@extends('layouts.app')

@section('title', __('accounting::lang.trial_balance'))

@section('content')

    @include('accounting::layouts.nav')

    <section class="content px-0">

        <div class="col-md-3">
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
                    <h2 class="box-title text-cusTheme">@lang('accounting::lang.trial_balance')</h2>
                    <p>{{ @format_date($start_date) }} ~ {{ @format_date($end_date) }}</p>
                </div>

                <div class="box-body">
                    <div class="momo-table">
                        <table class="table table-stripped table-bordered zefot-table cust" style="min-height: 300px">
                            <thead>
                                <tr>
                                    <th colspan="1">الحساب الرئيسي</th>
                                    <th colspan="1">الحساب</th>
                                    <th colspan="2">رصيد سابق</th>
                                    <th colspan="2">الحركات خلال الفتره</th>
                                    <th colspan="2">رصيد حتي الفتره</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>@lang('accounting::lang.debit')</th>
                                    <th>@lang('accounting::lang.credit')</th>
                                    <th>@lang('accounting::lang.debit')</th>
                                    <th>@lang('accounting::lang.credit')</th>
                                    <th>@lang('accounting::lang.debit')</th>
                                    <th>@lang('accounting::lang.credit')</th>
                                </tr>
                            </thead>

                            @php
                                $total_debit_first = 0;
                                $total_credit_first = 0;
                                $total_debit = 0;
                                $total_credit = 0;
                            @endphp

                            <tbody>
                                @foreach ($accounts as $account)
                                    @php
                                        $total_debit_first += $account->debit_balance_first;
                                        $total_credit_first += $account->credit_balance_first;
                                        $total_debit += $account->debit_balance;
                                        $total_credit += $account->credit_balance;
                                    @endphp

                                    <tr>
                                        <td>{{ $account->account_sub_type->name }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td class="deb_fr">
                                            {{ (float) $account->transactions()->where('type', 'debit')->where('operation_date', '<', $start_date)->sum('amount') }}
                                        </td>
                                        <td class="crd_fr">
                                            {{ (float) $account->transactions()->where('type', 'credit')->where('operation_date', '<', $start_date)->sum('amount') }}
                                        </td>
                                        <td class="deb">
                                            {{ (float) $account->transactions()->where('type', 'debit')->where('operation_date', '>=', $start_date)->where('operation_date', '<=', $end_date)->sum('amount') }}

                                        </td>
                                        <td class="crd">
                                            {{ (float) $account->transactions()->where('type', 'credit')->where('operation_date', '>=', $start_date)->where('operation_date', '<=', $end_date)->sum('amount') }}
                                        </td>
                                        <td class="deb_fn">

                                        </td>
                                        <td class="crd_fn">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <td></td>
                                    <th id="deb_fr_tot"></th>
                                    <th id="crd_fr_tot"></th>
                                    <th id="deb_tot"></th>
                                    <th id="crd_tot"></th>
                                    <th id="deb_fn_tot"></th>
                                    <th id="crd_fn_tot"></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
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

        window.onload = function() {
            let sum_deb = 0;

            let sum_crd = 0;
            let sum2 = 0;
            // let fin = pparseFloat($('.fin').val()) || 0;
            // let perc = parseFloat($('.total').val()) || 0;
            // alert(perc);



            $('.cust tr').each(function(e) {

                let deb_fr = $(this).find('.deb_fr').text() || 0;
                let crd_fr = $(this).find('.crd_fr').text() || 0;
                let deb = $(this).find('.deb').text() || 0;
                let crd = $(this).find('.crd').text() || 0;
                sum_deb = deb_fr + deb_fn;
                sum_crd = crd_fr + crd_fn;
                // sum1 += sum;
                // let frst = parseFloat($('.frst1').val(), 2);
                alert(sum_deb);
                // sum2 = sum1 + frst;
                $(this).find('.deb_fn').val((sum_deb.toLocaleString()));
                $(this).find('.crd_fn').val((sum_crd.toLocaleString()));


                // $('.fin').val(sum2.toLocaleString());
                // let perc = $('.perc').val();
                // // console.log(perc);
                // $('.perc1').val(sum2 * perc / 100);

                //     $('.fin').val();
                // } else {
                //     // console.log(sum2);

                //     $('.fin1').val();
                //     $('.fin').val(Math.abs(sum2).toFixed(2));
                // }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $(' .cust tr').each(function() {
                var sum_deb_fr = 0;
                var sum_crd_fr = 0;
                var sum_deb = 0;
                var sum_crd = 0;
                $(this).find('.deb_fr').each(function() {
                    var combat = $(this).text();
                    if (!isNaN(combat) && combat.length !== 0) {
                        sum_deb_fr += parseFloat(combat);
                    }
                });
                $(this).find('.deb').each(function() {
                    var combat = $(this).text();
                    if (!isNaN(combat) && combat.length !== 0) {
                        sum_deb += parseFloat(combat);
                    }
                });
                $(this).find('.deb_fn').html(sum_deb + sum_deb_fr);

                $(this).find('.crd_fr').each(function() {
                    var combat = $(this).text();
                    if (!isNaN(combat) && combat.length !== 0) {
                        sum_crd_fr += parseFloat(combat);
                    }
                });
                $(this).find('.crd').each(function() {
                    var combat = $(this).text();
                    if (!isNaN(combat) && combat.length !== 0) {
                        sum_crd += parseFloat(combat);
                    }
                });
                $(this).find('.crd_fn').html(sum_crd + sum_crd_fr);
            });


            var cell = document.getElementsByClassName("deb_fr");
            var val = 0;
            var i = 0;
            while (cell[i] != undefined) {
                val += parseFloat(cell[i].innerHTML);
                i++;
            } //end while
            document.getElementById("deb_fr_tot").innerHTML = parseFloat(val).toFixed(0);

            var cell = document.getElementsByClassName("crd_fr");
            var val = 0;
            var i = 0;
            while (cell[i] != undefined) {
                val += parseFloat(cell[i].innerHTML);
                i++;
            } //end while
            document.getElementById("crd_fr_tot").innerHTML = parseFloat(val).toFixed(0);

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

            var cell = document.getElementsByClassName("deb_fn");
            var val = 0;
            var i = 0;
            while (cell[i] != undefined) {
                val += parseFloat(cell[i].innerHTML);
                i++;
            } //end while
            document.getElementById("deb_fn_tot").innerHTML = parseFloat(val).toFixed(0);

            var cell = document.getElementsByClassName("crd_fn");
            var val = 0;
            var i = 0;
            while (cell[i] != undefined) {
                val += parseFloat(cell[i].innerHTML);
                i++;
            } //end while
            document.getElementById("crd_fn_tot").innerHTML = parseFloat(val).toFixed(0);
        });
    </script>

@stop
