@extends('layouts.app')

@section('title', __('accounting::lang.get_acc_trans'))

@section('content')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection

@include('accounting::layouts.nav')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'accounting::lang.get_acc_trans' )</h1>
</section>
<section class="content">
 <div style="font-weight:bold" class="card table-responsive">
    <table class="table table-striped datatable">
        <head>
            <th>رقم العمليه</th>
            <th>رقم الحساب</th>
            <th>اسم الحساب</th>
            <th>طبيعه العمليه</th>
            <th>تاريخ العمليه</th>
            <th>نوع العمليه</th>
            <th>القيمه</th>
            <th>عمليه القيد</th>
        </head>
        <body>
            @foreach ($quods as $key => $item)
                <tr>
                    <td>{{$item->transaction_id}}</td>
                    <td>{{$item->accounting_account_id}}</td>
                    <td>{{$item->account_account->name}}</td>
                    <td>{{$item->type}}</td>
                    <td>{{$item->operation_date}}</td>
                    <td>{{$item->sub_type}}</td>
                    <td>{{$item->accounting_account_id}}</td>
                    <td>
                        @if ($item->sub_type == "journal_entry")
                            قيد يدوي
                        @else
                            قيد تلقائي
                        @endif
                    </td>
                   
                </tr>
            @endforeach
        </body>
    </table>
 </div>
 @endsection


