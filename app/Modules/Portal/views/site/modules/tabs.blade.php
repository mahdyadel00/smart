@php
     $module= App\Modules\Admin\Models\Modules\Modules::with('Data')->where('id',request()->id)->first();
@endphp
    <div class="container pd-50 pt-50"><h4 class="text-center">{{$module->Data?$module->Data->first()->title : ''}}  </h4></div>
    <div id="exTab1" class="container-fluid container-xl tabs-module">
        <nav id="navbar" class="navbar text-center">
        <ul  class="nav nav-pills ">
            <li class="active">
                <a class="nav-link scrollto"  href="#1a" data-toggle="tab">{{ _i('Interoduction') }}</a>
            </li>
            <li><a class="nav-link scrollto" href="#2a" data-toggle="tab">{{ _i('Goals') }}</a>
            </li>
            <li><a class="nav-link scrollto" href="#3a" data-toggle="tab">{{ _i('Insturcation Module') }}</a>
            </li>
            <li><a class="nav-link scrollto" href="#4a" data-toggle="tab">{{ _i('Content') }}</a>
            </li>
            <li><a class="nav-link scrollto" href="#5a" data-toggle="tab">{{ _i('Activity') }}</a>
            </li>
            <li><a class="nav-link scrollto" href="#6a" data-toggle="tab">{{ _i('After Quiz') }}</a>
            </li>
        </ul>
        </nav>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
                @include('site.modules.include.home')

            </div>
            <div class="tab-pane" id="2a">
                <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
            </div>
            <div class="tab-pane" id="3a">
                <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
            </div>
            <div class="tab-pane" id="4a">
                @include('site.modules.include.content')

            </div>
            <div class="tab-pane" id="5a">
                <h3>tesasdddddddddddddddddssss</h3>
            </div>
            <div class="tab-pane" id="6a">
                <h3>ssdasdasdasdasdasd be equal to the tab</h3>
            </div>
        </div>

    </div>





