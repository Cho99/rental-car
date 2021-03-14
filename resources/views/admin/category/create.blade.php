@extends('admin.layout')
@section('content')
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('category.category_manager') }}</h3>
    </div>
    <section class="content-header">
        <h1>{{ trans('category.category_create') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('category.category_manager') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#settings" data-toggle="tab"
                                aria-expanded="true">{{ trans('category.category_form') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form role="form" action="{{ route('admin.categories.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="namecategory">Name</label>
                                        <input type="text" name="name" class="form-control" id="namecategory"
                                            placeholder="Name Trademark" required>
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group" style="width: 100%">
                                        <label>Trademark</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            aria-hidden="true" name="parent_id">
                                            <option value="0">--- Trademark ---</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
