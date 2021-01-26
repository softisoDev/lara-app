@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(array('method' =>'POST', 'url' => addSlash2Url(route('admin.page.translation.update', $page->id)))) !!}

                    @method('PUT')

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

                    {!! Form::hidden('page_id', $page->id, array('id' => 'pageId')) !!}

                    <div class="form-group">
                        {!! Form::label('languages', 'Choose language') !!}
                        {!! Form::select('lang', $languages, $currentLang, array('class' => 'form-control', 'id' => 'languages')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', $page->title, array('class'=>'form-control', 'id'=>'title')) !!}
                        @error('title')<small class="text-red">{{$message}}</small>@enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('body', 'Body') !!}
                        {{Form::textarea('body', $page->body, array('id' => 'body'))}}
                        @error('body')<small class="text-red">{{$message}}</small>@enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('metaDesc', 'Meta Description') !!}
                        {!! Form::textarea('meta_desc', $page->meta_desc, array('class'=>'form-control', 'id'=>'metaDesc', 'rows' => 5)) !!}
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


@push('add-script')

    <script src="{{asset('admin-assets/plugins/ckeditor4/ckeditor.js')}}"></script>
    <!-- CKFinder setup -->
    @include('ckfinder::setup')
    <script src="{{asset('admin-assets/js/pages/page_add_translation.js')}}"></script>

@endpush
