@extends('admin.layout')
@section('content')
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('feature.feature_manager') }}</h3>
    </div>
    <section class="content-header">
        <h1>{{ trans('feature.feature_create') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('feature.feature_manager') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#settings" data-toggle="tab"
                                aria-expanded="true">{{ trans('feature.feature_form') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form role="form" action="{{ route('admin.features.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="nameFeature">Name Feature</label>
                                        <input type="text" name="name" class="form-control" id="nameFeature"
                                            placeholder="Name Feature" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image input</label>
                                        <input type="file" id="image" name="image">
                                        <p class="help-block">Preview Image</p>
                                        <img src="" alt="" id="img-preview">
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
    <script src="{{ asset('js/previewImage.js') }}"></script>
@endsection
