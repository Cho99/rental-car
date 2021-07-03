@extends('admin.layout')
@section('content')
    <section class="content-header">
        <h1>{{ trans('report.report_manager') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('report.report') }}</li>
        </ol>
        @if (session()->has('infoMessage'))
            <div class="infoMessage">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bell-o"></i>
                            {{ trans('report.notifi') }}
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
                        <h3 class="box-title">{{ trans('report.report_list') }}</h3>
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
                                                    {{ trans('report.user_name') }}</th>
                                                <th>
                                                    {{ trans('report.car') }}</th>
                                                <th>
                                                    {{ trans('report.description') }}</th>
                                                <th>
                                                    {{ trans('report.status') }}</th>
                                                <th>
                                                    {{ trans('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($index = 1)
                                                @foreach ($reports as $report)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{ $index++ }}</td>
                                                        <td>{{ $report->user->name }}</td>
                                                        <td>{{ $report->car->license_plates }}</td>
                                                        <td>{{ $report->description }}</td>
                                                        <td><span class="label label-{{ $report->status_class }}">{{ $report->status_name }}</span></td>
                                                        <td class="td general">
                                                            @if ($report->status == App\Models\Report::UNREAD)
                                                                <a href="" data-toggle="modal" data-target="#modal-default-{{ $report->id }}"><i
                                                                    class="fa fa-reply"></i></a>
                                                            @endif
                                                            <div class="modal fade" id="modal-default-{{ $report->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">{{ trans('report.reply') }}</h4>
                                                                        </div>
                                                                        <form role="form" action="{{ route('admin.reports.reply', $report->id) }}" id="form">
                                                                            <div class="modal-body">
                                                                                <div class="box-body">
                                                                                    <div class="form-group">
                                                                                        <label for="namecategory">@lang('report.description')</label>
                                                                                        <textarea class="form-control" id="namecategory" rows="3" name="description"></textarea>
                                                                                    </div>
                                                                                    <p class="error description"></p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
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
                    { "orderable": false, "targets": 5 }
                ]
            })
        })
 
        $('.btn-primary').click(function (e) { 
            e.preventDefault();

            let form = $(this).parents('form');
            let formData = form.serializeArray();
        
            form.find('.error').text('');

            $.ajax({
                type: "POST",
                url: form.attr('action'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType: "json",
                success: function () {
                    $('.modal').hide();
                    swal("Phản hồi thành côngs", {
                    icon: "success",
                    })
                    .then(() => {
                        return location.reload();
                    });
                },
                error: function (error) {
                    if (error.responseJSON) {
                        $.each(error.responseJSON.errors, function (indexInArray, valueOfElement) { 
                            form.find('.' + indexInArray).text(valueOfElement)
                        });
                    }
                    
                }
            });
        });
           
    </script>
@endsection
