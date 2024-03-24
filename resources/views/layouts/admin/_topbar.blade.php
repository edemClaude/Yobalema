<div class="d-flex align-items-center justify-content-between">
    @if(Route::has('admin.dashboard'))
        <a href="{{ route('accueil') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('admin/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">{{ config('app.name', 'Yobalema') }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    @endif
</div><!-- End Logo -->

<div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div><!-- End Search Bar -->
