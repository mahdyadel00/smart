
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('site') }}/img/logo.png" alt="">
        <span>{{ _i('Smart Agent') }}</span>
      </a>

      <nav id="navbar" class="navbar text-center">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">{{ _i('Interoduction') }}</a></li>
          <li><a class="nav-link scrollto" href="#about">{{ _i('Goals') }}</a></li>
          <li><a class="nav-link scrollto" href="#services">{{ _i('Insturcation Module') }}</a></li>
          <li><a class="nav-link scrollto" href="#">{{ _i('Content') }}</a></li>
          <li><a class="nav-link scrollto" href="#">{{ _i('Activity') }}</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">{{ _i('After Quiz') }}</a></li>

          {{--  <li><a class="getstarted scrollto" href="{{ route('login') }}">{{ _i('get_started') }}</a></li>  --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
