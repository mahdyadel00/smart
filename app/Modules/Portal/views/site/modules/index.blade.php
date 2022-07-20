@extends('site.modules.content')

@section('title', _i('Modules'))

@section('content_module')

    <?php
        $images = \App\Bll\Site::get_default_images();
        $site_settings = \App\Bll\Site::getSettingsData();

    ?>



@endsection
