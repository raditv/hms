@extends ('backend.layouts.master')

@section ('title', 'Daily Sales Outlet Report')

@section('page-header')
    <h1>
        Reporting
        <small>{{ trans('menus.backend.report.daily-salesout') }}</small>
    </h1>
@endsection

@section('after-styles-end')
    {!! Html::style('js/backend/plugin/datepicker/datepicker3.css') !!}
@stop

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.report.daily-salesout') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
            {!! Form::open(['route' => 'admin.report.sales.post.dailysalesout', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('date', null, ['class' => 'form-control pull-right', 'placeholder' => trans('menus.backend.report.date-chooser'), 'id' => 'date']) !!}
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Generate Report</button>
                    </span>
                </div>
               {!! Form::close() !!}
            </div>
            <label>Date: {{ date('d/m/Y', strtotime($date)) }}</label>
            <div class="table-responsive">
                <table class="table table-hover">
                <tr>
                  <th>Description</th>
                  <th>Today Cover</th>
                  <th>Today Food</th>
                  <th>Tdoay Beferage</th>
                  <th>Today Other FB</th>
                  <th>Today Other</th>
                  <th>Today PC</th>
                </tr>
                @foreach($sales as $sale)
                <tr>
                  <td>{{ $sale->DESCRIPTION }}</td>
                  <td>{{ replaceZero($sale->TODAYCOVER) }}</td>
                  <td>{{ replaceZero($sale->TODAYFOOD) }}</td>
                  <td>{{ replaceZero($sale->TODAYBEVERAGE) }}</td>
                  <td>{{ replaceZero($sale->TODAYOTHERFB) }}</td>
                  <td>{{ replaceZero($sale->TODAYOTHER) }}</td>
                  <td>{{ replaceZero($sale->TODAYPC) }}</td>
                </tr>
                @endforeach
                </table>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
@section('after-scripts-end')
{!! Html::script('js/backend/plugin/datepicker/bootstrap-datepicker.js') !!}
<script type="text/javascript">
$('#date').datepicker({
    format: 'yyyy/mm/dd',
    autoclose: true
    });
</script>
@stop