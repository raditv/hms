@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('after-styles-end')
    {!! Html::style('js/backend/plugin/chartjs/Chart.css') !!}
    {!! Html::style('js/backend/plugin/d3/nv.d3.css') !!}
@stop
@section('content')
    <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                @if(count($reservations))
                {{ $reservations[0]['TODAY'] }}
                @else
                0
                @endif
              </h3>

              <p>Room Available</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                @if(count($reservations))
                {{ $reservations[2]['TODAY'] }}
                @else
                0
                @endif
              </h3>

              <p>Vacant Room</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                @if(count($reservations))
                {{ $reservations[3]['TODAY'] }}
                @else
                0
                @endif
              </h3>

              <p>Out of Order Room</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                @if(count($reservations))
                {{ $reservations[9]['TODAY'] }}
                @else
                0
                @endif
              </h3>

              <p>Occupied Room</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
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
                <div class="chart" id="dailyRevenue">
                <svg></svg>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        <section class="col-lg-12 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Last Ten Days Sales</h3>

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
    </div>
    
@endsection
@section('after-scripts-end')
{!! Html::script('js/backend/plugin/chartjs/Chart.min.js') !!}
{!! Html::script('js/backend/plugin/d3/d3.v3.min.js') !!}
{!! Html::script('js/backend/plugin/d3/nv.d3.min.js') !!}
<script>
nv.addGraph(function() {
        var chart = nv.models.lineChart()
                      .x(function (d) { return d.x; })
                      .margin({left: 100})  //Adjust chart margins to give the x-axis some breathing room.
                      .useInteractiveGuideline(true)  //We want nice looking tooltips and a guideline!
                      .showLegend(true)       //Show the legend, allowing users to turn on/off line series.
                      .showYAxis(true)        //Show the y-axis
                      .showXAxis(true)        //Show the x-axis
                      .color(d3.scale.category10().range());

        chart.xAxis     //Chart x-axis settings
            .tickFormat(function(d) {
              return d3.time.format('%x')(new Date(d))
            });

        chart.yAxis     //Chart y-axis settings
            .tickFormat(d3.format('.02f'));

        d3.select('#dailySales svg')    //Select the <svg> element you want to render the chart in.   
            .datum(salesData)         //Populate the <svg> element with chart data...
            .call(chart);          //Finally, render the chart!

        //Update the chart when window resizes.
        nv.utils.windowResize(function() { chart.update() });
        return chart;
});
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true)
      .color(d3.scale.category10().range());

    d3.select("#dailyRevenue svg")
        .datum(testChart)
      .transition().duration(1200)
        .call(chart);

  return chart;
});

/*
Chart.defaults.global.scaleLabel = function(label){
    return new Intl.NumberFormat().format(label.value);
};
Chart.defaults.global.tooltipTemplate = function(label){
    return label.label + ': ' + Intl.NumberFormat().format(label.value);
};
Chart.defaults.global.multiTooltipTemplate = function(label){
    return label.datasetLabel + ': ' + Intl.NumberFormat().format(label.value);
};
$(document).on('ready', function() {
  var ds = document.getElementById("dailyRevenue").getContext("2d");
  var dailySalesChart = new Chart(ds).Pie(dailyRevenue);
  document.getElementById("dailyRevenueLegend").innerHTML = dailySalesChart.generateLegend();
});
/*
$(document).on('ready', function() {
    $.ajax({
        url: "/admin/monthlyrevenue",
        data: {_token: "{!!csrf_token()!!}"},
        dataType: 'json',
        method: "post"
    }).done(function (data) {
        var ds = document.getElementById("monthlyRevenue").getContext("2d");
        var dailySalesChart = new Chart(ds).Pie(data);
        document.getElementById("monthlyRevenueLegend").innerHTML = dailySalesChart.generateLegend();
    });   
});
$(document).on('ready', function() {
    $.ajax({
        url: "/admin/yearlyrevenue",
        data: {_token: "{!!csrf_token()!!}"},
        dataType: 'json',
        method: "post"
    }).done(function (data) {
        var ds = document.getElementById("yearlyRevenue").getContext("2d");
        var dailySalesChart = new Chart(ds).Pie(data);
        document.getElementById("yearlyRevenueLegend").innerHTML = dailySalesChart.generateLegend();
    });   
});

$(document).on('ready', function() {
    $.ajax({
        url: "/admin/dailysaleschart",
        data: {_token: "{!!csrf_token()!!}"},
        dataType: 'json',
        method: "post"
    }).done(function (data) {
        nv.addGraph(function() {
        var chart = nv.models.lineChart()
                      .x(function (d) { return d.x; })
                      .margin({left: 100})  //Adjust chart margins to give the x-axis some breathing room.
                      .useInteractiveGuideline(true)  //We want nice looking tooltips and a guideline!
                      .showLegend(true)       //Show the legend, allowing users to turn on/off line series.
                      .showYAxis(true)        //Show the y-axis
                      .showXAxis(true)        //Show the x-axis
                      .color(d3.scale.category10().range());

        chart.xAxis     //Chart x-axis settings
            .tickFormat(function(d) {
              return d3.time.format('%x')(new Date(d))
            });

        chart.yAxis     //Chart y-axis settings
            .tickFormat(d3.format('.02f'));

        d3.select('#dailySales svg')    //Select the <svg> element you want to render the chart in.   
            .datum(salesData)         //Populate the <svg> element with chart data...
            .call(chart);          //Finally, render the chart!

        //Update the chart when window resizes.
        nv.utils.windowResize(function() { chart.update() });
        return chart;
      });
    });   
});
*/
</script>
@stop