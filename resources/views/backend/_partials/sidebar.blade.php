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
            <li @if (Request::is('backend/page*')) class="active" @endif">
                <a href="{{ route('backend.page.index') }}">
                    <i class="fa fa-file-text-o"></i> <span>{{ __('repositories.page') }}</span>
                </a>
            </li>
            <li @if (Request::is('backend/post*')) class="active" @endif">
                <a href="{{ route('backend.post.index') }}">
                    <i class="fa fa-book"></i> <span>{{ __('repositories.post') }}</span>
                </a>
            </li>
            <li @if (Request::is('backend/product*')) class="active" @endif">
                <a href="{{ route('backend.product.index') }}">
                    <i class="fa fa-cube"></i> <span>{{ __('repositories.product') }}</span>
                </a>
            </li>
            <li class="header">System</li>
            <li @if (Request::is('backend/user*')) class="active" @endif">
                <a href="{{ route('backend.user.index') }}">
                    <i class="fa fa-user"></i> <span>{{ __('repositories.user') }}</span>
                </a>
            </li>
        </ul>
        
    </section>
</aside>
