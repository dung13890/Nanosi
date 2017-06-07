<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $me->image ? route('image', $me->image_thumbnail) : asset('assets/img/backend/avatar.png') }}" class="img-circle">
            </div>
            <div class="pull-left info">
                <p>{{ str_limit($me->name, 15) }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @if (Request::is('backend')) class="active" @endif>
                <a href="{{ route('backend.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ __('repositories.dashboard') }}</span>
                </a>
            </li>
            <li @if (Request::is('backend/slide*')) class="active" @endif">
                <a href="{{ route('backend.slide.index') }}">
                    <i class="fa fa-file-image-o"></i> <span>{{ __('repositories.slide') }}</span>
                </a>
            </li>
            <li @if (Request::is('backend/page*')) class="active" @endif">
                <a href="{{ route('backend.page.index') }}">
                    <i class="fa fa-file-text-o"></i> <span>{{ __('repositories.page') }}</span>
                </a>
            </li>
            <li class="treeview @if (Request::is('backend/post*') || Request::is('backend/category/type/post*')) active @endif">
                <a href="#">
                    <i class="fa fa-book"></i> <span>{{ __('repositories.post') }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if (Request::is('backend/category/type/post*')) class="active" @endif><a href="{{ route('backend.category.type','post') }}"><i class="fa fa-circle-o"></i> {{ __('repositories.category') }}</a></li>
                    <li @if (Request::is('backend/post*')) class="active" @endif><a href="{{ route('backend.post.index') }}"><i class="fa fa-circle-o"></i> {{ __('repositories.post') }}</a></li>
                </ul>
            </li>
            <li class="treeview @if (Request::is('backend/product*') || Request::is('backend/category/type/product*')) active @endif">
                <a href="#">
                    <i class="fa fa-cube"></i> <span>{{ __('repositories.product') }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if (Request::is('backend/category/type/product*')) class="active" @endif><a href="{{ route('backend.category.type','product') }}"><i class="fa fa-circle-o"></i> {{ __('repositories.category') }}</a></li>
                    <li @if (Request::is('backend/product*')) class="active" @endif><a href="{{ route('backend.product.index') }}"><i class="fa fa-circle-o"></i> {{ __('repositories.product') }}</a></li>
                </ul>
            </li>
            <li class="header">System</li>
            <li @if (Request::is('backend/user*')) class="active" @endif">
                <a href="{{ route('backend.user.index') }}">
                    <i class="fa fa-user"></i> <span>{{ __('repositories.user') }}</span>
                </a>
            </li>
            <li @if (Request::is('backend/menu*')) class="active" @endif">
                <a href="{{ route('backend.menu.index') }}">
                    <i class="fa fa-list-ul"></i> <span>{{ __('repositories.menu') }}</span>
                </a>
            </li>
            <li @if (Request::is('backend/config*')) class="active" @endif">
                <a href="{{ route('backend.config.index') }}">
                    <i class="fa fa-wrench"></i> <span>{{ __('repositories.config') }}</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
