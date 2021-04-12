<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    @auth('web')
    <!-- Right navbar links -->
    <ul class="navbar-nav @if(LaravelLocalization::getCurrentLocaleName() == 'English') ml-auto @endif " @if(LaravelLocalization::getCurrentLocaleName() == 'Arabic') style="margin-right: auto" @endif>
        <li class="dropdown dropdown-language nav-item">
            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), null, [], true) }}" data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                @if(LaravelLocalization::getCurrentLocaleName() == 'Arabic')
                    <i class="flag-icon flag-icon-eg"></i><span class="selected-language"> العربية </span>
                @else
                    <i class="flag-icon flag-icon-us"></i><span class="selected-language"> English </span>
                @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                @if(LaravelLocalization::getCurrentLocaleName() == 'Arabic')
                    <a class="dropdown-item" rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                        <i class="flag-icon flag-icon-us"></i><span> English </span></a>
                @else
                    <a class="dropdown-item" rel="alternate" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                        <i class="flag-icon flag-icon-eg"></i><span> العربية </span></a>
                @endif
            </div>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="btn btn-danger">{{__('messages.Signout')}}</a>
        </li>
    </ul>
    @endauth
</nav>
