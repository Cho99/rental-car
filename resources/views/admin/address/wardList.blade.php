@extends('admin.layout')
@section('content')
    <section class="content-header">
        <h1>{{ trans('address.wards_manager') }}</h1>
        <div class="timeline-footer general">
            <a href="{{ route('admin.create-district') }}" class="btn btn-primary btn general">
                <i class="fa fa-plus-square general"></i> {{ trans('address.add_district') }}
            </a>
            <a href="{{ route('admin.create-ward') }}" class="btn btn-primary btn general">
                <i class="fa fa-plus-square general"></i> {{ trans('address.add_ward') }}
            </a>
        </div>
        <ol class="breadcrumb">
            <li>{{ trans('address.address') }}</li>
        </ol>
        @if (session()->has('infoMessage'))
            <div class="infoMessage">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bell-o"></i>
                            {{ trans('address.notifi') }}
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
                        <h3 class="box-title">{{ trans('address.address_list') }}</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs">
                                <input type="text" onkeyup="showResult(this.value)" name="search"
                                    class="form-control pull-right" placeholder="{{ trans('address.address_search') }}"
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
                                                    {{ trans('admin.stt') }} </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    {{ trans('address.name') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    {{ trans('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($index = 1)
                                                @foreach ($wards as $ward)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{ $index++ }}</td>
                                                        <td>{{ $ward->name }}</td>
                                                        <td class="td general">
                                                            <a href="{{ route('admin.addresses.edit', $ward->id) }}"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <form
                                                                action="{{ route('admin.addresses.destroy', $ward->id) }}"
                                                                method="POST" class="delete delete-form general"
                                                                id="delete_{{ $ward->id }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
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
