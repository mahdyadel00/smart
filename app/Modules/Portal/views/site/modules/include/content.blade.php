
<style>
    .nav-pills-custom .nav-vertical {
        color: #aaa;
        background: #fff;
        position: relative;
    }

    .nav-pills-custom .nav-vertical:active {
        color: #4154f1!important;
        background: #fff;
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link::before {
            content: '';
            display: block;
            border-top: 8px solid transparent;
            border-left: 10px solid #fff;
            border-bottom: 8px solid transparent;
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            opacity: 0;
        }
    }

    .nav-pills-custom .nav-link.active::before {
        opacity: 1;
    }

    .fade:not(.show) {
         opacity: 1 !important;
    }

</style>


    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($contents as $content)
                    <a class="nav-link nav-vertical mb-3 p-3 shadow" id="#{{$content->id}}" data-toggle="pill" href="#{{$content->id}}" >
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">{{$content->title}}</span></a>
                        @endforeach
                </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content tab-content-vertical" id="v-pills-tabContent">
                    @foreach($contents as $content)
                    <div class="tab-pane fade shadow rounded bg-white show p-3" id="{{$content->id}}">
                        {{--<iframe width="600" height="400" src="{{ $content->video }}" frameborder="0" allowfullscreen>--}}
                        {{--</iframe>--}}

                        <video id="my-video" class="video-js" controls preload="auto" width="200" height="100" data-setup="{}">
                            <source src="{{ $content->video }}" type='video/mp4'>
                        </video>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>



