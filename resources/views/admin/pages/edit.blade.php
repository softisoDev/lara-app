@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            {!! Form::open(array('method' =>'POST', 'url' => addSlash2Url(route('admin.page.update', $page->id)), 'enctype' => 'multipart/form-data')) !!}

            @method('PUT')

            @if(session()->has('success'))
                <div class="form-group">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{session()->get('success') ? "Update success" : "Update failed"}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <h3>{!! $page->currentLanguage->first()->title !!}</h3>
            </div>

            <div class="form-group">
                {!! Form::label('pageType', 'Menu type') !!}
                {!! Form::select('type[]', $menuType, $page->type, array('class' => 'form-control', 'id' => 'pageType', 'multiple' => 'multiple')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('status', 'Status') !!}
                {!! Form::select('status', statusSelect(), $page->status, array('class' => 'form-control', 'id' => 'status')) !!}
            </div>

            <div class="form-group text-right">
                <a href="{{addSlash2Url(route('admin.page.index'))}}" class="btn btn-danger">Cancel</a>
                {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
            </div>


            {!! Form::close() !!}
        </div>
        <div class="col-md-2 col-lg-2"></div>
    </div>
@endsection

@push('add-style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/css/bootstrap-select.min.css">
@endpush

@push('add-script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/js/bootstrap-select.min.js"></script>

    <script src="{{asset('admin-assets/js/pages/page_edit.js')}}"></script>
@endpush
