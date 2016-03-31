@extends ('backend.layouts.master')

@section ('title', 'Daily Sales Report')

@section('page-header')
    <h1>
        Reporting
        <small>{{ trans('menus.backend.report.daily-sales') }}</small>
    </h1>
@endsection

@section('after-styles-end')
    {!! Html::style('js/backend/plugin/datepicker/datepicker3.css') !!}
    {!! Html::style('js/backend/plugin/d3/nv.d3.css') !!}
@stop

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.report.daily-sales') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
            {!! Form::open(['route' => 'admin.report.sales.post.dailysales', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

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
                  <th width="9%">Today</th>
                  <th width="9%">%</th>
                  <th width="9%">This Month</th>
                  <th width="2%">%</th>
                  <th width="9%">Budget</th>
                  <th width="9%">% Progress</th>
                  <th width="9%">Year to Date</th>
                  <th width="2%">%</th>
                </tr>
                @foreach($sales as $sale)
                <tr>
                @if($sale->DESCRIPTION == 'STATISTIC' || $sale->DESCRIPTION == 'REVENUE' || $sale->DESCRIPTION == 'SERVIS & TAX' || $sale->DESCRIPTION == 'ACCOUNT RECIVABLE')
                  <th>{{ $sale->DESCRIPTION }}</th>
                @elseif($sale->NORPT == '29' || $sale->NORPT == '34' || $sale->NORPT == '42' || $sale->NORPT == '45' || $sale->NORPT == '46')
                  <td><b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sale->DESCRIPTION }}</b></td>
                @else
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sale->DESCRIPTION }}</td>
                @endif
                @if($sale->DESCRIPTION == 'STATISTIC' || $sale->DESCRIPTION == 'REVENUE' || $sale->DESCRIPTION == 'SERVIS & TAX' || $sale->DESCRIPTION == 'ACCOUNT RECIVABLE' || $sale->NORPT == '18' || $sale->NORPT == '30' || $sale->NORPT == '35')
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                @elseif($sale->NORPT == '29' || $sale->NORPT == '34' || $sale->NORPT == '42' || $sale->NORPT == '45' || $sale->NORPT == '46')
                  <td align="right"><b>{{replaceZero($sale->TODAY)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->PERSEN)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->THISMONTH)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->MONTHPERSEN)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->BUDGET)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->PROGRESS)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->THISYEAR)}}</b></td>
                  <td align="right"><b>{{replaceZero($sale->YEARPERSEN)}}</b></td>
                @else
                  <td align="right">{{replaceZero($sale->TODAY)}}</td>
                  <td align="right">{{replaceZero($sale->PERSEN)}}</td>
                  <td align="right">{{replaceZero($sale->THISMONTH)}}</td>
                  <td align="right">{{replaceZero($sale->MONTHPERSEN)}}</td>
                  <td align="right">{{replaceZero($sale->BUDGET)}}</td>
                  <td align="right">{{replaceZero($sale->PROGRESS)}}</td>
                  <td align="right">{{replaceZero($sale->THISYEAR)}}</td>
                  <td align="right">{{replaceZero($sale->YEARPERSEN)}}</td>
                @endif
                </tr>
                @endforeach
                </table>
            </div>
            <div class="row">
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Sales</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <div class="chart" id="dailySales">
                <svg></svg>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        <section class="col-lg-4 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Sales</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <div class="chart" id="monthlySales">
                <svg></svg>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        <section class="col-lg-4 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Yearly Sales</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <div class="chart" id="yearlySales">
                <svg></svg>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
@section('after-scripts-end')
{!! Html::script('js/backend/plugin/datepicker/bootstrap-datepicker.js') !!}
{!! Html::script('js/backend/plugin/d3/d3.v3.min.js') !!}
{!! Html::script('js/backend/plugin/d3/nv.d3.min.js') !!}
<script type="text/javascript">
$('#date').datepicker({
    format: 'yyyy/mm/dd',
    autoclose: true
});
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true)
      .color(d3.scale.category10().range());

    d3.select("#dailySales svg")
        .datum(dailySales)
      .transition().duration(1200)
        .call(chart);

  return chart;
});
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true)
      .color(d3.scale.category10().range());

    d3.select("#monthlySales svg")
        .datum(monthlySales)
      .transition().duration(1200)
        .call(chart);

  return chart;
});
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true)
      .color(d3.scale.category10().range());

    d3.select("#yearlySales svg")
        .datum(yearlySales)
      .transition().duration(1200)
        .call(chart);

  return chart;
});
</script>
@stop