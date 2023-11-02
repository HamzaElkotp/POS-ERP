@extends('layouts.app')
@section('title', __('home.translation'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('home.translation')
        <small>@lang('home.translation')</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <input type="text" class="form-control" id="search" >
        </div>

        <br>
        <br>

        <div id="result"></div>

        <br>
        <br>
        <br>
        <hr>
        <div class="col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    @foreach ($files as $key => $file )
                    <li class="{{ $key == 'account' ? 'active' : '' }}">
                        <a href="#{{ $key }}" data-toggle="tab">
                            <i class="fa fa-book"></i> <strong>{{ $key }}</strong>
                        </a>
                    </li>
                    
                    @endforeach

                    {{-- <li>
                        <a href="#account_types" data-toggle="tab">
                            <i class="fa fa-list"></i> <strong>
                            @lang('lang_v1.account_types') </strong>
                        </a>
                    </li> --}}
                </ul>
                <div class="tab-content">
                  @foreach ($files as $key => $file )
                    <div class="tab-pane {{ $key == 'account' ? 'active' : '' }}" id="{{ $key }}">
                        <div class="row">
                            <div class="col-md-12">
                              {!! Form::open(['url' => action([\App\Http\Controllers\HomeController::class, 'update_trans'], [$key]), 'method' => 'POST', 'id' => $key ]) !!}
                              @foreach ($files[$key]['en'] as $k => $en)
                              <div class="row">
                                @if(isset($files[$key]['en'][$k]) && is_string($files[$key]['en'][$k]))
                                <div class="col-md-4">
                                  {{ $k }} <br>
                                </div>
                                @endif
                                @if(isset($files[$key]['en'][$k]) && is_string($files[$key]['en'][$k]))
                                <div class="col-md-4">
                                  <div class="form-group">
                                    {{-- {!! Form::label('amount', __( 'tax_rate.rate' ) . ':*') !!} @show_tooltip(__('lang_v1.tax_exempt_help')) --}}
                                      {!! Form::text($k . '_en' , $files[$key]['en'][$k], ['class' => 'form-control', 'required']); !!}
                                  </div>
                                   <br>
                                </div>
                                @endif
                                @if(isset($files[$key]['ar'][$k]) && is_string($files[$key]['ar'][$k]))
                                <div class="col-md-4">
                                  <div class="form-group">
                                    {{-- {!! Form::label('amount', __( 'tax_rate.rate' ) . ':*') !!} @show_tooltip(__('lang_v1.tax_exempt_help')) --}}
                                      {!! Form::text($k . '_ar' , $files[$key]['ar'][$k], ['class' => 'form-control', 'required']); !!}
                                  </div>
                                   <br>
                                </div>
                                @endif
                              </div>
                              @endforeach
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">@lang( 'messages.update' ) / {{ $key }}</button>
                              </div>
                          
                              {!! Form::close() !!}
                            </div>
                           
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade account_model" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel" id="account_type_modal">
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        $(document).on('click', 'button.close_account', function(){
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
                if(willDelete){
                     var url = $(this).data('url');

                     $.ajax({
                         method: "get",
                         url: url,
                         dataType: "json",
                         success: function(result){
                             if(result.success == true){
                                toastr.success(result.msg);
                                capital_account_table.ajax.reload();
                                other_account_table.ajax.reload();
                             }else{
                                toastr.error(result.msg);
                            }

                        }
                    });
                }
            });
        });

        $(document).on('submit', 'form#edit_payment_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "POST",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $(document).on('submit', 'form#payment_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "post",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        // capital_account_table
        capital_account_table = $('#capital_account_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/account/account?account_type=capital',
                        columnDefs:[{
                                "targets": 5,
                                "orderable": false,
                                "searchable": false
                            }],
                        columns: [
                            {data: 'name', name: 'name'},
                            {data: 'account_number', name: 'account_number'},
                            {data: 'note', name: 'note'},
                            {data: 'balance', name: 'balance', searchable: false},
                            {data: 'action', name: 'action'}
                        ],
                        "fnDrawCallback": function (oSettings) {
                            __currency_convert_recursively($('#capital_account_table'));
                        }
                    });
        // capital_account_table
        other_account_table = $('#other_account_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/account/account?account_type=other',
                            data: function(d){
                                d.account_status = $('#account_status').val();
                            }
                        },
                        columnDefs:[{
                                "targets": [6,8],
                                "orderable": false,
                                "searchable": false
                            }],
                        columns: [
                            {data: 'name', name: 'accounts.name'},
                            {data: 'parent_account_type_name', name: 'pat.name'},
                            {data: 'account_type_name', name: 'ats.name'},
                            {data: 'account_number', name: 'accounts.account_number'},
                            {data: 'note', name: 'accounts.note'},
                            {data: 'balance', name: 'balance', searchable: false},
                            {data: 'account_details', name: 'account_details'},
                            {data: 'added_by', name: 'u.first_name'},
                            {data: 'action', name: 'action'}
                        ],
                        "fnDrawCallback": function (oSettings) {
                            __currency_convert_recursively($('#other_account_table'));
                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                            var footer_total_balance = 0;
                            for (var r in data){
                                footer_total_balance += $(data[r].balance).data('orig-value') ? parseFloat($(data[r].balance).data('orig-value')) : 0;
                            }
                            
                            $('.footer_total_balance').html(__currency_trans_from_en(footer_total_balance));
                        }
                    });

    });

    $('#account_status').change( function(){
        other_account_table.ajax.reload();
    });

    $(document).on('submit', 'form#deposit_form', function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
          method: "POST",
          url: $(this).attr("action"),
          dataType: "json",
          data: data,
          success: function(result){
            if(result.success == true){
              $('div.view_modal').modal('hide');
              toastr.success(result.msg);
              capital_account_table.ajax.reload();
              other_account_table.ajax.reload();
            } else {
              toastr.error(result.msg);
            }
          }
        });
    });
    
    $('.account_model').on('shown.bs.modal', function(e) {
        $('.account_model .select2').select2({ dropdownParent: $(this) })
    });

    $(document).on('click', 'button.delete_account_type', function(){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete)=>{
            if(willDelete){
                $(this).closest('form').submit();
            }
        });
    })

    $(document).on('click', 'button.activate_account', function(){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willActivate)=>{
            if(willActivate){
                 var url = $(this).data('url');
                 $.ajax({
                     method: "get",
                     url: url,
                     dataType: "json",
                     success: function(result){
                         if(result.success == true){
                            toastr.success(result.msg);
                            capital_account_table.ajax.reload();
                            other_account_table.ajax.reload();
                        }else{
                            toastr.error(result.msg);
                        }
                        
                    }
                });
            }
        });
    });

</script>

<script>
    $(document).ready(function(){
    $(document).on('input', '#search', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var val =  $(this).val()
        console.log(val)
        
        var formData = {
            val: val,
            description: jQuery('#description').val(),
        };
        $('#result').html('')
        $.ajax({
                method: "POST",
                url: '/getTransSearch',
                dataType: "json",
                data: formData,
                success:function(result){
                    var htm = ""
                    if(result && result.length > 0){
                        for (let i = 0; i < result.length; i++) {
                            htm += `<li> ${result[i]}  </li>`
                        }
                    }

                    var html = "<ul>" + htm +"</ul>"

                    $('#result').append(html);

                }
            });

    });
    });
</script>
@endsection