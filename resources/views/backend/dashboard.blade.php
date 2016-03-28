@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('after-styles-end')
    {!! Html::style('js/backend/plugin/chartjs/Chart.css') !!}
@stop
@section('content')
    <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

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
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Revenue</p>
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
              <h3>44</h3>

              <p>Guests</p>
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
              <h3>65</h3>

              <p>Sales</p>
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
        <section class="col-lg-6 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Revenue Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="dailyRevenue" style="height:250px"></canvas>
                <div id="dailyRevenueLegend" class="chart-legend"></div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        <section class="col-lg-6 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Revenue Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="monthlyRevenue" style="height:250px"></canvas>
                <div id="monthlyRevenueLegend" class="chart-legend"></div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        <section class="col-lg-6 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Yearly Revenue Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="yearlyRevenue" style="height:250px"></canvas>
                <div id="yearlyRevenueLegend" class="chart-legend"></div>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
        </section>
        <section class="col-lg-6 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Last 10 Days Revenue & Account Receiveable</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="dailySales" style="height:250px"></canvas>
                <div id="salesLegend" class="chart-legend"></div>
              </div>
            </div>
            <!-- /.box-body -->
</div>
        </section>
    </div>
    
@endsection
@section('after-scripts-end')
<script>
        //Being injected from FrontendController
        console.log(test);
</script>
{!! Html::script('js/backend/plugin/chartjs/Chart.min.js') !!}
<script>
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
        var dso = document.getElementById("dailySales").getContext("2d");
        var dailySalesOutChart = new Chart(dso).Line(data);
        document.getElementById("salesLegend").innerHTML = dailySalesOutChart.generateLegend();
    });   
});
</script>
@stop