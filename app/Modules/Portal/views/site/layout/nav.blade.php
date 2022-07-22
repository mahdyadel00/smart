@php
if (Auth()->check()){
$modules = App\Modules\Admin\Models\Modules\Modules::where('group_module_id',Auth()->user()->group_id)->with('Data')->get();
}

@endphp
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between" style="max-width: fit-content;">
        <nav id="navbar" class="navbar text-center">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center mx-auto">
                <img src="{{ asset('site') }}/img/logo.png" alt="">
                <span>{{ _i('Smart Agent') }}</span>
            </a>
            <ul>
                {{-- <li><a class="nav-link scrollto {{ request()->is('/*') ? 'active' : '' }}"
                        href="{{ route('home') }}">{{ _i('Home') }}</a></li> --}}
                <li><a class="nav-link scrollto {{ request()->is('/*') ? 'active' : '' }}"
                        href="#about">{{ _i('Main Goals') }}</a></li>
                <li><a class="nav-link scrollto {{ request()->is('/*') ? 'active' : '' }}"
                        href="#services">{{ _i('Main Insturcation') }}</a></li>
                @auth
                    <li><a class="nav-link scrollto {{ request()->is('quiz*') ? 'active' : '' }}"
                            href="{{ route('quiz') }}">{{ _i('Befor Quiz') }}</a></li>
                @if(Auth()->user()->group_id != null)
                    <li class="dropdown"><a href="#"><span>{{ _i('All Modules') }}</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            @foreach ($modules as $module)
                                <li><a
                                        href="{{ route('content.index' , $module->id) }}">{{ $module->data->isNotEmpty() ? $module->Data->first()->title : '' }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    @else
                        <li class="dropdown"><a href="#"><span>{{ _i('All Modules') }}</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a class="btn openModal">{{ _i('Please Choose Group') }}</a class></li>
                            </ul>
                        </li>
                    @endif
                    <li><a class="nav-link scrollto {{ request()->is('quiz*') ? 'active' : '' }}"
                            href="{{ route('quiz') }}">{{ _i('After Quiz') }}</a></li>
                @endauth
                @guest
                    <li><a class="nav-link scrollto " href="{{ route('login') }}">{{ _i('Befor Quiz') }}</a></li>
                    <li class="dropdown"><a href="#"><span>{{ _i('All Modules') }}</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('login') }}">{{ _i('Please login to view modules') }}</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="{{ route('login') }}">{{ _i('After Quiz') }}</a></li>
                @endguest
                <li><a class="nav-link scrollto {{ request()->is('/*') ? 'active' : '' }}"
                        href="#portfolio">{{ _i('Help') }}</a></li>
                {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}
                {{-- <li><a href="blog.html">Blog</a></li> --}}
                {{-- <ul>
            <li><a href="#">Drop Down 1</a></li>
            <li class="dropdown"><a href="#"><span> Drop Down</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>
                <li><a href="#">Deep Drop Down 2</a></li>
                <li><a href="#">Deep Drop Down 3</a></li>
                <li><a href="#">Deep Drop Down 4</a></li>
                <li><a href="#">Deep Drop Down 5</a></li>
              </ul>
            </li>
            <li><a href="#">Drop Down 2</a></li>
            <li><a href="#">Drop Down 3</a></li>
            <li><a href="#">Drop Down 4</a></li>
          </ul> --}}
                <li><a class="nav-link scrollto {{ request()->is('contact-us*') ? 'active' : '' }}"
                        href="{{ route('contact') }}">{{ _i('contacts') }}</a></li>
                @auth
                    <li><a class="getstarted scrollto" href="{{ route('logout') }}">{{ _i('Logout') }}</a></li>
                    <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }}</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                                <li><a
                                        href="{{ route('my_profile') }}">{{ _i('My Profile') }}</a>
                                </li>

                        </ul>
                    </li>
                @endauth
                @guest
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">{{ _i('get_started') }}</a></li>
                @endguest
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>
