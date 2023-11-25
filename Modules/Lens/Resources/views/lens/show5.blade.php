@extends('layouts.app')
<style>
        @media print {
        /* .pagebreak {
            page-break-after: always;
        } */

        body {
            margin: 0;
        }

        html {
            zoom: 30%;
        }

        margin-top: 0;
        td{
        max-width:7px;
        }
        /* .card {
            width: 27cm;
            height: 21cm;

        } */

        @page {

            size: landscape !important;
        }
    }

    td{
        max-width:10px;
        }


        .sph{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

</style>
@section('content')
{{-- <button class="btn btn-success" id="prnt" onclick="myFunction()">
            طباعه
        </button> --}}

    <div class="card print-area">

        <div class="card-body" dir="ltr">
            <div class="">
                {{-- <h3>        بفرع:      {{ Auth::user()->branch->name_arabic }}        {{ $len->lens_type }}          : بيانات الكميات الموجوده من عدسه    </h3> --}}
            <table  class=" table table-bordered table-striped table-hover datatable datatable-LensCompany">

                <thead>
                    <tr>
                        <th>Sph</th>
                        <th>0.00</th>
                        <th>-0.25</th>
                        <th>-0.50</th>
                        <th>-0.75</th>
                        <th>-1.00</th>
                        <th>-1.25</th>
                        <th>-1.50</th>
                        <th>-1.75</th>
                        <th>-2.00</th>
                        <th>-2.25</th>
                        <th>-2.50</th>
                        <th>-2.75</th>
                        <th>-3.00</th>
                        <th>-3.25</th>
                        <th>-3.50</th>
                        <th>-3.75</th>
                        <th>-4.00</th>
                        <th>-4.25</th>
                        <th>-4.50</th>
                        <th>-4.75</th>
                        <th>-5.00</th>
                        <th>-5.25</th>
                        <th>-5.50</th>
                        <th>-5.75</th>
                        <th>-6.00</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($len->len_lenses_diams as $key => $len)
                        <tr data-entry-id="{{ $len->id }}" style="font-weight:bold">
                            <td class="sph">

                                {{ $len->sph }}

                            </td>
                            <td>{{ $len->s00 }}</td>
                            <td>{{ $len->_s25 }}</td>
                            <td>{{ $len->_s50 }}</td>
                            <td>{{$len->_s75 }}</td>
                            <td>{{  $len->_s100 }}</td>
                            <td>{{ $len->_s125 }}</td>
                            <td>{{$len->_s150 }}</td>
                            <td>{{ $len->_s175 }}</td>
                            <td>{{$len->_s200 }}</td>
                            <td>{{ $len->_s225 }}</td>
                            <td>{{$len->_s250 }}</td>
                            <td>{{ $len->_s275 }}</td>
                            <td>{{ $len->_s300 }}</td>
                            <td>{{$len->_s325 }}</td>
                            <td>{{$len->_s350 }}</td>
                            <td>{{ $len->_s375 }}</td>
                            <td>{{ $len->_s400 }}</td>
                            <td>{{  $len->_s425 }}</td>
                            <td>{{ $len->_s450 }}</td>
                            <td>{{ $len->_s475 }}</td>
                            <td>{{  $len->_s500 }}</td>
                            <td>{{ $len->_s525 }}</td>
                            <td>{{  $len->_s550 }}</td>
                            <td>{{ $len->_s575 }}</td>
                            <td>{{ $len->_s600 }}</td>


                        </tr>
                    @endforeach

                </tbody>            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let table = $('.datatable-LensCompany:not(.ajaxTable)').DataTable({ buttons: dtButtons })


})

</script>
@endsection


@section('scripts')

    <script>
        $('#cyl_n').keyup(function(e) {

            let cyl1 = $('#cyl_n').val() || 0;
            let cyl = 0;
            switch (cyl1) {
                case '0.00':
                    cyl = 's00';

                    break;

                case '0.25':
                    cyl = 's25';
                    break;
                case '0.50':
                    cyl = 's50';
                    break;
                case '0.50':
                    cyl = 's50';
                    break;
                case '0.75':
                    cyl = 's75';
                    break;
                case '1.00':
                    cyl = 's100';
                    break;
                case '1.25':
                    cyl = 's125';
                    break;
                case '1.50':
                    cyl = 's150';
                    break;
                case '1.75':
                    cyl = 's175';
                    break;
                case '2.00':
                    cyl = 's200';
                    break;
                case '2.25':
                    cyl = 's225';
                    break;
                case '2.75':
                    cyl = 's275';
                    break;
                case '3.00':
                    cyl = 's300';
                    break;
                case '3.25':
                    cyl = 's325';
                    break;
                case '3.75':
                    cyl = 's375';
                    break;
                case '4.000':
                    cyl = 's400';
                    break;
                case '4.25':
                    cyl = 's425';
                    break;
                case '4.50':
                    cyl = 's450';
                    break;
                case '4.75':
                    cyl = 's475';
                    break;
                case '5.00':
                    cyl = 's500';
                    break;
                case '5.25':
                    cyl = 's525';
                    break;
                case '5.50':
                    cyl = 's550';
                    break;
                case '5.75':
                    cyl = 's575';
                    break;
                case '6.00':
                    cyl = 's600';
                    break;

                case '-0.25':
                    cyl = '_s25';
                    break;
                case '-0.50':
                    cyl = '_s50';
                    break;
                case '-0.50':
                    cyl = '_s50';
                    break;
                case '-0.75':
                    cyl = '_s75';
                    break;
                case '-1.00':
                    cyl = '_s100';
                    break;
                case '-1.25':
                    cyl = '_s125';
                    break;
                case '-1.50':
                    cyl = '_s150';
                    break;
                case '-1.75':
                    cyl = '_s175';
                    break;
                case '-2.00':
                    cyl = '_s200';
                    break;
                case '-2.25':
                    cyl = '_s225';
                    break;
                case '-2.75':
                    cyl = '_s275';
                    break;
                case '-3.00':
                    cyl = '_s300';
                    break;
                case '-3.25':
                    cyl = '_s325';
                    break;
                case '-3.75':
                    cyl = '_s375';
                    break;
                case '-4.000':
                    cyl = '_s400';
                    break;
                case '-4.25':
                    cyl = '_s425';
                    break;
                case '-4.50':
                    cyl = '_s450';
                    break;
                case '-4.75':
                    cyl = '_s475';
                    break;
                case '-5.00':
                    cyl = '_s500';
                    break;
                case '-5.25':
                    cyl = '_s525';
                    break;
                case '-5.50':
                    cyl = '_s550';
                    break;
                case '-5.75':
                    cyl = '_s575';
                    break;
                case '-6.00':
                    cyl = '_s600';
                    break;

                    // default:
                    //     alert('يجب ادخال Cyl  بشكل صحيح');
            }
            // alert(cyl1);

            $('#cyl_n1').val(cyl);

        });

    </script>

@endsection

