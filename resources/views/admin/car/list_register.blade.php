@extends('admin.layout')

@section('content')
    <section class="content-header">
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
                        <h3 class="box-title">@lang('car.car_register')</h3>
                    </div>
                    <!-- /.box-header -->
                    <div id="livesearch"></div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-hover dataTable" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th>
                                                    {{ trans('admin.stt') }}</th>
                                                <th>
                                                    {{ trans('user.email') }}</th>
                                                <th>
                                                    {{ trans('car.info') }}</th>
                                                <th>
                                                    {{ trans('car.image') }}</th>
                                                <th>
                                                    {{ trans('car.price') }}</th>
                                                <th >
                                                    {{ trans('car.status') }}</th>
                                                <th>
                                                    {{ trans('admin.actions') }}
                                            </th>
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
                                                        @if ($car->image)
                                                            @php
                                                                $image = json_decode($car->image->image_list);
                                                            @endphp
                                                            <td><img src="{{ asset('upload/car/'. $image[0]) }}" alt="{{ $car->category->name }}" width="150px"></td>
                                                        @else
                                                            <td><img src="{{ asset('images/car.jpg') }}" alt="{{ $car->category->name }}" width="150px"></td>
                                                        @endif
                                                       
                                                        <td>
                                                            <strong>{{ currency_format($car->price) }} VNĐ</strong> 
                                                        </td>
                                                        <td>
                                                            <span class="label label-warning">
                                                                {{ $car->status == 0 ? 'Đang chờ' : 'Từ Chối'}}
                                                            </span>
                                                        </td>                                                       
                                                        <td class="td general">
                                                            <a href="{{ route('admin.cars.register', $car->id) }}"><i 
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
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                "columnDefs": [
                    { "orderable": false, "targets": [3,6] }
                ],
            })
        })
    </script>
@endsection
