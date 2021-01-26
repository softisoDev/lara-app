@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-10 col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="p-3 text-right">
                        <a href="{{addSlash2Url(route('admin.page.create'))}}" class="btn btn-sm btn-success"><i
                                class="fas fa-plus"></i> Create new page</a>
                    </div>

                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Type</th>
                                <th scope="col">Title</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{$page->id}}</td>
                                    <td>{{$page->getMenuTypeHuman()}}</td>
                                    <td>{{$page->title}}</td>
                                    <td>{{$page->slug}}</td>
                                    <td class="w-1">{!! generateStatusBadge($page->status) !!}</td>
                                    <td class="w-25">
                                        <a href="{{addSlash2Url(route('admin.page.edit', $page->id))}}"
                                           class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Edit</a>
                                        <a href="{{addSlash2Url(route('front.page.index', $page->slug))}}" target="_blank"
                                           class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a>
                                        <a href="{{addSlash2Url(route('admin.page.translation.add',['id' =>  $page->id, 'lang' => config('app.locale')]))}}"
                                           target="_blank" class="btn btn-warning btn-sm">
                                            <i class="fas fa-language"></i> Translate
                                        </a>
                                        <button
                                            onclick="removeData('{{addSlash2Url(route("admin.page.destroy", $page->id))}}', {{$page->id}})"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-lg-1"></div>
    </div>
@endsection
