@extends('admin.layout')

@section('content')
    <section class="content-header">
        <h1>{{ trans('car.car_manager') }}</h1>
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
                            @if ($car->status !== config('define.car.status.reject'))
                                @if ($car->status !== config('define.car.status.block'))
                                    <button type="button" class="btn btn-danger" id="btn-block">
                                        {{ trans('car.block') }}
                                    </button>
                                @elseif ($car->status === config('define.car.status.block'))
                                    <button type="button" class="btn btn-info" id="btn-unblock">
                                        {{ trans('car.unblock') }}
                                    </button>
                                @endif
                            @endif
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
                                        @if ($car->status !== config('define.car.status.reject'))
                                            <h4>
                                                {{ trans('car.status') }}: <b>
                                                @switch ($car->status)
                                                    @case (config('define.car.status.pending'))
                                                        <span class="label label-warning">Được phép lưu hành</span>
                                                    @break
                                                    @case (config('define.car.status.renting'))
                                                        <span class="label label-danger">Đang được thuê</span>
                                                    @break
                                                    @case (config('define.car.status.block'))
                                                        <span class="label label-danger">Bị khóa</span>
                                                    @break
                                                    @default
                                                @endswitch
                                                </b>
                                            </h4>
                                        @else 
                                        <h4>
                                            {{ trans('car.status') }}: <b>
                                                <span class="label label-danger">Xe bị từ chối đăng ký</span>
                                            </b>
                                        </h4>
                                        @endif
                                      
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
                                    @php
                                        $images = null;
                                        if (!empty($car->image)) {
                                            $images = json_decode($car->image->image_list);
                                        }
                                    @endphp
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
        $('#btn-block').click(function (e) {
            e.preventDefault();
            var id = $('#id').val();
            swal({
                title:"Bạn có chắc chắn",
                text: "Block xe này",
                icon: "danger",
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
                    url: url + '/admin/cars/register/block/' + id,
                    data: {
                        'id' : id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.message === 'success') {
                            swal("Block xe thành coong", {
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
        });

        $('#btn-unblock').click(function (e) {
            e.preventDefault();
            var id = $('#id').val();
            swal({
                title:"Bạn có chắc chắn",
                text: "Mở khóa cho xe này",
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
                    url: url + '/admin/cars/register/unblock/' + id,
                    data: {
                        'id' : id,
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.message === 'success') {
                            swal("Bỏ chặn xe thành công", {
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
        });
</script>
@endsection