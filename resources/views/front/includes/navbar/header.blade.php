<nav class="nav"><h2 class="hidden">Top navigation</h2>
    <ul id="nav_menu" class="nav__menu">
        @foreach($headerNavbar as $navbar)
            @if($navbar->children()->count())
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{$navbar->title}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($navbar->children->currentLanguage() as $child)
                            <a class="dropdown-item"
                               href="{{addSlash2Url(route('front.page.index', $child->slug))}}">{{$child->title}}</a>
                        @endforeach
                    </div>
                </li>
            @else
                <a href="{{addSlash2Url(route('front.page.index', $navbar->slug))}}">
                    <li>{{$navbar->title}}</li>
                </a>
            @endif
        @endforeach
        <?php /*
        <!-- start languages -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                {{app('languages')[app()->getLocale()]}}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach(app('languages') as $code => $language)
                    <a class="dropdown-item" href="{{addSlash2Url(url("/$code"))}}">{{$language}}</a>
                @endforeach
            </div>
        </li>
        <!-- end languages -->
        */ ?>
    </ul>
    <button id="nav_menu_button" class="nav__menu-button"><span></span> <span></span> <span></span></button>
</nav>


