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
                    <i class="fa fa-dashboard"></i> <span>{{ trans('repositories.dashboard') }}</span>
                </a>
            </li>
            <li class="header">System</li>
            <li @if (Request::is('backend/user*') || Request::is('backend/role*')) class="active" @endif">
                <a href="{{ route('backend.user.index') }}">
                    <i class="fa fa-user"></i> <span>{{ trans('repositories.user') }}</span>
                </a>
            </li>
        </ul>
        
    </section>
</aside>
