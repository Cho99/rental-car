@extends('admin.layout')
@section('content')
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('address.address_manager') }}</h3>
    </div>
    <section class="content-header">
        <h1>{{ trans('address.address_edit') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('address.address_manager') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#settings" data-toggle="tab"
                                aria-expanded="true">{{ trans('address.address_form') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal" action="{{ route('admin.addresses.update', $address->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                @if (!empty($districts))
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="Ward"
                                            value="{{ $address->name }}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                    <br>
                                    <div class="input-group" style="width: 100%">
                                        <label>Districts</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            aria-hidden="true" name="parent_id">
                                            @foreach ($districts as $district)
                                                @if ($district->id === $address->parent_id)
                                                    <option value="{{ $district->id }}" selected>{{ $district->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="District"
                                            value="{{ $address->name }}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                @endif
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                    <input type="text" name="parent_id" class="form-control" value="Hà Nội" disabled>
                                </div>
                                <br>
                                <div class="input-group">
                                    <div>
                                        <button type="submit" id="add"
                                            class="btn btn-danger">{{ trans('address.edit_submit_button') }}</button>
                                        <a href="{{ route('admin.addresses.index') }}"
                                            class="btn btn-info quaylai">{{ trans('admin.return') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('.select2').select2()

    </script>
@endsection
