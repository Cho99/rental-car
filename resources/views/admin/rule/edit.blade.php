@extends('admin.layout')
@section('content')
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('rule.rule_manager') }}</h3>
    </div>
    <section class="content-header">
        <h1>{{ trans('rule.rule_edit') }}</h1>
        <ol class="breadcrumb">
            <li>{{ trans('rule.rule_manager') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#settings" data-toggle="tab"
                                aria-expanded="true">{{ trans('rule.rule_form') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form role="form" action="{{ route('admin.rules.update', $rule->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="namerule">Name rule</label>
                                        <input type="text" name="name" class="form-control" value="{{ $rule->name }}"
                                            id="namerule" placeholder="Name rule" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image input</label>
                                        <input type="file" id="image" name="image">
                                        <p class="help-block">Preview Image</p>
                                        <img src="{{ asset('upload/rule/' . $rule->image) }}"
                                            alt="{{ $rule->name }}" id="img-preview" width="60px">
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
