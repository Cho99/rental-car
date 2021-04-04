@extends('admin.layout')

@section('content')
    <section class="content-header">
        <h1>{{ trans('car.car_manager') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('car.car') }}</li>
        </ol>
        @if (session()->has('infoMessage'))
            <div class="infoMessage">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bell-o"></i>
                            {{ trans('car.notifi') }}
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        {{ session()->get('infoMessage') }}
                    </div>
                </div>
            </div>
        @endif
    </section>
   <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('car.car_list') }}</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs">
                                <input type="text" onkeyup="showResult(this.value)" name="search"
                                    class="form-control pull-right" placeholder="{{ trans('car.car_search') }}"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div id="livesearch"></div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    {{ trans('admin.stt') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    {{ trans('user.email') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    {{ trans('car.info') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    {{ trans('car.image') }}</th>
                                                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    {{ trans('car.price') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    {{ trans('car.discount') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    {{ trans('car.status') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    {{ trans('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 1
                                            @endphp
                                                @foreach ($cars as $car)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{ $index++ }}</td>
                                                        <td>
                                                            {{ $car->user->email }}
                                                        </td>
                                                        <td>
                                                            <p>{{ $car->category->name }} -  Đời: {{ date('Y', strtotime($car->year_of_product)) }}</p>
                                                            <p>Biển số xe: {{ $car->license_plates }}</p>
                                                        </td>
                                                        @php
                                                            $image = null;
                                                            if (!empty($car->image)) {
                                                                $image = json_decode($car->image->image_list);
                                                            }
                                                        @endphp
                                                        @if (isset($image))
                                                            <td><img src="{{ asset('upload/car/'. $image[0]) }}" alt="{{ $car->category->name }}" width="150px"></td>
                                                        @else
                                                            <td><img src="{{ asset('images/car.jpg') }}" alt="{{ $car->category->name }}" width="150px"></td>  
                                                        @endif
                                                        <td>
                                                            <strong>{{ $car->price }} K</strong>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $car->discount }} %</strong>
                                                        </td>
                                                        <td>
                                                            @if ($car->status === 2) 
                                                                <span class="label label-info">
                                                                    Được phép lưu hành
                                                                </span>
                                                            @elseif ($car->status === 3) 
                                                                <span class="label label-danger">
                                                                    Được được thuê
                                                                </span>
                                                            @elseif ($car->status === 4) 
                                                                <span class="label label-danger">
                                                                    Bị khóa
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="td general">
                                                            <a href="{{ route('admin.cars.show', $car->id) }}"><i 
                                                                class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
    </section>
@endsection

@section('script')
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <script>
        $(function() {
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })

    </script>
@endsection
