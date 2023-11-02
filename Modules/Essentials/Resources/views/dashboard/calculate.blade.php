@extends('layouts.app')
@section('title', __('essentials::lang.holiday'))

@section('content')

<h2>End Of Services Benefites Calc (DEMO)</h2>
<div class="pos-tab-content active">
	<div class="row">

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('start_date', 'Start Date' . ':') !!}
                @show_tooltip('Start Date')
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {!! Form::text('start_date', null, ['class' => 'form-control', 'readonly']); !!}
                    <span class="input-group-addon">
                        <i class="fas fa-times-circle cursor-pointer clear_start_date"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('end_date', 'End Date' . ':') !!}
                @show_tooltip('End Date')
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {!! Form::text('end_date', null, ['class' => 'form-control', 'readonly']); !!}
                    <span class="input-group-addon">
                        <i class="fas fa-times-circle cursor-pointer clear_end_date"></i>
                    </span>
                </div>
            </div>
        </div>

		<div class="col-xs-4">
            <div class="form-group">
            	{!! Form::label('no_of_days_for_leave',  'Number Of Days for Leave Without Pay' . ':') !!}
            	{!! Form::text('no_of_days_for_leave', 0, ['class' => 'form-control','placeholder' => 'Number Of Days for Leave Without Pay']); !!}
            </div>
        </div>

		<div class="col-xs-4">
            <div class="form-group">
            	{!! Form::label('total_cross_salary',  'Total Gross Salary'. ':') !!}
            	{!! Form::text('total_cross_salary', 5000, ['class' => 'form-control','placeholder' => 'Total Gross Salary']); !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="termination">Reason For End Of Employment</label>
            <select class="form-select form-control" aria-label="Default select example" id="termination">
                <option value="1">Termination By  The Employer</option>
                <option value="2">Resignation on Contract Completion</option>
                <option value="3">Resignation withot Contract Completion</option>
                <option value="4">Termination under artical 80</option>
                <option value="5">Termination under artical 81</option>
                <option value="6">Death Of The Employee</option>
              </select>
            </div>
        </div>

        
		<div class="col-xs-6">
            <div class="form-group">
            	{!! Form::label('employment_tenure',  'Employment Tenure'. ':') !!}
            	{!! Form::text('employment_tenure', null, ['class' => 'form-control','placeholder' => 'Employment Tenure']); !!}
            </div>
        </div>

        
		<div class="col-xs-4">
            <div class="form-group">
                <label for="">&nbsp;</label>
                <br>
            	<button id="submit"class="btn btn-primary pull-right" type="submit"> Calculate ->></button>
            </div>
        </div>

   
	</div>
    <div class="row">
        <table class="table">
          
            <tbody id="tbody">

              
            </tbody>
          </table>
    </div>
</div>
<!-- Main content -->
<section class="content">

</section>
<!-- /.content -->
@endsection
@section('css')
    @include('repair::job_sheet.tagify_css')
@stop
@section('javascript')
    <script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
    $(document).ready( function() {
        $('#start_date').datetimepicker({
            format: moment_date_format,
            ignoreReadonly: true,
        });
        $('#end_date').datetimepicker({
            format: moment_date_format,
            ignoreReadonly: true,
        });
        $('#start_date').data("DateTimePicker").date('1/11/2016');
        $('#end_date').data("DateTimePicker").date(new Date());
        
        $(document).on('click', '.clear_start_date', function() {
            $('#start_date').data("DateTimePicker").clear();
        });
        $(document).on('click', '.clear_end_date', function() {
            $('#end_date').data("DateTimePicker").clear();
        });
        $(document).on('click', '#submit', function() {

            var start_date = $('#start_date').val()
            var end_date = $('#end_date').val()
            var no_of_days_for_leave = parseFloat($('#no_of_days_for_leave').val())
            var total_cross_salary = parseFloat($('#total_cross_salary').val())
            var termination = $('#termination').val()

            var dat_arr = calcDate(start_date, end_date)
            var tenure =  dat_arr[2] + ' Years ' + dat_arr[1] + ' months ' + dat_arr[0] + ' Days '
            $('#employment_tenure').val(tenure)

           var  more_10 = 0;
           var  more_5 = 0;
           var  less_5 = 0;
           var where_month = '';
            if(parseFloat(dat_arr[2]) > 10){
                more_10 = parseFloat(dat_arr[2]) - 10;
                more_5 = 5;
                less_5 = 5;
                where_month = 'more_10';
            }else if(parseFloat(dat_arr[2]) > 5){
                more_10 = 0;
                more_5 = parseFloat(dat_arr[2]) - 5;
                less_5 = 5;
                where_month = 'more_5';
            }else{
                more_10 = 0;
                more_5 = 0;
                less_5 = parseFloat(dat_arr[2]);
                where_month = 'less_5';
            }

            var  more_10_total = 0;
           var  more_5_total = 0;
           var  less_5_total = 0;
           var  months_total = 0;
           var  days_total = 0;
           var  total = 0;
           var  final_more_10 = 0;
           var  final_more_5 = 0;
           var  final_less_5 = 0;


           final_more_10 = more_10  * total_cross_salary
           final_more_5 = more_5  * total_cross_salary
           final_less_5 = less_5 / 2  * total_cross_salary
           if(where_month == 'more_10'){
               months_total = total_cross_salary * parseFloat(dat_arr[1]) / 12;
               days_total = months_total * parseFloat(dat_arr[0]) / 30;

               final_more_10 = more_10 * total_cross_salary  + months_total + days_total
           }
           if(where_month == 'more_5'){
               months_total = total_cross_salary * parseFloat(dat_arr[1]) / 12;
               days_total = months_total * parseFloat(dat_arr[0]) / 30

               final_more_5 = more_5 * total_cross_salary + months_total + days_total
           }
           if(where_month == 'less_5'){
               months_total = total_cross_salary * parseFloat(dat_arr[1]) / 24;
               days_total = months_total * parseFloat(dat_arr[0])  / 30

               final_less_5 = (less_5 *  total_cross_salary / 2) + months_total + days_total
           }
            if(termination == '1' || termination == '2'){
              

            }

            if(termination == '3'){
                if(parseFloat(dat_arr[2]) <= 2){
                    final_more_10 = 0;
                    final_more_5 = 0;
                    final_less_5 = 0;
                    months_total = 0;
                    days_total = 0;

                }else{
                    if(parseFloat(dat_arr[2]) > 10){
                        final_more_10 = final_more_10 ;
                        final_more_5 = final_more_5 
                        final_less_5 = final_less_5 * 1 / 2
                    }else if(parseFloat(dat_arr[2]) > 5){
                        final_more_10 = final_more_10 * 2 / 3;
                        final_more_5 = final_more_5 * 2 / 3
                        final_less_5 = final_less_5 * 2 / 3
                        
                    }else{
                        final_more_10 = final_more_10 * 1 / 3;
                        final_more_5 = final_more_5 * 1 / 3
                        final_less_5 = final_less_5 * 1 / 3
                    }
                }
            }
            total = final_more_10 + final_more_5 + final_less_5 + months_total + days_total
            
            
            console.log('total_cross_salary',total_cross_salary)
            console.log('more_10_total',more_10_total)
            console.log('more_5_total',more_5_total)
            console.log('less_5_total',less_5_total)
            console.log('months_total',months_total)
            console.log('days_total',days_total)
            console.log('final_more_5',final_more_5)
            console.log('final_less_5',final_less_5)


            var result  = "<tr><td>End of Service for the first 5 years(" +less_5 + "Years " + (where_month == 'less_5' ? dat_arr[1] +'Months ' + dat_arr[0] +'Days ' : '' )+")</td><td>"+final_less_5.toFixed(2)+"</td></tr>"   
         + "<tr><td>End of Service for 5 to 10 Years(" +more_5 + "Years " + (where_month == 'more_5' ? dat_arr[1] +'Months ' + dat_arr[0] +'Days ' : '' )+")</td><td>"+final_more_5.toFixed(2)+"</td></tr>"   
          + "<tr><td>End of Service for more than 10 years(" +more_10 + "Years " + (where_month == 'more_10' ? dat_arr[1] +'Months ' + dat_arr[0] +'Days ' : '' )+")</td><td>"+final_more_10.toFixed(2)+"</td></tr> "
         + "<tr><td>Total EOS Benefites</td><td>"+total.toFixed(2)+"</td></tr>"
         $('#tbody').html(result)
        });

    })


    function calcDate(date1, date2){
    /*
    * calcDate() : Calculates the difference between two dates
    * @date1 : "First Date in the format MM-DD-YYYY"
    * @date2 : "Second Date in the format MM-DD-YYYY"
    * return : Array
    */

    var date11 = date1.split('/');
    date1 = date11[0] + '-' + date11[1] + '-' + date11[2];

    var date22 = date2.split('/');
    date2 = date22[0] + '-' + date22[1] + '-' + date22[2];
    //new date instance
    const dt_date1 = new Date(date1);
    const dt_date2 = new Date(date2);
    
    //Get the Timestamp
    const date1_time_stamp = dt_date1.getTime();
    const date2_time_stamp = dt_date2.getTime();
    
        console.log(date1_time_stamp)
        console.log(date2_time_stamp)
        
        let calc;
        
        //Check which timestamp is greater
        if (date1_time_stamp > date2_time_stamp) {
            calc = new Date(date1_time_stamp - date2_time_stamp);
        } else {
            calc = new Date(date2_time_stamp - date1_time_stamp);
        }
        //Retrieve the date, month and year
        const calcFormatTmp = calc.getDate() + '-' + (calc.getMonth() + 1) + '-' + calc.getFullYear();
        //Convert to an array and store
        const calcFormat = calcFormatTmp.split("-"); 
        const days_passed = Number(Math.abs(calcFormat[0]) - 1);
        const months_passed = Number(Math.abs(calcFormat[1]) - 1);
        const years_passed = Number(Math.abs(calcFormat[2]) - 1970);
        
        var arr = []
        
        arr.push(days_passed) 
        arr.push(months_passed) 
        arr.push(years_passed) 
    
        return arr


   
    }
</script>
@endsection