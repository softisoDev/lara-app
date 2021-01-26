<!-- navbar -->

<nav class="navbar navbar-expand-md navbar-light bg-white navbar-shadow fixed-top">

    <a href="{{addSlash2Url(route('admin.dashboard'))}}" class="navbar-brand">WebsiteName</a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="{{addSlash2Url(route('admin.dashboard'))}}" class="nav-item nav-link active">Dashboard</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-dark" data-toggle="dropdown">Pages</a>
                <div class="dropdown-menu">
                    <a href="{{addSlash2Url(route('admin.page.index'))}}" class="dropdown-item">List</a>
                    <a href="{{addSlash2Url(route('admin.page.create'))}}" class="dropdown-item">Create</a>
                    <a href="{{addSlash2Url(route('admin.page.order'))}}" class="dropdown-item">Order Pages</a>
                </div>
            </div>
        </div>

        <div class="navbar-nav">
            <a href="{{addSlash2Url(route('logout'))}}" class="nav-item nav-link"><i class="fas fa-sign-out-alt"></i> Log out</a>
        </div>
    </div>
</nav>
