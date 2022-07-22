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
            @include('site.modules.include.goals')
            </div>
            <div class="tab-pane" id="3a">
                    @include('site.modules.include.insturcation')
                </div>
            <div class="tab-pane" id="4a">
                @include('site.modules.include.content')

            </div>
            <div class="tab-pane" id="5a">
            @include('site.modules.include.activty')
            </div>
            <div class="tab-pane" id="6a">
                <h3>ssdasdasdasdasdasd be equal to the tab</h3>
            </div>
        </div>

    </div>





