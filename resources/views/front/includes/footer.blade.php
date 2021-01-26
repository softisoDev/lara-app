<footer class="footer bg-tertiary text-white text-center">
    <div class="container mx-auto py-4 text-center">
        @include('front.includes.navbar.footer')
        <hr class="white-line"/>
        <ul class="text-sm d-inline-flex">
            @foreach(app('languages') as $code => $language)
                <li class="pr-2"><a class="hover:text-primary" href="{{addSlash2Url(url("/$code"))}}">{{$language}}</a></li>
            @endforeach
        </ul>
    </div>
</footer>
