<!DOCTYPE html>
<html lang="ar" dir="rtl">
<!-- Change to RTL in Arabic version -->

@php
$settings = \App\Bll\Site::getSettings();
$site_settings = \App\Bll\Site::getSettingsData();
@endphp

@include('site.includes.style', ['settings' => $settings])

<body>

    @include('site.layout.nav')

    <section>


        @yield('content_module')
    </section>

    @include('site.layout.footer', ['settings' => $settings])

    @include('site.includes.script')

</body>

</html>
