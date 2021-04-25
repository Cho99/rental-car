@extends('admin.layout')

@section('content')

    <section class="content-header">
        <h1>{{ trans('car.car_register') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('car.car') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{ $car->user->name }}</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{ trans('user.email') }} </b><a class="pull-right">{{ $car->user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('user.phone') }}</b> <a
                                    class="pull-right">{{ $car->user->phone ? $car->user->phone : trans('user.unknow') }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('user.address') }}</b> <a
                                    class="pull-right">{{ $car->user->gplx ? $car->user->gplx : trans('user.unknow') }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('user.gplx') }}</b> <a
                                    class="pull-right">{{ $car->user->gplx ? $car->user->gplx : trans('user.unknow') }}</a>
                            </li>
                             <li class="list-group-item">
                                <b>{{ trans('user.phone') }}</b> <a
                                    class="pull-right">{{ $car->user->gplx ? $car->user->gplx : trans('user.unknow') }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('user.status') }}</b>
                                @if ($car->user->status <= config('user.block'))
                                    <a class="pull-right">
                                        <span class="label label-info">{{ trans('user.active') }}</span>
                                    </a>
                                @elseif ($car->user->status >= config('user.block'))
                                    <a class="pull-right">
                                        <span class="label label-danger">{{ trans('user.block') }}</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-success" id="btn-accept">
                                {{ trans('car.accept') }}
                              </button>
                            <button type="button" class="btn btn-danger" id="btn-reject">
                                {{ trans('car.reject') }}
                              </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="clearfix" id="view">
                                    <form action="" accept-charset="utf-8">
                                        <h1 class="text-center">{{ trans('car.info_car') }}</h1>
                                        <h4>{{ trans('car.created') }}: <b>{{ date('d-m-Y', strtotime($car->created_at)) }}</b>
                                        <h4>Km giới hạn: {{ $car->limited_km }} Km - Tiền phạt: {{ $car->limit_pass_fee }} K/1km</h4>
                                        <h4>Description: {{ $car->description }}</h4>
                                        <input type="hidden" value="{{ $car->id }}" id="id">
                                        <h4>
                                            {{ trans('car.status') }}: <b>
                                            @switch ($car->status)
                                                @case (config('car.pending'))
                                                    <span class="label label-warning">{{ trans('car.pending') }}</span>
                                                @break
                                                @case (config('car.accept'))
                                                    <span class="label label-primary">{{ trans('car.accept') }}</span>
                                                @break
                                                @case (config('car.reject'))
                                                    <span class="label label-danger">{{ trans('car.reject') }}</span>
                                                @break
                                                @case (config('car.borrow'))
                                                    <span class="label label-info">{{ trans('car.borrowing') }}</span>
                                                @break
                                                @case (config('car.return'))
                                                    <span class="label label-success">{{ trans('car.return') }}</span>
                                                @break
                                                @case (config('car.late'))
                                                    <span class="label label-danger">{{ trans('car.too_late') }}</span>
                                                @break
                                                @case (config('car.forget'))
                                                    <span class="label label-danger">{{ trans('car.take_car_late') }}</span>
                                                @break
                                                @default
                                            @endswitch
                                            </b>
                                        </h4>
                                        <br />
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th>{{ trans('car.image') }}</th>
                                                        <th>{{ trans('car.info') }}</th>
                                                        <th>{{ trans('car.seats') }}</th>
                                                        <th>{{ trans('car.type_of_fuel') }}</th>
                                                        <th>{{ trans('car.actions') }}</th>
                                                        <th>{{ trans('car.price') }}</th>
                                                        <th>{{ trans('car.discount') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($car->image)
                                                        @php
                                                            $image = json_decode($car->image->image_list);
                                                        @endphp
                                                        <td><img src="{{ asset('upload/car/'. $image[0]) }}" alt="{{ $car->category->name }}" width="150px"></td>
                                                    @else
                                                        <td><img src="{{ asset('images/car.jpg') }}" alt="{{ $car->category->name }}" width="150px"></td>
                                                    @endif
                                                    <td>
                                                        <p>{{ $car->category->name }} - Đời: {{ date('Y', strtotime($car->year_of_product)) }}</p>
                                                        <strong>
                                                            Biển số xe: {{ $car->license_plates }}
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        <span>{{ $car->seats }} Chỗ</span>
                                                    </td>
                                                    <td>
                                                        @if ($car->type_of_fuel === 1)
                                                            <span class="label label-warning">Số tự động</span>
                                                        @elseif ($car->type_of_fuel === 2)
                                                            <span class="label label-info">Số sàn</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($car->type_of_fuel === 1)
                                                            <span class="label label-warning">Xăng</span>
                                                        @elseif ($car->type_of_fuel === 2)
                                                            <span class="label label-danger">Dầu</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $car->price }} K
                                                    </td>
                                                    <td>
                                                        {{ $car->discount }} %
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <br>
                                <div class="post"></div>
                                    <!-- /.user-block -->
                                <div>
                                    <span>
                                        <h2>{{ trans('car.list_image') }}</h2>
                                    </span>
                                    <br>
                                    @if (isset($images))
                                    <div class="row margin-bottom">
                                        <div class="col-sm-6">
                                          <img class="img-responsive" src="{{ asset('upload/car/'. $images[0]) }}" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                          <div class="row">
                                            @foreach ($images as $image)
                                              <div class="col-sm-6">
                                                  <img class="img-responsive" src="{{ asset('upload/car/'. $image) }}" alt="Photo">
                                              </div>
                                            @endforeach
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.row -->
                                    @else
                                        <td>
                                            Chưa thêm ảnh    
                                        </td>  
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('script')
    <script>
        var url = window.location.origin;
        $('#btn-accept').click(function (e) {
            e.preventDefault();
            var id = $('#id').val();
            swal({
                title:"Bạn có chắc chắn",
                text: "Một khi đã chập thuận thì xe này sẽ được xuất hiện trên trang web",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willSave) => {
                if (willSave) {
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: url + '/admin/cars/register/accept/' + id,
                    data: {
                        'id' : id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.message === 'success') {
                            swal("Đăng ký xe thành công", {
                                icon: "success",
                            })
                            .then(() => {
                                location.href = '/admin/cars/' + id;
                            });
                        } else {
                            swal("Đăng ký xe thất bại", {
                                icon: "error",
                            })
                            .then(() => {
                                location.reload;
                            });
                        }
                    }
                });
            }
            });
        })

        $('#btn-reject').click(function (e) {
            e.preventDefault();
            var id = $('#id').val();
            swal({
                title:"Bạn có chắc chắn",
                text: "Xe này sẽ bị từ chối và sẽ không xuất hiện trên trang web của bạn",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willSave) => {
                if (willSave) {
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: url + '/admin/cars/register/reject/' + id,
                    data: {
                        'id' : id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.message === 'success') {
                            swal("Xác nhận thành công", {
                                icon: "success",
                            })
                            .then(() => {
                                location.href = '/admin/cars/' + id;
                            });
                        } else {
                            swal("Hệ thống lỗi", {
                                icon: "error",
                            })
                            .then(() => {
                                location.reload;
                            });
                        }
                    }
                });
            }
            });
        })
    </script>
@endsection