@extends('admin.layout')
@section('content')
        <section class="content-header">
            <h1>{{ trans('dashboard.dashboard') }}</h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>
                            <h3 class="box-title">{{ trans('dashboard.name') }}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                              <canvas id="barChart" style="height: 230px; width: 510px;" height="230" width="510"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('script')
    <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
