@extends ('backend.layouts.master')

@section ('title', 'Daily Sales Outlet Chart')

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
                data here
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