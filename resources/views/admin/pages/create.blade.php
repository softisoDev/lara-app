@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(array('method' =>'POST', 'url' => addSlash2Url(route('admin.page.store')))) !!}

                    @if(session()->has('success'))
                        <div class="form-group">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>{{session()->get('success') ? "Success" : "Failed"}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        {!! Form::label('pageType', 'Menu type') !!}
                        {!! Form::select('type[]', $menuType, 0, array('class' => 'form-control', 'id' => 'pageType', 'multiple' => 'multiple')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('parentPage', 'Parent Page') !!}
                        {!! Form::select('parent_page', $parentPage, 0, array('class' => 'form-control', 'id' => 'parentPage')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, array('class'=>'form-control', 'id'=>'title')) !!}
                        @error('title')<small class="text-red">{{$message}}</small>@enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('body', 'Body') !!}
                        {{Form::textarea('body', null, array('id' => 'body'))}}
                        @error('body')<small class="text-red">{{$message}}</small>@enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('metaDesc', 'Meta Description') !!}
                        {!! Form::textarea('meta_desc', null, array('class'=>'form-control', 'id'=>'metaDesc', 'rows' => 5)) !!}
                    </div>

                    <div class="form-group text-right">
                        <a href="{{addSlash2Url(route('admin.page.index'))}}" class="btn btn-danger">Cancel</a>
                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
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

    <script src="{{asset('admin-assets/plugins/ckeditor4/ckeditor.js')}}"></script>
    <!-- CKFinder setup -->
    @include('ckfinder::setup')
    <script src="{{asset('admin-assets/js/pages/page_create.js')}}"></script>

@endpush
