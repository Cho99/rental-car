@extends('admin.layout')

@section('css')
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
</style>
@endsection

@section('content')
    <section class="content-header">
        <h1>{{ trans('category.category_manager') }}</h1>
        <div class="timeline-footer general">
            <button href="" class="btn btn-primary btn general" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus-square general"></i> {{ trans('category.add_category') }}
            </button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{ trans('category.category_create') }}</h4>
                        </div>
                        <form role="form" id="form">
                            @csrf
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="namecategory">Name</label>
                                        <input type="text" name="name" class="form-control" id="namecategory"
                                            placeholder="Name Trademark" required>
                                            <div class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
        <ol class="breadcrumb">
            <li>{{ trans('category.category') }}</li>
        </ol>
        @if (session()->has('infoMessage'))
            <div class="infoMessage">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bell-o"></i>
                            {{ trans('category.notifi') }}
                        </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
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
                        <h3 class="box-title">{{ trans('category.trademark_list') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div id="livesearch"></div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th>
                                                    {{ trans('admin.stt') }} </th>
                                                <th>
                                                    {{ trans('category.trademark') }}</th>
                                                <th>
                                                    {{ trans('admin.actions') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="table">
                                            @php($index = 1)
                                                @foreach ($categories as $category)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{ $index++ }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td class="td general">
                                                            <a href="{{ route('admin.categories.show', $category->id) }}"><i
                                                                    class="fa fa-eye"></i></a>
                                                            <a href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <form
                                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                                method="POST" class="delete delete-form general"
                                                                id="delete_{{ $category->id }}">
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
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            })
        })
    </script>
    <script src="{{ asset('js/createTrademark.js') }}"> </script>
@endsection