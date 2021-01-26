<ul class="text-sm d-inline-flex">
    @foreach($footerNavbar as $navbar)
        <li class="pr-2"><a class="hover:text-primary" href="{{addSlash2Url(route('front.page.index', $navbar->slug))}}">{{$navbar->title}}</a></li>
    @endforeach
</ul>
