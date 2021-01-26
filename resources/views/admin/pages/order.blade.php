@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3 col-lg-3"></div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="p-2 text-center">
                        <button type="button" class="btn btn-primary" onclick="updateTree('{{addSlash2Url(route('admin.page.order.set'))}}')">Update tree</button>
                    </div>

                    <div class="myadmin-dd-empty dd" id="nestable2">
                        <ol class="dd-list">

                            @foreach($pages as $page)
                                <li class="dd-item dd3-item" data-id="{{$page->id}}" data-status="{{$page->status}}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content"> {{$page->title}}</div>
                                    @if(count($page->children->currentLanguage()) > 0)
                                        <ol class="dd-list">
                                            @foreach($page->children as $child)
                                                @include('admin.pages.includes.order_nest', $child)
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>
                            @endforeach

                        </ol>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3"></div>
    </div>
@endsection

@push('add-style')
    {{--  nestable  --}}
    <link href="{{asset('admin-assets/plugins/nestable/nestable.css')}}" rel="stylesheet">
@endpush

@push('add-script')
    {{--  nestable  --}}
    <script src="{{asset('admin-assets/plugins/nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('admin-assets/js/pages/page_order.js')}}"></script>
@endpush
