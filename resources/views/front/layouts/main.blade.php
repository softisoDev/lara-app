<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.includes.head')
    @include('front.includes.main_css')
    @stack('add-style')

</head>
<body class="font-body">

@include('front.includes.header')

<div class="wrapper overflow-hidden">

    @yield('content')

    @include('front.includes.footer')

</div>

@include('front.includes.main_js')
<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });


        return false;
    });
</script>
@stack('add-script')
</body>
</html>
